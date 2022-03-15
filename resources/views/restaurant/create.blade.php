@extends('adminlte::page')

@section('title', 'Create Restauranat')

@section('content')


    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">
                Add Your {{request()->route('id') ? '' : 'Main'}} Restaurant
            </p>
            <form action="{{route('createRestaurant',request()->route('id'))}}" method="post" enctype="multipart/form-data">
                @csrf
               
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Name" name="name">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        </div>
                    </div>
                </div>
               

                <div class="input-group mb-3">
                    <input type="number" class="form-control" placeholder="Phone Number" name="phone_number">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        </div>
                    </div>
                </div>
                
                <div class="col">
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" rows="3" placeholder="Description ..." name="desc">

                        </textarea>
                    </div>
                </div>
                @if(!request()->route('id'))
                <div class="form-group">
                    <label for="exampleInputFile">Select Restaurant Logo</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="exampleInputFile" name="logo">
                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                        <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                            </div>
                        </div>
                </div>
                @endif
            

                @if(request()->route('id'))
                <input type="text" name="latit" class="latit_inp"  hidden>
                <input type="text" name="longit" class="longit_inp"  hidden>
                <div class="row form-group">
                     @foreach($days as $day)
                <div class="col-3">
                <label>{{$day->day}}</label>
                <input type="time" class="form-control" name="{{$day->id . '_start'}}">
                <input type="time" class="form-control" name="{{$day->id . '_end'}}">
                </div> 
                @endforeach
                <br>
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Select Images</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="exampleInputFile" name="images[]" multiple>
                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                        <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                            </div>
                        </div>
                </div>
                <div class="col">
                  <div id="map" class="map"></div>  
                </div>
                @endif
                

                

                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">SAVE</button>
                    </div>

                </div>
            </form>
        </div>

    </div>
    </div>
@endsection

@section('css')
    <style>
        .map {
        height: 400px;
        width: 100%;
      }
    </style>
@stop

@section('js')
@if(request()->route('id'))
        <script src="{{mix ('js/app.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.13.0/build/ol.js"></script>
        <script src="https://unpkg.com/ol-geocoder"></script>
    <script type="text/javascript">
         var map = new ol.Map({
        target: 'map',
        layers: [
          new ol.layer.Tile({
            source: new ol.source.OSM()
          })
        ],
        view: new ol.View({
          center: ol.proj.fromLonLat([37.41, 8.82]),
          zoom: 4
        })
      });

      1


    map.on('click', function(evt) {
        let coords = ol.proj.toLonLat(evt.coordinate);
        let lat = coords[1];
        let lon = coords[0];
        $('.latit_inp').val(lat)
        $('.longit_inp').val(lon)
        console.log(lon);
        
    }); 




    </script>
@endif    
@endsection