@extends('adminlte::page')

@section('title', 'Edit Floor Plan')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-header card-header-primary card-header-text">
                            <div class="card-text">
                                <h4 class="card-title">Edit Floor Plan</h4>
                            </div>
                        </div>
                        {{-- --------form-------------- --}}
                        <form class="mt-5 send" enctype="multipart/form-data">
                            @csrf

                            <div class="card-body ">
                                <div class="row d-flex flex-wrap card-cont">
                                    <div class="w-50">
                                        <div class="tbl-div" style="background-image: url({{route('getFile',['path' => $data['img']])}}); background-repeat: no-repeat; background-size: cover">
                                            <table id="table" class="tbl">
                                                @for($y=0;$y<$data['table_y'];$y++)
                                                <tr id="id-{{$y}}" class="some-class">
                                                    @for($x=0;$x<$data['table_x'];$x++)
                                                    <td class='some-td ui-droppable' data-x={{$x}} data-y={{$y}}
                                                        style="width: {{500/$data->table_x}}px; height: {{500/$data->table_y}}px">
                                                        @foreach(json_decode($data['data_json'],true) as $item)
                                                            @if (isset($item['y']) && isset($item['x']) && $y==$item['y'] && $x==$item['x'])
                                                                <div class="ui-widget-content ui-corner-tr mr-4 ui-draggable ui-draggable-handle">
                                                                    <div class="w-100 text-right x px-3">x</div>
                                                                    <img src="{{route('getFile',['path' => 'public/restaurant/images-tables/' . $item['img']])}}" class="img-table" data-name="{{$item['img']}}" style="width: 60%;">
                                                                    <input class="form-control quantity-chair text-center" type="number" name="mm-2" placeholder="quantity chair" required="true" aria-required="true" aria-invalid="true"
                                                                           value="{{$item['quantity_chair']}}">
                                                                </div>
                                                                @endif
                                                        @endforeach
                                                    </td>
                                                    @endfor
                                                </tr>
                                                @endfor
                                            </table>
                                        </div>
                                    </div>
                                    <div class="w-50">
                                        <div class="form-group bmd-form-group has-danger">
                                            <label class=" d-flex align-items-center " for="imageUpload"><span> floor plan image</span><span
                                                    class="material-icons">
                                                   upload_file
                                                    </span>
                                            </label>
                                            <input class="form-control img" id="imageUpload" type="file" name="img">
                                        </div>
                                        <div class="d-flex">
                                            {{-- ---------table x--------------------- --}}
                                            <div class="form-group mr-3 bmd-form-group ">
                                                <label class=" bmd-label-floating ">width</label>
                                                <input class="form-control width xy" type="number" name="table_x"
                                                       required="true" aria-required="true" aria-invalid="true"
                                                       value="{{$data->table_x}}">
                                            </div>
                                            {{-- ------------table y---------------------- --}}
                                            <div class="form-group mr-3 bmd-form-group ">
                                                <label class="bmd-label-floating ">Height</label>
                                                <input class="form-control height xy" type="number" name="table_y"
                                                       required="true" aria-required="true" aria-invalid="true"
                                                       value="{{$data->table_y}}">
                                            </div>
                                            <div>
                                                <div class="create-tbl btn btn-primary">create froor plane</div>
                                            </div>
                                        </div>
                                        {{-- ----------------------tables images-------------------------------- --}}
                                        <div id="gallery"
                                             class=" my-5 d-flex flex-wrap gallery ui-helper-reset ui-helper-clearfix">
                                            <div class="ui-widget-content ui-corner-tr mr-4 ">
                                                <img
                                                    src={{ route('getFile',['path' => 'public/restaurant/images-tables/3.png'])}} class="img-table"
                                                    data-name='3.png'>
                                            </div>
                                            <div class="ui-widget-content ui-corner-tr mr-4">
                                                <img
                                                    src={{ route('getFile',['path' => 'public/restaurant/images-tables/4.png'])}} class="img-table"
                                                    data-name='4.png'>
                                            </div>
                                            <div class="ui-widget-content ui-corner-tr mr-4">
                                                <img
                                                    src={{ route('getFile',['path' => 'public/restaurant/images-tables/6.png'])}} class="img-table"
                                                    data-name='6.png'>
                                            </div>
                                            <div class="ui-widget-content ui-corner-tr mr-4">
                                                <img
                                                    src={{ route('getFile',['path' => 'public/restaurant/images-tables/8.png'])}} class="img-table"
                                                    data-name='8.png'>
                                            </div>
                                        </div>
                                        {{-- -----------Hall name---------------- --}}
                                        <div class="form-group mr-3 bmd-form-group mt-5">
                                            <label class=" bmd-label-floating">Hall name</label>
                                            <input class="form-control hall-name" type="text" name="hall_name"
                                                   required="true" aria-required="true" aria-invalid="true"
                                                   value="{{$data->hall_name}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        {{-- ------------description----------------------- --}}
                                        <div class="form-group mr-3 bmd-form-group mt-5">
                                            <label class=" bmd-label-floating">Description</label>
                                            <textarea class="form-control desc" name="description" required="true"
                                                      aria-required="true" aria-invalid="true">
                                            {{$data->description}}
                                        </textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- ----------card footer---------------- --}}
                            <div class="card-footer ml-auto mr-auto ">
                                <div class="message mt-2 mx-5"></div>
                                <input type="hidden" value="9" name="restaurnt_id" id="restaurant_id">
                                <input type="hidden" name="data_json" value="" id="arr-tbl">
                                <input type="hidden" name="hidden_url" value="{{route('updateFloorPlanData',request()->route('id'))}}" id="hidden-url">
                                <input type="hidden" name="hidden_background_url" value="{{$data
->background_img}}">
                                <input type="submit" name="" value="Edit floor plane" class=" btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection


@section('css')
    <link rel="stylesheet" href="{{ asset('css/floor-plan/create-floor-plan.css') }}">
@stop

@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script src="{{ asset('js/floor-plan/drag-drop.js') }}"></script>
    <script src="{{ asset('js/floor-plan/script.js') }}"></script>
    <script src="{{ asset('js/floor-plan/edit.js') }}"></script>
@endsection
