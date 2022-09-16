{{-- View for present QR Code --}}

@extends('layouts.main')
@include('components.navbar')

@section('container')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">QR Code</h3>
                    </div>
                    <div class="panel-body text-center">
                        {!! $qrCode !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
