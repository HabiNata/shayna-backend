<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsGalleryRequest;
use App\Models\Products;
use App\Models\ProductsGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsGalleryController extends Controller
{
    public function json()
    {
        $datas = ProductsGallery::with('products')->get();
        return datatables()->of($datas)
            ->addColumn('action', function ($row) {
                $btn = '<button class="btn btn-sm btn-danger delete-row"
                                    type="button"
                                    data-id="' . $row->id . '">
                                    <span class="fa fa-trash"></span>
                                </button>';
                return $btn;
            })->addColumn('name', function ($row) {
                $btn = $row->products->name;
                return $btn;
            })
            ->addColumn('image', function ($row) {
                $btn = url($row->photo);
                return $btn;
            })
            ->addColumn('is_default', function ($row) {
                $btn = $row->is_default ? 'YA' : 'TIDAK';
                return $btn;
            })
            ->toJson();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $datas = ProductsGallery::with('products')->get();
        // return view('Pages.ProductsGallery.Index', [
        //     'datas' => $datas,
        // ]);

        return view('Pages.ProductsGallery.Index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $products = DB::table('Products')->select(['id', 'name'])->get();
        $products = Products::all(['id', 'name']);

        return view('Pages.ProductsGallery.Create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $data['photo'] = $request->file('photo')->store('assets/product', 'public');

        ProductsGallery::create($data);
        return redirect()->route('productsgallery.index')->withSuccess('Tambah foto barang berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = ProductsGallery::findorFail($id);

        if ($data->delete()) {
            return response()->json(['didSucceed' => 'true']);

            // return redirect()->route('productsgallery.index');
        } else {
            return response()->json(['didSucceed' => 'false']);
        }
    }
}
