<?php

namespace App\Http\Controllers\Roles;

use App\Http\Controllers\Controller;
use JWTAuth;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Requests\RegistrationFormRequest;
use App\Models\Permissions;
use App\Models\Roles;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Expr\Cast\Object_;

class RolesController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    public function find(Request $request)
    {
        $permissions = Roles::Where('title', 'like', '%' . $request->search . '%')->orderBy($request->sort, $request->order? $request->order : 'DESC')->skip(($request->page * $request->pageSize) - $request->pageSize)->take($request->page * $request->pageSize)->get();
        $totalPermissions = Roles::Where('title', 'like', '%' . $request->search . '%')->orderBy($request->sort, $request->order? $request->order : 'DESC')->count();

        foreach ($permissions as $key => $value) {
            $data = Permissions::WhereIn('id', $this->getArrayData($value->permissions))->get();
            $permissions[$key]->permissions = $data;
        }

        $returnData = [
            'total' => $totalPermissions,
            'data' => $permissions,
        ];
        return response()->json($returnData, 200);


    }

    public function getArrayData($degisken) {
        $returnData =  str_replace(['[', ']'], "", $degisken);
        $returnData = explode(',', $returnData);
        return $returnData;
    }

    public function permissions(Request $request)
    {
        $result = [];
        $permissions = Permissions::where('level', true)->orderBy('name', 'ASC')->get();

        foreach ($permissions as $value) {
            $altPermissions = Permissions::where('parentId', $value->id)->orderBy('name', 'ASC')->pluck('name');
            $result[$value->name] = $altPermissions;
        }

        return $result;


    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);

        $ara = [];

        foreach ($request->selected as $value) {
            array_push($ara,  $value['item']);
        };

        $altPermissions = Permissions::whereIn('name', $ara)->orderBy('name', 'ASC')->pluck('id');

        $task = new Roles();
        $task->title = $request->title;
        $task->permissions = $altPermissions;

        if ($task->save())
            return response()->json([
                'success' => true,
                'task' => $altPermissions,
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
            'title' => 'required',
        ]);

        $ara = [];

        foreach ($request->selected as $value) {
            array_push($ara,  $value['item']);
        };

        $altPermissions = Permissions::whereIn('name', $ara)->orderBy('name', 'ASC')->pluck('id');

        $task = Roles::find($request->id);
        $task->title = $request->title;
        $task->permissions = $altPermissions;

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


        $task = Roles::find($id);


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
