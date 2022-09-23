@extends('layouts.app')


@section('title')
    Lab
@endsection


@section('activeHalls')
    active border-2 border-bottom border-primary
@endsection


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-0 shadow-lg">
                    <div class="card-header border-0 bg-transparent mb-2 fs-2 text-primary lead">
                        <div class="d-flex justify-content-between">
                            <span>{{ __('Lab') }}</span>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary rounded-0 shadow-none ms-auto" data-bs-toggle="modal"
                                data-bs-target="#HallsAddModal">
                                <span class="me-2"><i class="fa-solid fa-square-plus"></i></span>
                                {{ __('Tambah Lab') }}
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="HallsAddModal" data-bs-backdrop="static" data-bs-keyboard="false"
                                tabindex="-1" aria-labelledby="HallsAddModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="HallsAddModalLabel">Data Lab</h5>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <input class="id form-control" type="hidden" id="id" name="id">
                                                <div class="row mb-3">
                                                    <div class="col-md-10 m-auto">
                                                        <input id="nama_lab" type="text"
                                                            class="nama_lab form-control shadow-none rounded-0"
                                                            name="nama_lab" value="{{ old('nama_lab') }}" required
                                                            autocomplete="nama_lab" autofocus placeholder="Nama Lab ...">
                                                        <small class="nama_lab_error fs-5 text-danger"></small>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-10 m-auto">
                                                        <input id="lantai" type="text"
                                                            class="lantai form-control shadow-none rounded-0" name="lantai"
                                                            value="{{ old('lantai') }}" required autocomplete="lantai"
                                                            autofocus placeholder="Lantai ...">
                                                        <small class="lantai_error fs-5 text-danger"></small>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-10 m-auto">
                                                        <input id="kapasitas" type="text"
                                                            class="kapasitas form-control shadow-none rounded-0"
                                                            name="kapasitas" value="{{ old('kapasitas') }}" required
                                                            autocomplete="kapasitas" autofocus placeholder="Kapasitas ...">
                                                        <small class="kapasitas_error fs-5 text-danger"></small>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="rounded-0 shadow-none btn btn-danger"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="button"
                                                class="addHall rounded-0 shadow-none btn btn-primary">{{ __('Tambah Lab') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12 table-responsive" id="collegesTable">
                            <table class="table table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="row">#</th>
                                        <th scope="row">Nama</th>
                                        <th scope="row">Lantai</th>
                                        <th scope="row">Kapasitas</th>
                                        <th scope="row" class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection



@section('scripts')
    @if (session()->has('success'))
        <script>
            toastr.success('{{ session()->get('success') }}');
        </script>
    @endif

    @if (session()->has('error'))
        <script>
            toastr.error('{{ session()->get('error') }}');
        </script>
    @endif

    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            fetch();

            function fetch() {
                $.ajax({
                    type: "GET",
                    url: "/dashboard/lab/getLab",
                    dataType: "json",
                    success: function(response) {
                        // console.log(response);
                        var count = 1;
                        $('tbody').empty();
                        $.each(response.labs.data, function(key, item) {
                            $('tbody').append(
                                '<tr class="align-middle"><td>' + count++ + '</td><td>' +
                                item.nama_lab +
                                '</td><td>' + item.lantai + '</td><td>' + item.kapasitas +
                                '</td><td class="text-center"><button type="button" value="' +
                                item.id +
                                '"class="hall-delete btn btn-outline-danger mx-1 shadow-none"><i class="fa-solid fa-trash"></i></button></td></tr>'
                            );

                        });
                    }
                });
            }
            $(document).on('click', '.addHall', function(e) {
                e.preventDefault(e);
                var data = {
                    'nama_lab': $('.nama_lab').val(),
                    'lantai': $('.lantai').val(),
                    'kapasitas': $('.kapasitas').val(),
                };


                $.ajax({
                    type: "POST",
                    url: "/dashboard/lab/store",
                    data: data,
                    dataType: "json",
                    success: function(response) {

                        $('.nama_lab').removeClass('is-invalid');
                        $('.nama_lab_error').empty();
                        $('.lantai').removeClass('is-invalid');
                        $('.lantai_error').empty();
                        $('.kapasitas').removeClass('is-invalid');
                        $('.kapasitas_error').empty();


                        if (response.status == false) {

                            if (response.errors['nama_lab'] != null) {
                                $('.nama_lab').addClass('is-invalid');
                                $('.nama_lab_error').append(response.errors['nama_lab']);
                            }
                            if (response.errors['lantai'] != null) {
                                $('.lantai').addClass('is-invalid');
                                $('.lantai_error').append(response.errors['lantai']);
                            }
                            if (response.errors['kapasitas'] != null) {
                                $('.kapasitas').addClass('is-invalid');
                                $('.kapasitas_error').append(response.errors['kapasitas']);
                            }
                        } else {
                            fetch();
                            toastr.success(response.success);
                            // console.log(response.success);
                        }

                    }
                });
            });
            $(document).on('click', '.hall-delete', function(e) {
                e.preventDefault(e);
                var labid = $(this).val();

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "GET",
                            url: `/dashboard/lab/destroy/${labid}`,
                            dataType: "json",
                            success: function(response) {
                                fetch();
                                if (response.status == true) {
                                    Swal.fire(
                                        'Deleted!',
                                        response.success,
                                        'success'
                                    );
                                }
                            }
                        });

                    }
                })
            });
        });
    </script>
@endsection
