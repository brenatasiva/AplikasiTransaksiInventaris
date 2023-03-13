<form method="post" action="{{url('user/'.$data->user_id)}}" autocomplete="off">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label>Nama User</label>
        <input type="text" class="form-control" name="name" value="{{$data->name}}">
        <label>Email</label>
        <input type="text" class="form-control" name="email" value="{{$data->email}}">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
