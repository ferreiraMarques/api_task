<?php

use App\Task;
use Faker\Factory;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        for ($i = 0; $i < 10; ++$i) {
            Task::create([
                'name' => $faker->text(40),
                'completed' => $faker->boolean(),
            ]);
        }

    }
}
