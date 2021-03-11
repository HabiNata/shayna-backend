@extends('Layouts.Index')

@section('content')
    <div class="order">
        <div class="row justify-content-center ">
            <div class="col-xl-11">
                <div class="card">
                    <div class="card-header"><strong>Ubah Barang</strong><small> {{ $data->name }} </small></div>
                    <form action="{{ route('products.update', $data->id) }}" method="post">
                        @csrf
                        @method('patch')
                        <div class="card-body card-block">
                            <div class="form-group"><label for="name" class=" form-control-label">Name Barang</label>
                                <input type="text" id="name" placeholder="Masukan nama produk"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name') ? old('name') : $data->name }}" name="name">
                                @error('name')
                                    <div class="text-muted">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group"><label for="type" class=" form-control-label">Tipe Barang</label>
                                <input type="text" id="type" placeholder="Masukan tipe produk"
                                    class="form-control @error('type') is-invalid @enderror"
                                    value="{{ old('type') ? old('type') : $data->type }}" name="type">
                                @error('type')
                                    <div class="text-muted">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group"><label for="description" class=" form-control-label">Deskripsi
                                    Produk</label>
                                <textarea name="description" id="description" cols="30" rows="10"
                                    class="form-control ckeditor @error('description') is-invalid @enderror">{{ old('description') ? old('description') : $data->description }}</textarea>
                                @error('description')
                                    <div class="text-muted">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group"><label for="price" class=" form-control-label">Harga Produk</label>
                                <input type="number" id="price" class="form-control @error('price') is-invalid @enderror"
                                    value="{{ old('price') ? old('price') : $data->price }}" name="price">
                                @error('price')
                                    <div class="text-muted">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group"><label for="quantity" class=" form-control-label">Jumlah Barang</label>
                                <input type="number" id="quantity" class="form-control @error('type') is-invalid @enderror"
                                    value="{{ old('quantity') ? old('quantity') : $data->quantity }}" name="quantity">
                                @error('type')
                                    <div class="text-muted">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block" type="submit">
                                    Ubah Barang
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
    {{-- CKEditor --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/25.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('.ckeditor'), {
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote'],
                heading: {
                    options: [{
                            model: 'paragraph',
                            title: 'Paragraph',
                            class: 'ck-heading_paragraph'
                        },
                        {
                            model: 'heading1',
                            view: 'h1',
                            title: 'Heading 1',
                            class: 'ck-heading_heading1'
                        },
                        {
                            model: 'heading2',
                            view: 'h2',
                            title: 'Heading 2',
                            class: 'ck-heading_heading2'
                        }
                    ]
                }
            })
            .catch(error => {
                console.log(error);
            });

    </script>
@endpush
