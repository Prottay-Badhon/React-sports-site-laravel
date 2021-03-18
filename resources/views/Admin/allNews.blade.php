@extends('Admin.adminIndex')
@section('content')
 <div class="container">
                <div class="py-5">
                <table class="table table-striped responsive bg-light">
                    <thead>
                        <tr>

                        <th scope="col">News Id</th>
                        <th scope="col">News Category</th>

                        <th scope="col">News Headlines</th>
                        <th scope="col">Description</th>
                        <th scope="col">News pic</th>
                        <th scope="col">News video </th>

                        <th scope="col">Publication status</th>
                        <th scope="col">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                       @foreach($news as $row)
                        <tr>
                            <td>{{$row->news_id}}</td>
                            <td>{{$row->category_name}}</td>

                            <td>{{$row->headlines}}</td>
                            <td>{{$row->news_description}}</td>
                            <td>
                            <img src="{{$row->news_pic}}" alt="" style="height:200px;width: 200px">
                            </td>

                        <td>
                            <video controls class="" style="height: 200px;width:200px">
                                  <source src="{{$row->news_video}}" type="video/mp4"/>
                                  <source src="{{$row->news_video}}" type="video/ogg"/>
                                Your browser does not support the video tag.
                            </video>
                        </td>
                        <?php
                            $status=$row->publication_status;
                            if($status==null){ ?>
                                <td class="btn btn-danger">In active</td>
                           <?php  }
                                 else{ ?>
                                <td class="btn btn-success">Active</td>
                           <?php } ?>
                        
                        <td>
                            <a href="{{ URL::to('/editNews'.$row->news_id) }}" class="btn btn-success btn-sm">Edit</a>
                            <a href="{{ URL::to('/deleteNews'.$row->news_id) }}" class="btn btn-danger btn-sm">delete</a>
                            
                        </td>
                        </tr>
                       @endforeach
                    </tbody>
                    </table>
                </div>
                </div>
@endsection
