@extends('Layouts.Index')
@push('after-style')
    <link rel="stylesheet" href="{{ asset('assets/css/lib/chosen/chosen.min.css') }}">
@endpush
@section('content')
    <div class="order">
        <div class="row justify-content-center ">
            <div class="col-xl-11">
                <div class="card">
                    <div class="card-header"><strong>Tambah Foto Barang</strong></div>
                    <form action="{{ route('productsgallery.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body card-block">
                            <div class="form-group">
                                <label for="name" class=" form-control-label">Pilih Barang</label>
                                <br>
                                <select name="products_id" id="products_id" data-placeholder="Pilih Barang..." tabindex="1"
                                    class="standardSelect @error('products_id') is-invalid @enderror">
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                                @error('products_id')
                                    <div class="text-muted">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group"><label for="type" class=" form-control-label">Tambah Foto Barang</label>
                                <input type="file" id="photo" accept="image/*"
                                    class="form-control-file @error('photo') is-invalid @enderror"
                                    value="{{ old('photo') }}" name="photo">
                                @error('photo')
                                    <div class="text-muted">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description" class=" form-control-label">Deskripsi
                                    Produk</label>
                                <br>
                                <div class="form-check-inline form-check">
                                    <label for="inline-radio1" class="form-check-label ">
                                        <input type="radio" name="is_default" value="1"
                                            class="form-check-input @error('is_invalid') is-invalid @enderror">YA
                                    </label>
                                    &nbsp;
                                    <label for="inline-radio2" class="form-check-label ">
                                        <input type="radio" name="is_default" value="0"
                                            class="form-check-input @error('is_default') is-invalid @enderror">TIDAK
                                    </label>
                                </div>
                                @error('is_default')
                                    <div class="text-muted">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block" type="submit">
                                    Tambah Barang
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('after-script')
    <script src="{{ asset('assets/js/lib/chosen/chosen.jquery.min.js') }}"></script>
    <script>
        jQuery(document).ready(function() {
            jQuery(".standardSelect").chosen({
                disable_search_threshold: 10,
                no_results_text: "Oops, nothing found!",
                width: "50%"
            }).change();
        });

    </script>
@endpush
