<?php

namespace App\Http\Controllers;

use App\Models\Publicacion;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    public function votar(Request $request)
    {
        $publicacionId = $request->input('publicacion_id');
        $tipoVoto = $request->input('type_vote');
        $userId = Auth::user()->id;

        $votoExistente = Vote::where('user_id', $userId)
            ->where('publicacion_id', $publicacionId)
            ->first();

        if ($votoExistente) {
            if ($votoExistente->type_vote != $tipoVoto) {
                $votoExistente->type_vote = $tipoVoto;
                $votoExistente->save();

                $publicacion = Publicacion::find($publicacionId);

                if ($tipoVoto) {
                    $publicacion->increment('votes', 2);
                } else {
                    $publicacion->decrement('votes', 2);
                }
            }
        } else {
            $voto = new Vote();
            $voto->user_id = $userId;
            $voto->publicacion_id = $publicacionId;
            $voto->type_vote = $tipoVoto;
            $voto->save();

            $publicacion = Publicacion::find($publicacionId);

            if ($tipoVoto) {
                $publicacion->increment('votes');
            } else {
                $publicacion->decrement('votes');
            }
        }

        $totalVotos = Publicacion::findOrFail($publicacionId)->calcularVotos();
        return response()->json(['votes' => $totalVotos]);
    }
}
