<?php

namespace App\Http\Controllers;

use App\Models\ModelUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function store(Request $request){
        ModelUsers::create([
            'email'     => $request->email,
            'nama_lengkap'  => $request->fullName,
            'nomor_telepon'        => $request->phoneNumber,
            'password'      => Hash::make($request->password),
            'role'  => 0
        ]);

        return response()->json([
            'status' => true,
            'message' => "Users berhasil ditambahkan",
        ]);
    }
}
