<?php

namespace App\Http\Controllers\Messages;

use App\Http\Controllers\Controller;

use App\Models\Messages;

use JWTAuth;
use Illuminate\Http\Request;




use App\User;


class MessagesController extends Controller
{
    protected $user;
    public function getArrayData($degisken) {
        $returnData =  str_replace(['[', ']'], "", $degisken);
        $returnData = explode(',', $returnData);
        return $returnData;
    }
    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        
        $user_uretici = User::where('id', $this->user->id)->pluck('id');
        $this->role = $this->getArrayData($this->user->roleData->permissions);

        $this->userPermData = [
     
            'user_uretici' => $user_uretici
        ];
    }

    public function find(Request $request)
    {
        if (!in_array("41", $this->role)) {
            return response()->json([
                'success' => false,
                'error' => 'Bu İşlemi Yapmaya Yetkiniz Yok'
            ], 400);
            exit;
        }
        $searchData = $request->search;
        

        $permissions = new Messages();
        $permissions = $permissions->where(function($q) {
            $q->orWhereIn('user_id', $this->userPermData['user_uretici']);
     
        });
        if(isset($searchData) AND $searchData != '') {
            $this->searchData = $searchData;
            $permissions = $permissions->where(function($q) {
                $q->Where('id', 'like', '%' . $this->searchData . '%');
                $q->orWhere('name', 'like', '%' . $this->searchData . '%');
            });
        }

        $permissions = $permissions->orderBy($request->sort, $request->order? $request->order : 'DESC')
        ->skip(($request->page * $request->pageSize) - $request->pageSize)
        ->take($request->pageSize)

        ->get();



        $totalPermissions = new Messages();
        $totalPermissions = $totalPermissions->where(function($q) {
            $q->orWhereIn('user_id', $this->userPermData['user_uretici']);
        });
        if(isset($searchData) AND $searchData != '') {
            $this->searchData = $searchData;
            $totalPermissions = $totalPermissions->where(function($q) {
                $q->Where('id', 'like', '%' . $this->searchData . '%');
                $q->orWhere('plaka', 'like', '%' . $this->searchData . '%');
                $q->orWhere('name', 'like', '%' . $this->searchData . '%');

            });
        }


        $totalPermissions = $totalPermissions->count();

        $returnData = [
            'recordsTotal' => $totalPermissions,
            'data' => $permissions,
        ];
        return response()->json($returnData, 200);
    }



    public function create(Request $request)
    {

        if (!in_array("41", $this->role)) {
            return response()->json([
                'success' => false,
                'error' => 'Bu İşlemi Yapmaya Yetkiniz Yok'
            ], 400);
            exit;
        }
        $user_id = $this->user->id;

     
     
        $task = new Messages();
        $task->name = $request->name;
   
      
        $task->aciklama = $request->aciklama;
        $task->email = $request->email;


        $task->user_id = $user_id;
   

        if ($task->save()){
            {
               $details = [
                   'title' => 'Sayın ' .$task->name.' ',
                   'body' => ''.$task->aciklama. ' ',
                   'body2'  => '(Bu mesaj Mail Bilgi Yönetim Platformu tarafından bilgi amaçlı  gönderilmektedir.  LÜTFEN CEVAPLAMAYINIZ.  )'
               ];
              
               \Mail::to($request->email)->send(new \App\Mail\MyTestMail($details));
           
          
           }
        
            return response()->json([
                'success' => true,
                'message' => 'Kayıt Oluşturuldu'
            ]);
        }
        else
            return response()->json([
                'success' => false,
                'error' => 'Hata'
            ]);
        
    }


    public function edit(Request $request)
    {

        if (!in_array("41", $this->role)) {
            return response()->json([
                'success' => false,
                'error' => 'Bu İşlemi Yapmaya Yetkiniz Yok'
            ], 400);
            exit;
        }
        $this->validate($request, [
            'name' => 'required',
            'plaka' => 'required',
            'aciklama' => 'required',

        ]);
        if($request->firma_id || $request->belediye_id) {
        
        $task = Messages::find($request->id);
        $task->name = $request->name;
   
        $task->aciklama = $request->aciklama;
      
     
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
        } else
        return response()->json([
            'success' => false,
            'error' => 'Hata'
        ]);
    }



    public function delete(Request $request, $id)
    {

        if (!in_array("41", $this->role)) {
            return response()->json([
                'success' => false,
                'error' => 'Bu İşlemi Yapmaya Yetkiniz Yok'
            ], 400);
            exit;
        }
        $task = Messages::find($request->id);


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
