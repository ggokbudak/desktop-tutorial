<?php

namespace App\Http\Controllers\Permissions;

use App\Http\Controllers\Controller;
use JWTAuth;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Requests\RegistrationFormRequest;
use App\Models\Permissions;

class PermissionController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    public function find(Request $request)
    {
        $permissions =  Permissions::Where('name', 'like', '%' . $request->search . '%')->orderBy($request->sort, $request->order? $request->order : 'DESC')->with('parent')->skip(($request->page * $request->pageSize) - $request->pageSize)->take($request->page * $request->pageSize)->get();
        $totalPermissions =Permissions::Where('name', 'like', '%' . $request->search . '%')->orderBy($request->sort, $request->order? $request->order : 'DESC')->with('parent')->count();
        $returnData = [
            'total' => $totalPermissions,
            'data' => $permissions,
        ];
        return response()->json($returnData, 200);
    }

    public function allAna(Request $request)
    {
        $permissions = Permissions::where('level', true)->orderBy('name', 'ASC')->get();
        return $permissions;


    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $task = new Permissions();
        $task->name = $request->name;
        $task->level = $request->level;
        $task->parentId = $request->parentId;

        if ($task->save())
            return response()->json([
                'success' => true,
                'task' => $task,
                'message' => 'Kayıt Oluşturuldu'
            ]);
        else
            return response()->json([
                'success' => false,
                'error' => 'Hata'
            ]);
    }

    public function edit(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $task = Permissions::find($request->id);
        $task->name = $request->name;
        $task->level = $request->level;
        $task->parentId = $request->parentId;

        if ($task->save())
            return response()->json([
                'success' => true,
                'task' => $task,
                'message' => 'Güncellendi'
            ]);
        else
            return response()->json([
                'success' => false,
                'error' => 'Hata'
            ]);
    }

    public function delete(Request $request, $id)
    {


        $task = Permissions::find($id);


        if ($task->delete())
            return response()->json([
                'success' => true,
                'message' => 'Silindi'
            ]);
        else
            return response()->json([
                'success' => false,
                'error' => 'Hata'
            ]);
    }
}
