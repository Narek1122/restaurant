@extends('adminlte::page')

@section('title', 'Create Restauranat')

@section('content')


    <div class="card">
     @if($data->parent)
     <div class="row">
          <div class="col-6">
               <a class="btn btn-block btn-primary" href="{{route('restMenu',request()->route('id'))}}">
                    Add Menu
               </a>
          </div>
          <div class="col-6">
               <a class="btn btn-block btn-primary" href="{{route('floorPlan',request()->route('id'))}}">
                   Floor Plan
               </a>
          </div>
     </div>
     @endif
        <div class="card-body login-card-body">
          <form action="{{route('editRestaurantData',request()->route('id'))}}" method="post" enctype="multipart/form-data" name="some2">
               @csrf
               @method('put')

               @if(isset($data->parent->mainImage))
               <div class="row">
                    <div class="col form-group">
                         <label for="">Logo</label>
                         <br>
                         <img class="img-responsive" src="{{route('getFile',['path' => $data->parent->mainImage['path'] ?: null])}}" alt="Photo" width="100px">
                    </div>
               </div>
               @endif

               @if(isset($data->parent))
               <div class="form-group">
                    <label >Parent Name</label>
                    <input type="text" class="form-control"  value="{{$data->parent['name'] ?? null}}" disabled>
               </div>

               @endif

               <div class="form-group">
                    <label >Name</label>
                    <input type="text" class="form-control"  placeholder="Enter name" value="{{$data['name'] ?? null}}" name="name">
               </div>

               <div class="form-group">
                    <label >Phone Number</label>
                    <input type="number" class="form-control"  placeholder="Enter Phone" value="{{$data['phone_number'] ?? null}}" name="phone_number">
               </div>

               <div class="form-group">
                    <label>Textarea</label>
                    <textarea class="form-control" rows="3" placeholder="Enter ..." name="desc">
                         {{$data['desc'] ?? null}}
                    </textarea>
               </div>

               @if(isset($data->parent))
               <div class="row">
                    @foreach($days as $num => $day)
                    <div class="col-3">
                    <label>{{$day->day}}</label>
                    <input type="time" class="form-control" name="{{$day->id . '_start'}}"
                    value="{{$data->days[$num]['start'] ?? null}}"
                    >
                    <input type="time" class="form-control" name="{{$day->id . '_end'}}"
                    value="{{$data->days[$num]['end'] ?? null}}"
                    >
                    </div>
                    @endforeach
               </div>
               @endif
               <br>
               @if(isset($data->images))
               <div class="row">
                    @foreach($data->images as $num => $dat)
                    <div class="col-3">
                         <div class="image_container">
                              <div class="top-right">
                                        <input class="delete_image{{$num}}" type="text" hidden name="delete_image[]">
                                        <button class="btn" type="button" onclick="deleted('{{$num}}','{{$dat['path']}}')">
                                             <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                              </div>
                              <img class="img-responsive" src="{{route('getFile',['path' => $dat['path'] ?: null])}}" alt="Photo" width="100%">

                         </div>
                    </div>
                    @endforeach
               </div>
               @endif

               <br>

               @if(!isset($data->parent))
               <div class="form-group">
                    <label for="exampleInputFile">Select Logo</label>
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

               @if(isset($data->parent))
               <input type="text" name="latit" class="latit_inp"  hidden>
                <input type="text" name="longit" class="longit_inp"  hidden>
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
               <br>
               <div class="col">
                    <div id="map" class="map"></div>
               </div>
               @endif
               <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">SAVE</button>
                    </div>
          </form>
          </div>
     </div>
@endsection


@section('css')
    <style>
        .map {
        height: 400px;
        width: 100%;
      }
      .image_container{
          position: relative;
          text-align: center;
          color: white;
          width: 200px;

          }
          .top-right {
          position: absolute;
          top: 8px;
          right: 16px;
          }
      }
    </style>
@stop

@section('js')

<script>
     function deleted(id,path){
          let inp = $('.delete_image' + id)
          inp.val(path)

     }
</script>
@if($data->parent)
        <script src="{{mix ('js/app.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.13.0/build/ol.js"></script>
        <script src="https://unpkg.com/ol-geocoder"></script>
    <script type="text/javascript">
          let latitD = "{{$data['latit'] ?? 37.41}}"
          let longitD = "{{$data['latit'] ?? 8.82}}"
         var map = new ol.Map({
        target: 'map',
        layers: [
          new ol.layer.Tile({
            source: new ol.source.OSM()
          })
        ],
        view: new ol.View({
          center: ol.proj.fromLonLat([latitD, longitD]),
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


    });




    </script>
@endif
@endsection
