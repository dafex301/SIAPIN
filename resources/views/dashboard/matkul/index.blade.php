@extends('layouts.app')


@section('title')
    Mata Kuliah Praktikum
@endsection


@section('activeCourses')
    active border-2 border-bottom border-primary
@endsection


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-lg">
                    <div class="card-header border-0 bg-transparent mb-2 fs-2 text-primary lead">
                        <div class="d-flex justify-content-between">
                            <span>{{ __('Mata Kuliah Praktikum') }}</span>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary rounded-0 shadow-none ms-auto" data-bs-toggle="modal"
                                data-bs-target="#CoursesAddModal">
                                <span class="me-2"><i class="fa-solid fa-square-plus"></i></span>
                                {{ __('Tambah MK Praktikum') }}
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="CoursesAddModal" data-bs-backdrop="static" data-bs-keyboard="false"
                                tabindex="-1" aria-labelledby="CoursesAddModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="CoursesAddModalLabel">Data MK Praktikum</h5>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <input class="id form-control" type="hidden" id="id" name="id">
                                                <div class="row mb-3">
                                                    <div class="col-md-10 m-auto">
                                                        <input id="kode_matkul" type="text"
                                                            class="kode_matkul form-control shadow-none rounded-0"
                                                            name="kode_matkul" value="{{ old('kode_matkul') }}" required
                                                            autocomplete="kode_matkul" autofocus
                                                            placeholder="Kode Matkul ...">
                                                        <small class="kode_error fs-5 text-danger"></small>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-10 m-auto">
                                                        <input id="nama_matkul" type="text"
                                                            class="nama_matkul form-control shadow-none rounded-0"
                                                            name="nama_matkul" value="{{ old('nama_matkul') }}" required
                                                            autocomplete="nama_matkul" autofocus
                                                            placeholder="Nama Matkul ...">
                                                        <small class="nama_matkul_error fs-5 text-danger"></small>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-10 m-auto">
                                                        <input id="pertemuan" type="text"
                                                            class="pertemuan form-control shadow-none rounded-0"
                                                            name="pertemuan" value="{{ old('pertemuan') }}" required
                                                            autocomplete="pertemuan" autofocus placeholder="Pertemuan ...">
                                                        <small class="pertemuan_error fs-5 text-danger"></small>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="rounded-0 shadow-none btn btn-danger"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="button"
                                                class="addCourse rounded-0 shadow-none btn btn-primary">{{ __('Tambah MK Prak') }}</button>
                                            <button type="button"
                                                class="updateCourse rounded-0 shadow-none btn btn-info">{{ __('Update MK Prak') }}</button>
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
                                        <th scope="row">Kode</th>
                                        <th scope="row">Nama Mata Kuliah</th>
                                        <th scope="row">Pertemuan</th>
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
                    url: "/dashboard/matkul/getMatkul",
                    dataType: "json",
                    success: function(response) {
                        var count = 1;
                        $('tbody').empty();
                        $.each(response.matkuls.data, function(key, item) {
                            $('tbody').append(
                                '<tr class="align-middle"><td>' + count++ + '</td><td>' +
                                item.kode_matkul +
                                '</td><td>' +
                                item.nama_matkul +
                                '</td><td>' +
                                item.pertemuan +
                                '</td><td class="text-center"><button type="button" value="' +
                                item.id +
                                '" class="course-edit btn btn-outline-info mx-1 shadow-none"> <i class="fa-solid fa-pen-to-square"></i></button><button type="button" value="' +
                                item.id +
                                '"class="course-delete btn btn-outline-danger mx-1 shadow-none"><i class="fa-solid fa-trash"></i></button></td></tr>'
                            );

                        });
                    }
                });
            }
            $(document).on('click', '.addCourse', function(e) {
                e.preventDefault(e);
                var data = {
                    'kode_matkul': $('.kode_matkul').val(),
                    'nama_matkul': $('.nama_matkul').val(),
                    'pertemuan': $('.pertemuan').val(),
                };


                $.ajax({
                    type: "POST",
                    url: "/dashboard/matkul/store",
                    data: data,
                    dataType: "json",
                    success: function(response) {

                        $('.kode_matkul').removeClass('is-invalid');
                        $('.kode_matkul_error').empty();
                        $('.nama_matkul').removeClass('is-invalid');
                        $('.nama_matkul_error').empty();
                        $('.pertemuan').removeClass('is-invalid');
                        $('.pertemuan_error').empty();
                        if (response.status == false) {

                            if (response.errors['kode_matkul'] != null) {
                                $('.kode_matkul').addClass('is-invalid');
                                $('.kode_matkul_error').append(response.errors['kode_matkul']);
                            }
                            if (response.errors['nama_matkul'] != null) {
                                $('.nama_matkul').addClass('is-invalid');
                                $('.nama_matkul_error').append(response.errors['nama_matkul']);
                            }
                            if (response.errors['pertemuan'] != null) {
                                $('.pertemuan').addClass('is-invalid');
                                $('.pertemuan_error').append(response.errors['pertemuan']);
                            }
                        } else {
                            fetch();
                            toastr.success(response.success);
                        }

                    }
                });
            });

            $(document).on('click', '.course-edit', function(e) {
                e.preventDefault(e);
                var matkulId = $(this).val();

                $.ajax({
                    type: "GET",
                    url: `/dashboard/matkul/edit/${matkulId}`,
                    dataType: "json",
                    success: function(response) {

                        $('#id').val(response.matkul.id);
                        $('#kode_matkul').val(response.matkul.kode_matkul);
                        $('#nama_matkul').val(response.matkul.nama_matkul);
                        $('#pertemuan').val(response.matkul.pertemuan);
                        $('#CoursesAddModal').modal('show');
                    }
                });
                // console.log(courseId);
            });
            $(document).on('click', '.updateCourse', function(e) {
                e.preventDefault(e);
                var data = {
                    'id': $('.id').val(),
                    'kode_matkul': $('.kode_matkul').val(),
                    'nama_matkul': $('.nama_matkul').val(),
                    'pertemuan': $('.pertemuan').val(),
                };


                $.ajax({
                    type: "POST",
                    url: "/dashboard/matkul/update",
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        $('.kode_matkul').removeClass('is-invalid');
                        $('.kode_matkul_error').empty();
                        $('.nama_matkul').removeClass('is-invalid');
                        $('.nama_matkul_error').empty();
                        $('.pertemuan').removeClass('is-invalid');
                        $('.pertemuan_error').empty();
                        if (response.info != null) {
                            toastr.info(response.info);
                        } else {
                            if (response.status == false) {
                                if (response.errors['kode_matkul'] != null) {
                                    $('.kode_matkul').addClass('is-invalid');
                                    $('.kode_matkul_error').append(response.errors[
                                        'kode_matkul']);
                                }
                                if (response.errors['nama_matkul'] != null) {
                                    $('.nama_matkul').addClass('is-invalid');
                                    $('.nama_matkul_error').append(response.errors[
                                        'nama_matkul']);
                                }
                                if (response.errors['pertemuan'] != null) {
                                    $('.pertemuan').addClass('is-invalid');
                                    $('.pertemuan_error').append(response.errors['pertemuan']);
                                }
                            } else {
                                fetch();
                                toastr.success(response.success);
                            }
                        }
                        // console.log(response.info);
                    }
                });
            });

            $(document).on('click', '.course-delete', function(e) {
                e.preventDefault(e);
                var matkulId = $(this).val();

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
                            url: `/dashboard/matkul/destroy/${matkulId}`,
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
