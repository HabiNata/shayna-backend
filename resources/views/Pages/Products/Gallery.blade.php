@extends('Layouts.Index')

@push('after-style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css"
        integrity="sha512-ZKX+BvQihRJPA8CROKBhDNvoc2aDMOdAlcm7TUQY+35XYtrd3yh95QOOhsPDQY9QnKE0Wqag9y38OIgEvb88cA=="
        crossorigin="anonymous" />

    <link rel="stylesheet" href="{{ asset('assets/css/lib/datatable/dataTables.bootstrap.min.css') }}">
@endpush

@section('content')
    <!-- Orders -->
    <div class="orders">
        <div class="row justify-content-center ">
            <div class="col-xl-11">
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
                        <div class="table-stats order-table ov-h">
                            <table id="example" class="table table-striped table-bordered display responsive nowrap"
                                width="100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Produk</th>
                                        <th>Foto</th>
                                        <th>Is Default</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div> <!-- /.table-stats -->
                    </div>
                </div> <!-- /.card -->
            </div> <!-- /.col-lg-8 -->
        </div>
    </div>
    <!-- /.orders -->
@endsection

@push('after-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"
        integrity="sha512-k2GFCTbp9rQU412BStrcD/rlwv1PYec9SNrkbQlo6RZCf75l6KcC3UwDY8H5n5hl4v77IDtIPwOk9Dqjs/mMBQ=="
        crossorigin="anonymous"></script>

    {{-- sweetalert cdn script --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    {{-- Datatabels --}}
    <script src="{{ asset('assets/js/lib/data-table/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/data-table/dataTables.bootstrap.min.js') }}"></script>

    {{-- datatables --}}
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#example').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "ajax": '/galleryJson/{{ $datas ? $datas->products_id : 0 }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'image',
                        name: 'image',
                        render: function(data, type, row) {
                            return '<a href="' + data + '" data-lightbox="image"><img src = "' +
                                data + '" alt = "" ></a>';
                        },
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'is_default',
                        name: 'is_default'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            // setInterval(function() {
            //     table.ajax.reload();
            // }, 2000);
        });

    </script>

    {{-- delete-rows --}}
    <script type="text/javascript">
        $(document).on('click', ".delete-row", function(e) {
            var table = $('#example').DataTable();

            let button = $(this);
            let id = $(this).attr('data-id');
            let tr = $(this).closest('tr');

            // sweetalert
            swal({
                    title: "Anda yakin?",
                    text: "Setelah dihapus, Anda tidak akan dapat memulihkan data ini!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: 'DELETE',
                            url: '/productsgallery/' + id,
                            data: {
                                '_token': $('input[name="_token"]').val(),
                                'id': id
                            },
                            success: function(response) {
                                if (response.didSucceed) {
                                    tr.remove();
                                    swal("Poof! Data Anda telah dihapus!", {
                                        icon: "success",
                                    });
                                    table.ajax.reload();
                                } else {
                                    swal("Error! Data Anda gagal dihapus!", {
                                        icon: "error",
                                    });
                                }
                            },
                            error: function(response) {
                                console.log('Error:', response);
                            }
                        });
                    } else {
                        swal("Data anda aman!");
                    }
                });
        });

    </script>
@endpush
