<?php

namespace Database\Factories;

use App\Models\Comentario;
use App\Models\Publicacion;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ComentarioFactory extends Factory
{
    protected $model = Comentario::class;

    public function definition()
    {
        $userIds = User::pluck('id')->all();
        $publicacionIds = Publicacion::pluck('id')->all();
        $id_user = $userIds[array_rand($userIds)];
        $id_publicacion = $publicacionIds[array_rand($publicacionIds)];

        return [
            'id_user' => $id_user,
            'id_publicacion' => $id_publicacion,
            'content' => $this->faker->sentence,
            'created_at' => $this->faker->date,
            'updated_at' => $this->faker->date,
            'votes' => $this->faker->randomNumber(2),
        ];
    }
}
