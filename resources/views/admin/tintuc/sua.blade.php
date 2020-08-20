@extends('admin.layout.index')
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Category
                        <small>Add</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    @if(count($errors) >0)
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $err)
                                {{$err}}
                                <br>
                            @endforeach
                        </div>
                    @endif
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
                    <form action="admin/tintuc/sua/{{$tt->id}}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <label>Category Parent</label>
                            <select class="form-control" name="TheLoai" id="TheLoai">
                                @foreach($theloai as $tl)
                                    <option value="{{$tl->id}}">{{$tl->Ten}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Type of Category</label>
                            <select class="form-control" name="loaitin" id="LoaiTin">
                                @foreach($loaitin as $lt)
                                    <option value="{{$lt->id}}">{{$lt->Ten}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <input class="form-control" name="tieude" placeholder="Please Enter Category Name" value="{{$tt->TieuDe}}"/>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea id="demo" class="ckeditor" rows="3" name="tomtat" >{{$tt->TomTat}}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Content</label>
                            <textarea id="demo1" class="ckeditor" rows="5" name="noidung">{{$tt->NoiDung}}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="hinh" value="{{$tt->Hinh}}">
                        </div>
                        <div class="form-group">
                            <label>Category Status</label>
                            <label class="radio-inline">
                                <input name="noibat" value="{{$tt->NoiBat}}" checked="" type="radio">Visible
                            </label>
                            <label class="radio-inline">
                                <input name="noibat" value="{$tt->NoiBat}}" type="radio">Invisible
                            </label>
                        </div>
                        <button type="submit" class="btn btn-default">Category Add</button>
                        <button type="reset" class="btn btn-default">Reset</button>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Category
                        <small>Add</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    @if(count($errors) >0)
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $err)
                                {{$err}}
                                <br>
                            @endforeach
                        </div>
                    @endif
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
                    <form action="admin/tintuc/sua/{{$tt->id}}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <label>Category Parent</label>
                            <select class="form-control" name="TheLoai" id="TheLoai">
                                @foreach($theloai as $tl)
                                    <option value="{{$tl->id}}">{{$tl->Ten}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Type of Category</label>
                            <select class="form-control" name="loaitin" id="LoaiTin">
                                @foreach($loaitin as $lt)
                                    <option value="{{$lt->id}}">{{$lt->Ten}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <input class="form-control" name="tieude" placeholder="Please Enter Category Name" value="{{$tt->TieuDe}}"/>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea id="demo" class="ckeditor" rows="3" name="tomtat" >{{$tt->TomTat}}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Content</label>
                            <textarea id="demo1" class="ckeditor" rows="5" name="noidung">{{$tt->NoiDung}}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="hinh" value="{{$tt->Hinh}}">
                        </div>
                        <div class="form-group">
                            <label>Category Status</label>
                            <label class="radio-inline">
                                <input name="noibat" value="{{$tt->NoiBat}}" checked="" type="radio">Visible
                            </label>
                            <label class="radio-inline">
                                <input name="noibat" value="{$tt->NoiBat}}" type="radio">Invisible
                            </label>
                        </div>
                        <button type="submit" class="btn btn-default">Category Add</button>
                        <button type="reset" class="btn btn-default">Reset</button>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Category
                        <small>List</small>
                    </h1>
                </div>
                @if(session('thongbao'))
                    <div class="alert alert-success">
                        {{session('thongbao')}}
                    </div>
            @endif
            <!-- /.col-lg-12 -->
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>User</th>
                        <th>New</th>
                        <th>Content</th>
                        <th>Create At</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tt->comment as $cm)
                        <tr class="odd gradeX" align="center">
                            <td>{{$cm->id}}</td>
                            <td>{{$cm->idUser}}</td>
                            <td>{{$cm->idTinTuc}}</td>
                            <td>{{$cm->NoiDung}}</td>
                            <td>{{$cm->createAt}}</td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/comment/xoa/{{$cm->id}}/{{$tt->id}}"> Delete</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function (){
            $('#TheLoai').change(function (){
                var  idTheLoai = $(this).val();
                $.get("ajax/loaitin/"+idTheLoai,function (data){
                    $('#LoaiTin').html(data);
                })
            })
        });
    </script>
@endsection
