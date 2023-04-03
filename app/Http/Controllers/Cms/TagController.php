<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagValRequest;
use App\Models\TagModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class TagController extends Controller
{
    public function index()
    {
        $dbResult = TagModel::all();
        return view('pages.Tag')->with('data', $dbResult);
    }

    public function getAllTag()
    {
        try {
            $dbResult = TagModel::all();
            $tag = array(
                'data' => $dbResult,
                'code' => 201
            );
        } catch (\Throwable $th) {
            $tag = array(
                'response' => array(
                    'icon' => 'error',
                    'title' => 'Gagal',
                    'message' => $th->getMessage(),
                ),
                'code' => 500
            );
        }

        return response()->json($tag, $tag['code']);
    }

    public function createTag(TagValRequest $request)
    {
        try {
            $dbResult = TagModel::create($request->all());
            $tag = array(
                'data' => $dbResult,
                'response' => array(
                    'icon' => 'success',
                    'title' => 'Tersimpan',
                    'message' => 'Data berhasil disimpan',
                ),
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

        return response()->json($tag, $tag['code']);
    }

    public function getTagById($idTag)
    {
        $id = Crypt::decrypt($idTag);
        try {
            $dbResult = TagModel::whereId($id)->first();
            if ($dbResult) {
                $tag = array(
                    'data' => $dbResult,
                    'code' => 201
                );
            } else {
                $tag = array(
                    'data' => null,
                    'response' => array(
                        'icon' => 'warning',
                        'title' => 'Tidak Ditemukan',
                        'message' => 'Data tidak tersedia',
                    ),
                    'code' => 404
                );
            }
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

        return response()->json($tag, $tag['code']);
    }

    public function updateTag(TagValRequest $request, $idTag)
    {
        try {
            $id = Crypt::decrypt($idTag);
            $dbCon = TagModel::whereId($id);
            $findId = $dbCon->first();

            $request->updated_at = Carbon::now();


            if ($findId) {
                $tag = array(
                    'data' => $dbCon->update($request->all()),
                    'response' => array(
                        'icon' => 'success',
                        'title' => 'Tersimpan',
                        'message' => 'Data berhasil disimpan',
                    ),
                    'code' => 201
                );
            } else {
                $tag = array(
                    'data' => null,
                    'response' => array(
                        'icon' => 'warning',
                        'title' => 'Tidak Ditemukan',
                        'message' => 'Data tidak tersedia',
                    ),
                    'code' => 404
                );
            }
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

        return response()->json($tag, $tag['code']);
    }

    public function deleteTag($idTag)
    {
        try {
            $id = Crypt::decrypt($idTag);
            $dbCon = TagModel::whereId($id);
            $findId = $dbCon->first();
            if ($findId) {
                $tag = array(
                    'data' => $dbCon->delete(),
                    'response' => array(
                        'icon' => 'success',
                        'title' => 'Tersimpan',
                        'message' => 'Data berhasil disimpan',
                    ),
                    'code' => 201
                );
            } else {
                $tag = array(
                    'data' => null,
                    'response' => array(
                        'icon' => 'warning',
                        'title' => 'Tidak Ditemukan',
                        'message' => 'Data tidak tersedia',
                    ),
                    'code' => 404
                );
            }
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

        return response()->json($tag, $tag['code']);
    }
}
