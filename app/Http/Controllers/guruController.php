<?php

namespace App\Http\Controllers;

use App\Models\izin;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use Illuminate\Http\Request;

class guruController extends Controller
{
    public function index()
    {
        $data = izin::all(); // use Post model
        return view('guru', compact('data'));
    }

    public function image($id)
    {
        $post = izin::findOrFail($id);
        $content = Storage::get($post->image_path);
        return response($content)->header('Content-Type', 'image/jpeg');
    }

    public function updateApproval(Request $request, $id)
    {
        try {
            $post = izin::findOrFail($id);
            $post->aprooval = $request->aprooval; // check spelling too
            $post->save();
    
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // 🔴 Debugging: Return error as JSON instead of Laravel HTML page
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
