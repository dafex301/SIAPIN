@extends('layouts.app')


@section('title')
    Input Jadwal
@endsection


@section('content')
    @include('components.navbar')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card border-0 shadow-lg">
                    <div class="card-body">
                        <div class="form-group mb-2">
                            <div class="input-group mb-3">
                                <input type="hidden" class="id" name="id" id="id" value="{{ $id }}">
                                <input id="nama_jadwal" disabled type="text"
                                    class="nama_jadwal form-control shadow-none rounded-0" name="nama_jadwal"
                                    value="{{ $matkul->nama_matkul }}" required autocomplete="nama_jadwal"
                                    placeholder="Nama Jadwal">
                            </div>
                            <div class="input-group mb-3">
                                <input id="nim" disabled type="text" class="form-control shadow-none rounded-0"
                                    name="nim" value="{{ old('nim') }}" required autocomplete="nim"
                                    placeholder="NIM scan">
                            </div>
                        </div>
                        <div class="form-group mb-2 p-0">
                            <video id="preview" class="form-control p-0"></video>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card border-0 shadow-lg">
                    <div class="card-header border-0 bg-transparent mb-2 fs-2 text-primary lead">
                        <div class="d-flex justify-content-between">
                            Mahasiswa Peserta Praktikum
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12 table-responsive" id="TabelMhsPraktikum">
                            <table class="table table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="row">#</th>
                                        <th scope="row">Nama Mahasiswa</th>
                                        <th scope="row">Mata Kuliah Praktikum</th>
                                        <th scope="row">Present</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $count = 1;
                                    @endphp
                                    @foreach ($mhs_praktikums as $mhs_praktikum)
                                        <tr>
                                            <td>{{ $count++ }}</td>
                                            <td>{{ $mhs_praktikum->nama }}</td>
                                            <td>{{ $mhs_praktikum->nama_matkul }}</td>
                                            <td>
                                                @if ($mhs_praktikum->isPresent == 0)
                                                    <span class="badge bg-danger">Absent</span>
                                                @else
                                                    <span class="badge bg-success">Present</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script type="text/javascript">
        var scanner = new Instascan.Scanner({
            video: document.getElementById('preview'),
            scanPeriod: 5,
            mirror: false
        });

        scanner.addListener('scan', function(content) {
            // alert(content);
            document.getElementById('nim').value = content;
            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                let Nim = content;
                // console.log(Nim);
                var data = {
                    'id': $('.id').val(),
                    'Nim': Nim,
                    'nama_jadwal': $('.nama_jadwal').val(),
                };
                $.ajax({
                    type: "POST",
                    url: `/dashboard/mhspraktikum/updateAtt`,
                    data: data,
                    dataType: "JSON",
                    success: function(response) {
                        // console.log(response);
                        $("#TabelMhsPraktikum").load(location.href + " #TabelMhsPraktikum");
                        toastr.success(response.success);
                    }
                });
            });
            //window.location.href=content;
        });
        Instascan.Camera.getCameras().then(function(cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
                $('[name="options"]').on('change', function() {
                    if ($(this).val() == 1) {
                        if (cameras[0] != "") {
                            scanner.start(cameras[0]);
                        } else {
                            alert('No Front camera found!');
                        }
                    } else if ($(this).val() == 2) {
                        if (cameras[1] != "") {
                            scanner.start(cameras[1]);
                        } else {
                            alert('No Back camera found!');
                        }
                    }
                });
            } else {
                console.error('No cameras found.');
                alert('No cameras found.');
            }
        }).catch(function(e) {
            console.error(e);
            alert(e);
        });
    </script>
@endsection
