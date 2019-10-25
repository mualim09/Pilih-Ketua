<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kandidat;
use App\Hasil;
use App\App;

class UserController extends Controller
{
    public function login() {
        return view('Login');
    }
    public function auth(Request $request) {
        $this->validate($request,[
            'nama'=>'required | min:3 | unique:hasil_pemilihan,nama'
        ]);
        $request->session()->put([
            'user'=>1,
            'nama'=>$request->nama
        ]);
        return redirect(route('user.pemilihan'));
        
    }
    public function pemilihan(Request $request) {
        $data = Kandidat::orderBy('no_kandidat','asc')->get();
        return view('Pemilihan')->with('data',$data);
    }
    public function logout(Request $request) {
        $request->session()->forget([
            'user',
            'nama'
        ]);
        return redirect(route('user.login'));
    }
    public function checkActive() {
        $data = App::where('name','active')->first();
        return response()->json($data);

    }
    public function off() {
        App::find(1)->update([
            'value'=>0
        ]);
    }
    public function on() {
        App::find(1)->update([
            'value'=>1
        ]);
    }
    public function pilih(Request $request) {
        $count=Hasil::where('nama',$request->nama)->count();
        if($count<1) {
            Hasil::insert([
                'nama'=>$request->nama,
                'no_kandidat'=>$request->no
            ]);
        }

    }
}
