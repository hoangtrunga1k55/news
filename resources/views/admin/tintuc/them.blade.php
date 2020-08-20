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
                                @if(session('thongbao'))
                                    <div class="alert alert-success">
                                        {{session('thongbao')}}
                                    </div>
                                @endif

                                @if(session('loi'))
                                    <div class="alert alert-danger">
                                        {{session('loi')}}
                                    </div>
                                @endif           {{$err}}
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
                    <form action="admin/tintuc/them" method="POST" enctype="multipart/form-data">
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
                            <input class="form-control" name="tieude" placeholder="Please Enter Category Name"/>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea id="demo" class="ckeditor" rows="3" name="tomtat"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Content</label>
                            <textarea id="demo1" class="ckeditor" rows="5" name="noidung"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="hinh">
                        </div>
                        <div class="form-group">
                            <label>Category Status</label>
                            <label class="radio-inline">
                                <input name="noibat" value="1" checked="" type="radio">Visible
                            </label>
                            <label class="radio-inline">
                                <input name="noibat" value="0" type="radio">Invisible
                            </label>
                        </div>
                        <button type="submit" class="btn btn-default">Category Add</button>
                        <button type="reset" class="btn btn-default">Reset</button>
                    </form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('#TheLoai').change(function () {
                var idTheLoai = $(this).val();
                $.get("ajax/loaitin/" + idTheLoai, function (data) {
                    $('#LoaiTin').html(data);
                })
            })
        });
    </script>
@endsection
