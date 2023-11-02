<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Department;
use App\Models\Student;
use App\Models\Result;
use Illuminate\Support\Str;


class ResultFactory extends Factory
{
    protected $model = Result::class;

    public function definition(): array
    {
        $StudentIds = Student::pluck('id')->toArray();

        return [
            'student_id' => $StudentIds[array_rand($StudentIds)],
            'gpa' => number_format($this->faker->randomFloat(2, 1.00, 4.00), 2),
            'date' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
        ];
    }
}
