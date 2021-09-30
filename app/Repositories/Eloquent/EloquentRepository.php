<?php

namespace App\Repositories\Eloquent;

abstract class EloquentRepository implements RepositoryInterface
{
    protected $_model;

    /**
     * EloquentRepository constructor.
     */
    public function __construct()
    {
        $this->setModel();
    }

    /**
     * @return mixed
     */
    abstract public function getModel();

    /**
     * Set model function
     */
    public function setModel()
    {
        $this->_model = app()->make(
            $this->getModel()
        );
    }

    /**
     * Function list all record no using condition
     *
     * @return mixed
     */
    public function listAll()
    {
        return $this->_model->get();
    }

    /**
     * Function get all record and order by id using param $orderBy
     *
     * @param int $paginate
     * @param string $orderBy (asc or desc)
     * @return mixed
     */
    public function getAll($paginate, $orderBy)
    {
        return $this->_model->orderBy('id', $orderBy)->paginate($paginate);
    }

    /**
     * Function find an record using id param
     *
     * @param int $id
     * @return mixed
     */
    public function find($id)
    {
        $result = $this->_model->find($id);

        return $result;
    }

    /**
     * Function create an record using array attribute
     *
     * @param array $attribute
     * @return bool
     */
    public function create(array $attribute)
    {
        $create = $this->_model->create($attribute);
        if ($create) {
            return $create;
        }

        return false;
    }

    /**
     * Function update an record using attribute and id int
     *
     * @param array $attribute
     * @param int $id
     * @return bool
     */
    public function update(array $attribute, $id)
    {
        $model = $this->_model->findOrFail($id);
        $model->fill($attribute);
        if ($model->save()) {
            return true;
        }

        return false;
    }

    /**
     * Function delete an record using id
     *
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        $result = $this->_model->find($id);
        if ($result) {
            if ($result->delete($id)) {
                return true;
            }

            return false;
        }

        return false;
    }

    /**
     * Get all data of table wwith relations
     *
     * @param  null  $relations
     * @return mixed
     */
    public function getList($relations = null)
    {
        $model = $this->_model;
        if ($relations) {
            $model = $model->with($relations);
        }

        return $model->get();
    }

    /**
     * Get all data of table with relations and status
     *
     * @param  int  $status status of data to get
     * @param  array  $relations relations of model in DB default null
     * @return mixed
     */
    public function getListByStatus($status, $relations = null)
    {
        $model = $this->_model;
        $model = $model->where('status', '=', $status);
        if ($relations) {
            $model = $model->with($relations);
        }

        return $model->get();
    }
}
