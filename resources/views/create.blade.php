<x-layouts>
    <form  action="{{route('create.data')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" name="name" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name">
            @error('name') <p class="alert alert-danger">{{$message}}</p> @enderror
          </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Email address</label>
          <input type="email" name="email" value="{{old('email')}}" class="form-control @error('name') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
          @error('email') <p class="alert alert-danger">{{$message}}</p> @enderror
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Date of birth</label>
          <input type="date" name="date_of_birth" value="{{old('date_of_birth')}}" class="form-control @error('name') is-invalid @enderror" id="exampleInputPassword1" placeholder="Date of birth">
          @error('name') <p class="alert alert-danger">{{$message}}</p> @enderror
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Image</label>
          <input type="file" name="image" class="form-control" id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
</x-layouts>