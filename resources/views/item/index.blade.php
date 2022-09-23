@extends('layout.sbadmin') @section('content')
<h1 class="mt-4">Barang</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item active">Lihat Barang</li>
</ol>
<table id="table_id" class="display">
    <thead>
        <tr>
            <th>Nama Barang</th>
            <th>Harga</th>
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
                    <td>{{$d->price}}</td>
                    <td>{{$d->stock}}</td>
                    <td>{{$d->unit}}</td>
                    <td><button type="button" id="add_row" class="btn btn-warning" data-toggle="modal" data-target="#modalEditBrand" onclick="modalEdit({{$d->item_id}})">Edit</button></td>
                </tr>
            @endforeach 
        @endisset
    </tbody>
</table>
@endsection 

@section('modal')
<div class="modal fade" id="modalCreate" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Tambah Jenis Barang</h4>
            </div>
            <form method="post" action="">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp"
                            placeholder="Name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEditBrand" tabindex="-1" aria-labelledby="modalEditBrand" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditBrand">Edit Brand</h5>
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
    function modalEdit(itemId) {
        $.ajax({
            type: 'POST',
            url: 'formEditItem',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'itemId': itemId,
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
