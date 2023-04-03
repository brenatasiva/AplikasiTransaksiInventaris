@extends('layout.sbadmin') 

@section('content')
<h1 class="mt-4">Barang</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item active">Pembelian Barang</li>
</ol>
<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 column">
            {{-- <form action="{{ url('/submitAddedItem') }}" method="post" autocomplete="off">
                <table class="table table-bordered table-hover" id="tab_logic">
                    <thead>
                        <tr>
                        <th class="text-center">Nama</th>
                        <th class="text-center">Harga Beli</th>
                        <th class="text-center">Jumlah</th>
                        <th>
                            <button type="button" id="add_row" class="btn btn-primary">Tambah Baris</button>
                        </th>
                        </tr>
                    </thead>
                    <tbody>
                        @csrf
                        <tr id='addr0'>
                            <td>
                                <input type="text" name='name[]' placeholder='Nama Barang' class="form-control autocomplete searchBox" required/>
                            </td>
                            <td>
                                <input type="number" name='buyPrice[]' placeholder='Harga Beli' class="form-control" required/>
                            </td>
                            <td>
                                <input type="number" name='quantity[]' placeholder='Jumlah yang dibeli' class="form-control" required/>
                            </td>
                        </tr>
                        <tr id='addr1'>

                        </tr>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-success" onclick="if(!confirm('Apakah anda yakin data yang di inputkan benar? Pastikan Nama barang sudah sesuai')){return false;}">Simpan</button>
            </form> --}}
            <form action="{{ url('/submitAddedItem') }}" method="post" autocomplete="off">
                <div class="form-group row">
                    <div class="col-md-4">
                        <select id="item" class="form-control">
                            @foreach ($data as $d)
                            <option value="{{$d['item_id']}}|{{$d['name']}}|{{$d['price']}}">{{$d['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="number" placeholder="Harga Beli" id="buyPrice" class="form-control" onClick="this.select();">
                    </div>
                    <div class="col-md-2">
                        <input type="number" placeholder="Jumlah" id="quantity" class="form-control" min="1" onClick="this.select();">
                    </div>
                    <div class="col-md-4">
                        <button type="button" id="add_item" class="btn btn-primary">Tambah</button>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-8">
                        <table class="table table-sm">
                            <thead> 
                                <tr>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Harga Beli</th>
                                    <th class="text-center">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody id="body">
                                @csrf
                                <tr id="addr1">
                                    
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <button class="form-control btn btn-success">Simpan</button>
                    </div>
                </div>
                    
            </form> 
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        // var i = 1;
        // $("#add_row").click(function() {
        //     $('tr').find('input')
        //     $('#addr' + i).html("<td><input type='text' name='name[]" +
        //          "'  placeholder='Nama Barang' class='form-control autocomplete searchBox' required/></td><td><input type='number' name='buyPrice[]" +
        //              "' placeholder='Harga Beli' class='form-control ' required/></td><td><input type='number' name='quantity[]" +
        //                 "' placeholder='Jumlah yang dibeli' class='form-control' required/>" + 
        //                 '<td><button type="button" id="add_row" class="btn btn-danger deleteRow">Hapus Baris</button></td>');

        //     $('#tab_logic').append('<tr id="addr' + (i + 1) + '"></tr>');
        //     i++;
        // });
        $("#add_item").click(function() {
            var items = $("#item").val();
            var item = items.split('|');
            var quantity = $("#quantity").val();
            var buyPrice = $("#buyPrice").val();

            $('tr').find('input');
            $("#body").append('<tr><td><input type="text" name="name[]" class="form-control" value="'+item[1]+'" readonly></td>'+
                                '<td><input type="number" name="buyPrice[]" class="form-control" value="'+buyPrice+'" onClick="this.select();" required></td>'+
                                '<td class="col-md-2"><input type="number" name="quantity[]" class="form-control" value="'+quantity+'" onClick="this.select();" required></td>'+
                                '<td><button class="btn btn-danger btnHapus">Hapus</button></td></tr>');
            
            $("#quantity").val();
            $("#buyPrice").val();
        });

        $('body').on('click', '.btnHapus', function() {
            $(this).parent().parent().remove();
        });

        // var array = @json($data);

        // $('body').on('click', '.searchBox', function() {
            
        //     $(this).autocomplete({
        //     source: array,
        //     minLength: 1,
        //     select: function(event, ui) {
        //         //update input with selection
        //         $(event.target).val(ui.item.label);
        //     }
        // });

    });

    // $('body').on('click', '.deleteRow', function() {
    //     $(this).parent().parent().remove();
    // });
</script>

@endsection