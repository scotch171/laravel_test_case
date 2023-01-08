<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleCommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_name' => $this->faker->name,
            'text' => $this->faker->realText(500),
            'article_id' => Article::all()->random()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
