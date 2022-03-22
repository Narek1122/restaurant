@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="{{mix ('css/app.css')}}">
@stop


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Kitchen Categories Management</h2>
            </div>
            <div class="pull-right">
                @can('kitchen-cat-create')
                    <button class="btn btn-success" data-toggle="modal" data-target="#createPerm"> Create New
                        Categorie
                    </button>
                @endcan
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($datas as $key => $data)
            <tr>
                <td>{{ $key }}</td>
                <td>
                    <div class="form-group">
                        <input class="form-control" type="text" value="{{ $data->name }}" readonly="true" ondblclick="this.readOnly=!this.readOnly;" onchange="update('{{$data->id}}',this.value)">
                    </div>
                </td>
                <td>

                    @can('kitchen-cat-delete')
                        {!! Form::open(['method' => 'DELETE','route' => ['kitchen_categories.destroy', $data->id],'style'=>'display:inline']) !!}
                        <button class="btn fa-solid fa-trash-can"></button>
                        {!! Form::close() !!}
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>

    {!! $datas->links("pagination::bootstrap-5") !!}




    <div class="modal" id="createPerm">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Category</h4>
                </div>
                <div class="modal-body">
                    <form action="{{route('kitchen_categories.store')}}" method="POST">
                        <div class="form-group">
                            @csrf
                            <input type="text" name="name" value="" class="form-control">
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary">Save</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

@endsection


@section('js')
            <script>
                function update(id,value) {
                    let url = '{{ route("kitchen_categories.edit", ":id") }}';
                    url = url.replace(':id', id);

                    $.ajax({
                        url: url,
                        method: 'get',
                        data: {
                            name: value,
                        },
                        success: function(data){

                            console.log(data);
                        }
                    });
                }
            </script>
@endsection


