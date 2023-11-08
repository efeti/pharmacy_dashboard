@extends('layout')

@section('sidebar_name')
Prescriptions
@stop

@section('active_prescriptions')
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
                <th>Customer Name</th>
                <th>Prescription</th>
                <th>Drug</th>
            </tr>
        </thead>
        <tbody>
            @foreach($prescriptions as $prescription)
            <tr>
                <td>{{ $prescription->full_name }}</td>
                <td>{{ $prescription->prescription }}</td>
                <td>{{ $prescription->name}}</td>  
            </tr>
            @endforeach   
        </tbody>
    </table>
</div>

@stop