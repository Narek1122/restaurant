@extends('adminlte::page')

@section('title', 'Create Restauranat')

@section('content')
       <a type="button" class="btn btn-block btn-primary" href="{{route('createMainRestaurantPage',request()->route('id') ?? null)}}">
          Add {{request()->route('id') ? '' : 'Main'}} Restaurant
       </a>
<br>

@if(isset($data))
@foreach($data as $dat)
<div class="card">
   <a class="btn" href="{{route('editRestaurant',$dat['id'])}}">
      <i class="fas fa-edit"></i>
   </a>
   <div class="row">
      @foreach($dat['images'] as $img)
      <div class="col">
         <img class="card-img-top" src="{{route('getFile',['path' => $img['path'] ?: null])}}" alt="Card image cap" style="width: 100px">
      </div>
      @endforeach
   </div>
    
     <div class="card-body">
       <h5 class="card-title">
            {{$dat['name'] ?? null}}
       </h5>
       <p class="card-text">
          {{$dat['desc'] ?? null}}
       </p>
       <a href="{{route('getRestaurant',$dat['id'])}}" class="btn btn-primary">
       Go somewhere
       </a>
     </div>
   </div>
@endforeach
@endif
   {{$data->links()}}
 
@endsection