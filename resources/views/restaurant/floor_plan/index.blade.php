@extends('adminlte::page')

@section('title', 'Create Floor Plane')

@section('content')
    <a type="button" class="btn btn-block btn-primary" href="{{route('addFloorPlan',request()->route('id') ?? null)}}">
        Add Floor Plan
    </a>
    <br>

    @if(isset($data))
        @foreach($data as $dat)
            <div class="card">

                <div class="card-body">
                    <h5 class="card-title">
                        {{$dat['hall_name'] ?? null}}
                    </h5>
                    <p class="card-text">
                        {{$dat['description'] ?? null}}
                    </p>
                    <a href="{{route('editFloorPlan',$dat['id'])}}" class="btn btn-primary">
                        <i class="fas fa-edit"></i>
                    </a>
                </div>
            </div>
        @endforeach
    @endif


@endsection
