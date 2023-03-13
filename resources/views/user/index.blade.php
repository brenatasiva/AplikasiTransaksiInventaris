@extends('layout.sbadmin')
@section('content')
<h1 class="mt-4">User</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item active">User - Manage User</li>
</ol>


<table id="table_id" class="display">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
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
                    <td>{{$d->name}}</td>
                    <td>{{$d->email}}</td>
                    <td>{{$d->role}}</td>
                    <td>
                        <button type="button" id="add_row" class="btn btn-warning" data-toggle="modal" data-target="#modalEditUser" onclick="modalEdit({{$d->user_id}})">Edit</button>
                        <form method="post" action="{{route('user.destroy', $d->user_id)}}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger" onclick="if(!confirm('Apakah anda yakin ingin menghapus user ini?')){return false;}">Delete</button>
                        </form>
                    </td>
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
<div class="modal fade" id="modalEditUser" tabindex="-1" aria-labelledby="modalEditUser" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditUser">Edit User</h5>
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

@endsection
@section('script')
<script>
    $("#table_id").DataTable();

    function modalEdit(userId) {
        $.ajax({
            type: 'POST',
            url: 'formEditUser',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'userId': userId,
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