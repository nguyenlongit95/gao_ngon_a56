<?php

namespace App\Repositories\Tags;

use App\Models\ProductTags;
use App\Models\Tags;
use App\Repositories\Eloquent\EloquentRepository;

class TagsEloquentRepository extends EloquentRepository implements TagsRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getModel()
    {
        return Tags::class;
    }

    /**
     * @param object $tags an tags
     * @return mixed
     */
    public function checkDataDepend($tags)
    {
        return ProductTags::where('tags_id', $tags->id)->count();
    }
}
