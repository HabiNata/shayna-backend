<?php

namespace Database\Seeders;

use App\Models\Products;
use App\Models\Transactions;
use App\Models\TransactionsDetail;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = Products::factory()->create();
        Transactions::factory()->has(TransactionsDetail::factory()->count(5)->for($product), 'detail')->state(new Sequence(
            ['transaction_status'=>'PENDING'],
            ['transaction_status'=>'SUCCESS'],
            ['transaction_status'=>'FAILED'],
        ))->create();
    }
}
