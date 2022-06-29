<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Http\Requests\PrioritasRequest;
use App\Models\PrioritasModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class PrioritasController extends Controller
{
    public function index()
    {
        $dbResult = PrioritasModel::all();
        return view('pages.Prioritas')->with('data', $dbResult);
    }

    public function getAllPrioritas()
    {
        try {
            $dbResult = PrioritasModel::all();
            $prioritas = array(
                'data' => $dbResult,
                'code' => 201
            );
        } catch (\Throwable $th) {
            $prioritas = array(
                'response' => array(
                    'icon' => 'error',
                    'title' => 'Gagal',
                    'message' => $th->getMessage(),
                ),
                'code' => 500
            );
        }

        return response()->json($prioritas, $prioritas['code']);
    }

    public function createPrioritas(PrioritasRequest $request)
    {
        try {
            $dbResult = PrioritasModel::create($request->all());
            $prioritas = array(
                'data' => $dbResult,
                'response' => array(
                    'icon' => 'success',
                    'title' => 'Tersimpan',
                    'message' => 'Data berhasil disimpan',
                ),
                'code' => 201
            );
        } catch (\Throwable $th) {
            $prioritas = array(
                'data' => null,
                'response' => array(
                    'icon' => 'error',
                    'title' => 'Gagal',
                    'message' => $th->getMessage(),
                ),
                'code' => 500
            );
        }

        return response()->json($prioritas, $prioritas['code']);
    }

    public function getPrioritasById($idPrioritas)
    {
        $id = Crypt::decrypt($idPrioritas);
        try {
            $dbResult = PrioritasModel::whereId($id)->first();
            if ($dbResult) {
                $prioritas = array(
                    'data' => $dbResult,
                    'code' => 201
                );
            } else {
                $prioritas = array(
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
            $prioritas = array(
                'data' => null,
                'response' => array(
                    'icon' => 'error',
                    'title' => 'Gagal',
                    'message' => $th->getMessage(),
                ),
                'code' => 500
            );
        }

        return response()->json($prioritas, $prioritas['code']);
    }

    public function updatePrioritas(PrioritasRequest $request, $idPrioritas)
    {
        try {
            $id = Crypt::decrypt($idPrioritas);
            $dbCon = PrioritasModel::whereId($id);
            $findId = $dbCon->first();

            $request->updated_at = Carbon::now();


            if ($findId) {
                $prioritas = array(
                    'data' => $dbCon->update($request->all()),
                    'response' => array(
                        'icon' => 'success',
                        'title' => 'Tersimpan',
                        'message' => 'Data berhasil disimpan',
                    ),
                    'code' => 201
                );
            } else {
                $prioritas = array(
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
            $prioritas = array(
                'data' => null,
                'response' => array(
                    'icon' => 'error',
                    'title' => 'Gagal',
                    'message' => $th->getMessage(),
                ),
                'code' => 500
            );
        }

        return response()->json($prioritas, $prioritas['code']);
    }

    public function deletePrioritas($idPrioritas)
    {
        try {
            $id = Crypt::decrypt($idPrioritas);
            $dbCon = PrioritasModel::whereId($id);
            $findId = $dbCon->first();
            if ($findId) {
                $prioritas = array(
                    'data' => $dbCon->delete(),
                    'response' => array(
                        'icon' => 'success',
                        'title' => 'Tersimpan',
                        'message' => 'Data berhasil disimpan',
                    ),
                    'code' => 201
                );
            } else {
                $prioritas = array(
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
            $prioritas = array(
                'data' => null,
                'response' => array(
                    'icon' => 'error',
                    'title' => 'Gagal',
                    'message' => $th->getMessage(),
                ),
                'code' => 500
            );
        }

        return response()->json($prioritas, $prioritas['code']);
    }
}
