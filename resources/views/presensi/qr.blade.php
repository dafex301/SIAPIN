@extends('dashboard.index')
@section('main_content')
    <div class="p-12 py-6">
        {{-- Back Button --}}
        <a href="/dashboard/presensi/{{ request()->jadwal_id }}?p={{ request()->pertemuan }}"
            class="flex items-center gap-2 text-blue-400 hover:text-blue-600">
            {{-- Back Icon --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            <span>Kembali</span>
        </a>
        <div class="flex mt-5 justify-between">
            <div>
                <h1 class="text-2xl font-bold">{{ $jadwal->nama }}</h1>
                <h2 class="text-xl">Pertemuan {{ request()->pertemuan }}</h2>
                <h2>{{ $jadwal->lab->nama }} |
                    {{ $jadwal->hari . ', ' . date('H:i', strtotime($jadwal->jam_mulai)) . '-' . date('H:i', strtotime($jadwal->jam_selesai)) }}
                </h2>
            </div>
        </div>
        <div class="flex justify-around">
            <div>
                <h2 class="text-md mt-5">Kode Presensi</h2>
                <p class="text-2xl font-semibold">{{ $random_string }}</p>
            </div>
            {{-- make div for timer  --}}
            <div>
                <h2 class="text-md mt-5">Sisa Waktu</h2>
                <p class="text-2xl font-semibold" id="timer">00:00</p>
            </div>
        </div>
        <div class="flex justify-center my-5">
            <div class="mt-5">
                {!! QrCode::size(400)->generate($random_string) !!}
            </div>
        </div>

        <div class="flex justify-center">
            {{-- Delete QR Button --}}
            <form action="/dashboard/presensi/{{ request()->jadwal_id }}/{{ request()->pertemuan }}/qr/{{ $qr->id }}"
                method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" name="pertemuan" value="{{ request()->pertemuan }}">
                <button type="submit" id="submit" style="display: none;"
                    class="flex items-center gap-2 text-white bg-red-500 p-2 rounded-md hover:bg-red-700 mt-5 font-semibold text-md">
                    {{-- Close Icon --}}
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M3.293 3.293a1 1 0 011.414 0L10 8.586l5.293-5.293a1 1 0 111.414 1.414L11.414 10l5.293 5.293a1 1 0 01-1.414 1.414L10 11.414l-5.293 5.293a1 1 0 01-1.414-1.414L8.586 10 3.293 4.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>Hapus Presensi</span>
                </button>
            </form>
        </div>

    </div>
@endsection

@section('scripts')
    {{-- automaticaly click delete qr button in 40 seconds countdown --}}
    <script>
        setTimeout(function() {
            document.getElementById('submit').click();
        }, 1000 * 114);

        // timer
        var countDownDate = new Date().getTime() + 1000 * 112;

        // Update the count down every 1 second
        var x = setInterval(function() {
            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Display the result in the element with id="demo"
            document.getElementById("timer").innerHTML = minutes + ":" + seconds;

            // If the count down is finished, write some text
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("timer").innerHTML = "<span style='color: red;'>EXPIRED</span>";
            }
        }, 1000);
    </script>
@endsection
