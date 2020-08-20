@extends('admin.layout.index');
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">User
                        <small>Edit</small>
                    </h1>
                </div>
                @if(count($errors) >0)
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $err)
                            {{$err}}<br>
                        @endforeach
                    </div>
                @endif
                @if(session('loi'))
                    <div class="alert alert-danger">
                        {{session('loi')}}
                    </div>
                @endif
                @if(session('thongbao'))
                    <div class="alert alert-success">
                        {{session('thongbao')}}
                    </div>
            @endif

            <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    <form action="admin/user/sua/{{$user->id}}" method="POST">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <label>Name</label>
                            <input class="form-control" name="name" placeholder="Please Enter Category Name" value="{{$user->name}}"/>
                        </div>
                        <div class="form-group">
                            <label>email</label>
                            <input type="email" class="form-control" name="email" placeholder="Please Enter email " value="{{$user->email}}" />
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Please Enter PassWord" />
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="passwordAgain" placeholder="Please Enter PassWord Again" />
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <label class="radio-inline">
                                <input name="quyen" value="1" type="radio">Admin
                            </label>
                            <label class="radio-inline">
                                <input name="quyen" value="0" type="radio">Normal
                            </label>
                        </div>
                        <button type="submit" class="btn btn-default">Edit User</button>
                        <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection
