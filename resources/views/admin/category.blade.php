<!DOCTYPE html>
<html>
    <head>
  @include('admin.css')

  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <style type="text/css">

  .div_center{
    text-align: center;
    margin: auto;
  }

  .cat_label{
    font-size: 30px;
    font-weight: bold;
    padding: 30px;
    color: white;
  }

  .center{
    margin: auto;
    width: 50%;
    text-align: center;
    margin-top: 50px;
    border: 1px solid white;
  }

  th{
    background-color: skyblue;
    padding: 10px;
  }

  tr{
    border: 1px solid white;
    padding: 10px;
  }
   </style>

  </head>
  <body>
   
  @include('admin.header')

    <div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
   
   @include('admin.sidebar')    
      <!-- Sidebar Navigation end-->
         <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">

          <div class="div_center">

 <div>
  @if(session()->has('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('message') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  @if(session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{ session('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif
</div>

{{-- SweetAlert popups for success/error --}}

<script>
  @if(session('message'))
    swal("Success!", "{{ session('message') }}", "success");
  @endif

  @if(session('error'))
    swal("Error!", "{{ session('error') }}", "error");
  @endif
</script>


            <h1 class="cat_label"> Add Category</h1>

            <form action="{{url('add_category')}}" method="Post">

              @csrf

              <span style="padding-right: 15px">

              <label>Category Name</label>
              <input type="text" name="category" required>
              </span>

              <input class="btn btn-primary" type="submit" value="Add Category">



            </form>

          <div>

            <table class="center">
  <tr>
    <th>Category Name</th>
    <th>Subcategories</th>
    <th>Action</th>
  </tr>
  @foreach($data as $category)
    <tr>
      <td>{{ $category->cat_title }}</td>
      <td>
        @if($category->subcategories->isNotEmpty())
          <ul style="text-align: left;">
            @foreach($category->subcategories as $sub)
              <li>{{ $sub->sub_title }}</li>

            @endforeach
          </ul>
        @else
          <em>No Subcategories</em>
        @endif
      </td>
      <td>
        <a class="btn btn-info" href="{{ url('edit_category', $category->id) }}">Update</a>
        <a onclick="confirmation(event)" class="btn btn-danger" href="{{ url('cat_delete', $category->id) }}">Delete</a>
      </td>
    </tr>
  @endforeach
</table>




          </div>

          

</div>

</div>
</div>
</div>
     
             
    @include('admin.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <script type="text/javascript">


    function confirmation(ev) {
    ev.preventDefault();
    var urlToRedirect = ev.currentTarget.getAttribute('href');
    console.log(urlToRedirect);

    swal({
        title: "Are you sure to Delete this",
        text: "You will not be able to revert this!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willCancel) => {
        if (willCancel) {
            window.location.href = urlToRedirect;
        }
    });
}


    </script>
 </body>
</html>