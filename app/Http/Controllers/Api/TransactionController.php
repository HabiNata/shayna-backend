<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transactions;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function get(Request $request, $id)
    {
        $products = Transactions::with(['detail.products'])->find($id);

        if($products)
        {
            return ResponseFormatter::success($products, 'Data produk berhasil di ambil');
        }
        else
        {
            return ResponseFormatter::error(null, 'Data produk tidak ada', 404);
        }
    }
}
