@extends('layout.sbadmin') 
@section('content')
<h1 class="mt-4">Laporan</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item active">Laporan - Laporan Penjualan</li>
</ol>


<h4>Hitung Keuntungan dan Omset</h4>
<input type="date" id="startDate"> -
<input type="date" id="endDate">
<button type="button" class="btn btn-primary" onclick="calcProfit()">
    Hitung
</button><br>
<label id="profit"></label><br>
<label id="omset"></label><br><br>


{{-- <table id="table_id" class="display">
    <thead>
        <tr>
            <th>ID Nota</th>
            <th>Nama Penjual</th>
            <th>Nama Pelanggan</th>
            <th>Tanggal Pembelian</th>
            <th>Total</th>
            <th>Keuntungan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <div id="range">

        </div>

        <div id="firstLoad">
            @isset($data) 
                @php
                    $i = 1
                @endphp
                @foreach ($data as $d)
                    <tr>
                        <td>{{$d->invoice_id}}</td>
                        <td>{{$d->seller_name}}</td>
                        <td>{{$d->customer_name}}</td>
                        <td>{{$d->date}}</td>
                        <td>Rp. {{number_format($d->total)}}</td>
                        <td>Rp. {{number_format($d->profit)}}</td>
                        <td><button type="button" id="add_row" class="btn btn-secondary" data-toggle="modal" data-target="#modalDetailInvoice" onclick="modalDetail({{$d->invoice_id}})">Detail</button></td>
                    </tr>
                    @php
                        $i++
                    @endphp
                @endforeach   
            @endisset
        </div>
    </tbody>
</table> --}}

<table id="table2"  class="display">
    <thead>
        <tr>
            <th>ID Nota</th>
            <th>Nama Penjual</th>
            <th>Nama Pelanggan</th>
            <th>Tanggal Pembelian</th>
            <th>Total</th>
            <th>Keuntungan</th>
            <th>Aksi</th>
        </tr>
    </thead>
</table>


@endsection
@section('script')
<script>
    // $("#table_id").DataTable();
    var table;
    $.ajax({
        type: "Post",
        url: "sellDatatable",
        data: {'_token': '<?php echo csrf_token() ?>'},
        success: function (response) {
            console.log(response);
            table = $('#table2').DataTable({
                data: response,
                columns: [
                    { data: 'invoice_id' },
                    { data: 'seller_name' },
                    { data: 'customer_name' },
                    { data: 'date' },
                    { data: 'total' },
                    { data: 'profit' },
                    {data: 'invoice_id' , render : function ( data, type, row, meta ) {
                        return '<button type="button" id="add_row" class="btn btn-secondary" data-toggle="modal" data-target="#modalDetailInvoice" onclick="modalDetail('+data+')">Detail</button>'
                    }},
                ]
            });

        },
        error: function (response) {
            alert(response.responseText);
        }
    });

    function calcProfit() {
        var startDate = $('#startDate').val();
        var endDate = $('#endDate').val();
        table.clear();

        $.ajax({
            type: 'POST',
            url: 'calcProfit',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'startDate': startDate,
                'endDate': endDate,
            },
            success: function (data) {
                table.clear();
                table.rows.add(data['invoice']);
                table.draw();
                $('#profit').html('Keuntungan = Rp. '+data['profit'].toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
                $('#omset').html('Omset = Rp. '+data['omset'].toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
            },
            error: function (xhr) {
                alert("Pastikan tanggal sudah sesuai");
                console.log(xhr);
            }
        });
    }
</script>

@endsection

@section('modal')
<div class="modal fade bd-example-modal-lg" id="modalDetailInvoice" tabindex="-1" aria-labelledby="modalDetailInvoice" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailInvoice">Detail Nota</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group" id="modalContent">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('ajax')
<script>
    function modalDetail(invoiceId) {
        $.ajax({
            type: 'POST',
            url: 'formDetailInvoiceReport',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'invoiceId': invoiceId,
            },
            success: function (data) {
                $("#modalContent").html(data.msg);
            },
            error: function (xhr) {
                console.log(xhr);
            }
        });
    }
</script>
@endsection
