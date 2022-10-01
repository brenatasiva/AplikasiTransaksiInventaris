@extends('layout.sbadmin') 

@section('content')
<h1 class="mt-4">Transaksi</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item active"><a href="/transaction">Transaksi</a></li>
    <li class="breadcrumb-item">Tambah Transaksi</li>
</ol>
<div class="container">
    <form action="{{ url('/submitInvoice') }}" method="post" autocomplete="off">
        <div class="form-group row">
            <label for="customerName" class="col-sm-2 col-form-label">Nama Pelanggan:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="customerName" name="customerName" placeholder="Nama Pelanggan" required>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-md-12 column">
                <table class="table table-bordered table-hover" id="tab_logic">
                    <thead>
                        <tr>
                        <th class="align-middle text-center">Nama Barang</th>
                        <th class="align-middle text-center">Harga</th>
                        <th class="align-middle text-center">Jumlah</th>
                        <th class="align-middle text-center">Subtotal</th>
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
                                <input type="number" name='price[]' placeholder='Harga' min="0" value="0" class="form-control price" required/>
                            </td>
                            <td>
                                <input type="number" name='quantity[]' id="quantity" min="0" value="0" placeholder='Jumlah' class="form-control quantity" required/>
                            </td>
                            <td>
                                <span class="form-control subtotal">0</span>
                            </td>
                            
                        </tr>
                        <tr id='addr1'>

                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="align-middle text-right"><b>TOTAL</b></td>
                            <td colspan="2"><b class="total form-control ">0</b></td>
                        </tr>
                    </tfoot>
                </table>
                <button type="submit" class="btn btn-success" onclick="if(!confirm('Apakah anda yakin data yang di inputkan benar? Pastikan Nama barang sudah sesuai')){return false;}">Simpan</button>
            </div>
        </div>
    </form>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        var i = 1;
        $("#add_row").click(function() {
            $('tr').find('input')
            $('#addr' + i).html("<td><input type='text' name='name[]" +
                 "'  placeholder='Nama Barang' class='form-control autocomplete searchBox' required/></td><td><input type='number' name='price[]' min='0' value='0'" +
                     "' placeholder='Harga' class='form-control price' required/></td><td><input type='number' name='quantity[]' min='0' value='0'" +
                        "' placeholder='Jumlah' class='form-control quantity' required/><td>" + 
                            '<span class="form-control subtotal">0</span></td>' +
                        '<td><button type="button" id="add_row" class="btn btn-danger deleteRow">Hapus Baris</button></td>');

            $('#tab_logic').append('<tr id="addr' + (i + 1) + '"></tr>');
            i++;
        });

        var arrData = @json($data);

        var source  = [ ];
        var price = { };
        for(var i = 0; i < arrData.length; ++i) {
            source.push(arrData[i].name);
            price[arrData[i].name] = arrData[i].price;
        }

        $('body').on('click', '.searchBox', function() {
            $(this).autocomplete({
                source: source,
                minLength: 1,
                select: function(event, ui) {
                    //update input with selection
                    $(event.target).val(ui.item.label);
                    $(this).parent().parent().find(".price").val((price[ui.item.value]));
                }
            });
        });

        $('body').on('click', '.quantity', function(){
            countSubtotal($(this));
            countTotal($(this));
        });

        $('body').on('change', '.price', function(){
            countSubtotal($(this));
            countTotal($(this));
        });

        $('body').on('click', '.deleteRow', function() {
            $(this).parent().parent().remove();
            $('body').find('#quantity').click();
        });

        function countSubtotal(ths){
            var price = ths.parent().parent().find(".price").val();
            var quantity = ths.parent().parent().find(".quantity").val();
            var subtotal = price * quantity;
            ths.parent().parent().find(".subtotal").html(subtotal.toLocaleString('de-DE'));
        }

        function countTotal(ths){
            var total = 0;
            $(ths).parent().parent().parent().find('.subtotal').each(function(){
                var value = $(this).text().replace(".","");
                total += parseFloat(value);
            });
            ths.parent().parent().parent().parent().find(".total").html(total.toLocaleString('de-DE'));
        }
    });
</script>

@endsection