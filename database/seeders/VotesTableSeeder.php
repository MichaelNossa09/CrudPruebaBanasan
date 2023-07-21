<?php

namespace Database\Seeders;

use App\Models\Publicacion;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class VotesTableSeeder extends Seeder
{

    public function run()
    {
        $userIds = User::pluck('id')->all();
        $publicacionIds = Publicacion::pluck('id')->all();

        for ($i = 0; $i < 80; $i++) {
            $userId = Arr::random($userIds);
            $publicacionId = Arr::random($publicacionIds);
            $tipoVoto = rand(0, 1);

            $existingVote = Vote::where('user_id', $userId)->where('publicacion_id', $publicacionId)->first();

            if (!$existingVote) {
                Vote::create([
                    'user_id' => $userId,
                    'publicacion_id' => $publicacionId,
                    'type_vote' => $tipoVoto,
                ]);
            }
        }

        $publicaciones = Publicacion::all();
        foreach ($publicaciones as $publicacion) {
            $publicacion->votes = $publicacion->calcularVotos();
            $publicacion->save();
        }
    }
}
