<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function settings($id){
        $item = User::findOrFail($id);
        return view('auth.setting',compact('item'));
    }

    public function updateSettings(Request $request, $id){
     
        $request->validate([
            'name'=>['required','string','max:70'],
            'password'=>['required','string','min:8','confirmed'],
        ],[
            'name.required'=> 'Nama tidak boleh kosong',
            'password.min'=> 'Password minimal 8 karakter',
            'password.confirmed'=> 'Konfirmasi password berbeda' 
        ]);

        $item = User::findOrFail($id);
        if(Hash::check($request->password_lama,$item->password)){
            $data['name'] = $request->name;
            $data['password'] = Hash::make($request->password);
            
            $item->update($data);
            if($item->role == 'DONATUR'){
                return redirect()->route('home')->with('sukses','Data Berhasil Di Ubah');
            }
            elseif($item->role == 'ADMIN'){
                return redirect()->route('dashboard')->with('sukses','Data Berhasil Di Ubah');
            }
            elseif($item->role == 'LOGISTIK'){
                return redirect()->route('dashboard-logistik')->with('sukses','Data Berhasil Di Ubah');
            }
            elseif($item->role == 'POSKO'){
                return redirect('posko/info-posko')->with('sukses','Data Berhasil Di Ubah');
            }
        }
        else 
        {
           return redirect()->back()->with('gagal','Password Lama Berbeda'); 
        }
    }
}

