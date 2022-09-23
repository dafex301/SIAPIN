{{-- @extends('layouts.main')

@section('container')
    @include('components.navbar')
    <table>
        <thead>
            <tr>
                <th>NIM</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mahasiswa as $m)
                <tr>
                    <td>{{ $m->nim }}</td>
                    <td>{{ $m->nama }}</td>
                    <td>{{ $m->email }}</td>
                    <td class="flex">
                        <a href="/dashboard/mahasiswa/create"
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Add
                        </a>
                        <a href="/dashboard/mahasiswa/{{ $m->id }}/edit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Edit
                        </a>
                        <form action="/dashboard/mahasiswa/{{ $m->id }}" method="POST" class="d-inline">
                            @method('delete')
                            @csrf
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        @endsection --}}

@extends('layouts.app')


@section('title')
    Students
@endsection


@section('activeStudents')
    active border-2 border-bottom border-primary
@endsection


@section('content')
{{-- @include('components.navbar') --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border-0 shadow-lg">
                    <div class="card-header border-0 bg-transparent mb-2 fs-2 text-primary lead">
                        <div class="d-flex justify-content-between">
                            <span>{{ __('Daftar Mahasiswa') }}</span>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary rounded-0 shadow-none ms-auto" data-bs-toggle="modal"
                                data-bs-target="#StudentAddModal">
                                <span class="me-2"><i class="fa-solid fa-square-plus"></i></span>
                                {{ __('Tambah Mahasiswa') }}
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="StudentAddModal" data-bs-backdrop="static" data-bs-keyboard="false"
                                tabindex="-1" aria-labelledby="StudentAddModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="StudentAddModalLabel">Data Mahasiswa</h5>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <input class="id form-control" type="hidden" id="id" name="id">
                                                <div class="row mb-3">
                                                    <div class="col-md-10 m-auto">
                                                        <input id="nama" type="text"
                                                            class="nama form-control shadow-none rounded-0"
                                                            name="nama" value="{{ old('nama') }}" required
                                                            autocomplete="nama" autofocus placeholder="Nama ...">
                                                        <small class="studentName_error fs-5 text-danger"></small>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-10 m-auto">
                                                        <input id="nim" type="text"
                                                            class="nim form-control shadow-none rounded-0"
                                                            name="nim" value="{{ old('nim') }}" required
                                                            autocomplete="nim" autofocus placeholder="NIM ...">
                                                        <small class="studentId_error fs-5 text-danger"></small>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-10 m-auto">
                                                        <input id="phone" type="tel"
                                                            class="phone form-control shadow-none rounded-0" name="phone"
                                                            value="{{ old('phone') }}" required autocomplete="phone"
                                                            autofocus placeholder="phone ...">
                                                        <small class="phone_error fs-5 text-danger"></small>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-10 m-auto">
                                                        <input id="email" type="email"
                                                            class="email form-control shadow-none rounded-0" name="email"
                                                            value="{{ old('email') }}" required autocomplete="email"
                                                            autofocus placeholder="E-mail ...">
                                                        <small class="email_error fs-5 text-danger"></small>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="rounded-0 shadow-none btn btn-danger"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="button"
                                                class="addStudent rounded-0 shadow-none btn btn-primary">{{ __('Add New Student') }}</button>
                                            <button type="button"
                                                class="updateStudent rounded-0 shadow-none btn btn-info">{{ __('Update Student') }}</button>
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
                                        <th scope="row">Name</th>
                                        <th scope="row">NIM</th>
                                        <th scope="row">Phone</th>
                                        <th scope="row">E-mail</th>
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

            function getAge(dateString) {
                var today = new Date();
                var birthDate = new Date(dateString);
                var age = today.getFullYear() - birthDate.getFullYear();
                var m = today.getMonth() - birthDate.getMonth();
                if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }
                return age;
            }
            fetch();

            function fetch() {
                $.ajax({
                    type: "GET",
                    url: "/dashboard/mahasiswa/getMahasiswa",
                    dataType: "json",
                    success: function(response) {
                        var count = 1;
                        $('tbody').empty();
                        $.each(response.mahasiswas.data, function(key, item) {
                            $('tbody').append(
                                '<tr class="align-middle"><td>' + count++ + '</td><td>' +
                                item.nama +
                                '</td><td>' +
                                item.nim +
                                '</td><td>' +
                                item.phone +
                                '</td><td>' +
                                item.email +
                                '</td><td class="text-center"><button type="button" value="' +
                                item.id +
                                '" class="student-edit btn btn-outline-info mx-1 shadow-none"> <i class="fa-solid fa-pen-to-square"></i></button><button type="button" value="' +
                                item.id +
                                '"class="student-delete btn btn-outline-danger mx-1 shadow-none"><i class="fa-solid fa-trash"></i></button></td></tr>'
                            );

                        });
                    }
                });
            }
            $(document).on('click', '.addStudent', function(e) {
                e.preventDefault(e);
                var data = {
                    'nama': $('.nama').val(),
                    'nim': $('.nim').val(),
                    'phone': $('.phone').val(),
                    'email': $('.email').val(),
                };


                $.ajax({
                    type: "POST",
                    url: "/dashboard/mahasiswa/store",
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        $('.nama').removeClass('is-invalid');
                        $('.nim').removeClass('is-invalid');
                        $('.phone').removeClass('is-invalid');
                        $('.email').removeClass('is-invalid');
    

                        $('.studentName_error').empty();
                        $('.studentId_error').empty();
                        $('.phone_error').empty();
                        $('.email_error').empty();

                        if (response.status == false) {
                            if (response.errors['nama'] != null) {
                                $('.nama').addClass('is-invalid');
                                $('.studentName_error').append(response.errors['nama']);
                            }
                            if (response.errors['nim'] != null) {
                                $('.nim').addClass('is-invalid');
                                $('.studentId_error').append(response.errors['nim']);
                            }
                            if (response.errors['phone'] != null) {
                                $('.phone').addClass('is-invalid');
                                $('.phone_error').append(response.errors['phone']);
                            }
                            if (response.errors['email'] != null) {
                                $('.email').addClass('is-invalid');
                                $('.email_error').append(response.errors['email']);
                            }
                        } else {
                            fetch();
                            toastr.success(response.success);
                        }

                    }
                });
            });

            $(document).on('click', '.student-edit', function(e) {
                e.preventDefault(e);
                var nim = $(this).val();

                $.ajax({
                    type: "GET",
                    url: `/dashboard/mahasiswa/edit/${nim}`,
                    dataType: "json",
                    success: function(response) {
                        $('#id').val(response.mahasiswa.id);
                        $('#nama').val(response.mahasiswa.nama);
                        $('#nim').val(response.mahasiswa.nim);
                        $('#phone').val(response.mahasiswa.phone);
                        $('#email').val(response.mahasiswa.email);
                        $('#StudentAddModal').modal('show');
                    }
                });
            });
            $(document).on('click', '.updateStudent', function(e) {
                e.preventDefault(e);
                var data = {
                    'id': $('.id').val(),
                    'nama': $('.nama').val(),
                    'nim': $('.nim').val(),
                    'phone': $('.phone').val(),
                    'email': $('.email').val(),
                };


                $.ajax({
                    type: "POST",
                    url: "/dashboard/mahasiswa/update",
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        $('.nama').removeClass('is-invalid');
                        $('.nim').removeClass('is-invalid');
                        $('.phone').removeClass('is-invalid');
                        $('.email').removeClass('is-invalid');

                        $('.studentName_error').empty();
                        $('.studentId_error').empty();
                        $('.phone_error').empty();
                        $('.email_error').empty();

                        // console.log(response);
                        if (response.status == false) {
                            if (response.errors['nama'] != null) {
                                $('.nama').addClass('is-invalid');
                                $('.studentName_error').append(response.errors['nama']);
                            }
                            if (response.errors['nim'] != null) {
                                $('.nim').addClass('is-invalid');
                                $('.studentId_error').append(response.errors['nim']);
                            }
                            if (response.errors['phone'] != null) {
                                $('.phone').addClass('is-invalid');
                                $('.phone_error').append(response.errors['phone']);
                            }
                            if (response.errors['email'] != null) {
                                $('.email').addClass('is-invalid');
                                $('.email_error').append(response.errors['email']);
                            }
                        } else {
                            // console.log(response);
                            fetch();
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
                                url: `/admin/courses/destroy/${matkulId}`,
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

            $(document).on('click', '.student-delete', function(e) {
                e.preventDefault(e);
                var nim = $(this).val();

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
                            url: `/dashboard/mahasiswa/destroy/${nim}`,
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
