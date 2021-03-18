@extends('Admin.adminIndex')
@section('content')
   <div class="container">
                    <form class="p-5" action="{{URL::to('/uploadNews')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                        <label class="">Category Name:</label>
                        <select class="form-control form-control-sm" id="exampleFormControlSelect1" name="categoryId">
                            @foreach($result as $row)
                             <option value="{{$row->id}}">{{$row->category_name}}</option>
                             @endforeach
                         </select>
                        </div>

                        <div class="form-group">
                        <label class="">News Headlines:</label>
                        <textarea class="form-control" name="headlines" rows="4"></textarea>
                        </div>

                        <div class="form-group">
                        <label class="">News Description:</label>
                        <textarea class="form-control" name="description"   rows="10"></textarea>
                        </div>
                        
                        <div class="form-group">
                        <label for="exampleFormControlInput1">News Pic</label>
                        <input type="file" name="newsPic" class="" id="exampleFormControlInput1" placeholder="">
                        </div>

                         <div class="form-group">
                        <label for="exampleFormControlInput1">News Video</label>
                        <input type="file" name="newsVideo"  id="exampleFormControlInput1" placeholder="">
                        </div>

                             <div class="form-group">
                            <input class="form-check-input " type="checkbox" value="1" id="defaultCheck1" name="status"/>
                            <label class="form-check-label" for="defaultCheck1">
                            publication status
                            </label>
                        </div>
                        <div class="form-group">
                        <input type="submit" class="btn  btn-success" value="Add News"></input>
                        </div>
                       
                    </form>
                </div>
@endsection
