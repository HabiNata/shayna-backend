@extends('Layouts.Index')

@section('content')
    <!-- Orders -->
    <div class="orders">
        <div class="row justify-content-center ">
            <div class="col-xl-12">
                @if (Session::has('success'))
                    <div class="sufee-alert alert with-close alert-primary alert-dismissible fade show">
                        <span class="badge badge-pill badge-primary">Success</span>
                        {{ Session::get('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">List Foto Barang </h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h tableFixHead">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="serial">#</th>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Nomor</th>
                                        <th>Total Transaksi</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($datas as $data)
                                        <tr>
                                            <td class="serial">-</td>
                                            <td> <span>{{ $data->id }}</span> </td>
                                            <td> <span class="name">{{ Str::limit($data->name, 20, '...') }}</span> </td>
                                            <td> <span class="name"> {{ Str::limit($data->email, 25, '...') }} </span>
                                            </td>
                                            <td> <span class="name">{{ $data->number }}</span> </td>
                                            <td> <span class="">Rp {{ number_format($data->transaction_total) }}</span>
                                            </td>
                                            <td>
                                                @if ($data->transaction_status == 'PENDING')
                                                    <span class="badge badge-info">
                                                    @elseif($data->transaction_status == 'SUCCESS')
                                                        <span class="badge badge-success">
                                                        @elseif($data->transaction_status == 'FAILED')
                                                            <span class="badge badge-warning">
                                                            @else
                                                                <span>
                                                @endif
                                                {{ $data->transaction_status }}
                                                </span>
                                            </td>
                                            <td>
                                                @if ($data->transaction_status == 'PENDING')
                                                    <a href="{{ route('transactions.status', $data->id) }}?status=SUCCESS"
                                                        class="btn btn-success btn-sm"><i class="fa fa-check"></i></a>
                                                    <a href="{{ route('transactions.status', $data->id) }}?status=FAILED"
                                                        class="btn btn-warning btn-sm"><i class="fa fa-times"></i></a>
                                                @endif
                                                <a href="#mymodal" data-remote="{{ route('transactions.show', $data->id) }}"
                                                    class="btn btn-info btn-sm" data-toggle="modal" data-target="#mymodal"
                                                    data-title="Detail Transaksi {{ $data->uuid }}"><i
                                                        class="fa fa-eye"></i></a>
                                                <a href="{{ route('transactions.edit', $data->id) }}" type="button"
                                                    class="btn btn-primary btn-sm"><span class="fa  fa-pencil"></span></a>
                                                <form id="data-{{ $data->id }}"
                                                    action="{{ route('transactions.destroy', $data->id) }}" method="post"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                                <button onclick="deleteRow( {{ $data->id }} )"
                                                    class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center p-5">
                                                Data tidak tersedia.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div> <!-- /.table-stats -->
                    </div>
                </div> <!-- /.card -->
            </div> <!-- /.col-lg-8 -->
        </div>
    </div>
    <!-- /.orders -->

    {{-- modal --}}
    <div class="modal" id="mymodal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Transaksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <i class="fa fa-spinner fa-spin"></i>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('after-script')

    {{-- sweetalert cdn script --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    {{-- script untuk konfirmasi delete dengan sweetalert --}}
    <script>
        function deleteRow(id) {
            swal({
                    title: "Anda yakin?",
                    text: "Setelah dihapus, Anda tidak akan dapat memulihkan file ini!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        swal("Poof! File Anda telah dihapus!", {
                            icon: "success",
                        });
                        setTimeout(function() {
                            jQuery('#data-' + id).submit();
                        }, 1000);
                    } else {
                        swal("Your file is safe!");
                    }
                });
        }

    </script>

    <script>
        jQuery(document).ready(function($) {
            $('#mymodal').on('show.bs.modal', function(e) {
                var button = $(e.relatedTarget);
                var modal = $(this);

                modal.find('.modal-body').load(button.data("remote"));
                modal.find('.modal-title').html(button.data("title"));
            });
        });

    </script>
@endpush
