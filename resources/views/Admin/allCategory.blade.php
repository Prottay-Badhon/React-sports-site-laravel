@extends('Admin.adminIndex')
@section('content')
 <div class="container">
                <div class="p-5">
                <table class="table table-striped responsive" width="700px">
                    <thead>
                        <tr>

                        <th scope="col">Category Id</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Publication status</th>
                        <th scope="col">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                       @foreach($result as $row)
                        <tr>
                            <td>{{$row->id}}</td>
                            <td>{{$row->category_name}}</td>
                            <td>{{$row->description}}</td>
                            
                            <?php
                            $status=$row->publication_status;
                            if($status==null){ ?>
                                <td class="btn btn-danger">In active</td>
                           <?php  }
                                 else{ ?>
                                <td class="btn btn-success">Active</td>
                           <?php } ?>
                        
                        <td>
                            <a href="{{URL::to('/editCategory'.$row->id)}}" class="btn btn-success btn-sm">Edit</a> 
                            <a href="{{URL::to('/deleteCategory'.$row->id)}}" class="btn btn-danger btn-sm">delete</a>
                            
                        </td>
                        </tr>
                       @endforeach
                    </tbody>
                    </table>
                </div>
                </div>
@endsection
