@extends('layout.sbadmin') 
@section('content')
<h1 class="mt-4">Laporan</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item active">Laporan - Laporan Pembelian</li>
</ol>


<table id="table_id" class="display">
    <thead>
        <tr>
            <th>#</th>
            <th>Tanggal</th>
            <th>Total</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @isset($data) 
        @php
            $i = 1
        @endphp
            @foreach ($data as $d)
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$d->date}}</td>
                    <td>Rp. {{number_format($d->total)}}</td>
                    <td><button type="button" id="add_row" class="btn btn-secondary" data-toggle="modal" data-target="#modalDetailHistory" onclick="modalDetail({{$d->history_id}})">Detail</button></td>
                </tr>
                @php
                    $i++
                @endphp
            @endforeach 
        @endisset
    </tbody>
</table>


@endsection

@section('modal')
<div class="modal fade" id="modalDetailHistory" tabindex="-1" aria-labelledby="modalDetailHistory" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailHistory">Detail Pembelian</h5>
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

@section('script')
<script>
    $(document).ready(function () {
    });
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
@section('ajax')
<script>
    function modalDetail(historyId) {
        $.ajax({
            type: 'POST',
            url: 'formDetailHistory',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'historyId': historyId,
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
