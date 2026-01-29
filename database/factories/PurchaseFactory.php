<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<\App\Models\Purchase>
 */
class PurchaseFactory extends Factory
{
    protected $model = Purchase::class;

    public function definition(): array
    {
        $status = $this->faker->randomElement(['pending', 'paid', 'failed']);

        return [
            'mollie_payment_id' => in_array($status, ['pending', 'paid']) ? 'tr_'.Str::random(12) : null,
            'user_id' => User::query()->inRandomOrder()->value('id') ?? User::factory(),
            'project_id' => Project::query()->inRandomOrder()->value('id') ?? Project::factory(),
            'amount_cents' => $this->faker->numberBetween(200, 10000),
            'status' => $status,
        ];
    }
}
