<!DOCTYPE html>
<html>
    <head>
  @include('admin.css')

  <style type="text/css">

   .div_center{
    text-align: center;
    margin: auto;
  }

  .title{
    color: white;
    padding: 30px;
    font-size: 30px;
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

          <div class="div_center">

            <h1 class="title">Update book</h1>

            <form action="{{url('update_book',$data->id)}}" method="Post" enctype="multipart/form-data">
                @csrf
                <div class="div_pad">
                    <label>Book Title</label>
                    <input type="text" name="title" value="{{$data->title}}">

                </div>
                            <div class="div_pad" >
                    <label>Auther Name</label>
                    <input type="text" name="auther_name" value="{{$data->auther_name}}">

                </div>
                            <div class="div_pad">
                    <label>Price</label>
                    <input type="text" name="price" value="{{$data->price}}">

                </div>
                            <div class="div_pad">
                    <label>Quantity</label>
                    <input type="text" name="quantity" value="{{$data->quantity}}">

                </div>
                            <div class="div_pad">
                    <label>Description</label>
                    <textarea name="description">{{$data->description}}</textarea>

                </div>
                            <div class="div_pad">
        <label>Category</label>
        <select name="category" id="category_select" required>
            <option value="{{ $data->category_id }}">{{ $data->category->cat_title }}</option>
            @foreach($category as $cat)
                @if($cat->id != $data->category_id)
                    <option value="{{ $cat->id }}">{{ $cat->cat_title }}</option>
                @endif
            @endforeach
        </select>
    </div>

    <div class="div_pad">
        <label>Subcategory</label>
        <select name="subcategory" id="subcategory_select" required>
            <option value="{{ $data->subcategory_id }}">{{ $data->subcategory->sub_title }}</option>
            @foreach($subcategories as $subcat)
                @if($subcat->id != $data->subcategory_id)
                    <option value="{{ $subcat->id }}">{{ $subcat->sub_title }}</option>
                @endif
            @endforeach
        </select>
    </div>

                            <div class="div_pad">

                                <label>Current Auther Image</label>
                                <img style="width: 80px; border-radius: 50%; margin: auto;" src="/auther/{{$data->auther_img}}">
                            </div>

                            <div class="div_pad">
                                <label>Change Auther Image</label>
                                <input type="file" name="auther_img">

                            </div>


                              <div class="div_pad">

                                <label>Current Book Image</label>
                                <img style="width: 80px; margin: auto; " src="/book/{{$data->book_img}}">
                            </div>

                             <div class="div_pad">
                                <label>Chnage Book Image</label>
                                <input type="file" name="book_img">

                            </div>

                            <div class="div_pad">
                               <input class="btn btn-info" type="submit" value="Update Book">
                            </div>

                            


                            </div>
         

            </form>

          </div>


          </div>
        </div>
      </div>
             
    @include('admin.footer')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function(){
    $('#category_select').change(function(){
        var category_id = $(this).val();

        $.ajax({
            url: '/get-subcategories/' + category_id,
            type: 'GET',
            success: function(subcategories) {
                $('#subcategory_select').empty();

                // Add a default "Select Subcategory" option
                $('#subcategory_select').append('<option value="">Select Subcategory</option>');

                $.each(subcategories, function(index, subcat){
                    $('#subcategory_select').append('<option value="'+subcat.id+'">'+subcat.sub_title+'</option>');
                });
            }
        });
    });
});
</script>




 </body>
</html>