<!DOCTYPE html>
<html>
    <head>
  @include('admin.css')

  <style>
    .div_center{
        text-align: center;
        margin: auto;
    }

    .title_deg{
        color: white;
        padding: 35px;
        font-size: 40px;
        font-weight: bold;
    }

    label{
        display: inline-block;
        width: 200px;
    }

    .div_pad{
        padding: 15px;
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

            @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif


            <div class="div_center">

                <h1 class="title_deg">Add Books</h1>

                <form action="{{url('store_book')}}" method="Post" enctype="multipart/form-data">
                     @csrf

                    <div class="div_pad">
                        <label>Book Title</label>
                        <input type="text" name="book_name">
                    </div>
                     <div class="div_pad">
                        <label>Auther name</label>
                        <input type="text" name="auther_name">
                    </div>
                     <div class="div_pad">
                        <label>Price</label>
                        <input type="text" name="price">
                    </div>
                     <div class="div_pad">
                        <label>Quantity</label>
                        <input type="number" name="quantity">
                    </div>
                      <div class="div_pad">
                        <label>Description</label>
                        <textarea name="description"></textarea>
                    </div>
                   <div class="div_pad">
    <label>Category</label>
    <select name="category" id="category" required>
        <option value="">Select a Category</option>
        @foreach($data as $category)
            <option value="{{ $category->id }}">{{ $category->cat_title }}</option>
        @endforeach
    </select>
</div>

<div class="div_pad">
    <label>Subcategory</label>
    <select name="subcategory" id="subcategory" required>
        <option value="">Select a Subcategory</option>
        <!-- dynamically filled -->
    </select>
</div>


                     <div class="div_pad">
                        <label>Book Image</label>
                        <input type="file" name="book_img">
                    </div>
                     <div class="div_pad">
                        <label>Auther Image</label>
                        <input type="file" name="auther_img">
                    </div>
                   
                     <div class="div_pad">
                       
                        <input type="submit" value="Add Book" class="btn btn-info">
                    </div>


                </form>


            </div>

          </div>
        </div>
        </div>
     
             
    @include('admin.footer')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    $('#category').on('change', function() {
        var categoryId = $(this).val();
        if(categoryId) {
            $.ajax({
                url: '/get-subcategories/' + categoryId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#subcategory').empty();
                    $('#subcategory').append('<option value="">Select a Subcategory</option>');
                    $.each(data, function(key, subcategory) {
                        $('#subcategory').append('<option value="'+subcategory.id+'">'+subcategory.sub_title+'</option>');
                    });
                },
                error: function() {
                    alert('Error fetching subcategories.');
                }
            });
        } else {
            $('#subcategory').empty();
            $('#subcategory').append('<option value="">Select a Subcategory</option>');
        }
    });
});
</script>




 </body>
</html>