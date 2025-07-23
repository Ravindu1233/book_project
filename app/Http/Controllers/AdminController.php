<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use App\Models\Book;

use App\Models\SubCategory;


use Illuminate\Support\Facades\Auth;

use App\Models\Category;
use PhpParser\Node\Expr\FuncCall;

class AdminController extends Controller
{
    public function index()
    {
        if(Auth::id()){

            $user_type = Auth()->user()->usertype;

            if($user_type == 'admin'){
                
                return view('admin.index');
            }

            else if ($user_type == 'user'){

                return view ('home.index');
            }
        }

        else
        {
            return redirect()->back();
        }
    }

    public function category_page()
    {
        //$data = Category::all();
        $data = Category::with('subcategories')->get();

        return view('admin.category', compact('data'));
    }

public function add_category(Request $request)
{
    

    $data = new Category;
    $data->cat_title = $request->category;
    $data->save();

    return redirect()->back()->with('message','Category Added Successfully');
}

public function cat_delete($id)
{
    $category = Category::find($id);

    if (!$category) {
        return redirect()->back()->with('error', 'Category not found.');
    }

   
   if ($category->subcategories()->count() > 0 || $category->books()->count() > 0) {
    return redirect()->back()->with('error', 'Cannot delete this category because it has related subcategories or books.');
}


    $category->delete();

    return redirect()->back()->with('message', 'Category deleted successfully.');
}



  public function edit_category($id)
  {

    $data = Category::find($id);

    return view('admin.edit_category', compact('data'));
  }

  public function update_category(Request $request, $id)
  {
    $data = Category::find($id);
    $data->cat_title = $request->cat_name;
    $data->save();
    return redirect('/category_page')->with('message','Category Updated Successfully');
  }

<<<<<<< HEAD
 public function add_book()
{
    $data = Category::with('subcategories')->get(); // now includes subcategories
=======
    public function images()
{
    return $this->hasMany(Image::class);
}


  public function add_book()
  {
    $data = Category::all();
>>>>>>> 736d65632cc3b4f46edf5747e27f30faf68da1ab
    return view('admin.add_book', compact('data'));
}


  public function store_book(Request $request)
  {
    $data = new Book;

    $data->title = $request->book_name;

    $data->auther_name = $request->auther_name;

    $data->price = $request->price;

    $data->quantity = $request->quantity;

    $data->description = $request->description;

    $data->category_id = $request->category;

    $data->subcategory_id = $request->subcategory;


    $book_image = $request->book_img;

    $auther_image = $request->auther_img;
     
    if($book_image)
    {
        $book_image_name = time().'.'.$book_image->getClientOriginalExtension();

        $request->book_img->move('book',$book_image_name);

        $data->book_img = $book_image_name;
    }

     if($auther_image)
    {
        $auther_image_name = time().'.'.$auther_image->getClientOriginalExtension();

        $request->auther_img->move('auther',$auther_image_name);

        $data->auther_img = $auther_image_name;
    }

    $data->save();

     return redirect()->back()->with('success', 'Book added successfully!');



  }

  public function show_book()
{
    $book = Book::with(['category', 'subcategory'])->get();
    return view('admin.show_book', compact('book'));
}


  public function book_delete($id)
  {
    $data = Book::find($id);

    $data->delete();

    return redirect()->back()->with('message','Book Deleted Successfully');
  }

  public function edit_book($id)
{
    $data = Book::find($id);
    $category = Category::all();
    $subcategories = SubCategory::all(); 

    return view('admin.edit_book', compact('data', 'category', 'subcategories'));
}


  public function update_book(Request $request, $id)
  {
    $data = Book::find($id);

     $data->title = $request->title;

    $data->auther_name = $request->auther_name;

    $data->price = $request->price;

    $data->quantity = $request->quantity;

    $data->description = $request->description;

    $data->category_id = $request->category;

     $data->subcategory_id = $request->subcategory; 

    $book_image = $request->book_img;

    $auther_image = $request->auther_img;
     
    if($book_image)
    {
        $book_image_name = time().'.'.$book_image->getClientOriginalExtension();

        $request->book_img->move('book',$book_image_name);

        $data->book_img = $book_image_name;
    }

     if($auther_image)
    {
        $auther_image_name = time().'.'.$auther_image->getClientOriginalExtension();

        $request->auther_img->move('auther',$auther_image_name);

        $data->auther_img = $auther_image_name;
    }

      $data->save();

      return redirect('/show_book')->with('message', 'Book Updated succesfully');




  }

  public function subcat_page()
  {

    $data = Category::all();

     $subcategories = SubCategory::with('category')->get();

    return view('admin.supcat', compact('data','subcategories'));
  }


  public function store_subcat(Request $request)
  {
      $data = new SubCategory();
    $data->sub_title = $request->sub_title;

  
    $data->category_id = $request->sub_category;

    $data->save();

    return redirect()->back()->with('message', 'Subcategory added successfully!');
  }

    public function getSubcategories($category_id)
    {
        $subcategories = SubCategory::where('category_id', $category_id)->get();

        return response()->json($subcategories);
    }

  
public function edit_subcategory($id)
{
    $subcategory = Subcategory::find($id);
    $categories = Category::all();
    return view('admin.edit_subcategory', compact('subcategory', 'categories'));
}


public function update_subcategory(Request $request, $id)
{
    $subcategory = Subcategory::find($id);
    $subcategory->sub_title = $request->sub_title;
    $subcategory->category_id = $request->category_id;
    $subcategory->save();

    return redirect('/subcat_page')->with('message', 'Subcategory Updated Successfully');
}

public function delete_subcategory($id)
{
    $subcategory = SubCategory::find($id);

    if (!$subcategory) {
        return redirect()->back()->with('error', 'Subcategory not found.');
    }

    if ($subcategory->books()->count() > 0) {
        return redirect()->back()->with('error', 'Cannot delete this subcategory because it has related books.');
    }

    $subcategory->delete();

    return redirect()->back()->with('message', 'Subcategory deleted successfully.');
}







}
