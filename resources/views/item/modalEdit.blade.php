<form method="post" action="{{url('item/'.$data->item_id)}}" autocomplete="off">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="exampleInputEmail1">Nama Barang</label>
        <input type="text" class="form-control" name="name" value="{{$data->name}}">
            <label for="exampleInputEmail1">Harga Jual</label>
        <input type="number" class="form-control" name="price" value="{{$data->price}}">
            <label for="exampleInputEmail1">Harga Beli</label>
        <input type="number" class="form-control" name="buyPrice" value="{{$data->buy_price}}">
            <label for="exampleInputEmail1">Stok</label>
        <input type="number" class="form-control" name="stock" value="{{$data->stock}}">
            <label for="exampleInputEmail1">Satuan</label>
        <input type="text" class="form-control" name="unit" value="{{$data->unit}}">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
