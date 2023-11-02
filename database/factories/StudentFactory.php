<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Department;
use App\Models\Student;
use Illuminate\Support\Str;


class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition(): array
    {
        $departmentIds = Department::pluck('id')->toArray();
        $batchNames = ['Batch A', 'Batch B', 'Batch C', 'Batch D'];

        return [
            'name' => $this->faker->name(),
            'department_id' => $departmentIds[array_rand($departmentIds)],
            'batch_name' => $this->faker->randomElement($batchNames),
        ];
    }
}
