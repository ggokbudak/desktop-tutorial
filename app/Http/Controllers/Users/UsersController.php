<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use JWTAuth;
use Illuminate\Http\Request;
use App\Models\Permissions;
use App\Models\Roles;
use App\User;
use App\Models\BelediyeUser;

class UsersController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    public function find(Request $request)
    {
        $permissions =  User::Where('name', 'like', '%' . $request->search . '%')->orderBy($request->sort, $request->order? $request->order : 'DESC')->with('roleData', 'belediyeProfil', 'firmaProfil' , 'ureticiProfil')->skip(($request->page * $request->pageSize) - $request->pageSize)->take($request->page * $request->pageSize)->get();
        $totalPermissions =User::Where('name', 'like', '%' . $request->search . '%')->orderBy($request->sort, $request->order? $request->order : 'DESC')->count();
        $returnData = [
            'total' => $totalPermissions,
            'data' => $permissions,
        ];
        return response()->json($returnData, 200);
    }

    public function roles(Request $request)
    {
        $permissions = Roles::orderBy('title', 'ASC')->get();
        return $permissions;


    }
  
    

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'roles' => 'required',
            'password' => 'min:6',
            'confirmPassword' => 'required_with:password|same:password|min:6'
        ]);

        $task = new User();
        $task->name = $request->name;
        $task->email = $request->email;
        $task->active = $request->active;
        $task->roles = $request->roles;
        $task->password = bcrypt($request->password);

        if ($task->save())
            return response()->json([
                'success' => true,
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
            'email' => 'required',
            'roles' => 'required',
        ]);

        $task = User::find($request->id);
        $task->name = $request->name;
        $task->email = $request->email;
        $task->active = $request->active;
        $task->roles = $request->roles;

        if ($task->save())
            return response()->json([
                'success' => true,
                'message' => 'Güncellendi'
            ]);
        else
            return response()->json([
                'success' => false,
                'error' => 'Hata'
            ]);
    }

    public function editPass(Request $request)
    {
        $this->validate($request, [
            'password' => 'min:6',
            'confirmPassword' => 'required_with:password|same:password|min:6'
        ]);

        $task = User::find($request->id);
        $task->password = bcrypt($request->password);

        if ($task->save())
            return response()->json([
                'success' => true,
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
