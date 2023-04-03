@extends('layout.sbadmin') 
@section('content')
<h1 class="mt-4">Laporan</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item active">Laporan - Laporan Penjualan</li>
</ol>


<form action="{{url('/generateSellPdf')}}" method="POST">
    <div class="form-group row">
        <h4 class="col-md-12">Hitung Keuntungan dan Omset</h4>
        @csrf
        <input class="col-md-4 form-control" type="date" name="startDate" id="startDate">
        <label><b class="col-md-1">-</b></label>
        <input class="col-md-4 form-control" type="date" name="endDate" id="endDate">
        <div class="col-md-3">
            <button type="button" class="btn btn-primary" onclick="calcProfit()">
                Hitung
            </button>
            <button type="submit" class="btn btn-warning" id="btnGeneratePdf">Generate PDF</button>
        </div>
    </div>
</form>
<div class="col-md-3 text-black bg-warning" id="result">
    <label>Keuntungan = Rp. <span id="showProfit"></span></label><br>
    <label>Omset = Rp. <span id="showOmset"></span></label>
</div>
<br><br>

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
    $(document).ready(function() {
        $('#result').hide();
        $('#btnGeneratePdf').hide();
    });
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
                $('#showProfit').html(data['profit'].toLocaleString());
                $('#showOmset').html(data['omset'].toLocaleString());
                $('#result').show();
                $('#btnGeneratePdf').show();
            },
            error: function (xhr) {
                Swal.fire({
                title: 'PERINGATAN',
                text: "Pastikan Tanggal Sudah Sesuai",
                icon: 'warning'
                })
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
