@extends('layouts.app')

@push('css')

@endpush
@section('content')

    <section class="home-section">

        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1><b>Users List</b></h1>
                </div>

            </div>

            <div class="row pt-5">
                <div class="col">

                    <table class="table">
                        <thead class="thead-dark">
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
    </section>

@endsection
