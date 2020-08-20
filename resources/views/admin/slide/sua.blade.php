@extends('admin.layout.index');
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Slide
                        <small>Edit</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                @if(session('thongbao'))
                    <div class="alert alert-success">
                        {{session('thongbao')}}
                    </div>
                @endif

                @if(session('loi'))
                    <div class="alert alert-danger">
                        {{session('loi')}}
                    </div>
                @endif
                <div class="col-lg-7" style="padding-bottom:120px">
                    <form action="admin/slide/sua/{{$slide->id}}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <label>Slide Name</label>
                            <input class="form-control" name="Ten" placeholder="Please Enter Category Name" value="{{$slide->Ten}}" />
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" class="form-control" name="Hinh" placeholder="Please Enter Category Order" />
                        </div>
                        <div class="form-group">
                            <label>Content</label>
                            <textarea id="demo" class="ckeditor" rows="6" name="NoiDung" cols="10">{{$slide->NoiDung}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>link</label>
                            <input type="text" class="form-control" name="link" placeholder="Please Enter Link" value="{{$slide->link}}" />
                        </div>
                        <button type="submit" class="btn btn-default">Category Add</button>
                        <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection
