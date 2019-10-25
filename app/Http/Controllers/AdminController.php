<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\Hasil;
use App\Kandidat;

class AdminController extends Controller
{
	public function index() {
        $countKandidat = Kandidat::all()->count();
        $countPemilih = Hasil::all()->count();
        $countAdmin = Admin::all()->count();

        $data = [$countKandidat,$countPemilih,$countAdmin];

		return view('admin.Home')->with('data',$data);
    }
    
    public function login() {
        return view('admin.Login');
    }

    public function auth(Request $request) {
        $this->validate($request,[
    		'username'=>'required|min:2',
    		'password'=>'required|min:4'
    	]);

    	if(!auth()->attempt(['username'=>$request->username,'password'=>$request->password])) {
    		return redirect()->back()->with('message','Incorrect username or password !');
    	}
        return redirect()->route('admin.home');
    }
    
    public function register_action(Request $request) {

    	$this->validate($request,[	
    		'username'=>'required|min:2|unique:admins',
    		'password'=>'required|min:4|confirmed'
    	]);	

    	Admin::insert([
    		'username'=>$request->username,
    		'password'=>bcrypt($request->password)
    	]);
    	return redirect()->back()->with('message','Admin baru berhasil ditambahkan!');
    }

    public function logout() {
    	auth()->logout();
    	return redirect()->route('login');
    }
    public function manageAdmin() {
        $data=['data'=>Admin::all()];
        return view('admin.manageAdmin')->with($data);
    }
    public function deleteAdmin($id) {
        $admin = Admin::destroy($id);
        return redirect()->back()->with('message','Admin berhasil dihapus !');
    }
    public function editAdmin(Request $request,$id) {

        if($request->newpassword == '') {
            $pw = $request->password;
        }
        else {
            $pw = bcrypt($request->newpassword);
        }

        Admin::find($id)->update([
            'username'=>$request->username,
            'password'=>$pw,
        ]);
        return redirect()->back()->with('message','Admin berhasil Diedit !');
    }
    public function hasilText() {
        $data = Hasil::all();
        return view('admin.HasilText')->with('data',$data);
    }
    public function hasilGrafik() {
        $data = Hasil::all();
        return view('admin.HasilGrafik')->with('data',$data);
    }
    public function deleteHasil($id) {
        $hasil = Hasil::destroy($id);
        return redirect()->back()->with('message','Pilihan berhasil dihapus !');
    }
    public function suaraTerbanyak() {
        $suaraTerbanyak = Hasil::select('no_kandidat')
        ->groupBy('no_kandidat')
        ->orderByRaw('COUNT(*) DESC')
        ->limit(1)
        ->get();
        foreach($suaraTerbanyak as $v) {
           $data=[
               'suaraTerbanyak'=>Kandidat::where('no_kandidat',$v->no_kandidat)->get(),
               'jumlahSuara'=>Hasil::where('no_kandidat',$v->no_kandidat)->count()
           ];
        }
        return response()->json($data);
    }
    public function getSuara() {
        $no1 = Hasil::where('no_kandidat',1)->count();
        $no2 = Hasil::where('no_kandidat',2)->count();
        $no3 = Hasil::where('no_kandidat',3)->count();
        $data = [$no1,$no2,$no3];
        return response()->json($data);
    }
    public function persenSuara() {
        $jumlahSuara = Hasil::all()->count();
        $no1 = Hasil::where('no_kandidat',1)->count();
        $sub1 = number_format((float)$no1/$jumlahSuara*100, 2, '.', '');
        $no2 = Hasil::where('no_kandidat',2)->count();
        $sub2 = number_format((float)$no2/$jumlahSuara*100, 2, '.', '');
        $no3 = Hasil::where('no_kandidat',3)->count();
        $sub3 = number_format((float)$no3/$jumlahSuara*100, 2, '.', '');

        $data = [$sub1,$sub2,$sub3];
        return response()->json($data);
    }

}
