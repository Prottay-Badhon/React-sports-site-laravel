<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
class newsController extends Controller
{

 function newsByCategoryApi($id){
   $category = DB::table('categories')->join('news','categories.id','news.category_id')
   ->where('id',$id)
      ->select('categories.*','news.*')->get();
          return response()->json($category);   

 }

   function newsByIdApi($id){
          $news=DB::table('news')->join('categories','news.category_id','categories.id')
      ->where('news_id',$id)
      ->select('categories.*','news.*')->first();
          return response()->json($news);   
    }

  function allNewsApi(){
      $news=DB::table('news')->join('categories','news.category_id','categories.id')
      ->where('news.publication_status',1)
      ->where('categories.publication_status',1)
      ->select('categories.*','news.*')->get();
      return response()->json($news);
    }

      function allNewsApiAdmin(){
      $news=DB::table('news')->join('categories','news.category_id','categories.id')
      ->select('categories.*','news.*')->get();
      return response()->json($news);
    }

    function check(Request $request){
      $image = $request->file('image');
      $video = $request->file('video');

          $imageName=Str::random(10);
        $ext =strtolower($image->getClientOriginalExtension());
        $imgFullName=$imageName.'.'.$ext;
        $uploadPath = "newsPic/";
        $imgUrl = $uploadPath.$imgFullName;
        $success =$image->move($uploadPath,$imgFullName);
        $data['news_pic']=$imgUrl;


        $videoName=Str::random(10);
        $extVid =strtolower($video->getClientOriginalExtension());
        $vidFullName=$videoName.'.'.$extVid;
        $uploadPathVideo = "newsVideo/";
        $videoUrl = $uploadPathVideo.$vidFullName;
        $success =$video->move($uploadPathVideo,$vidFullName);
        $data['news_video']=$videoUrl;


        $insertNews = DB::table('check')->insert($data);
        return response()->json($insertNews);   

    }


function insertNewsApi(Request $request){
  $data =array();
  $data['category_id']=$request->categoryId;
  $data['headlines']=$request->headlines;
  $data['news_description']=$request->description;
  $data['publication_status']=$request->status;

  $image = $request->file('newsPic');
  $video = $request->file('newsVideo');

if($image || $video){
  if($image){
    $imageName=Str::random(10);
    $ext =strtolower($image->getClientOriginalExtension());
    $imgFullName=$imageName.'.'.$ext;
    $uploadPath = "newsPic/";
    $imgUrl = $uploadPath.$imgFullName;
    $success =$image->move($uploadPath,$imgFullName);
    $data['news_pic']=$imgUrl; 
     
  }


  if($video ){
    $videoName=Str::random(10);
    $ext =strtolower($video->getClientOriginalExtension());
    $vidFullName=$videoName.'.'.$ext;
    $uploadPath = "newsVideo/";
    $videoUrl = $uploadPath.$vidFullName;
    $success =$video->move($uploadPath,$vidFullName);
    $data['news_video']=$videoUrl;
  }
  $insertNews = DB::table('news')->insert($data);
  return response()->json($insertNews,200);
   
  }
    else {
      $insertNews = DB::table('news')->insert($data);

     return response()->json($insertNews,200);
      
       }
  }

    function editNewsApi($id){
          $editNews =DB::table('news')->where('news_id',$id)->first();
          return response()->json($editNews);   
    }

 function updateNewsApi(Request $request,$id){
         $data =array();
      $data['headlines']=$request->headlines;
      $data['news_description']=$request->description;
      $data['publication_status']=$request->status;

      $image = $request->file('newsPic');
      $video = $request->file('newsVideo');


      if($image || $video ){
        $imageName=Str::random(10);
        $ext =strtolower($image->getClientOriginalExtension());
        $imgFullName=$imageName.'.'.$ext;
        $uploadPath = "newsPic/";
        $imgUrl = $uploadPath.$imgFullName;
        $success =$image->move($uploadPath,$imgFullName);
        $data['news_pic']=$imgUrl;
       
     
        $videoName=Str::random(10);
        $ext =strtolower($video->getClientOriginalExtension());
        $vidFullName=$videoName.'.'.$ext;
        $uploadPath = "newsVideo/";
        $videoUrl = $uploadPath.$vidFullName;
        $success =$video->move($uploadPath,$vidFullName);
        $data['news_video']=$videoUrl;
         $updateNews =DB::table('news')->where('news_id',$id)->update($data);
    }
    else {
        
         $updateNews =DB::table('news')->where('news_id',$id)->update($data);
          
        }
    }

    function viewNewsForm(){
      $result=DB::table('categories')->get();
      return view('Admin.addNews',compact('result'));
    }


    function insertNews(Request $request){
    	  $data =array();
      $data['category_id']=$request->categoryId;
      $data['headlines']=$request->headlines;
      $data['news_description']=$request->description;
      $data['publication_status']=$request->status;

      $image = $request->file('newsPic');
      $video = $request->file('newsVideo');

if($image || $video){
      if($image){
        $imageName=Str::random(10);
        $ext =strtolower($image->getClientOriginalExtension());
        $imgFullName=$imageName.'.'.$ext;
        $uploadPath = "newsPic/";
        $imgUrl = $uploadPath.$imgFullName;
        $success =$image->move($uploadPath,$imgFullName);
        $data['news_pic']=$imgUrl; 
         
      }


      if($video ){
        $videoName=Str::random(10);
        $ext =strtolower($video->getClientOriginalExtension());
        $vidFullName=$videoName.'.'.$ext;
        $uploadPath = "newsVideo/";
        $videoUrl = $uploadPath.$vidFullName;
        $success =$video->move($uploadPath,$vidFullName);
        $data['news_video']=$videoUrl;
      }
      $insertNews = DB::table('news')->insert($data);
      return redirect()->back();
    }
        else {
          $insertNews = DB::table('news')->insert($data);
         return redirect()->back();
          
        }
    }
    function allNews(){
      $news=DB::table('news')->join('categories','news.category_id','categories.id')->select('categories.*','news.*')->get();
      return view('Admin.allNews',compact('news'));
    }

    function deleteNews($id){
        $deleteNews=DB::table('news')->where('news_id',$id)->delete();
        return redirect()->back();
    }
     function editNews($id){
          $editNews =DB::table('news')->where('news_id',$id)->first();
        return view('Admin.editNews',compact('editNews'));
    }

    function updateNews(Request $request,$id){
         $data =array();
      $data['headlines']=$request->headlines;
      $data['news_description']=$request->description;
      $data['publication_status']=$request->status;

      $image = $request->file('newsPic');
      $video = $request->file('newsVideo');


      if($image || $video ){
        $imageName=Str::random(10);
        $ext =strtolower($image->getClientOriginalExtension());
        $imgFullName=$imageName.'.'.$ext;
        $uploadPath = "newsPic/";
        $imgUrl = $uploadPath.$imgFullName;
        $success =$image->move($uploadPath,$imgFullName);
        $data['news_pic']=$imgUrl;
       
     
        $videoName=Str::random(10);
        $ext =strtolower($video->getClientOriginalExtension());
        $vidFullName=$videoName.'.'.$ext;
        $uploadPath = "newsVideo/";
        $videoUrl = $uploadPath.$vidFullName;
        $success =$video->move($uploadPath,$vidFullName);
        $data['news_video']=$videoUrl;
         $updateNews =DB::table('news')->where('news_id',$id)->update($data);
         return redirect()->back();
    }
    else {
        
         $updateNews =DB::table('news')->where('news_id',$id)->update($data);
         return redirect()->back();
          
        }
    }
}