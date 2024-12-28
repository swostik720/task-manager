@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <!-- Display User's Name Dynamically -->
                    <h3>Welcome, {{ Auth::user()->name }}!</h3>
                    <p>You are logged in!</p>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
