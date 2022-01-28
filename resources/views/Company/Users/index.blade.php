@extends('layouts.app')
@push('css')
    <style>
       thead{
            background-color: #272c4a;
            color: whitesmoke;
        }
    </style>
@endpush
@push('css')

@endpush
@section('content')
    <section class="home-section">
        <div class="modal-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1>Users List</h1>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Status</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($company->companyUsers as $user)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$user->user->name}}</td>
                                <td>{{$user->user->email}}</td>
                                <td>{{$user->status}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        </div>
    </section>

@endsection
