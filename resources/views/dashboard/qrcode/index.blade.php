<!-- Build view qr code -->
<!-- resources\views\data.blade.php -->
@extends('layouts.main')
@include('components.navbar')

@section('container')
    {{-- <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Generate QR Code</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="GET" action="{{ route('data.generate') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('qr_code_text') ? ' has-error' : '' }}">
                            <label for="qr_code_text" class="col-md-4 control-label">QR Code Text</label>

                            <div class="col-md-6">
                                <input id="qr_code_text" type="text" class="form-control" name="qr_code_text" value="{{ old('qr_code_text') }}" required autofocus>

                                @if ($errors->has('qr_code_text'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('qr_code_text') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Generate QR Code
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if (isset($data))
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">QR Code</h3>
                    </div>
                    <div class="panel-body text-center">
                        {!! $data->svg() !!}
                    </div>
                </div>
            </div>
        </div>
    @endif
</div> --}}
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Generate QR Code</div>

                    <div class="card-body">
                        <form action="/dashboard/qrcode" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="name">Email</label>
                                <input type="email" name="email" id="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="name">Phone</label>
                                <input type="text" name="phone" id="phone" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary">Generate</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
