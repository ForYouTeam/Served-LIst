<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Models\TaskModel;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $data = TaskModel::with('prioritasRole', 'tagsRole', 'staffRole')->get();

        return view('Pages.Task')->with('data', $data);
    }

    public function updateRealtime($id, Request $request)
    {
        try {
            $dbCon = TaskModel::whereId($id);
            $findId = $dbCon->first();
            if ($findId) {
                $result = array(
                    'data' => $dbCon->update($request->all()),
                    'message' => 'success',
                    'code' => 201
                );
            } else {
                $result = array(
                    'data' => null,
                    'message' => 'not found',
                    'code' => 404
                );
            }
        } catch (\Throwable $th) {
            $result = array(
                'data' => null,
                'message' => $th->getMessage(),
                'code' => 500
            );
        }

        return response()->json($result);
    }

    public function createTask(TaskRequest $request)
    {
        return response()->json($request->all());
    }
}
