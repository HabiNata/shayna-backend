<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Models\Transactions;
use App\Models\TransactionsDetail;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Transactions::all();

        return view('Pages.Transaction.Index', ['datas' => $datas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $datas = Transactions::with('detail.products')->findorFail($id);

        return view('Pages.Transaction.Show', [
            'datas' => $datas,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Transactions::findorFail($id);

        return view('Pages.Transaction.Edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TransactionRequest $request, $id)
    {
        $trans = $request->all();

        $data = Transactions::findorFail($id);
        $data->update($trans);

        return redirect()->route('transactions.index')->withSuccess('Berhasil ubah data transaksi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Transactions::findorFail($id);

        $data->delete();

        TransactionsDetail::where('transaction_id', $id)->delete();

        return redirect()->route('transactions.index')->withSuccess('Data Berhasil di hapus');
    }

    public function setStatus(Request $request, $id)
    {
        $request->validate([
            'status' => ['required', 'in:PENDING,SUCCESS,FAILED'],
        ]);

        $trans = $request->status;

        $data = Transactions::findorFail($id);
        $data->transaction_status = $request->status;
        $data->save();

        return redirect()->route('transactions.index')->withSuccess('Berhasil mengganti status');

    }
}
