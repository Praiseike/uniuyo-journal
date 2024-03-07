<?php

namespace Database\Factories;

use App\Models\Paper;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Paper>
 */
class PaperFactory extends Factory
{

    protected $model = Paper::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faker = FakerFactory::create();

        return [
            'user_id' => 1, // Assuming 10 users exist
            'title' => $faker->sentence(6),
            'slug' => \Str::slug($faker->sentence(6)),
            'abstract' => $faker->paragraph(3),
            'published_on' => $faker->dateTimeThisYear(),
            'reviewer_id' => 1, // Assuming 10 users exist
            'authors' => $faker->name . ', ' . $faker->name,
            'reference' => $faker->text(200),
            'file_path' => 'path/to/file.pdf', // Replace with actual path
            'paper_status_id' => 1, // Assuming 3 paper statuses
            'transaction_id' => 1, // Assuming transaction is not required initially
        ];
    }
}
