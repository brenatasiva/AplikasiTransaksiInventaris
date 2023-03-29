<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Item;
use App\Models\InvoiceDetails;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            //code...
            $data = Invoice::all();
            return view('invoice.index', compact('data'));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('fail', 'Gagal');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            //code...
            $data = Item::all()->sortBy("name");
            return view('invoice.addInvoice', compact('data'));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('fail', 'Gagal');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            //code...
            $i = new Invoice();
            if($request->name == null) throw new Exception("");
            
            $i->seller_name = Auth::user()->name;
            $i->customer_name = $request->get('customerName')==null ? "-": $request->get('customerName');
            $i->total = 0;
            $i->pay = (double)str_replace(',', '', $request->get('pay'));
            $i->save(); //add item to table invoices before adding anything to table invoice_details
            
            $iid = $i->insertInvoiceDetail($request, $i->invoice_id);
            $i->total = $iid['total'];
            $i->profit = $iid['profit'];
            $i->save();

            $invoice = Invoice::all()->where('invoice_id', $i->invoice_id);
            $invoiceDetails = InvoiceDetails::all()->where('invoice_id', $i->invoice_id);

            return view('invoice.printInvoice', compact('invoice', 'invoiceDetails'))->with('success', 'Transaksi berhasil');
            // return redirect()->back()->with('success', 'Transaksi berhasil');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('fail', 'Transaksi gagal');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }

    public function showDetailModal(Request $request)
    {
        try {
            //code...
            $id = $request->get('invoiceId');
            $data = InvoiceDetails::all()->where('invoice_id', $id);
            return response()->json(array(
                'msg' => view('invoice.modalDetail', compact('data'))->render()
            ), 200);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('fail', 'Gagal');
        }
    }

    public function sellIndex()
    {
        try {
            //code...
            $data = Invoice::all();
            return view('report.sellIndex', compact('data'));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('fail', 'Gagal');
        }
    }

    public function calcProfit(Request $request)
    {
        try {
            //code...
            // \DB::enableQueryLog();
            $startDate = $request->get('startDate');
            $endDate = $request->get('endDate');
            $data = Invoice::select('*')->where('date','<=',$endDate)->where('date','>=',$startDate)->get();
            // dd($data);
            $profit = 0;
            $omset = 0;
            foreach($data as $d){
                $profit += $d['profit'];
                $omset += $d['total'];
            }
            // dd($data);
            // dd(\DB::getQueryLog());
            return response()->json(array(
                'profit' => $profit,
                'omset' => $omset,
                'invoice' => $data
            ), 200);
        } catch (\Throwable $th) {
            //throw $th;
            
            return redirect()->back()->with('fail', 'Gagal');
        }
    }

    public function datatable()
    {
        try {
            //code...
            $data = Invoice::all();
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('fail', 'Gagal datatable');
        }
    }

    public function generateSellPdf(Request $request)
    {
        $startDate = $request->get('startDate');
        $endDate = $request->get('endDate');
        $invoice = Invoice::select('*')->where('date','<=',$endDate)->where('date','>=',$startDate)->get();
        $profit = 0;
        $omset = 0;
        foreach($invoice as $i){
            $profit += $i['profit'];
            $omset += $i['total'];
        }

        return view('report.generatePdf', compact('invoice', 'startDate', 'endDate', 'omset', 'profit'));
    }
}

