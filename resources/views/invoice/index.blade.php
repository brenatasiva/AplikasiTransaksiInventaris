@extends('layout.sbadmin')

@section('content')
<h1 class="mt-4">Transaksi</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item active">Transaksi</li>
</ol>
<a class="btn btn-primary btn-lg" href="{{ url('/addInvoice') }}">Tambah Transaksi</a>
<br><br>
<h3>Daftar Transaksi</h3>
<table id="table_id" class="display">
    <thead>
        <tr>
            <th>ID Nota</th>
            <th>Nama Penjual</th>
            <th>Nama Pelanggan</th>
            <th>Tanggal Pembelian</th>
            <th>Total</th>
            <th>lain-lain</th>
        </tr>
    </thead>
    <tbody>
        @isset($data) 
            @foreach ($data as $d)
                <tr>
                    <td>{{$d->invoice_id}}</td>
                    <td>{{$d->user->name}}</td>
                    <td>{{$d->customer_name}}</td>
                    <td>{{$d->date}}</td>
                    <td>{{number_format($d->total)}}</td>
                    <td><button type="button" id="add_row" class="btn btn-warning" data-toggle="modal" data-target="#modalDetailInvoice" onclick="modalDetail({{$d->invoice_id}})">Detail</button></td>
                </tr>
            @endforeach 
        @endisset
    </tbody>
</table>

@endsection
@section('modal')
{{-- <div class="modal fade" id="modalCreate" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Tambah Jenis Barang</h4>
            </div>
            <form method="post" action="{{route('item.store')}}" autocomplete="off">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Barang</label>
                        <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp"
                            placeholder="Contoh: Paku Payung" required><br>
                        <label for="exampleInputEmail1">Harga</label>
                        <input type="number" class="form-control" id="price" name="price" aria-describedby="emailHelp"
                            placeholder="Harga Jual"><br>
                        <label for="exampleInputEmail1">Stok</label>
                        <input type="number" class="form-control" id="name" name="stock" aria-describedby="emailHelp"
                            placeholder="Stok" required><br>
                        <label for="exampleInputEmail1">Satuan</label>
                        <input type="text" class="form-control" id="unit" name="unit" aria-describedby="emailHelp"
                            placeholder="Contoh: Kg, Meter, Pcs" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div> --}}

<div class="modal fade" id="modalDetailInvoice" tabindex="-1" aria-labelledby="modalDetailInvoice" aria-hidden="true">
    <div class="modal-dialog">
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
            url: 'formDetailInvoice',
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
@section('script')
<script>
    $(document).ready(function () {
        $("#table_id").DataTable();
    });
</script>

@endsection