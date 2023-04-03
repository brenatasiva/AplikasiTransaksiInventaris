@extends('layout.sbadmin') 

@section('content')
<h1 class="mt-4">Transaksi</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item active"><a href="/transaction">Transaksi</a></li>
    <li class="breadcrumb-item">Tambah Transaksi</li>
</ol>
<div class="container">
    <form action="{{ url('/submitInvoice') }}" method="post" autocomplete="off" onsubmit="return isValidForm(this)">
        <div class="form-group row">
            <label for="customerName" class="col-sm-2 col-form-label">Nama Pelanggan:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="customerName" name="customerName" placeholder="Nama Pelanggan"  onClick="this.select();">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-4">
                <select id="item" class="form-control">
                    @foreach ($data as $d)
                    <option value="{{$d['item_id']}}|{{$d['name']}}|{{$d['price']}}">{{$d['name']}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <input type="number" placeholder="Jumlah" id="quantity" class="form-control" min="1" value="1" onClick="this.select();">
            </div>
            <div class="col-md-6">
                <button type="button" id="add_item" class="btn btn-primary">Tambah</button>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-8">
                <table class="table table-sm">
                    <thead> 
                        <tr>
                            <th class="w-50">Nama</th>
                            <th class="w-25">Harga</th>
                            <th>Qty</th>
                            <th>Sub Total</th>
                            <th></th>
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
                <h2 class="text-black bg-warning">Total Rp. <label id="total">0</label></h2>
                <label for="customerName" class="form-label">Bayar:</label>
                <input type="text" id="pay" name="pay" class="form-control" onClick="this.select();" required>
                <br>
                <h5 class="text-black bg-warning">Kembalian <b>Rp. <label id="kembalian">0</label></b></h5>
                <br>
                <button class="form-control btn btn-success">Simpan</button>
            </div>
        </div>
            
    </form> 
</div>
@endsection
@section('script')
<script type="text/javascript">
var arrItem = $.map(@json($data), function(value, index){ return [value]; });

function isValidForm(form){
    var pay = parseInt($('#pay').val().replace(',', ''));
    var total = parseInt($("#total").text().replace(/,/g, ""));

    if(pay < total) {
        Swal.fire({
        title: 'GAGAL TRANSAKSI',
        text: "Jumlah Uang kurang!",
        icon: 'error'
        })
        return false;
    }else{
        return true;
    }
}

    $(document).ready(function() {

        $("#add_item").click(function() {
            var items = $("#item").val();
            var item = items.split('|');
            var quantity = $("#quantity").val();
            var subtotal = item[2] * quantity;

            $('tr').find('input');
            $("#body").append('<tr><td><input type="text" name="name[]" class="form-control" value="'+item[1]+'" readonly></td>'+
                                '<td><input type="number" name="price[]" class="form-control" value="'+item[2].toLocaleString()+'" readonly ></td>'+
                                '<td class="col-md-2"><input type="number" name="quantity[]" class="form-control" value="'+quantity+'" readonly /></td>'+
                                '<td class="subtotal">'+subtotal.toLocaleString()+'</td>'+
                                '<td><button class="btn btn-danger btnHapus">Hapus</button></td></tr>');
            $("#total").html((parseInt($("#total").text().replace(/,/g, "")) + subtotal).toLocaleString());

            calcKembalian(parseInt($('#pay').val().replace(',', '')));

            var stock = parseFloat(arrItem.find((o) => { return o["name"] === item[1] })['stock']);

            if(quantity > stock){
                Swal.fire({
                title: 'PERINGATAN',
                text: "Jumlah Melebihi Stok! Stok " + item[1] + " sekarang = " + stock,
                icon: 'warning'
                })
            }
        });

        function countTotal(){
            var subtotals = $(".subtotal").map(function() {
                return this.innerHTML.replace(/,/g, "");
            }).get().toString();
            var arrSubtotals = subtotals.split(',').map(Number);
            var sum = arrSubtotals.reduce(function(a, b){
                return a + b;
            }, 0);
            $("#total").html(sum.toLocaleString());
        }

        $('body').on('click', '.btnHapus', function() {
            $(this).parent().parent().remove();
            countTotal();
            calcKembalian(parseInt($('#pay').val().replace(',', '')));
            // $("#pay").val('');
            // $("#kembalian").html('0');
        });

        function calcKembalian(value){
            var total = parseInt($("#total").text().replace(/,/g, ""));
            $("#kembalian").html((value-total).toLocaleString());
        }

        function delay(callback, ms) {
            var timer = 0;
            return function() {
                var context = this, args = arguments;
                clearTimeout(timer);
                timer = setTimeout(function () {
                callback.apply(context, args);
                }, ms || 0);
            }
        }

        $('body').on('keyup', '#pay', delay(function(e){
            var val = parseInt((this.value).replace(',', ''));
            calcKembalian(val);
        }, 500));

        function updateTextView(_obj){
            var num = getNumber(_obj.val());
            if(num==0){
                _obj.val('');
            }else{
                _obj.val(num.toLocaleString());
            }
        }

        function getNumber(_str){
            var arr = _str.split('');
            var out = new Array();
            for(var cnt=0;cnt<arr.length;cnt++){
                if(isNaN(arr[cnt])==false){
                out.push(arr[cnt]);
                }
            }
            return Number(out.join(''));
        }

        $('#pay').on('keyup',function(){
            updateTextView($(this));
        });
    });
    
</script>

@endsection