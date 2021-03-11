<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CheckoutRequest;
use App\Models\Products;
use App\Models\Transactions;
use App\Models\TransactionsDetail;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkout(CheckoutRequest $request)
    {
        $data = $request->except('transaction_details');

        $data['uuid'] = 'TRX' . mt_rand(10000, 999999) . mt_rand(100, 999);

        $transaction = Transactions::create($data);

        foreach($request->transaction_details as $products)
        {
            $details[] = new TransactionsDetail([
                'transaction_id'    =>  $transaction->id,
                'products_id'       =>  $products
            ]);

            Products::find($products)->decrement('quantity');
        }

        $transaction->detail()->saveMany($details);

        return ResponseFormatter::success($transaction);
    }
}
