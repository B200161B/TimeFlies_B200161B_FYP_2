@extends('layouts.app')

@push('css')

@endpush
@section('content')

    <section class="home-section">

        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1><b>File Explorer</b></h1>
                </div>

            </div>

            <div class="row">
                <div class="col">
                    <div style="height: 600px;">
                        <div id="fm"></div>
                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection
