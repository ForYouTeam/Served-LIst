<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Interfaces\TagRepositoryInterface;
use App\Models\DetailTagModel;
use App\Models\StaffModel;
use App\Models\TagModel;
use App\Models\TaskModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function __construct(TagRepositoryInterface $tagrepository)
    {
        $this->tagrepository = $tagrepository;
    }
    public function index()
    {
        $iduser = Auth::user()->id;
        $user = User::whereId($iduser)->first();
        if ($user->hasRole('super-admin')) {
            $data = TaskModel::with('prioritasRole', 'tagsRole.tagRole', 'staffRole')->get();
        } else {
            $staff = StaffModel::where('id_user', $iduser)->value('id');
            $data = TaskModel::where('id_staff', $staff)->with('prioritasRole', 'tagsRole.tagRole', 'staffRole')->get();
        }
        return view('pages.Task')->with('data', $data);
    }

    public function updateRealtime($id, Request $request)
    {
        // return response()->json($request->all(), 500);
        try {
            $dbCon = TaskModel::whereId($id);
            $findId = $dbCon->first();
            $tag = $request->tags ? explode(",", $request->tags) : null;
            if ($findId) {
                $result = array(
                    'data' => $dbCon->update($request->except('tags')),
                    'response' => array(
                        'icon' => 'success',
                        'title' => 'Update Berhasil',
                        'message' => 'Data berhasil diperbaharui',
                    ),
                    'code' => 201
                );
                if ($tag) {
                    foreach ($tag as $key => $value) {
                        $tgid = TagModel::where('id', $value)->orWhere('nama_tag', $value)->first();

                        if ($tgid == null) {
                            $newTag = $this->tagrepository->createTag([
                                'nama_tag' => $value,
                                'deskripsi' => '-'
                            ]);
                            $this->tagrepository->createDetailTag([
                                'id_tag' => $newTag['data']->id,
                                'id_task' => $id
                            ]);
                        } else {
                            $checkdetail = DetailTagModel::where('id_task', $id)->where('id_tag', $tgid->id)->first();
                            if ($checkdetail == null) {
                                $this->tagrepository->createDetailTag([
                                    'id_tag' => $tgid->id,
                                    'id_task' => $id
                                ]);
                            }
                        }
                    }
                }
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
                'response' => array(
                    'icon' => 'error',
                    'title' => 'Gagal',
                    'message' => $th->getMessage(),
                ),
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

    public function getById($id)
    {
        try {
            $dbResult = TaskModel::whereId($id)->with('tagsRole.tagRole')->first();
            if ($dbResult) {
                $task = array(
                    'data' => $dbResult,
                    'response' => array(
                        'icon' => 'success',
                        'title' => 'Tersimpan',
                        'message' => 'Data berhasil disimpan',
                    ),
                    'code' => 201
                );
            } else {
                $task = array(
                    'data' => $dbResult,
                    'message' => 'Data tidak tersedia',
                    'code' => 404
                );
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

    public function deleteTag($id, $idtask)
    {
        if (is_string($id)) {
            $findtag = TagModel::where('nama_tag', $id)->value('id');
            $finddetailtag = DetailTagModel::where('id_task', $idtask)->where('id_tag', $findtag);
        } else {
            $finddetailtag = DetailTagModel::where('id_task', $idtask)->where('id_tag', $id);
        }

        try {
            if ($finddetailtag->first()) {
                $finddetailtag->delete();
                $response = array(
                    'message' => 'Success',
                    'code' => 201
                );
            } else {
                $response = array(
                    'message' => 'Not Found',
                    'code' => 404
                );
            }
        } catch (\Throwable $th) {
            $response = array(
                'message' => $th->getMessage(),
                'code' => 500
            );
        }

        return response()->json($response, $response['code']);
    }

    public function deleteTask($id)
    {
        try {
            $findTask = TaskModel::whereId($id);
            if ($findTask->first()) {
                DetailTagModel::where('id_task', $id)->delete();
                $task = array(
                    'data' => $findTask->delete(),
                    'response' => array(
                        'icon' => 'success',
                        'title' => 'Terhapus',
                        'message' => 'Data berhasil dihapus',
                    ),
                    'code' => 201
                );
            } else {
                $task = array(
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
