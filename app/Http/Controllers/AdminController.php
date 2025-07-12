<?php

namespace App\Http\Controllers;

use App\Models\account;
use App\Models\master;
use app\Models\Post;
use App\Models\siswalist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;

class AdminController extends Controller
{ //
    public function siswalist(){
        $siswalist = siswalist::all();
        return view('admin.siswalist', compact('siswalist'));
    }
    
    public function siswamade(Request $request){

        $request->validate([
            'nama_siswa' => 'required|min:3',
            'kelas' => 'required|min:3',
        ]);


        siswalist::create([

            'nama_siswa'=>$request->nama_siswa,
            'kelas'=>$request->kelas,
        ]);

        return back()->with('success', 'success');

    }

    public function display()
    {
        $res = User::all();
        return view('admin.admin', compact('res'));
    }

    public function made(Request $input)
    {
        $input->validate([
            'username' => 'required|min:3',
            'password' => 'required|min:3',
            'role' => 'required',
        ]);

        $hashpass=Hash::make($input->password);

        User::create([

            'username' => $input->username,
            'password' => $hashpass,
            'role' => $input->role,
        ]);

        return back()->with('success', 'success');
    }

    public function destroy($id)
    {
        $input = User::findOrFail($id);
        $input->delete();

        return redirect()->back()->with('success', 'Data deleted');
    }

    public function updaterole(Request $request, $id)
    {
        try {
            $akun = User::findOrFail($id);
            $akun->role = $request->role; // check spelling too
            $akun->save();
    
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // 🔴 Debugging: Return error as JSON instead of Laravel HTML page
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy_siswa($id)
    {
        $input = siswalist::findOrFail($id);
        $input->delete();

        return redirect()->back()->with('success', 'Data deleted');
    }

}



// master
// $2y$12$viSU5PBoFwdDh44c0MlOherFMs56uUxZ58CvpoPaC/AyO3G7MXHK6