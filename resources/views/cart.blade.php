@extends('layouts.app')
@section('content')
@section('title', '- Cart')
@section('page-title', 'Cart')
<div class="container">
    @if(session()->has('msg'))
        <div class="alert alert-success mt-4">
            {{ session()->get('msg') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger mt-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="featured-courses courses-wrap">
        @empty($products)
            <div class="alert text-center alert-warning mt-4">
                Cart is empty :(
            </div>
        @endempty
        <div class="row mx-m-25 p-4">
            <div class="col-8">
                <ul class="list-group">
                    @foreach($products as $product)
                        <li class="list-group-item">
                            <h4>{{ $product['detail']->description }} ({{ $product['detail']->uuid }})</h4>


                            <form method="post" action="{{ route('cart.remove', $product['detail']->id) }}">
                                @csrf
                                Quantity: {{ $product['qty'] }}
                                <button type="submit" class="btn btn-danger btn-sm float-right mt-4">Remove Item</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-4">
                @if(count($products) > 0)
                    <a href="{{ route('checkout') }}" class="btn btn-dark btn-block text-white">Proceed Checkout</a>
                @endif
            </div>
        </div><!-- .row -->
    </div><!-- .featured-courses -->
</div><!-- .container -->

@endsection
