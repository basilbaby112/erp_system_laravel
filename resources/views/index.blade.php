<x-layouts>
    <h1 class="h1">Listings</h1>
    @if (session('message'))
        <p class="alert alert-info">{{session('message')}}</p>
    @endif
    <a href="{{route('create')}}" class="btn btn-primary">Create</a>  
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Sl.No</th>
            <th scope="col">Image</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Date Of Birth</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($listings as $item)
            <tr>
                <th scope="row">{{$listings->firstItem() + $loop->index}}</th>
                <td><img src="{{asset('storage/'.$item->image)}}" alt="no image" width="100 px" height="100 px"></td>
                <td>{{$item->name}}</td>
                <td>{{$item->email}}</td>
                <td>{{$item->date_of_birth_to_show}}</td>
                <td>{{$item->show_status}}</td>
                <td>
                    <a class="btn btn-primary" href="{{route('edit.data',['id'=>encrypt($item->id)])}}">Edit</a>
                    @if ($item->trashed())
                    <a class="btn btn-secondary" href="{{route('restore.data',['id'=>encrypt($item->id)])}}">Restore</a>
                    @else
                    <a class="btn btn-danger" href="{{route('delete.data',['id'=>encrypt($item->id)])}}">Delete</a>
                    @endif
                    <a class="btn btn-danger" href="{{route('force.delete.data',['id'=>encrypt($item->id)])}}">Force Delete</a>
                    
                </td>
              </tr>
            @endforeach
        </tbody>
      </table>
      <div>
        {{ $listings->links() }}
    </div>
</x-layouts>