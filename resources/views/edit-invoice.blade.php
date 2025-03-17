@extends('layouts.app')

@section('title', 'Edit Invoice')

@section('sidebar')
    @parent
    <p>this is appended to the master sidebar.</p>
@endsection

@section('content')
    <h1>Edit Invoice {{$invoice->id}}</h1>


    <form action="{{ route('invoice.update', $invoice->id) }}" method="POST">
        @csrf
        @method('PUT')
        <table>

            <tr>
                <td>Name</td>
                <td><input type="text" name="Name" value="{{ $invoice->Name }}"></input></td>
            </tr>

            <tr>
                <td>PriceNet</td>
                <td><input type="number" name="PriceNet" value="{{ $invoice->PriceNet }}"></input></td>
            </tr>

            <tr>
                <td>PriceGross</td>
                <td><input type="number" name="PriceGross" value="{{ $invoice->PriceGross }}"></input></td>
            </tr>

            <tr>
                <td>Vat</td>
                <td><input type="number" name="Vat" value="{{ $invoice->Vat }}"></input></td>
            </tr>

            <tr>
                <td>UserClearing</td>
                <td><input type="text" name="UserClearing" value="{{ $invoice->UserClearing }}"></input></td>
            </tr>

            <tr>
                <td>ClearingDate</td>
                <td><input type="datetime-local" name="ClearingData" value="{{ $invoice->ClearingDate }}"></input></td>
            </tr>

            <tr>
                <td>Created At</td>
                <td><input type="datetime-local" name="created_at" value="{{ $invoice->created_at }}"></input></td>
            </tr>

            <tr>
                <td><input type="submit" value="Update"></td>
            </tr>
        </table>
    </form>
    
@endsection
