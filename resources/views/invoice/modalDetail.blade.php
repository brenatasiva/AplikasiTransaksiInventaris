<form method="post" action="" autocomplete="off">
    @csrf
    @method('PUT')
    <div class="form-group">
        <table class="table table-bordered table-hover" id="tab_logic">
            <thead>
                <tr>
                    <th class="text-center">Barang</th>
                    <th class="text-center">Harga Jual</th>
                    <th class="text-center">Jumlah</th>
                    <th class="text-center">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @csrf
                @foreach ($data as $d)
                {{-- @dd($d) --}}
                    <tr>
                        <td>
                            {{$d->name}}
                        </td>
                        <td>
                            {{number_format($d->pivot->price)}}
                        </td>
                        <td>
                            {{$d->pivot->quantity}}
                        </td>
                        <td>
                            {{number_format($d->pivot->subtotal)}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</form>
