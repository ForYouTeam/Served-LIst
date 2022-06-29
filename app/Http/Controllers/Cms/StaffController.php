<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Http\Requests\StaffRequest;
use App\Models\StaffModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class StaffController extends Controller
{
    public function index()
    {
        $dbResult = StaffModel::with('userRole')->get();
        return view('pages.Staff')->with('data', $dbResult);
    }

    public function getAllStaff()
    {
        try {
            $dbResult = StaffModel::with('userRole')->get();
            $staff = array(
                'data' => $dbResult,
                'code' => 201
            );
        } catch (\Throwable $th) {
            $staff = array(
                'response' => array(
                    'icon' => 'error',
                    'title' => 'Gagal',
                    'message' => $th->getMessage(),
                ),
                'code' => 500
            );
        }

        return response()->json($staff, $staff['code']);
    }

    public function createStaff(StaffRequest $request)
    {
        try {
            $dbResult = StaffModel::create($request->all());
            $staff = array(
                'data' => $dbResult,
                'response' => array(
                    'icon' => 'success',
                    'title' => 'Tersimpan',
                    'message' => 'Data berhasil disimpan',
                ),
                'code' => 201
            );
        } catch (\Throwable $th) {
            $staff = array(
                'data' => null,
                'response' => array(
                    'icon' => 'error',
                    'title' => 'Gagal',
                    'message' => $th->getMessage(),
                ),
                'code' => 500
            );
        }

        return response()->json($staff, $staff['code']);
    }

    public function getStaffById($idStaff)
    {
        $id = Crypt::decrypt($idStaff);
        try {
            $dbResult = StaffModel::whereId($id)->first();
            if ($dbResult) {
                $staff = array(
                    'data' => $dbResult,
                    'code' => 201
                );
            } else {
                $staff = array(
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
            $staff = array(
                'data' => null,
                'response' => array(
                    'icon' => 'error',
                    'title' => 'Gagal',
                    'message' => $th->getMessage(),
                ),
                'code' => 500
            );
        }

        return response()->json($staff, $staff['code']);
    }

    public function updateStaff(StaffRequest $request, $idStaff)
    {
        try {
            $id = Crypt::decrypt($idStaff);
            $dbCon = StaffModel::whereId($id);
            $findId = $dbCon->first();

            $request->updated_at = Carbon::now();


            if ($findId) {
                $staff = array(
                    'data' => $dbCon->update($request->all()),
                    'response' => array(
                        'icon' => 'success',
                        'title' => 'Tersimpan',
                        'message' => 'Data berhasil disimpan',
                    ),
                    'code' => 201
                );
            } else {
                $staff = array(
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
            $staff = array(
                'data' => null,
                'response' => array(
                    'icon' => 'error',
                    'title' => 'Gagal',
                    'message' => $th->getMessage(),
                ),
                'code' => 500
            );
        }

        return response()->json($staff, $staff['code']);
    }

    public function deleteStaff($idStaff)
    {
        try {
            $id = Crypt::decrypt($idStaff);
            $dbCon = StaffModel::whereId($id);
            $findId = $dbCon->first();
            if ($findId) {
                $staff = array(
                    'data' => $dbCon->delete(),
                    'response' => array(
                        'icon' => 'success',
                        'title' => 'Tersimpan',
                        'message' => 'Data berhasil disimpan',
                    ),
                    'code' => 201
                );
            } else {
                $staff = array(
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
            $staff = array(
                'data' => null,
                'response' => array(
                    'icon' => 'error',
                    'title' => 'Gagal',
                    'message' => $th->getMessage(),
                ),
                'code' => 500
            );
        }

        return response()->json($staff, $staff['code']);
    }
}
