{{-- @dd($data) --}}
<form method="post" action="" autocomplete="off">
    @csrf
    @method('PUT')
    <div class="form-group">
        <table class="table table-bordered table-hover" id="tab_logic">
            <thead>
                <tr>
                    <th class="text-center">Barang</th>
                    <th class="text-center">Harga Beli</th>
                    <th class="text-center">Jumlah</th>
                    <th class="text-center">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @csrf
                @foreach ($data as $d)
                    <tr>
                        <td>
                            {{$d->item_name}}
                        </td>
                        <td>
                            Rp. {{number_format($d->buy_price)}}
                        </td>
                        <td>
                            {{$d->quantity}}
                        </td>
                        <td>
                            Rp. {{number_format($d->subtotal)}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</form>
