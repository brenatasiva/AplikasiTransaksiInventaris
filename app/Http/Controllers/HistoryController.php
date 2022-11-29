<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Invoice;
use Illuminate\Http\Request;

class HistoryController extends Controller
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
        $data = null;
        return view('report.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\History  $history
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        // \DB::enableQueryLog();
        $startDate = $request->get('startDate');
        $endDate = $request->get('endDate');
        $dataBuy = History::where('date','<=',$endDate)->where('date','>=',$startDate)->get();
        $dataSell = Invoice::where('date','<=',$endDate)->where('date','>=',$startDate)->get();
        $data = [];
        $data['buy'] = $dataBuy;
        $data['sell'] = $dataSell;
        // dd(\DB::getQueryLog());
        return response()->json(array(
            'msg' => $data
        ), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\History  $history
     * @return \Illuminate\Http\Response
     */
    public function edit(History $history)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\History  $history
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, History $history)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\History  $history
     * @return \Illuminate\Http\Response
     */
    public function destroy(History $history)
    {
        //
    }

    public function buyIndex()
    {
        $data = History::all();
        return view('report.buyIndex', compact('data'));
    }

    public function sellIndex()
    {
        $data = Invoice::all();
        return view('report.sellIndex', compact('data'));
    }

    public function buyItem(Request $request)//insert item that bought from supplier to table histories and history_details
    {
        $h = new History();
        $h->total = 0;
        $h->save(); //add item to table histories before adding anything to table history_details

        $total = $h->insertHistoryDetail($request, $h->history_id);
        $h->total = $total;
        $h->save();
        return redirect()->back()->with('status', 'Barang berhasil ditambahkan');

    }

    public function showDetailModal(Request $request)
    {
        $id = $request->get('historyId');
        $data = History::find($id)->item()->get();
        
        return response()->json(array(
            'msg' => view('report.modalDetailHistory', compact('data'))->render()
        ), 200);
    }

    public function calcProfit(Request $request)
    {
        // \DB::enableQueryLog();
        $startDate = $request->get('startDate');
        $endDate = $request->get('endDate');
        $data = Invoice::where('date','<=',$endDate)->where('date','>=',$startDate)->get();
        $profit = 0;
        foreach($data as $d){
            $profit += $d['profit'];
        }
        // dd(\DB::getQueryLog());
        return response()->json(array(
            'msg' => $profit
        ), 200);
    }
}
