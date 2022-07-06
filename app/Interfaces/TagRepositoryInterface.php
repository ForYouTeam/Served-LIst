<?php

namespace App\Interfaces;

interface TagRepositoryInterface
{
    public function createTag(array $newDetail);
    public function createDetailTag(array $newDetail);
}
