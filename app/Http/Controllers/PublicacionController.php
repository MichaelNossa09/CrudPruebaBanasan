<?php

namespace App\Http\Controllers;

use App\Models\Publicacion;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PublicacionController extends Controller
{
    public function index()
    {
        $publicaciones = Publicacion::with('votes', 'comentarios')->orderBy('created_at', 'desc')->get();

        return view('home', compact('publicaciones'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ], [
            'title.required' => 'El campo title es obligatorio.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $publicacion = new Publicacion();
            $publicacion->title = $request->title;
            $publicacion->content = $request->content;
            $publicacion->image = "https://via.placeholder.com/800x600.png/00bbcc?text=cumque";
            $publicacion->votes = 1;
            $publicacion->id_user = Auth::id();

            $publicacion->save();

            $voto = new Vote();
            $voto->user_id = Auth::id();
            $voto->publicacion_id = $publicacion->id;
            $voto->type_vote = 1;
            $voto->save();

            return redirect()->back()->with('success', 'Se posteó con éxito');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Hubo un error al crear post');
        }
    }

    public function show()
    {
        return view('publicaciones/create');
    }


    public function publicacionesUsuarioLogeado()
    {
        $userID = Auth::id();
        $user = User::find($userID);
        $publicaciones = $user->publicaciones()->latest('created_at')->get();

        return view('user/posts', compact('publicaciones'));
    }

    public function edit(Publicacion $publicacion)
    {
        return view('publicaciones.edit', compact('publicacion'));
    }

    public function update(Request $request, Publicacion $publicacion)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ], [
            'title.required' => 'El campo título es obligatorio.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $publicacion->title = $request->input('title');
        $publicacion->content = $request->input('content');

        $publicacion->save();

        return redirect()->route('publicacion.user')
            ->with('success', 'Post Updated Succesfully');
    }

    public function delete($id)
    {
        $publicacion = Publicacion::find($id);

        if (!$publicacion) {
            return redirect()->route('publicacion.user')->with('error', 'Post not found');
        }

        if ($publicacion->id_user == Auth::user()->id) {
            $publicacion->delete();
            return redirect()->route('publicacion.user')->with('success', 'Post Deleted Successfully');
        } else {
            return redirect()->route('publicacion.user')->with('error', 'You are not authorized to delete this post');
        }
    }
}
