<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Http\Requests\Admin\UserRequest;
use Illuminate\Http\Request;

class DataUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = User::all();
        return view('pages.admin.datauser.index', ['items'=>$items]);
    }

  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>['required','string','max:70'],
            'email'=>['required','string','max:100','unique:users','email'],
            'password'=>['required','string','min:8','confirmed'],
            'role'=>['required'] 
        ],[
            'name.required'=> 'Nama tidak boleh kosong',
            'email.unique'=> 'Email sudah terdaftar',
            'password.min'=> 'Password minimal 8 karakter',
            'password.confirmed'=> 'Konfirmasi password berbeda' 
            ]);

            $data = $request->all();
            $data['password'] = Hash::make($request->password);
            
            User::create($data);

        // User::create([
        //     'name' => $request['name'],
        //     'email' => $request['email'],
        //     'password' => Hash::make($request['password']),
        //     'role'=> $request['role']
        // ]);
        return redirect('admin/data-user')->with('sukses','Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $item = User::findOrFail($id);

        return view('pages.admin.datauser.edit',[
            'item'=>$item
        ]);

        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>['required','string','max:255'],
            'role'=>['required']
        ],[
            'name.required'=> 'Nama tidak boleh kosong',
            ]);

        $data = $request->all();
        $item = User::findOrFail($id);

        $item ->update($data);
        return redirect('admin/data-user')->with('edit','Data Berhasil Di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = User::findOrFail($id);
        $item->delete();
        return redirect()->route('data-user.index')->with('dihapus','Data Berhasil Dihapus');
    }
}
