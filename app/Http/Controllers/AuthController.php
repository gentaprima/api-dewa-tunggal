<?php

namespace App\Http\Controllers;

use App\Models\ModelUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function auth(Request $request){

        $getData = ModelUsers::where('email',$request->email)->first();
        

        if($getData == null){
            return response()->json([
                'status' => false,
                'message' => "Mohon maaf akun tidak ditemukan.",
            ]);
        }

        if(!Hash::check($request->password, $getData->password)){
            return response()->json([
                'status' => false,
                'message' => "Mohon maaf, Email atau Password tidak sesuai.",
            ]);
        }

        if($getData->is_active == 0){
            return response()->json([
                'status' => false,
                'message' => "Mohon maaf, akun tersebut belum aktif.",
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => "successfully login.",
            'data' => $getData
        ]);
    }
}
