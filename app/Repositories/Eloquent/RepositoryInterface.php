<?php
namespace App\Repositories\Eloquent;

interface RepositoryInterface
{
    // list all record no using condition
    public function listAll();

    // param orderBy: asc or desc string
    public function getAll($paginate, $orderBy);

    // Detail a record
    public function find($id);

    // create a record, param an array attribute
    public function create(array $attribute);

    // update a record, param an array attribute and id of the record
    public function update(array $attribute, $id);

    // delete a record, param an if of the record
    public function delete($id);

    // get list data of table with relations
    public function getList($relations = null);

    //Get all data of table with relations and status
    public function getListByStatus($status, $relations = null);
}
