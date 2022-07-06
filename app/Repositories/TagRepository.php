<?php

namespace App\Repositories;

use App\Interfaces\TagRepositoryInterface;
use App\Models\DetailTagModel;
use App\Models\TagModel;

class TagRepository implements TagRepositoryInterface
{
    public function createTag(array $newDetail)
    {
        try {
            $dbResult = TagModel::create($newDetail);
            $tag = array(
                'data' => $dbResult,
                'message' => 'Data berhasil disimpan',
                'code' => 201
            );
        } catch (\Throwable $th) {
            $tag = array(
                'data' => null,
                'response' => array(
                    'icon' => 'error',
                    'title' => 'Gagal',
                    'message' => $th->getMessage(),
                ),
                'code' => 500
            );
        }

        return $tag;
    }

    public function createDetailTag(array $newDetail)
    {
        try {
            $dbResult = DetailTagModel::create($newDetail);
            $tag = array(
                'data' => $dbResult,
                'message' => 'Data berhasil disimpan',
                'code' => 201
            );
        } catch (\Throwable $th) {
            $tag = array(
                'data' => null,
                'response' => array(
                    'icon' => 'error',
                    'title' => 'Gagal',
                    'message' => $th->getMessage(),
                ),
                'code' => 500
            );
        }

        return $tag;
    }
}
