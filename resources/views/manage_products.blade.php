@extends('layout')

@section('sidebar_name')
manage products
@stop

@section('active_manage_products')
active
@stop

@section('body')

<table id="products_table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Quantity</th>
            <th>Unit Price</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>

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

        @foreach($products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>{{ $product->quantity }}</td>
            <td>{{ $product->unit_price }}</td>
            <td>
                <div class="row">
                    <div class="col-xs-6 col-sm-2">
                        <a href="{{ route('edit_product', $product->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop