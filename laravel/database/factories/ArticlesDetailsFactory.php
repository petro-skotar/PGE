<?php

namespace Database\Factories;

use App\Models\ArticlesDetails;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ArticlesDetailsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ArticlesDetails::class;
	
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->sentence(5);
		return [
            //'id' => rand(8,50),
            'article_id' => rand(100,250),
            'lang' => $this->faker->randomElement(['pl','de','en','ru','cz']),
            'title' => $name,
            'name' => $name,
            'short_name' => $name,
            'bread' => $name,
            'description' => $this->faker->paragraph(2),
            'annotation' => $this->faker->paragraph(8),
            'content' => $this->faker->paragraph(30),
            'content_2' => $this->faker->paragraph(10),
            'content_3' => $this->faker->paragraph(10),
        ];
    }
}
