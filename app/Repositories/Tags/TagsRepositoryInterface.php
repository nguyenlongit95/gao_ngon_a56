<?php

namespace App\Repositories\Tags;

interface TagsRepositoryInterface
{
    /**
     * @param object $tags an tags
     * @return mixed
     */
    public function checkDataDepend($tags);
}
