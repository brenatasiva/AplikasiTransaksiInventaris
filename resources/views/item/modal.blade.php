<form method="post" action="" autocomplete="off">
    @csrf
    <div class="form-group">
        <label for="exampleInputEmail1">Nama Barang</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder=""
            name="name" value="{{$data->name}}">
            <label for="exampleInputEmail1">Harga</label>
        <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder=""
            name="name" value="{{$data->price}}">
            <label for="exampleInputEmail1">Stok</label>
        <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder=""
            name="name" value="{{$data->stock}}">
            <label for="exampleInputEmail1">Satuan</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder=""
            name="name" value="{{$data->unit}}">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
