@extends('Layouts.Index')

@push('after-style')
    <link rel="stylesheet" href="{{ asset('assets/css/lib/datatable/dataTables.bootstrap.min.css') }}">
@endpush

@section('content')
    <!-- Orders -->
    <div class="orders">
        <div class="row justify-content-center ">
            <div class="col-xl-11">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">List Barang </h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table id="example" class="table table-striped table-bordered display responsive nowrap"
                                width="100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
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
    {{-- sweetalert cdn script --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    {{-- Datatabels --}}
    <script src="{{ asset('assets/js/lib/data-table/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/data-table/dataTables.bootstrap.min.js') }}"></script>

    {{-- datatables --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').dataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "ajax": 'products/json',
                columns: [
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'type',
                        name: 'type'
                    },
                    {
                        data: 'quantity',
                        name: 'quantity'
                    },
                    {
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });

    </script>

    {{-- delete-rows --}}
    <script type="text/javascript">
        $(document).on('click', ".delete-row", function(e) {
            let table = $('#example').DataTable();
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
                            url: '/products/' + id,
                            data: {
                                '_token': $('input[name="_token"]').val(),
                                'id': id
                            },
                            success: function(response) {
                                if (response.didSucceed) {
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
