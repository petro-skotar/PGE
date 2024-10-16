<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;
	
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $module_and_template = $this->faker->randomElement(['offers','industries','career','our-team','faq']);
		return [
            'id' => $this->faker->unique()->numberBetween($min = 100, $max = 250),
            'url' => Str::random(20),
            'parent_id' =>  $this->faker->randomElement([0]),
            'active' => $this->faker->randomElement([1]),
            'module' => $module_and_template,
            'template' => $module_and_template,
            'sub' => $this->faker->randomElement(['no']),
            'in_nav' => $this->faker->randomElement([0,1]),
            'open_comments' => $this->faker->randomElement([0,1]),
        ];
    }
}
