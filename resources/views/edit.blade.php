<x-layouts>
    <form method="post" action="{{route('update.data')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <input type="hidden" name="id" value="{{encrypt($data->id)}}">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" name="name" value="{{$data->name}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name">
          </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Email address</label>
          <input type="email" name="email" value="{{$data->email}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Date of birth</label>
          <input type="date" name="date_of_birth" value="{{$data->date_of_birth}}" class="form-control" id="exampleInputPassword1" placeholder="Date of birth">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Image</label>
          <input type="file" name="image" value="{{$data->image}}" class="form-control" id="exampleInputPassword1" placeholder="Date of birth">
        </div>
        <img src="{{asset('storage/'.$data->image)}}" alt="no-image" height="100px" width="100px">
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
</x-layouts>