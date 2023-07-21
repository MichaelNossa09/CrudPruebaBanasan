<?php

namespace Database\Seeders;

use App\Models\Comentario;
use App\Models\Publicacion;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class ComentariosTableSeeder extends Seeder
{

    public function run()
    {
        Comentario::factory()->count(50)->create();
    }
}
