@extends('dashboard.index')
@section('main_content')
    <h2 class="text-left font-bold text-2xl pl-5 pt-4">
        Scan Presensi
    </h2>

    {{-- Form to input code --}}
    <div class="mx-5">
        {{-- Show message if there is --}}
        @if (session('error'))
            <div class="my-5 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">
                    {{ session('error') }}
                </strong>
                <span class="block sm:inline">{{ $errors->first() }}</span>
            </div>
        @endif

        {{-- Show success message --}}
        @if (session('success'))
            <div class="my-5 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">
                    {{ session('success') }}
                </strong>
                <span class="block sm:inline">{{ $errors->first() }}</span>
            </div>
        @endif

        {{-- create form video for scanner  --}}
        <div class="">
            <div class="w-1/2 my-5">
                <video id="preview" class="w-full ml-48 border-2 border-black"></video>
            </div>

            <form action="/dashboard/mhs/presensi" method="POST" class="mt-5">
                @csrf
                <div class="flex flex-col">
                    <label for="code" class="text-gray-500">Kode Presensi</label>
                    <input type="text" name="code" id="code" required
                        class="border-2 border-gray-300 rounded-lg p-2 mt-2 focus:outline-none focus:border-blue-500">
                </div>
                <button type="submit" id="submit" class="bg-blue-500 text-white rounded-lg px-4 py-2 mt-5" style="display: none;">Submit</button>
            </form>
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

            // scan and submit data to database via submit button and hide submit button
            scanner.addListener('scan', function(content) {
                document.getElementById('code').value = content;
                document.getElementById('submit').click();
                document.getElementById('submit').style.display = "none";
            });
            

            // scanner.addListener('scan', function(content) {
            //     document.getElementById('code').value = content;
            //     $.ajax({
            //         url: '/dashboard/mhs/presensi',
            //         type: 'POST',
            //         data: {
            //             _token: '{{ csrf_token() }}',
            //             code: content
            //         },
            //         success: function(response) {
            //             // if code match with class alert success message, else alert error message
            //             // if (response.status == 'success') {
            //             //     Swal.fire({
            //             //         icon: 'success',
            //             //         title: 'Presensi Berhasil',
            //             //         text: response.message,
            //             //         showConfirmButton: false,
            //             //         timer: 1500
            //             //     })
            //             // } else {
            //             //     Swal.fire({
            //             //         icon: 'error',
            //             //         title: 'Presensi Gagal',
            //             //         text: response.message,
            //             //         showConfirmButton: false,
            //             //         timer: 1500
            //             //     })
            //             // }
            //             Swal.fire({
            //                 icon: 'success',
            //                 title: 'Berhasil Absen',
            //                 text: 'Selamat, anda berhasil melakukan absensi',
            //                 showConfirmButton: false,
            //                 timer: 3000
            //             })
            //         },
            //     });
            // });

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
