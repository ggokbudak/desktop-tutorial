<?php

namespace App\Http\Controllers;

use JWTAuth;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Requests\RegistrationFormRequest;

use App\Models\Messages;


class ApiController extends Controller
{
    /**
     * @var bool
     */
    public $loginAfterSignUp = true;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
public function getArrayData($degisken) {
        $returnData =  str_replace(['[', ']'], "", $degisken);
        $returnData = explode(',', $returnData);
        return $returnData;
    }

public function login(Request $request)
    {
        $input = $request->only('email', 'password');
        $token = null;

        if (!$token = JWTAuth::attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
                'error' => 'Kullanıcı Adı veya Şifre Hatalı'
            ], 402);
        }
        $currentUser = Auth::user();
        $currentUser->accessToken = $token;
        $currentUser->success = true;
        $currentUser->token = $token;
        $currentUser->role = $this->getArrayData($currentUser->roleData->permissions);

        if ($request->type == "web") {

            if (!in_array("20",  $currentUser->role) ) {
                return response()->json([
                    'success' => false,
                    'error' => 'Bu İşlemi Yapmaya Yetkiniz Yok'
                ], 400);
                exit;
            }


        }  else {

            if (!in_array("21",  $currentUser->role)) {
                return response()->json([
                    'success' => false,
                    'error' => 'Bu İşlemi Yapmaya Yetkiniz Yok'
                ], 400);
                exit;
            }


        }

        if ($currentUser->active ==0 ) {
            return response()->json([
                'success' => false,
                'error' => 'Aktif bir kullanıcı değilsiniz lütfen Nereye Atayım ile iletişime geçiniz'
            ], 400);
            exit;
        }
        return response()->json($currentUser);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function logout(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        try {
            JWTAuth::invalidate($request->token);

            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], 500);
        }
    }

    /**
     * @param RegistrationFormRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegistrationFormRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        if ($this->loginAfterSignUp) {
            return $this->login($request);
        }

        return response()->json([
            'success'   =>  true,
            'data'      =>  $user
        ], 200);
    }


    
}
