<?php

namespace Database\Factories;

use App\Models\Workspaces;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class WorkspaceFactory extends Factory
{
    protected $model = \App\Models\Workspaces::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'workspace_name' => $this->faker->name(),
            'in_charged_by' => $this->faker->name(),
            'created_at' =>now(),
        ];
    }
}
