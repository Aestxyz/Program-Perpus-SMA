<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Book;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $now = now()->subMonths(1);
        $status = $this->faker->randomElement(['Menunggu', 'Berjalan', 'Terlambat', 'Selesai']);

        $borrowDate = match ($status) {
            'Menunggu' => null,
            'Selesai' => $now->addDays(14),
            'Terlambat' => $now->subDays(1), // Adjust the number of days as needed
            'Berjalan' => $now->subDays(7),
        };

        $returnDate = match ($status) {
            'Menunggu' => null,
            'Selesai' => $now->addDays(7),
            'Terlambat' => $now->addDays(7), // Adjust the number of days as needed
            'Berjalan' => $now->subDays(1),
        };

        return [
            'code' => Str::random(20),
            'book_id' => Book::all()->random()->id,
            'user_id' => User::where('role', 'Anggota')->inRandomOrder()->first()->id,
            'borrow_date' => $borrowDate,
            'return_date' => $returnDate,
            'status' => $status,
        ];
    }
}
