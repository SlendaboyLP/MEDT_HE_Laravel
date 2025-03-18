@extends('layouts.app')

@section('title', 'Show Invoice')

@section('sidebar')
    @parent
    <h2>View Invoice {{$invoice->id}}</h2>
@endsection

@section('content')
    

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