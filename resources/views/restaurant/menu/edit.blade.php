@extends('adminlte::page')

@section('title', 'Create Restauranat')

@section('content')
    <div class="card" >
        <form action="{{route('restMenuUpdate',$data['id'])}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
        <div class="card-body">
            <img class="card-img-top" src="{{route('getFile',['path' => $data['img']])}}" alt="Card image cap" height="200px">
            <div class="form-group">
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="img">
                        <label class="custom-file-label" for="exampleInputFile">Choose Image</label>
                    </div>
                </div>
            </div>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <div class="form-group">
                    <label>Category</label>
                    <select class="form-control" name="category_id">
                        @if($categories)
                            @foreach($categories as $category)
                                <option value="{{$category['id']}}" @if($category['id'] == $data['category_id']) selected @endif>
                                    {{$category['name']}}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </li>
            <li class="list-group-item">
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" class="form-control" id="" name="name" value="{{$data['name']}}">
                </div>
            </li>
            <li class="list-group-item">
                <div class="form-group">
                    <label for="">Price</label>
                    <input pattern="^\d*(\.\d{0,2})?$" class="form-control" id="" name="price" value="{{$data['price']}}">
                </div>
            </li>
            <li class="list-group-item">
                <div class="form-group">
                    <label for="">Sale Price</label>
                    <input pattern="^\d*(\.\d{0,2})?$" class="form-control" id="" name="sale_price" value="{{$data['sale_price']}}">
                </div>
            </li>
            <li class="list-group-item">
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" rows="3" placeholder="Enter ...">
                        {{$data['desc']}}
                    </textarea>
                </div>
            </li>
        </ul>
        <div class="card-body">
            <button class="btn btn-primary">
                Save
            </button>
        </div>
        </form>
    </div>

@endsection
