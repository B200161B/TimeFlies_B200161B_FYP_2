@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Company Login') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('company.login.check') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">


                                    @if(session('email'))

                                        <input id="email" type="email"
                                               class="form-control" name="email"
                                               value="{{ session('email') }}" required autocomplete="email">

                                    @else
                                        <input id="email" type="email"
                                               class="form-control @error('email') is-invalid @enderror" name="email"
                                               value="{{ old('email') }}" required autocomplete="email">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    @endif


                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    @if(session('password'))

                                        <input id="password" type="text"
                                               class="form-control" value="{{session('password')}}"
                                               name="password" required autocomplete="new-password">

                                    @else

                                        <input id="password" type="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               name="" required autocomplete="new-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror

                                    @endif
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
