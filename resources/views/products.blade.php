@extends('layouts.app')
@section('content')
@section('title', '- Products')
@section('page-title', 'Products')
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
        <div class="row mx-m-25">
            @foreach($products as $product)
                <div class="col-12 col-md-4 px-25">
                    <div class="course-content">
                        <figure class="course-thumbnail">
                            <a href="#"><img src="https://picsum.photos/350/220" alt=""></a>
                        </figure><!-- .course-thumbnail -->

                        <div class="course-content-wrap">
                            <header class="entry-header">
                                <h2 class="entry-title"><a href="#">{!! $product->description !!}({!! $product->uuid !!})</a></h2>

                                <div class="entry-meta flex flex-wrap align-items-center">
                                    <div class="course-author"><a href="#">{!! $product->category->name !!}</a></div>
                                </div><!-- .course-date -->
                            </header><!-- .entry-header -->

                            <form method="post" action="{{ route('cart.add', $product->id) }}">

                                <footer class="entry-footer flex flex-wrap justify-content-between align-items-center">
                                    <div class="course-cost">
                                        ${!! $product->price !!} <span class="price-drop">${!! $product->price + 10 !!}</span>
                                    </div><!-- .course-cost -->
                                    <input type="number" min="1" value="1" name="qty" required class="form-control" style="width: 80px">
                                </footer><!-- .entry-footer -->

                                @csrf
                                <button type="submit" class="btn btn-block btn-success mt-4">Add To Cart</button>
                            </form>
                        </div><!-- .course-content-wrap -->
                    </div><!-- .course-content -->
                </div><!-- .col -->
            @endforeach
        </div><!-- .row -->
    </div><!-- .featured-courses -->
</div><!-- .container -->

@endsection
@extends('layouts.app')
@section('content')
@section('title', '- Products')
@section('page-title', 'Products')
<div class="container">
    @if(session()->has('msg'))
        <div class="alert alert-success">
            {{ session()->get('msg') }}
        </div>
    @endif
    <div class="featured-courses courses-wrap">
        <div class="row mx-m-25">
            @foreach($products as $product)
                <div class="col-12 col-md-4 px-25">
                    <div class="course-content">
                        <figure class="course-thumbnail">
                            <a href="#"><img src="https://picsum.photos/350/220" alt=""></a>
                        </figure><!-- .course-thumbnail -->

                        <div class="course-content-wrap">
                            <header class="entry-header">
                                <h2 class="entry-title"><a href="#">{!! $product->description !!}({!! $product->uuid !!})</a></h2>

                                <div class="entry-meta flex flex-wrap align-items-center">
                                    <div class="course-author"><a href="#">{!! $product->category->name !!}</a></div>
                                </div><!-- .course-date -->
                            </header><!-- .entry-header -->

                            <form method="post" action="{{ route('cart.add', $product->id) }}">

                                <footer class="entry-footer flex flex-wrap justify-content-between align-items-center">
                                    <div class="course-cost">
                                        ${!! $product->price !!} <span class="price-drop">${!! $product->price + 10 !!}</span>
                                    </div><!-- .course-cost -->
                                    <input type="number" min="1" value="1" name="qty" required class="form-control" style="width: 80px">
                                </footer><!-- .entry-footer -->

                                @csrf
                                <button type="submit" class="btn btn-block btn-success mt-4">Add To Cart</button>
                            </form>
                        </div><!-- .course-content-wrap -->
                    </div><!-- .course-content -->
                </div><!-- .col -->
            @endforeach
        </div><!-- .row -->
    </div><!-- .featured-courses -->
</div><!-- .container -->

@endsection
