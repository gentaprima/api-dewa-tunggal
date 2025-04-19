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
        $user = ModelUsers::create([
            'email'     => $request->email,
            'nama_lengkap'  => $request->fullName,
            'nomor_telepon'        => $request->phoneNumber,
            'password'      => Hash::make($request->password),
            'role'  => 0
        ]);

        $verificationUrl = url('/verify-email/' . Str::random(64));
        Mail::to($user->email)->send(new VerifyEmail($user, $verificationUrl));

        return response()->json([
            'status' => true,
            'message' => "Users berhasil ditambahkan",
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
}
