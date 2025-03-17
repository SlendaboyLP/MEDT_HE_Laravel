@extends('layouts.app')

@section('title', 'Show Invoice')

@section('sidebar')
    @parent
    <p>this is appended to the master sidebar.</p>
@endsection

@section('content')
    <h1>Invoice {{$invoice->id}}</h1>

    <table>
            @foreach($invoice->getAttributes() as $key => $value)
                @if(!in_array($key, ['id', 'created_at', 'updated_at']))
                    <tr>
                        <td>{{ $key }}</td>
                        <td>{{ $value }}</td>
                    </tr>
                @endif
            @endforeach 

        </table>

@endsection