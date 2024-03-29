<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Invoice;
use App\Models\Item;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

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
        try {
            //code...
            $data = null;
            return view('report.index', compact('data'));
        } catch (\Throwable $th) {
            //throw $th;
            Alert::error('GAGAL', 'Gagal');
            return back();
        }
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
        try {
            //code...
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
        } catch (\Throwable $th) {
            //throw $th;
            Alert::error('GAGAL', 'Gagal');
            return back();
        }
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
        try {
            //code...
            $data = History::all();
            return view('report.buyIndex', compact('data'));
        } catch (\Throwable $th) {
            //throw $th;
            Alert::error('GAGAL', 'Gagal');
            return back();
        }
    }

    public function buyItem(Request $request)//insert item that bought from supplier to table histories and history_details
    {
        try {
            //code...
            $h = new History();
            $h->total = 0;
            $h->save(); //add item to table histories before adding anything to table history_details
    
            $total = $h->insertHistoryDetail($request, $h->history_id);
            $h->total = $total;
            $h->save();

            Alert::success('SUKSES', 'Berhasil Membeli Barang');
            $data = Item::all();
            return view('item.index', compact('data'));
        } catch (\Throwable $th) {
            //throw $th;
            Alert::error('GAGAL', 'Gagal Membeli Barang');
            return back();
        }

    }

    public function calcProfit(Request $request)
    {
        try {
            //code...
            // \DB::enableQueryLog();
            $startDate = $request->get('startDate');
            $endDate = date('Y-m-d H:i:s', strtotime($request->get('endDate'). ' + 23 hours 59 minutes 59 seconds'));
            $data = Invoice::where('date','<=',$endDate)->where('date','>=',$startDate)->get();
            $profit = 0;
            $omset = 0;
            foreach($data as $d){
                $profit += $d['profit'];
                $omset += $d['total'];
            }
            // dd(\DB::getQueryLog());
            return response()->json(array(
                'profit' => $profit,
                'omset' => $omset
            ), 200);
        } catch (\Throwable $th) {
            //throw $th;
            Alert::error('GAGAL', 'Gagal');
            return back();
        }
    }
}
