<?php

namespace Database\Factories;

use App\Models\Profile;
use Closure;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Author;

class AuthorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function($author) {
            $author->profile()->save(Profile::factory()->make());
        });
    }
}
