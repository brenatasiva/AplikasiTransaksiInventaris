<?php

namespace App\Http\Controllers;

use App\Models\HistoryDetails;
use Illuminate\Http\Request;

class HistoryDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HistoryDetails  $historyDetails
     * @return \Illuminate\Http\Response
     */
    public function show(HistoryDetails $historyDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HistoryDetails  $historyDetails
     * @return \Illuminate\Http\Response
     */
    public function edit(HistoryDetails $historyDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HistoryDetails  $historyDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HistoryDetails $historyDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HistoryDetails  $historyDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(HistoryDetails $historyDetails)
    {
        //
    }

    public function showDetailModal(Request $request)
    {
        $id = $request->get('historyId');
        $data = HistoryDetails::all()->where('history_id', $id);
        
        return response()->json(array(
            'msg' => view('report.modalDetailHistory', compact('data'))->render()
        ), 200);
    }
}
