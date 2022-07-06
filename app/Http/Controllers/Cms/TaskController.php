<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Interfaces\TagRepositoryInterface;
use App\Models\TagModel;
use App\Models\TaskModel;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(TagRepositoryInterface $tagrepository)
    {
        $this->tagrepository = $tagrepository;
    }
    public function index()
    {
        $data = TaskModel::with('prioritasRole', 'tagsRole.tagRole', 'staffRole')->get();
        // return response()->json($data[0]);
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
        $data = $request->only([
            'code_task', 'nama_task', 'level_prioritas', 'id_staff', 'deskripsi',
        ]);
        $tag = explode(",", $request->tags);
        try {
            $dbResult = TaskModel::create($data);
            $task = array(
                'data' => $dbResult,
                'response' => array(
                    'icon' => 'success',
                    'title' => 'Tersimpan',
                    'message' => 'Data berhasil disimpan',
                ),
                'code' => 201
            );
            foreach ($tag as $key => $value) {
                $resTag = TagModel::whereId($value)->first();
                if ($resTag) {
                    $this->tagrepository->createDetailTag([
                        'id_tag' => $resTag->id,
                        'id_task' => $dbResult->id
                    ]);
                } else {
                    $newTag = $this->tagrepository->createTag([
                        'nama_tag' => $value,
                        'deskripsi' => '-'
                    ]);
                    $this->tagrepository->createDetailTag([
                        'id_tag' => $newTag['data']->id,
                        'id_task' => $dbResult->id
                    ]);
                }
            }
        } catch (\Throwable $th) {
            $task = array(
                'data' => null,
                'response' => array(
                    'icon' => 'error',
                    'title' => 'Gagal',
                    'message' => $th->getMessage(),
                ),
                'code' => 500
            );
        }
        return response()->json($task, $task['code']);
    }
}
