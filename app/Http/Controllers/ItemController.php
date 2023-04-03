<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Item;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ItemController extends Controller
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
            $data = Item::all();
            return view('item.index', compact('data'));
        } catch (\Throwable $th) {
            //throw $th;
            Alert::error('Error', 'Gagal');
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
        try {
            //code...
            $data = Item::all()->sortBy("name");
            return view('item.addItem', compact('data'));
        } catch (\Throwable $th) {
            //throw $th;
            Alert::error('Error', 'Gagal');
            return back();
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
            $data = new Item();
    
            $data->name = $request->get('name');
            $data->price = $request->get('price');
            $data->buy_price = $request->get('buyPrice');
            $data->unit = $request->get('unit');
            $data->stock = $request->get('stock');
            $data->save();
            Alert::success('SUKSES', 'Berhasil Menambah Barang');
            return back();
        } catch (\Throwable $th) {
            //throw $th;
            Alert::error('GAGAL', 'Gagal Menambah Barang');
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        try {
            //code...
            $item->name = $request->get('name');
            $item->price = $request->get('price');
            $item->buy_price = $request->get('buyPrice');
            $item->unit = $request->get('unit');
            $item->stock = $request->get('stock');
            $item->save();

            Alert::success('SUKSES', 'Berhasil Mengubah Barang');
            return back();
        } catch (\Throwable $th) {
            //throw $th;
            Alert::error('GAGAL', 'Gagal Mengubah Barang');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        try {
            //code...
            $item->delete();
            Alert::success('SUKSES', 'Berhasil Menghapus Barang');
            return back();
        } catch (\Throwable $th) {
            //throw $th;
            Alert::error('GAGAL', 'Gagal Menghapus Barang');
            return back();
        }
    }

    public function showEditModal(Request $request)
    {
        try {
            //code...
            $id = $request->get('itemId');
            $data = Item::find($id);
            return response()->json(array(
                'msg' => view('item.modalEdit', compact('data'))->render()
            ), 200);
        } catch (\Throwable $th) {
            //throw $th;
            Alert::error('GAGAL', 'Gagal');
            return back();
        }
    }
}
