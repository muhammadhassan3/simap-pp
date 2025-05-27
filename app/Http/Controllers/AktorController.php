<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Aktor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AktorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;
        $jumlahbaris = 10;
        if(strlen($katakunci)){
            $data = User::where('username','like',"%$katakunci%")
            ->orWhere('role','like',"%$katakunci%")
            ->orderBy('username', 'asc')
            ->paginate($jumlahbaris);
        }else{
            $data = User::orderBy('username','asc')->paginate($jumlahbaris);
        }
        return view('aktor.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('aktor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'username'=>'required',
            'password'=>'required',
            'email'=>'required',
            'role'=>'required',
        ],[
            'username.required'=>'Username tidak boleh kosong',
            'password.required'=>'Password tidak boleh kosong',
            'email.required'=>'Email tidak boleh kosong',
            'role.required'=>'Role tidak boleh kosong',
        ]);
        $data = [
            'username'=>$request->username,
            'password'=> Hash::make($request->password),
            'email'=>$request->email,
            'role'=>$request->role,
        ];
        User::create($data);
        return redirect()->to('aktor')->with('success', 'Berhasil menambahkan data');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = User::where('username',$id)->first();
        return view('aktor.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'username'=>'required',
            'email'=>'required',
            'role'=>'required',
        ],[
            'username.required'=>'Username tidak boleh kosong',
            'email.required'=>'Email tidak boleh kosong',
            'role.required'=>'Role tidak boleh kosong',
        ]);
        if ($request->password != null){
            $data = [
                'username'=>$request->username,
                'password'=> Hash::make($request->password),
                'email'=>$request->email,
                'role'=>$request->role,
            ];
        }else{
            $data = [
                'username' => $request->username,
                'email' => $request->email,
                'role' => $request->role,
            ];
        }

        User::where('username',$id)->update($data);
        return redirect()->to('aktor')->with('success', 'Berhasil melakukan update data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::where('username',$id)->delete();
        return redirect()->to('aktor')->with('success', 'Berhasil melakukan delete data');
    }
}
