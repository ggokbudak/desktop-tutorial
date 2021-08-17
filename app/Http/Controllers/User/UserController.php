<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use JWTAuth;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Requests\RegistrationFormRequest;
class UserController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    public function profileabout()
    {
        $task = $this->user;

        if (!$task) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, task with id ' . $id . ' cannot be found.'
            ], 400);
        }

        return $task;
    }

    public function uploadImage(Request $request)
    {
        $image = $request->image;  // your base64 encoded
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = str_random(10).'.'.'png';
        \File::put(storage_path(). '/profileimages/' . $imageName, base64_decode($image));

        $this->user->pic = '/profileimages/' . $imageName;
        $this->user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Güncellendi'
        ], 200);
    }
    public function update(Request $request)
    {
        $userName = $request->name;  // your base64 encoded
        $this->user->name =  $userName;
        $this->user->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Güncellendi'
        ], 200);
    }
    public function updatePass(Request $request)
    {
        $password = $request->password;  // your base64 encoded
        $this->user->password = bcrypt($password);
        $this->user->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Şifre Güncellendi'
        ], 200);
    }
}
