@extends('layout')

@section('sidebar_name')
Edit product
@stop

@section('active_manage_products')
active
@stop

@section('body')
<div class="mb-3">
    <h6>
        <a href="{{ route('manage_products') }}">
            <i class="fa fa-arrow-left mx-2" aria-hidden="true"></i>Back
        </a>
    </h6>

</div>

<div class="mb-3">
    <form action="{{route('edit_product_submit')}}" method="post">
        @csrf
        <div>
            <input type="hidden" id="id" name="id" value="{{$product->id}}">
        </div>

        <div>
            <label for="name">Product Name:</label>
            <input type="text" id="name" name="name" value="{{$product->name}}" required>
        </div>

        <div>
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" min="1" value="{{$product->quantity}}" required>
        </div>

        <div>
            <label for="unit_price">Price:</label>
            <input type="number" id="unit_price" name="unit_price" min="1" value="{{$product->unit_price}}" required>
        </div>

        <div>
            <input type="submit" value="submit">
        </div>
    </form>
</div>
@stop