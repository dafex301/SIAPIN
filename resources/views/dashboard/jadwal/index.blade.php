@extends('layouts.app')


@section('title')
    Jadwal
@endsection


@section('activeExams')
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
                            <span>{{ __('Jadwal Praktikum') }}</span>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary rounded-0 shadow-none ms-auto" data-bs-toggle="modal"
                                data-bs-target="#ExamAddModal">
                                <span class="me-2"><i class="fa-solid fa-square-plus"></i></span>
                                {{ __('Tambah Jadwal Praktikum') }}
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="ExamAddModal" data-bs-backdrop="static" data-bs-keyboard="false"
                                tabindex="-1" aria-labelledby="ExamAddModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ExamAddModalLabel">Data Jadwal Praktikum</h5>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <input class="id form-control" type="hidden" id="id" name="id">

                                                <div class="row mb-3">
                                                    <div class="col-md-10 m-auto">
                                                        <small class="fs-6 text-muted">Mata Kuliah Praktikum</small>
                                                        <select name="matkul_id" id="matkul_id" size="4"
                                                            class="matkul_id form-control shadow-none rounded-0">
                                                            @foreach ($matkul as $m)
                                                                <option value="{{ $m->id }}">{{ $m->nama_matkul }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <small class="matkul_id_error fs-5 text-danger"></small>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-10 m-auto">
                                                        <small class="fs-6 text-muted">Lab</small>
                                                        <select name="lab_id" id="lab_id" size="4"
                                                            class="lab_id form-control shadow-none rounded-0">
                                                            @foreach ($lab as $l)
                                                                <option value="{{ $l->id }}">{{ $l->nama_lab }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <small class="lab_id_error fs-5 text-danger"></small>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-10 m-auto">
                                                        <small class="fs-6 text-muted">Start Time</small>
                                                        <input id="start" type="time"
                                                            class="start form-control shadow-none rounded-0" name="start"
                                                            value="{{ old('start') }}" required autocomplete="start"
                                                            autofocus>
                                                        <small class="start_error fs-6 text-danger"></small>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-10 m-auto">
                                                        <small class="fs-6 text-muted">End Time</small>
                                                        <input id="end" type="time"
                                                            class="end form-control shadow-none rounded-0" name="end"
                                                            value="{{ old('end') }}" required autocomplete="end"
                                                            autofocus>
                                                        <small class="end_error fs-6 text-danger"></small>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="rounded-0 shadow-none btn btn-danger"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="button"
                                                class="addExam rounded-0 shadow-none btn btn-primary">{{ __('Tambah Jadwal') }}</button>
                                            <button type="button"
                                                class="updateExam rounded-0 shadow-none btn btn-info">{{ __('Update Jadwal') }}</button>
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
                                        <th scope="row">Mata Kuliah Praktikum</th>
                                        <th scope="row">Lab</th>
                                        <th scope="row">Start Time</th>
                                        <th scope="row">End Time</th>
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
                    url: "/dashboard/jadwal/getJadwal",
                    dataType: "json",
                    success: function(response) {
                        var count = 1;
                        $('tbody').empty();
                        // count++
                        // console.log(response.exams);
                        $.each(response.jadwals, function(key, item) {
                            $('tbody').append(
                                '<tr class="align-middle"><td>' + count++ + '</td><td>' +
                                item.nama_matkul +
                                '</td><td>' +
                                item.nama_lab +
                                '</td><td>' +
                                item.start +
                                '</td><td>' +
                                item.end +
                                '</td><td class="text-center"><button type="button" value="' +
                                item.id +
                                '" class="exam-edit btn btn-outline-info mx-1 shadow-none"> <i class="fa-solid fa-pen-to-square"></i></button><button type="button" value="' +
                                item.id +
                                '"class="exam-delete btn btn-outline-danger mx-1 shadow-none"><i class="fa-solid fa-trash"></i></button><button type="button" value="' +
                                item.id +
                                '"class="exam-input btn btn-outline-dark mx-1 shadow-none"><i class="fa-solid fa-qrcode"></i></button></td></tr>'
                            );

                        });
                    }
                });
            }
            $(document).on('click', '.addExam', function(e) {
                e.preventDefault(e);
                var data = {
                    'lab_id': $('.lab_id').val(),
                    'matkul_id': $('.matkul_id').val(),
                    'start': $('.start').val(),
                    'end': $('.end').val(),
                };


                $.ajax({
                    type: "POST",
                    url: "/dashboard/jadwal/store",
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        $('.lab_id').removeClass('is-invalid');
                        $('.matkul_id').removeClass('is-invalid');
                        $('.start').removeClass('is-invalid');
                        $('.end').removeClass('is-invalid');

                        $('.lab_id_error').empty();
                        $('.matkul_id_error').empty();
                        $('.start_error').empty();
                        $('.end_error').empty();

                        if (response.status == false) {


                            if (response.errors['lab_id'] != null) {
                                $('.lab_id').addClass('is-invalid');
                                $('.lab_id_error').append(response.errors['lab_id']);
                            }
                            if (response.errors['matkul_id'] != null) {
                                $('.matkul_id').addClass('is-invalid');
                                $('.matkul_id_error').append(response.errors['matkul_id']);
                            }
                            if (response.errors['start'] != null) {
                                $('.start').addClass('is-invalid');
                                $('.start_error').append(response.errors['start']);
                            }
                            if (response.errors['end'] != null) {
                                $('.end').addClass('is-invalid');
                                $('.end_error').append(response.errors['end']);
                            }
                        } else {
                            fetch();
                            toastr.success(response.success);
                        }

                    }
                });
            });

            $(document).on('click', '.exam-edit', function(e) {
                e.preventDefault(e);
                // console.log('run');
                var jadwalId = $(this).val();

                $.ajax({
                    type: "GET",
                    url: `/dashboard/jadwal/edit/${jadwalId}`,
                    dataType: "json",
                    success: function(response) {
                        // console.log(response);
                        $('#id').val(response.jadwal.id);
                        $('#matkul_id').val(response.jadwal.matkul_id);
                        $('#lab_id').val(response.jadwal.lab_id);
                        $('#start').val(response.jadwal.start);
                        $('#end').val(response.jadwal.end);
                        $('#ExamAddModal').modal('show');
                    }
                });
            });
            $(document).on('click', '.updateExam', function(e) {
                e.preventDefault(e);
                // console.log('runn');
                var data = {
                    'id': $('.id').val(),
                    'matkul_id': $('.matkul_id').val(),
                    'lab_id': $('.lab_id').val(),
                    'start': $('.start').val(),
                    'end': $('.end').val(),
                };


                $.ajax({
                    type: "POST",
                    url: "/dashboard/jadwal/update",
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        $('.lab_id').removeClass('is-invalid');
                        $('.matkul_id').removeClass('is-invalid');
                        $('.start').removeClass('is-invalid');
                        $('.end').removeClass('is-invalid');

                        $('.lab_id_error').empty();
                        $('.matkul_id_error').empty();
                        $('.start_error').empty();
                        $('.end_error').empty();


                        // console.log(response);
                        if (response.status == false) {
                            if (response.errors['lab_id'] != null) {
                                $('.lab_id').addClass('is-invalid');
                                $('.lab_id_error').append(response.errors['lab_id']);
                            }
                            if (response.errors['matkul_id'] != null) {
                                $('.matkul_id').addClass('is-invalid');
                                $('.matkul_id_error').append(response.errors['matkul_id']);
                            }
                            if (response.errors['start'] != null) {
                                $('.start').addClass('is-invalid');
                                $('.start_error').append(response.errors['start']);
                            }
                            if (response.errors['end'] != null) {
                                $('.end').addClass('is-invalid');
                                $('.end_error').append(response.errors['end']);
                            }
                        } else {
                            fetch();
                            toastr.success(response.success);
                        }

                    }
                });

                $(document).on('click', '.exam-delete', function(e) {
                    e.preventDefault(e);
                    var jadwalId = $(this).val();
                    console.log(jadwalId);

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
                                url: `/dashboard/jadwal/destroy/${matkulId}`,
                                dataType: "json",
                                success: function(response) {
                                    fetchColleges();
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

            $(document).on('click', '.exam-delete', function(e) {
                e.preventDefault(e);
                var jadwal = $(this).val();
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
                            url: `/dashboard/jadwal/destroy/${jadwal}`,
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


            $(document).on('click', '.exam-input', function(e) {
                e.preventDefault(e);
                var jadwalId = $(this).val();
                // console.log(jadwalId);
                window.location.href = `/dashboard/jadwal/inputJadwal/${jadwalId}`;
            });
        });
    </script>
@endsection
