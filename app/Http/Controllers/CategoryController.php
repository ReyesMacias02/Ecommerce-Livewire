<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

class CategoryController extends Controller
{
 /**
  * The function "show" in PHP displays a view for a given category.
  * 
  * @param Category category The parameter "category" is of type "Category". It is being passed to the
  * "show" function.
  * 
  * @return a view called 'categories.show' and passing the 'category' variable to the view.
  */
    public function show(Category $category){
        return view('categories.show', compact('category'));
    }
}
