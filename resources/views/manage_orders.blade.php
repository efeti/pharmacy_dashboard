@extends('layout')

@section('sidebar_name')
Add Orders
@stop

@section('active_manage_orders')
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

<div class="orders_table">
    <table id="orders_table">
        <thead>
            <tr>
                <th>customer Name</th>
                <th>order name</th>
                <th>Quantity</th>
                <th>Payment Method</th>
                <th>Status</th>
                <th>Link</th>
                <th>Actions</th>
                <th>confirm</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->full_name }}</td>
                <td>{{ $order->name }}</td>
                <td>{{ $order->quantity }}</td>
                <td>{{$order->payment_method}}</td>
                <td>{{$order->status}}</td>
                <td></td>
                @if($order->status != 'paid')
                <td>
                    <form method="post" action="{{ route('delete_order', $order->id) }}">
                        @csrf
                      
                        <button type="submit" class="btn btn-danger btn-block btn-sm">Delete</button>
                    </form>
                </td>
                <td>
                    <form method="post" action="{{ route('paid_order', $order->id) }}">
                        @csrf
                        <button type="submit" class="btn btn-success btn-block btn-sm">paid</button>
                    </form>
                </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@stop