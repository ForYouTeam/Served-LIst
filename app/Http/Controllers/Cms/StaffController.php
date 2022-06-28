<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\StaffModel;
use Illuminate\Http\Request;

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
}
