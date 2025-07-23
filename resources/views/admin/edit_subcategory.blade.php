<!DOCTYPE html>
<html>
<head>
  @include('admin.css')

  <style type="text/css">
    .div_deg {
        text-align: center;
        margin: auto;
    }

    .title_deg {
        color: white;
        padding: 40px;
        font-size: 30px;
        font-weight: bold;
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

          <div class="div_deg">

            @if(session()->has('message'))
              <div class="alert alert-success">
                {{ session()->get('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
              </div>
            @endif

            <h2 class="title_deg">Update Subcategory</h2>

            <form action="{{ url('update_subcategory', $subcategory->id) }}" method="POST">
              @csrf

              <div class="mb-3">
                <label>Main Category</label>
                <select name="category_id" class="form-control" required style="width: 300px; margin: auto;">
                  @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $subcategory->category_id == $cat->id ? 'selected' : '' }}>
                      {{ $cat->cat_title }}
                    </option>
                  @endforeach
                </select>
              </div>

              <div class="mb-3">
                <label>Subcategory Title</label>
                <input type="text" name="sub_title" class="form-control" value="{{ $subcategory->sub_title }}" required style="width: 300px; margin: auto;">
              </div>

              <input type="submit" class="btn btn-info mt-3" value="Update Subcategory">

            </form>

          </div>

        </div>
      </div>
    </div>
  </div>

  @include('admin.footer')
</body>
</html>
