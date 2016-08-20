@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">List User</div>

                   <table class="table table-bordered" id="users-table">
                <thead>
                <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Edit</th>
                <th>Delete</th>
                </tr>
                <?php $count =0?>
                @foreach($data_user as $data)
                <?php $count++?>
                <tr>
                <th>{!! $count!!}</th>
                <th>{!! $data['name']!!}</th>
                <th>{!!$data['email']!!}</th>
                <th><a href="edit/{!!$data['id']!!}"><img src="{!!asset('/templates/images/edit.png')!!} " ></a></th>
                <th><a href="delete/{!!$data['id']!!}"><img src="{!!asset('/templates/images/delete.png')!!}"></a></th>
                </tr>
                @endforeach
            </thead>
    </table>
            </div>
        </div>
    </div>
</div>
@endsection
