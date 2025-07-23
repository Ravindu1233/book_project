<!DOCTYPE html>
<html>
<head>
  @include('admin.css')

  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" crossorigin="anonymous"></script>

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
    width: 70%;
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
    @include('admin.sidebar')

    <div class="page-content">
      <div class="page-header">
        <div class="container-fluid">

          <div class="div_center">

            @if(session()->has('message'))
              <div class="alert alert-success">
                {{ session()->get('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
              </div>
            @endif

            <h1 class="cat_label">Add Subcategory</h1>

            <form action="{{ url('store_subcat') }}" method="POST" enctype="multipart/form-data">
              @csrf

              <label>Category</label>
              <select name="sub_category" required>
                <option value="" disabled selected>Select a Category</option>
                @foreach($data as $cat)
                  <option value="{{ $cat->id }}">{{ $cat->cat_title }}</option>
                @endforeach
              </select>

              <label style="margin-left: 20px;">Subcategory Title</label>
              <input type="text" name="sub_title" required>

              <input type="submit" value="Add Subcategory" class="btn btn-info" style="margin-left: 20px;">
            </form>

            <h1 class="cat_label" style="margin-top: 50px;">Existing Subcategories</h1>

            <table class="center">
              <thead>
                <tr>
                  <th>Subcategory Title</th>
                  <th>Parent Category</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($subcategories as $subcat)
                  <tr>
                    <td>{{ $subcat->sub_title }}</td>
                    <td>{{ $subcat->category->cat_title ?? 'N/A' }}</td>
                    <td>
                      <a class="btn btn-info" href="{{ url('edit_subcategory', $subcat->id) }}">Update</a>
                      <a onclick="confirmation(event)" class="btn btn-danger" href="{{ url('delete_subcategory', $subcat->id) }}">Delete</a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>

          </div>

        </div>
      </div>
    </div>
  </div>

  @include('admin.footer')

  <script type="text/javascript">

    function confirmation(ev) {
      ev.preventDefault();
      var urlToRedirect = ev.currentTarget.getAttribute('href');

      swal({
          title: "Are you sure to Delete this",
          text: "You will not be able to revert this!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
      })
      .then((willDelete) => {
          if (willDelete) {
              window.location.href = urlToRedirect;
          }
      });
    }

  </script>

</body>
</html>
