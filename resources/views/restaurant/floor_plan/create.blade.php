@extends('adminlte::page')

@section('title', 'Create Restauranat')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                            <div class="card-header card-header-primary card-header-text">
                                <div class="card-text">
                                    <h4 class="card-title">Create Floor Plan</h4>
                                </div>
                            </div>
                            {{-- --------form-------------- --}}
                            <form class="mt-5 send" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body ">
                                    <div class="row d-flex flex-wrap card-cont">
                                        <div class="w-50">
                                            <div class="tbl-div">
                                                <table id="table" class="tbl"> </table>
                                            </div>
                                        </div>
                                        <div class="w-50">
                                            {{-- ------------------form group for upload_img----------------------- --}}
                                            <div class="form-group bmd-form-group has-danger">
                                                <label class=" d-flex align-items-center " for="imageUpload"><span> floor plan image</span><span class="material-icons">
                                                   upload_file
                                                    </span>
                                                </label>
                                                <input class="form-control img" id="imageUpload" type="file" name="img" required="true" aria-required="true" aria-invalid="true">
                                            </div>
                                            <div class="d-flex">
                                                {{-- ---------table x--------------------- --}}
                                                <div class="form-group mr-3 bmd-form-group ">
                                                    <label class=" bmd-label-floating ">width</label>
                                                    <input class="form-control width xy" type="number" name="table_x" required="true" aria-required="true" aria-invalid="true">
                                                </div>
                                                {{-- ------------table y---------------------- --}}
                                                <div class="form-group mr-3 bmd-form-group ">
                                                    <label class="bmd-label-floating ">Height</label>
                                                    <input class="form-control height xy" type="number" name="table_y" required="true" aria-required="true" aria-invalid="true">
                                                </div>
                                                <div>
                                                    <div class="create-tbl btn btn-primary">create froor plane</div>
                                                </div>
                                            </div>
                                            {{-- ----------------------tables images-------------------------------- --}}
                                            <div id="gallery" class=" my-5 d-flex flex-wrap gallery ui-helper-reset ui-helper-clearfix">
                                                <div class="ui-widget-content ui-corner-tr mr-4 ">
                                                    <img src={{ route('getFile',['path' => 'public/restaurant/images-tables/3.png'])}} class="img-table" data-name='3.png'>
                                                </div>
                                                <div class="ui-widget-content ui-corner-tr mr-4">
                                                    <img src={{ route('getFile',['path' => 'public/restaurant/images-tables/4.png'])}} class="img-table" data-name='4.png'>
                                                </div>
                                                <div class="ui-widget-content ui-corner-tr mr-4">
                                                    <img src={{ route('getFile',['path' => 'public/restaurant/images-tables/6.png'])}} class="img-table" data-name='6.png'>
                                                </div>
                                                <div class="ui-widget-content ui-corner-tr mr-4">
                                                    <img src={{ route('getFile',['path' => 'public/restaurant/images-tables/8.png'])}} class="img-table" data-name='8.png'>
                                                </div>
                                            </div>
                                            {{-- -----------Hall name---------------- --}}
                                            <div class="form-group mr-3 bmd-form-group mt-5">
                                                <label class=" bmd-label-floating">Hall name</label>
                                                <input class="form-control hall-name" type="text" name="hall_name" required="true" aria-required="true" aria-invalid="true">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            {{-- ------------description----------------------- --}}
                                            <div class="form-group mr-3 bmd-form-group mt-5">
                                                <label class=" bmd-label-floating">Description</label>
                                                <textarea class="form-control desc"  name="description" required="true" aria-required="true" aria-invalid="true"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- ----------card footer---------------- --}}
                                <div class="card-footer ml-auto mr-auto ">
                                    <div class="message mt-2 mx-5"></div>
                                    <!-- <input type="hidden" value="10" name="restaurant_id" id="restaurant_id"> -->
                                    <input type="hidden" name="data_json" value="" id="arr-tbl">
                                    <input type="hidden" name="hidden_url" value="{{route('createFloorPlanData',request()->route('id'))}}" id="hidden-url">

                                    {{-- <button type="submit" class="btn btn-rose">Create11<div class="ripple-container"></div></button> --}}
                                    <input type="submit" name="" value="Send floor plane" class=" btn btn-primary">

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
@endsection
@section('js')
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{ asset('js/floor-plan/drag-drop.js') }}"></script>
    <script src="{{ asset('js/floor-plan/script.js') }}"></script>
@endsection
