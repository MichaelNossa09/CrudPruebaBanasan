<?php

namespace Database\Seeders;

use App\Models\Publicacion;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class PublicacionesTableSeeder extends Seeder
{

    public function run()
    {
        $userIds = User::pluck('id')->all();

        Publicacion::factory()
            ->count(20)
            ->create([
                'id_user' => function () use ($userIds) {
                    return Arr::random($userIds);
                },
            ]);
    }
}
