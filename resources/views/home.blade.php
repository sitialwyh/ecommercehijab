@extends('layouts.app')
@section('content')
<link rel="icon" type="image/png" href="images/icons/favicon.png"/>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @auth
                <div class="card-header"><h5><b>Welcome {{ Auth::user()->name }} !</b></h5></div>
                @endauth

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif You are logged in. 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
