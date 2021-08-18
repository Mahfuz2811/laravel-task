<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    private static $order = 0;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->getEmail(self::$order++),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    private function getEmail($index): string
    {
        $emails = [
            'user1@example.com',
            'user2@example.com',
            'user3@example.com',
            'user4@example.com',
            'user5@example.com'
        ];

        return $emails[$index] ?? $this->faker->unique()->safeEmail();
    }
}
