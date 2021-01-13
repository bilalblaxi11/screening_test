@extends('layouts.app')
@section('content')
@section('title', '- Checkout')
@section('page-title', 'Checkout')
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
                <ul class="list-group" id="drag-container">
                    @foreach($products as $product)
                        <li class="list-group-item draggable" draggable="true">
                            <h4>{{ $product['detail']->description }} ({{ $product['detail']->uuid }})</h4>
                            <form method="post" action="{{ route('cart.remove', $product['detail']->id) }}">
                                @csrf
                                Quantity: {{ $product['qty'] }} x Price: ${{ $product['detail']->price }} = ${{ $product['total'] }}
                                <button type="submit" class="btn btn-danger btn-sm float-right mt-4">Remove Item</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-4">
                @if(!empty($afterDiscount['switch_discount']))
                    <div class="alert alert-success">
                        @foreach($afterDiscount['switch_discount'] as $freeProduct)
                            <p><b>{{ $freeProduct['qty'] }} "{{ $freeProduct['product-id'] }}" free </b> on every 5 switch products</p>
                        @endforeach
                    </div>
                @endif
                @if(!empty($afterDiscount['tool_discount']))
                    <div class="alert alert-success">
                        <p>20% Discount on one tool product if quantity is more then 1
                            <b>Total Discount: ${{ $afterDiscount['tool_discount']['discount'] }}</b></p>
                    </div>
                @endif
                @if(!empty($afterDiscount['flat_discount_on_total']))
                    <div class="alert alert-success">
                        <p>10% Flat Discount on $1000 purchase
                            <b>Total Discount: ${{ $afterDiscount['flat_discount_on_total'] }}</b></p>
                    </div>
                @endif
                <table class="table bg-dark text-white">
                    <tr>
                        <td>Subtotal</td>
                        <th>${{ $total }}</th>
                    </tr>
                    <tr>
                        <td>Discount</td>
                        <th>${{ (float)@$afterDiscount['total_discount'] }}</th>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <th>${{ (float)@$afterDiscount['total'] }}</th>
                    </tr>
                </table>
                @if(count($products) > 0)
                    <a href="{{ route('checkout') }}" class="btn btn-dark btn-block text-white">Place Order</a>
                @endif
            </div>
        </div><!-- .row -->
    </div><!-- .featured-courses -->
</div><!-- .container -->

@endsection

@section('js')
    @parent
    <script>

        document.querySelectorAll('.draggable').forEach(draggable => {
            draggable.addEventListener('dragstart', () => {
                draggable.classList.add('dragging')
            });

            draggable.addEventListener('dragend', () => {
                draggable.classList.remove('dragging')
            })
        });

        const container = document.querySelector('#drag-container');
        container.addEventListener('dragover', e => {
            e.preventDefault();
            const afterElement = getNextElement(container, e.clientY);
            const draggable = document.querySelector('.dragging');
            if (afterElement == null) {
                container.appendChild(draggable)
            } else {
                container.insertBefore(draggable, afterElement)
            }
        });

        function getNextElement(container, y) {
            const draggableElements = [...container.querySelectorAll('.draggable:not(.dragging)')]

            return draggableElements.reduce((closest, child) => {
                const box = child.getBoundingClientRect();
                const offset = y - box.top - box.height / 2;
                if (offset < 0 && offset > closest.offset) {
                    return { offset: offset, element: child }
                } else {
                    return closest
                }
            }, { offset: Number.NEGATIVE_INFINITY }).element
        }
    </script>

@endsection
