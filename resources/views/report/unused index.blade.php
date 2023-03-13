@extends('layout.sbadmin') 
@section('content')
<h1 class="mt-4">Laporan</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item active">Laporan</li>
</ol>


<label for="">Tanggal Awal</label><input type="date" id="startDate">
<label for="">Tanggal Akhir</label><input type="date" id="endDate">
<button type="button" class="btn btn-primary btn-lg" onclick="showReport()">
    Lihat Laporan
</button><br><br>


<table id="table_id" class="display">
    <thead>
        <tr>
            <th>Nama Barang</th>
            <th>Harga Jual</th>
            <th>Stok</th>
            <th>Satuan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @isset($data) 
            @foreach ($data as $d)
                <tr>
                    <td>{{$d->name}}</td>
                    <td>{{number_format($d->price)}}</td>
                    <td>{{$d->stock}}</td>
                    <td>{{$d->unit}}</td>
                    <td><button type="button" id="add_row" class="btn btn-warning" data-toggle="modal" data-target="#modalEditItem" onclick="modalEdit({{$d->item_id}})">Edit</button></td>
                </tr>
            @endforeach 
        @endisset
    </tbody>
</table>


@endsection
@section('script')
<script>
    var table = $("#table_id").DataTable();

    function showReport() {
        var startDate = $('#startDate').val();
        var endDate = $('#endDate').val();

        $.ajax({
            type: 'POST',
            url: 'showReport',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'startDate': startDate,
                'endDate': endDate,
            },
            success: function (data) {
                table.ajax.reload(null,false);
            },
            error: function (xhr) {
                alert("Pastikan tanggal sudah sesuai");
                console.log(xhr);
            }
        });
    }
</script>

@endsection
@section('ajax')
<script>
    
</script>
@endsection
