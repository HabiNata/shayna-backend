<?php

namespace Database\Seeders;

use App\Models\Transactions;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ProductsSeeder::class,
            TransactionSeeder::class,
        ]);
    }
}
