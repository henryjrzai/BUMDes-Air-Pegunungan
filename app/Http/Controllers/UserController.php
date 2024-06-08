<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
// use DataTables;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables as DataTables;

class UserController extends Controller
{
    public function index() { return view('admin.index'); }

    public function users() { return view('admin.users'); }

    public function showUsers() 
    { 
        $users = User::all();
        return DataTables::of($users)->make(true); 
    }

    public function destroy($email)
    {
        //delete user by email
        User::where('email', $email)->delete();

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Pengguna Berhasil Dihapus!.',
        ]); 
    }

    public function store(Request $request)
    {
        //validate request
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'role' => 'required',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->role = $request->role;
        $user->save();

        //create new user
        if($user) {
            //redirect with success message
            return response()->json([
                'success' => true,
                'message' => 'Data Pengguna Berhasil Ditambahkan!.',
            ]);
        } else {
            //redirect with error message
            return response()->json([
                'success' => false,
                'message' => 'Data Pengguna Gagal Ditambahkan!.',
            ]);
        }
    }

    public function show($email)
    {
        //get user by email
        $user = User::where('email', $email)->first();

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Pengguna Berhasil Ditampilkan!',
            'data' => $user
        ]);
    }

    public function update(Request $request, $email)
    {
        //validate request
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'role' => 'required',
        ]);

        //get user by email
        $user = User::where('email', $email)->first();

        //update user
        $user->update($request->all());

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Pengguna Berhasil Diperbarui!.',
        ]);
    }
}
