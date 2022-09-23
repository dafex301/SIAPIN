@extends('layouts.app')


@section('title')
    Peserta Praktikum
@endsection


@section('activeStudentExam')
    active border-2 border-bottom border-primary
@endsection


@section('content')
    @include('components.navbar')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border-0 shadow-lg">
                    <div class="card-header border-0 bg-transparent mb-2 fs-2 text-primary lead">
                        <div class="d-flex justify-content-between">
                            <span>{{ __('Peserta Praktikum') }}</span>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary rounded-0 shadow-none ms-auto" data-bs-toggle="modal"
                                data-bs-target="#studentExams">
                                <span class="me-2"><i class="fa-solid fa-square-plus"></i></span>
                                {{ __('Tambah Peserta Praktikum') }}
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="studentExams" data-bs-backdrop="static" data-bs-keyboard="false"
                                tabindex="-1" aria-labelledby="studentExamsLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="studentExamsLabel">Data Peserta Praktikum</h5>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <input class="id form-control" type="hidden" id="id" name="id">
                                                <div class="row mb-3">
                                                    <div class="col-md-10 m-auto">
                                                        <small class="fs-6 text-muted">Student Name</small>
                                                        <select name="mahasiswa_id" id="mahasiswa_id" size="4"
                                                            class="mahasiswa_id form-control shadow-none rounded-0">
                                                            @foreach ($mahasiswas as $mahasiswa)
                                                                <option value="{{ $mahasiswa->id }}">
                                                                    {{ $mahasiswa->nama }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <small class="mahasiswa_id_error fs-5 text-danger"></small>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-10 m-auto">
                                                        <small class="fs-6 text-muted">Exame Name</small>
                                                        <select name="jadwal_id" id="jadwal_id" size="4"
                                                            class="jadwal_id form-control shadow-none rounded-0">
                                                            @foreach ($allJadwal as $jadwal)
                                                                <option value="{{ $jadwal->id }}">
                                                                    {{ $jadwal->nama_matkul }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <small class="jadwal_id_error fs-5 text-danger"></small>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="rounded-0 shadow-none btn btn-danger"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="button"
                                                class="addExamStudent rounded-0 shadow-none btn btn-primary">{{ __('Tambah Peserta Prak') }}</button>
                                            <button type="button"
                                                class="updateExamStudent rounded-0 shadow-none btn btn-info">{{ __('Update Peserta Prak') }}</button>
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
                                        <th scope="row">Peserta Praktikum</th>
                                        <th scope="row">Mata Kuliah</th>
                                        <th scope="row">Lab</th>
                                        <th scope="row">Start Time</th>
                                        <th scope="row">End Time</th>
                                        <th scope="row">Present</th>
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

            function isPresenCheckt(isPresent) {

                if (isPresent == 1) {
                    return `<span class="badge bg-success">Present</span>`;
                } else {
                    return `<span class="badge bg-danger">Absent</span>`;
                }
            }



            function fetch() {
                $.ajax({
                    type: "GET",
                    url: "/dashboard/mhspraktikum/getMhsPraktikum",
                    dataType: "json",
                    success: function(response) {
                        // console.log(response.student_exams);
                        var count = 1;
                        $('tbody').empty();
                        $.each(response.mhs_praktikums, function(key, item) {
                            $('tbody').append(
                                '<tr class="align-middle"><td>' + count++ + '</td><td>' +
                                item.nama +
                                '</td><td>' +
                                item.nama_matkul +
                                '</td><td>' +
                                item.nama_lab +
                                '</td><td>' +
                                item.start +
                                '</td><td>' +
                                item.end +
                                '</td><td>' + isPresenCheckt(item.isPresent) +
                                '</td><td class="text-center"><button type="button" value="' +
                                item.id +
                                '" class="studentExams-edit btn btn-outline-info mx-1 shadow-none"> <i class="fa-solid fa-pen-to-square"></i></button><button type="button" value="' +
                                item.id +
                                '"class="studentExams-delete btn btn-outline-danger mx-1 shadow-none"><i class="fa-solid fa-trash"></i></button></td></tr>'
                            );

                        });
                    }
                });
            }
            $(document).on('click', '.addExamStudent', function(e) {
                e.preventDefault(e);
                var data = {
                    'mahasiswa_id': $('.mahasiswa_id').val(),
                    'jadwal_id': $('.jadwal_id').val(),
                };
                $.ajax({
                    type: "POST",
                    url: "/dashboard/mhspraktikum/store",
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        $('.mahasiswa_id').removeClass('is-invalid');
                        $('.jadwal_id').removeClass('is-invalid');

                        $('.mahasiswa_id_error').empty();
                        $('.jadwal_id_error').empty();


                        if (response.status == false) {


                            if (response.errors['mahasiswa_id'] != null) {
                                $('.mahasiswa_id').addClass('is-invalid');
                                $('.mahasiswa_id_error').append(response.errors[
                                    'mahasiswa_id']);
                            }
                            if (response.errors['jadwal_id'] != null) {
                                $('.jadwal_id').addClass('is-invalid');
                                $('.jadwal_id_error').append(response.errors['jadwal_id']);
                            }

                        } else {
                            fetch();
                            // console.log(response.success);
                            toastr.success(response.success);
                        }

                    }
                });
            });

            $(document).on('click', '.studentExams-edit', function(e) {
                e.preventDefault(e);
                // console.log('run');
                var jadwalId = $(this).val();

                $.ajax({
                    type: "GET",
                    url: `/dashboard/mhspraktikum/edit/${jadwalId}`,
                    dataType: "json",
                    success: function(response) {
                        // console.log(response);
                        $('#id').val(response.mhs_praktikum.id);
                        $('#jadwal_id').val(response.mhs_praktikum.jadwal_id);
                        $('#mahasiswa_id').val(response.mhs_praktikum.mahasiswa_id);
                        $('#studentExams').modal('show');
                    }
                });
            });
            $(document).on('click', '.updateExamStudent', function(e) {
                e.preventDefault(e);
                var data = {
                    'id': $('.id').val(),
                    'jadwal_id': $('.jadwal_id').val(),
                    'mahasiswa_id': $('.mahasiswa_id').val(),
                };


                $.ajax({
                    type: "POST",
                    url: "/dashboard/mhspraktikum/update",
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        $('.jadwal_id').removeClass('is-invalid');
                        $('.mahasiswa_id').removeClass('is-invalid');

                        $('.jadwal_id_error').empty();
                        $('.mahasiswa_id_error').empty();


                        // console.log(response);
                        if (response.status == false) {
                            if (response.errors['jadwal_id'] != null) {
                                $('.jadwal_id').addClass('is-invalid');
                                $('.jadwal_id_error').append(response.errors['jadwal_id']);
                            }
                            if (response.errors['mahasiswa_id'] != null) {
                                $('.mahasiswa_id').addClass('is-invalid');
                                $('.mahasiswa_id_error').append(response.errors[
                                    'mahasiswa_id']);
                            }
                        } else {
                            fetch();
                            // console.log(response.success);
                            toastr.success(response.success);
                        }

                    }
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
                                url: `/dashboard/mhspraktikum/destroy/${matkulId}`,
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

            $(document).on('click', '.studentExams-delete', function(e) {
                e.preventDefault(e);
                var Id = $(this).val();

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
                            url: `/dashboard/mhspraktikum/destroy/${Id}`,
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
