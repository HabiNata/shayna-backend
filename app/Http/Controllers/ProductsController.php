<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsRequest;
use App\Models\Products;
use App\Models\ProductsGallery;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class ProductsController extends Controller
{

    public function json()
    {
        $datas = Products::all();
        return datatables()->of($datas)
            ->addColumn('action', function ($row) {
                $btn = '<a href="' . route('products.gallery', $row->id) . '" type="button" class="btn btn-primary btn-sm">
                            <span class="fa fa-folder-open"></span>
                        </a>';
                $btn = $btn . '<a href="' . route('products.edit', $row->id) . '" type="button" class="btn btn-info btn-sm">
                                <span class="fa fa-pencil"></span>
                            </a>';
                $btn = $btn . '<button class="btn btn-sm btn-danger delete-row"
                                    type="button"
                                    data-id="' . $row->id . '">
                                    <span class="fa fa-trash"></span>
                                </button>';
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
        // $datas = Products::all();

        // return view('Pages.Products.Index', ['datas' => $datas]);
        return view('Pages.Products.Index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Pages.Products.Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductsRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        Products::create($data);

        return redirect()->route('products.index')->withSuccess('Berhasil tambah data produk');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Products::findOrFail($id);

        return view('Pages.Products.Edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductsRequest $request, $id)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        $item = Products::findorFail($id);
        $item->update($data);

        return redirect()->route('products.index')->withSuccess('Berhasil ubah data produk');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Products::find($id);

        if ($data->delete()) {
            ProductsGallery::where('products_id', $id)->delete();

            return response()->json(['didSucceed' => 'true']);

            // return redirect()->route('products.index');
        } else {
            return response()->json(['didSucceed' => 'false']);
        }
    }

    public function galleries($id)
    {
        // $products = Products::findorFail($id);

        $datas = ProductsGallery::with('Products')->where('products_id', $id)->first();

        return view('Pages.Products.Gallery', ['datas' => $datas]);
    }

    public function galleries_json($id)
    {
        $datas = ProductsGallery::with('Products')->where('products_id', $id)->get();

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
}
