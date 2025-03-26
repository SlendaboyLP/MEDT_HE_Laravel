<?php

namespace App\Http\Controllers;

use Yajra\DataTables\Facades\DataTables;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("list-invoice", [
            "data" => Invoice::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("create-invoice");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Invoice::create($request->all());

        $invoice = new Invoice();
        $invoice->Name = $request->Name;
        $invoice->PriceNet = $request->PriceNet;
        $invoice->PriceGross = $request->PriceGross;
        $invoice->Vat = $request->Vat;
        $invoice->UserClearing = $request->UserClearing;
        $invoice->ClearingDate = $request->ClearingDate;
        $invoice->save();  

        return redirect()->route('invoice.index')->with('success', 'Invoice created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        return view("show-invoice", [
            "invoice" => $invoice
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        return view("edit-invoice", [
            "invoice" => $invoice
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        $invoice->update($request->all());

        return redirect()->route("invoice.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return redirect()->route('invoice.index')->with('success', 'Invoice deleted successfully');
    }


    public function GetInvoiceData(Request $request)
    {
        $invoices = Invoice::all();

        // return json_encode(array('data' => $invoices));
        return datatables()->of(Invoice::all())->make(true);
    }

}
