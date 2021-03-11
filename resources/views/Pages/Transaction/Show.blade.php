<div class="table-responsive">
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Email</th>
                <th scope="col">Nomor</th>
                <th scope="col">Alamat</th>
                <th scope="col">Total Transaksi</th>
                <th scope="col">Status Transaksi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">{{ $datas->id }}</th>
                <td>{{ $datas->nama }}</td>
                <td>{{ $datas->email }}</td>
                <td>{{ $datas->number }}</td>
                <td>{{ $datas->alamat }}</td>
                <td>{{ $datas->transaction_total }}</td>
                <td>{{ $datas->transaction_status }}</td>
            </tr>
        </tbody>
    </table>
</div>
<br>
<br>
<br>
<h3>Pembelian</h3>
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Tipe</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas->detail as $data)
                <tr>
                    <td>{{ $data->products->name }}</td>
                    <td>{{ $data->products->type }}</td>
                    <td>Rp. {{ number_format($data->products->price) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


<div class="row">
    <div class="col-4">
        <a href="{{ route('transactions.status', $datas->id) }}?status=SUCCESS" class="btn btn-success btn-block">
            <i class="fa fa-check"></i> set success
        </a>
    </div>
    <div class="col-4">
        <a href="{{ route('transactions.status', $datas->id) }}?status=PENDING" class="btn btn-info btn-block">
            <i class="fa fa-spinner"></i> set pending
        </a>
    </div>
    <div class="col-4">
        <a href="{{ route('transactions.status', $datas->id) }}?status=FAILED" class="btn btn-warning btn-block">
            <i class="fa fa-times"></i> set gagal
        </a>
    </div>
</div>
