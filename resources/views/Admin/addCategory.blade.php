@extends('Admin.adminIndex')
@section('content')
  <div class="container">
                    <form class="p-5" action="{{URL::to('/categoryInserted')}}" method="post">
                        @csrf
                        <div class="form-group">
                        <label class="">Category Name:</label>
                        <input type="text" onChange={this.onChangeHandeler} class="form-control" 
                        name="category" required placeholder="Enter category name"></input>
                        </div>
                        <div class="form-group">
                        <label class="">Category Description:</label>
                        <input type="text" onChange={this.onChangeHandeler} class="form-control" name="description" placeholder="Enter description"></input>
                        </div>
                        
                         <div class="form-group">
                            <input class="form-check-input " type="checkbox"  value="1" id="defaultCheck1" name="publication_status"/>
                            <label class="form-check-label" for="defaultCheck1">
                            publication status
                            </label>
                        </div>
                        <div class="form-group">
                        <input type="submit" class="btn  btn-success" value="Add"></input>
                        </div>
                    </form>
                </div>
@endsection
