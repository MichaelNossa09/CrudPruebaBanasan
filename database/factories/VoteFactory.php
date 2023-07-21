<?php

namespace Database\Factories;

use App\Models\Publicacion;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class VoteFactory extends Factory
{
    protected $model = Vote::class;

    public function definition()
    {
        $userIds = User::pluck('id')->all();
        $publicacionIds = Publicacion::pluck('id')->all();

        return [
            'user_id' => $this->faker->randomElement($userIds),
            'publicacion_id' => $this->faker->randomElement($publicacionIds),
            'type_vote' => $this->faker->randomElement([0, 1]),
        ];
    }
}
