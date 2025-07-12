<?php 
namespace App\Http\Controllers;

use App\Models\izin;
use App\Models\Post;
use Illuminate\Http\Request;

class siswaController extends Controller
{
    public function uses()
    {
        $data = izin::all(); // use Post model
        return view('siswa', compact('data'));
    }
}

