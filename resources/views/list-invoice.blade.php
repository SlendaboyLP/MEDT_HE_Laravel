@extends('layouts.app')

@section('title', 'Invoices')

@section('sidebar')
    @parent
    <p>this is appended to the master sidebar.</p>
@endsection

@section('content')
    <h1>Invoices</h1>

    <table id="table_data">
        <tr>
            <td>ID</td>
            <td>Name</td>
        </tr>

        @foreach($data as $d)
        <tr>
            <td>{{$d->id}}</td>
            <td>{{$d->Name}}</td>
            <td><a href="{{route('invoice.show', $d)}}">Show</a></td>‚
            <td><a href="{{route('invoice.edit', $d)}}">Edit</a></td>
            <td><a href="{{route('invoice.destroy', $d)}}">Delete</a></td>
        </tr>
        @endforeach

    </table>
    <a href="{{route('invoice.create')}}">Create</a>

@endsection