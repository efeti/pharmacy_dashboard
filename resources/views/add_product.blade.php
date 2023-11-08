@extends('layout')

@section('sidebar_name')
Add product
@stop

@section('active_add_product')
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

<div class="mb-3">
    <form action="{{route('add_product_submit')}}" method="post">
        @csrf
        <br>
    <div class = "container">

    
        <h4 class="mx-auto text-bold">Add Product</h4>
        <br>
        <div class = "row mb-3">
            <div class = "col-12 col-sm-12 col-md-6 col-lg-6">
            <label for="name" class = "form-label">Product Name:</label>
            <input type="text" id="name" name="name"  class = "form-control" value="{{old('name')}}" required>
            </div>
        </div>
        <!-- <div>
            <label for="category">Category:</label>
            <select name="category" id="category">
                <option value="">medicine</option>
                <option value="">drug</option>
            </select>
        </div> -->

        <div class = "row mb-3">
            <div class = "col-12 col-sm-12 col-md-6 col-lg-6">
            <label for="quantity" class = "form-label">Quantity:</label>
            <input type="number" id="quantity" class = "form-control" name="quantity" min="1" value="{{old('quantity')}}" required>
            </div>  
        </div>
        <div class = "row mb-3">
            <div class = "col-12 col-sm-12 col-md-6 col-lg-6">           
            <label for="unit_price" class = "form-label">Price:</label>
            <input type="number" id="unit_price" class = "form-control" name="unit_price" min="1" value="{{old('unit_price')}}" required>
            </div>
        </div>

        <div>
            <input type="submit" value="Submit" class = "btn btn-primary">
        </div>
    </form>
</div></div>
@stop