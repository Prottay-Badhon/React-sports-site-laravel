<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class categoryController extends Controller
{

//Api development..............start.................................................
   function allCategoryApi(){
             $result = DB::table('categories')->get();
           return response()->json($result);
         
    }

    function updateCategoryApi(Request $request,$id){
         $data['category_name']=$request->categoryName;
           $data['description']=$request->description;
           $data['publication_status']=$request->publication_status;
            $category =DB::table('categories')->where('id',$id)->update($data);
             return response()->json($category);
       
    }


     function editCategoryApi($id){
        $category =DB::table('categories')->where('id',$id)->first();
        return response()->json($category);
    }

 function addCategoryApi(Request $request){
        $data["category_name"]=$request->category;
        $data["description"]= $request->description;
        $data["publication_status"]= $request->publication_status;

         $success = DB::table('categories')->insert($data);
         if($success){
             return response()->json($success);
         }
    }

function deleteCategoryApi($id){
      $deleteCategory=DB::table('categories')->where('id',$id)->delete();
}
//Api development.......................end...........................................





    function viewCategory(){
        return view('Admin.addCategory');
    }
    function addCategory(Request $request){
    	$data["category_name"]=$request->category;
    	$data["description"]= $request->description;
    	$data["publication_status"]= $request->publication_status;

    	 $success = DB::table('categories')->insert($data);
    	 if($success){
             return redirect()->back();
    	 }
    }

    function allCategory(Request $request){
    	 $result = DB::table('categories')->get();
    	 return view('Admin.allCategory',compact('result'));	
    }

    function deleteCategory($id){
        $deleteCategory=DB::table('categories')->where('id',$id)->delete();
        return redirect()->back();
    }
    function editCategory($id){
        $category =DB::table('categories')->where('id',$id)->first();
        return view('Admin.editCategory',compact('category'));
    }

    function updateCategory(Request $request,$id){
         $data['category_name']=$request->category;
           $data['description']=$request->description;
           $data['publication_status']=$request->publication_status;
            $category =DB::table('categories')->where('id',$id)->update($data);

        return redirect('/allCategory');
    }
}
