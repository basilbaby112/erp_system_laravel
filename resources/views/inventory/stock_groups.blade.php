<x-layouts>
    <main id="main" class="main">

        <div class="pagetitle">
          <h1>{{$title}}</h1>
          <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="">Home</a></li>
              <li class="breadcrumb-item">{{$title}}</li>
            </ol>
          </nav>
          <div id="alert">

          </div>
          <button class="btn btn-outline-primary" data-bs-toggle="modal" id="add-button" data-bs-target="#largeModal">Add</button>
        </div><!-- End Page Title -->
    
        <section class="section">
          <div class="row">
            <div class="col-lg-12">
    
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">{{$title}}</h5>
    
                  <!-- Table with stripped rows -->
                   <!-- Table with stripped rows -->
              <table class="table" id="warehouse-table">
                <thead>
                  <tr>
                    <th scope="col">Sl.No</th>
                    <th scope="col">Warehouse</th>
                    {{-- <th scope="col">Address</th> --}}
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                
              </table>
              <!-- End Table with stripped rows -->
                  <!-- End Table with stripped rows -->
    
                </div>
              </div>
    
            </div>
          </div>
        </section>
    
      </main>
 <!-- modal --> 

 <div class="modal fade" id="largeModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          {{-- form part --}}
          <div class="card">
            <div class="card-body">
              <h5 class="card-title" id="warehouse-title">Add Stock group</h5>

              <!-- Vertical Form -->
              <form class="row g-3" id="warehouse">
                @csrf
                <div class="col-12">
                  <label for="inputNanme4" class="form-label">Group Name</label>
                  <input type="text" class="form-control" id="name" name="name">
                </div>
                <input type="hidden" id="warehouseId" name="warehouseId">
                <div class="col-12">
                    <label for="floatingTextarea">Description</label>
                    <div class="form-floating">
                        <textarea class="form-control"  id="description" name="description"></textarea>
                    </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary" id="warehouse-button">Submit</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form><!-- Vertical Form -->

            </div>
          </div>
          {{-- form part end --}}
        </div>
      </div>
    </div>
  </div>
 
  {{-- form submition --}}
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function(){

      // fetch-table-data

      var table = $('#warehouse-table').DataTable({
                  processing: true,
                  serverSide: true,
                  ajax: '{{ route("stock_group.fetch") }}', // Route to fetch data
                  columns: [
                    { 
                          data: null,
                          orderable: false, // Disable sorting for this column
                          searchable: false, // Disable searching for this column
                          render: function(data, type, row, meta) {
                              // Calculate serial number
                              return meta.row + meta.settings._iDisplayStart + 1;
                          }
                      },
                      { data: 'name', name: 'name' },
                      // { data: 'address', name: 'address' },
                      { data: 'action', name: 'action',orderable:false,searchable:false },
                      // Add more columns as needed
                  ]
              });

    $('body').on('click','.editButton',function(){
      var id = $(this).data('id');
      $.ajax({
        url:'{{route("warehouse.edit","")}}/'+id,
        method: 'GET',
        success: function(response){
         
          $('#largeModal').modal('show')
          $('#warehouse-title').html('Edit Warehouse')
          $('#warehouse-button').html('Update')
          $('#inputNanme4').val(response.data['name'])
          $('#floatingTextarea').html(response.data['address'])
          $('#warehouseId').val(response.data['id'])
        },
        error: function(error){
          console.log(error);
        }
      })
    })

    $('body').on('click','.deleteButton',function(){
        var confirmed = confirm('Are you sure you want to delete this item?');
        if (confirmed) {
          var id = $(this).data('id');
          $.ajax({
            url:"{{route('warehouse.delete','')}}/"+id,
            method:'GET',
            success: function(response){
              $('#alert').html(`<div class="alert alert-primary alert-dismissible fade show" role="alert">
                        ${response}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`)

                table.ajax.reload();
            },
            error:function(error){
              console.log(error);
            }

          })
        } else {
            // Cancel deletion
            console.log('Deletion canceled');
        }
          
        })

    $('#add-button').click(function(){
       $('#largeModal').modal('show')
          $('#warehouse-title').html('Add Warehouse')
          $('#warehouse-button').html('Submit')
          $('#inputNanme4').val('')
          $('#floatingTextarea').html('')
          $('#warehouseId').val('')
    });
        $('#warehouse').submit(function(e){
            e.preventDefault();
            
            var formData = $(this).serialize();
            
            $.ajax({
                url: "{{ route('warehouse.create') }}",
                type: 'POST',
                data: formData,
                success: function(response){
                    $('#alert').html(`<div class="alert alert-primary alert-dismissible fade show" role="alert">
                        ${response.message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`);
                    $('#warehouse')[0].reset();
                    $('#largeModal').modal('hide');

                    table.ajax.reload();

                    // window.location.href = '{{ route("warehouse") }}';
                    
                    
                },
                error: function(xhr, status, error){
                    // Handle errors

                    if(xhr.status == 422) {
                        var errors = JSON.parse(xhr.responseText).errors;
                        var errorsHtml = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><ul>';
                        $.each(errors, function(key, value) {
                            errorsHtml += '<li>' + value + '</li>';
                        });
                        errorsHtml += '</ul><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                        $('#alert').html(errorsHtml);
                        $('#largeModal').modal('hide');
                        
                    } else {
                        console.error(xhr.responseText);
                    }
                }
            });
        });

    });

</script>
 <!-- modal end -->
</x-layouts>