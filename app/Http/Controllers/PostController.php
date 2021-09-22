<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index(Request $req){
        return Post::all();
    }

    public function get($id){
        $result = Post::find($id);
        //$result = DB::table('users')->where('user', '=', $user)->get();
        if($result)
            return $result;
        else
            return response()->json(['status'=>'failed'], 404);
    }

    public function create(Request $req){
        $this->validate($req,
        ['id'=>'required',
        'user'=>'required',
        'topics_id'=>'required',
        'mensaje'=>'required']);

        $datos = new Post;
        $result = $datos -> fill($req->all())->save();
        if($result)
            return response()->json(['status'=>'success'], 200);
        else
            return response()->json(['status'=>'failed'], 404);
    }

    public function update(Request $req, $id){
        $this->validate($req,
        ['id'=>'filled',
        'user'=>'filled',
        'topics_id'=>'filled',
        'mensaje'=>'filled']);

        $datos = Post::find($id);
        $result = $datos -> fill($req->all())->save();
        if($result)
            return response()->json(['status'=>'success'], 200);
        else
            return response()->json(['status'=>'failed'], 404);
    }

    public function destroy($id){

        $datos = Post::find($id);
        if(!$datos) return response()->json(['status'=>'failed'], 404);
        $result = $datos->delete();
        if($result)
            return response()->json(['status'=>'success'], 200);
        else
            return response()->json(['status'=>'failed'], 404);
    }
}