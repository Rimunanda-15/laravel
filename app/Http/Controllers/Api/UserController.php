<?php

namespace App\Http\Controllers\Api;
use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getAllUser()
    {
        $data = User::select('id', 'fullname', 'email', 'address', 'phoneNumber', 'birthdate', 'agama', 'jenis_kelamin')->get();
        return response()->json([
            'List User ' => $data
        ]);
    }
}
