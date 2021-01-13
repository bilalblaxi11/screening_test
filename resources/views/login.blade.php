@extends('layouts.app')
@section('content')
@section('title', '- Login')
@section('page-title', 'Login')
<div class="container">
    <div class="featured-courses courses-wrap" style="min-height: 300px">
        <div class="row mx-m-25">
            <div class="col-4">
                <h1 class="mt-5">Customer Login</h1>
            </div>
            <div class="col-8 pt-1">
                <form method="post" action="{{ route('login.attempt') }}">
                    <select class="form-control mt-5" required name="customer">
                        <option value="">Select Customer</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                        @endforeach
                    </select>
                    @csrf
                    <button class="btn btn-success mt-2 btn-block btn-sm">Login</button>
                </form>
            </div>
        </div><!-- .row -->
    </div><!-- .featured-courses -->
</div><!-- .container -->

@endsection
