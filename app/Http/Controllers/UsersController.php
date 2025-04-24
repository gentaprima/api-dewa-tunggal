<?php

namespace App\Http\Controllers;

use App\Models\ModelUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Mail\VerifyEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    public function store(Request $request)
    {
        $cekUsers = DB::table('tbl_users')->where('email','=',$request->email)->first();
        if($cekUsers != null){
            return response()->json([
                'status' => false,
                'message' => "Email sudah digunakan, silahkan gunakan email lain.",
            ]); 
        }

        $user = ModelUsers::create([
            'email'     => $request->email,
            'nama_lengkap'  => $request->fullName,
            'nomor_telepon'        => $request->phoneNumber,
            'password'      => Hash::make($request->password),
            'role'  => 0,
            'email_verification_token' => Str::random(64),
            'is_active' => 0
        ]);

        $verificationUrl = url('/api/verify-email/' . $user->email_verification_token);
        Mail::to($user->email)->send(new VerifyEmail($user, $verificationUrl));

        return response()->json([
            'status' => true,
            'message' => "Pendaftaran akun berhasil, silahkan konfirmasi email untuk bisa login.",
        ]);
    }

    public function getUsers($id)
    {
        $data = DB::table('tbl_users')->where('id', '=', $id)->first();
        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    public function verifyEmail($token){
        $users = DB::table('tbl_users')->where('email_verification_token','=',$token)->first();
        if ($users) {
            DB::table('tbl_users')
                ->where('email_verification_token', '=', $token)
                ->update([
                    'is_active' => 1,
                ]);
        }

        return redirect()->away('https://dewatunggalabadi.co.id/');
    }

    public function getDataUsers(){
        $data = DB::table('tbl_users')->where('role','=',0)->get();
        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }
}
