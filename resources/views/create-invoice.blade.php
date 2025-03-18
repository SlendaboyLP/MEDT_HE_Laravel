@extends('layouts.app')

@section('title', 'Create Invoice')

@section('sidebar')
    @parent
    <h2>Create Invoice</h2>
@endsection

@section('content')
    

    <form action="{{ route('invoice.store') }}" method="POST">
        @csrf
        <table>
            <tr>
                <td>Name</td>
                <td><input type="text" name="Name" value="{{ old('Name') }}"></td>
            </tr>

            <tr>
                <td>PriceNet</td>
                <td><input type="number" step="0.01" name="PriceNet" value="{{ old('PriceNet') }}"></td>
            </tr>

            <tr>
                <td>PriceGross</td>
                <td><input type="number" step="0.01" name="PriceGross" value="{{ old('PriceGross') }}"></td>
            </tr>

            <tr>
                <td>Vat</td>
                <td><input type="number" step="0.01" name="Vat" value="{{ old('Vat') }}"></td>
            </tr>

            <tr>
                <td><input type="submit" value="Create"></td>
            </tr>
        </table>
    </form>
@endsection
