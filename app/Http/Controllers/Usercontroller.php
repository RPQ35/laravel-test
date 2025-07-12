<?php

namespace App\Http\Controllers;

use App\Models\izin;
use App\Models\siswa;
use App\Models\siswalist;
use Carbon\Carbon;
use Illuminate\Http\Request;



class UserController extends Controller
{


    public function lives(Request $request)
    {
        $query = $request->input('q');

        $results = siswalist::where('nama_siswa', 'like', '%' . $query . '%')
            ->limit(3)
            ->pluck('nama_siswa');

        return response()->json($results);
    }


    public function save(Request $request)
    {

        try {
            // dd($request->all());
            $request->validate([
                'nama_siswa' => 'required|min:3',
                'kelas' => 'required',
                'jenis_izin' => 'required|min:3',
                'foto_bukti' => 'required',
            ]);
        } catch (\Exception $e) {
            dd($request->all());
        }

        // dd($request->file('foto_bukti'));

        $aprrove = 0;

        $path = $request->file('foto_bukti')->store('document');

        // dd($request);

        $check_siswa = siswalist::where('nama_siswa', $request->nama_siswa)
            ->where('kelas', $request->kelas)
            ->first();

        $check_i = izin::where('nama_siswa', $request->nama_siswa)
            ->whereDate('created_at', Carbon::today())
            ->where('kelas', $request->Kelas)
            ->first();

        // dd($check_siswa);

        if ($check_siswa) {
            // dd($check_i);
            if ($check_i) {

                $protect = izin::findOrFail($check_i->id);
                $protect->jenis_izin = $request->jenis_izin;
                $protect->image_path = $path;
                $protect->aprooval = $aprrove;
                $protect->save();
            } else {

                izin::create([
                    'nama_siswa' => $request->nama_siswa,
                    'kelas' => $request->kelas,
                    'jenis_izin' => $request->jenis_izin,
                    'image_path' => $path,
                    'aprooval' => $aprrove,
                ]);
            }

            return back()->with('success', 'success');
        } else {
            return back()->with('success', 'gagal (nama siswa tidak ada)');
        }
    }
}
