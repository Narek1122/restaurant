@extends('adminlte::page')

@section('title', 'Create Restauranat')

@section('content')


    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">
                Add Your Restaurant
            </p>
            <form action="login.html" method="post">
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

                <div class="col-sm-3">

                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" rows="3" placeholder="Description ..." name="desc">

                        </textarea>
                    </div>
                </div>

                <div id="map">
                    <p>Карта Москвы</p>
                    <div id="first_map" style="width:400px; height:300px"></div>
                    <p>Карта Санкт-Петербурга</p>
                    <p style="width:400px; height:200px"></p>
                </div>

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


@section('js')

    <script type="text/javascript">
        var moscow_map,
            piter_map;

        ymaps.ready(function(){
            moscow_map = new ymaps.Map("first_map", {
                center: [55.76, 37.64],
                zoom: 10
            });
            piter_map = new ymaps.Map(document.getElementsByTagName('p')[2], {
                center: [59.94, 30.32],
                zoom: 9
            });
        });
    </script>
@endsection
