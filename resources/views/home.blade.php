@extends('layout.sbadmin')

@section('content')
<h1 class="mt-4">Home</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Home</li>
</ol>

<div class="row">
    <!-- Data Barang -->
    @csrf
    @method('PUT')
    <div class="col-md-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h5><i class="fa fa-desktop"></i> Data Barang</h5>
            </div>
            @csrf
            <div class="panel-body">
                <center>
                    <h1>{{ $data['item'] }}</h1>
                </center>
            </div>
            <div class="panel-footer">
                <h4 style="font-size:15px;font-weight:700;"><a href='/item'>Tabel Barang <i
                            class='fa fa-angle-double-right'></i></a></h4>
            </div>
        </div>
    </div>

    <!-- Transaksi -->
    <div class="col-md-4">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h5><i class="fa fa-desktop"></i> Transaksi Sukses</h5>
            </div>
            <div class="panel-body">
                <center>
                    <h1>{{ $data['invoice'] }}</h1>
                </center>
            </div>
            <div class="panel-footer">
                <h4 style="font-size:15px;font-weight:700;font-weight:700;"><a href='/sellReport'>Tabel
                        transaksi <i class='fa fa-angle-double-right'></i></a></h4>
            </div>
        </div>
    </div>
    </form>

    <!-- user -->
    <div class="col-md-4">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <h5><i class="fa fa-desktop"></i> User Terdaftar</h5>
            </div>
            <div class="panel-body">
                <center>
                    <h1>{{ $data['user'] }}</h1>
                </center>
            </div>
            <div class="panel-footer">
                <h4 style="font-size:15px;font-weight:700;"><a href='/register'>Daftar user <i
                            class='fa fa-angle-double-right'></i></a></h4>
            </div>
        </div>
    </div>
</div>
@endsection