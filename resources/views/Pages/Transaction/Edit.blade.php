@extends('Layouts.Index')

@section('content')
    <div class="order">
        <div class="row justify-content-center ">
            <div class="col-xl-11">
                <div class="card">
                    <div class="card-header"><strong>Ubah Barang</strong><small> {{ $data->uuid }} </small></div>
                    <form action="{{ route('transactions.update', $data->id) }}" method="post">
                        @csrf
                        @method('patch')
                        <div class="card-body card-block">
                            <div class="form-group"><label for="name" class=" form-control-label">Name Pemesan</label>
                                <input type="text" id="name" placeholder="Nama"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name') ? old('name') : $data->name }}" name="name">
                                @error('name')
                                    <div class="text-muted">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group"><label for="email" class=" form-control-label">Email</label>
                                <input type="email" id="email" placeholder="Masukan tipe produk"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email') ? old('email') : $data->email }}" name="email">
                                @error('email')
                                    <div class="text-muted">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group"><label for="number" class=" form-control-label">Nomor telpon</label>
                                <input type="text" id="number" class="form-control @error('number') is-invalid @enderror"
                                    value="{{ old('number') ? old('number') : $data->number }}" name="number">
                                @error('number')
                                    <div class="text-muted">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group"><label for="address" class=" form-control-label">Alamat Pemesan</label>
                                <textarea name="address" id="address" cols="30" rows="10"
                                    class="form-control @error('address') is-invalid @enderror">{{ old('address') ? old('address') : $data->address }}</textarea>
                                @error('address')
                                    <div class="text-muted">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block" type="submit">
                                    Ubah Data Transaksi
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
