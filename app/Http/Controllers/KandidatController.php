<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kandidat;

class KandidatController extends Controller
{
    public function get() {
        $data= Kandidat::orderBy('no_kandidat','asc')->get();
        return response()->json($data);
    }
    public function manageKandidat() {
        $data=['data'=>Kandidat::orderBy('no_kandidat','asc')->get()];
        return view('admin.manageKandidat')->with($data);    
    }
    public function register_action(Request $request) {
        $this->validate($request,[
            'foto_ketua'=>'required | mimes:jpg,jpeg,png,svg,bmp | max:2000',
            'foto_wakil'=>'required | mimes:jpg,jpeg,png,svg,bmp | max:2000'
        ]);


        $file_ketua = $request->file('foto_ketua');
        $file_name_ketua = time().$file_ketua->getClientOriginalName();                      
        $file_path_ketua = 'uploads/';
        $file_ketua->move($file_path_ketua, $file_name_ketua);

        $file_wakil = $request->file('foto_wakil');
        $file_name_wakil = time().$file_wakil->getClientOriginalName();                      
        $file_path_wakil = 'uploads/';
        $file_wakil->move($file_path_wakil, $file_name_wakil);


        Kandidat::insert([
            'no_kandidat'=>$request->no,
            'nama'=>$request->ketua.",".$request->wakil,
            'foto'=>$file_name_ketua.",".$file_name_wakil,
            'visi'=>$request->visi,
            'misi'=>$request->misi
        ]);
    	return redirect()->back()->with('message','Kandidat baru berhasil ditambahkan !');
    }
    public function deleteKandidat($id) {
        $kandidat = Kandidat::destroy($id);
        return redirect()->back()->with('message','Berhasil menghapus kanididat !');
    }
    public function editKandidat(Request $request,$id) {


        if($request->hasFile('foto_ketua')) {
            $this->validate($request,[
                'foto_ketua'=>'required | mimes:jpg,jpeg,png,svg,bmp | max:2000'
            ]);

            $file_ketua = $request->file('foto_ketua');
            $file_name_ketua = time().$file_ketua->getClientOriginalName();                      
            $file_path_ketua = 'uploads/';
            $file_ketua->move($file_path_ketua, $file_name_ketua);
        
        }
        else {
            $file_name_ketua = $request->foto_ketua_ori;
        }
        if($request->hasFile('foto_wakil')) {
            $this->validate($request,[
                'foto_wakil'=>'required | mimes:jpg,jpeg,png,svg,bmp | max:20000'
            ]);
            $file_wakil = $request->file('foto_wakil');
            $file_name_wakil = time().$file_wakil->getClientOriginalName();                      
            $file_path_wakil = 'uploads/';
            $file_wakil->move($file_path_wakil, $file_name_wakil);

        }
        else {
            $file_name_wakil = $request->foto_wakil_ori;
        }

        Kandidat::find($id)->update([
            'no_kandidat'=>$request->no,
            'nama'=>$request->ketua.",".$request->wakil,
            'foto'=>$file_name_ketua.",".$file_name_wakil,
            'visi'=>$request->visi,
            'misi'=>$request->misi
        ]);
    	return redirect()->back()->with('message','Kandidat berhasil diedit !');
    }
}
