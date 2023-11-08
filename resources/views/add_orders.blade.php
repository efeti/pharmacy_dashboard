@extends('layout')

@section('sidebar_name')
Add Orders
@stop

@section('active_add_orders')
active
@stop

@section('body')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if($errors->any())
<div class="alert alert-danger ">
    @foreach ($errors->all() as $error)
    <li>{{$error}}</li>
    @endforeach
</div>
@endif



<form action="{{route('add_order_submit')}}" method="post">
    @csrf
    <div class="container-xl">
        <br>
        <h4 class="mx-auto text-bold"> Personal Details</h4>
        <br />
        <div class="row">
            <div class="col-12 mb-3 col-sm-12 col-md-6 col-lg-6">
                <label for="exampleFormControlInput1" class="form-label">Phone Number:</label>
                <input type="number" class="form-control" id="phone_number" name="phone_number" title="Please enter 11 digits starting with 0" minlength="11" maxlength="11" pattern="0[0-9]{10}" value="{{old('phone_number')}}" required>
            </div>
            <div class="col-12 mb-3 col-sm-12 col-md-6 col-lg-6">
                <label for="full_name" class="form-label">Customer name</label>
                <input type="text" id="full_name" class="form-control" name="full_name" value="{{old('full_name')}}" required>
            </div>
        </div>


        <div class="row mb-4">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                <label for="age" class="form-label"> Age</label>
                <input type="number" id="age" class="form-control" name="age" value="{{old('age')}}}" required>
            </div>
        </div>
        
        <h5 class="mb-4">Order Details</h5>
        <div>
            <div class="row mb-3 d-flex ">
                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                    <label for="prescription" class="form-label">Prescription</label>
                    <textarea name="prescription" id="prescription" class="form-control" cols="40" rows="2" value="{{old('prescription')}}"></textarea>
                </div>
            </div>
            <div class="row mb-3 ">
                <div class="col-12 col-sm-12 col-md-4 col-lg-4">

                    <label for="product_name" class="form-label">Product:</label>
                    <select name="product_name" class="product_select form-control" id="product_name">
                        <option value="">None</option>
                        @foreach ($products as $product)
                        <option value="{{$product->name}}" data-price="{{$product->unit_price}}" data-max_quantity="{{$product->quantity}}" {{old('product_name') == $product->name ? 'selected':''}}>{{$product->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 align-items-end d-flex">

                    <div class="col-auto">Price: <i class="fa-solid fa-naira-sign fa-sm"></i></div>
                    <div class="col-auto">
                        <span id="display_price"></span>
                    </div>
                </div>
            </div>

            <div class="row d-flex mb-3">
                <div class="col-12 col-sm-12 col-md-4 col-lg-4">

                    <label for="quantity" class="form-label me-3">Quantity: </label>
                    <input type="number" class="form-control" id="quantity" name="quantity" value="{{old('quantity')}}}" required>
                </div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 d-flex align-items-end">

                    <div class="col-auto"> max Quantity:</div>
                    <div class="col-auto">
                        <span id="max_quantity"></span>
                    </div>
                </div>
                <!-- <div>price:<span id="price_display"></span></div> -->
            </div>
            <div class="mb-3">
                <input type="radio" id="cash" name="payment_method" value="cash" {{old('payment_method') == "cash" ? 'selected':''}}>
                <label for="cash" class="radio-inline">Cash</label>

                <input type="radio" id="card" name="payment_method" value="card" {{old('payment_method') == 'cash' ? 'selected':''}}>
                <label for="card" class="radio-inline">Card</label><br>
            </div>
            <input type="submit" value="Purchase" class = "btn btn-primary">
</form>
@stop