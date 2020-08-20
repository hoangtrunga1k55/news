@extends('layout.index')
@section('content')
@endsection
<!-- Page Content -->
<div class="container">
    <div class="row">

        <!-- Blog Post Content Column -->
        <div class="col-lg-9">

            <!-- Blog Post -->

            <!-- Title -->
            <h1>{{$tintuc->TieuDe}}</h1>

            <!-- Author -->
            <p class="lead">
                by <a href="#">Start Bootstrap</a>
            </p>

            <!-- Preview Image -->
            <img class="img-responsive" src="{{asset('tintuc/'.$tintuc->Hinh)}}" alt="">

            <!-- Date/Time -->
            <p><span class="glyphicon glyphicon-time"></span> Posted on {{$tintuc->create_at}}</p>
            <hr>

            <!-- Post Content -->
{{--            <p class="lead">{!!$tintuc->NoiDung!!}</p>--}}

            <hr>

            <!-- Blog Comments -->

            <!-- Comments Form -->
            @if(\Illuminate\Support\Facades\Auth::check())
            <div class="well">
                @if(session('thongbao'))
                    <div class="alert alert-success">
                    {{session('thongbao')}}
                    </div>
                @endif
                <h4>Viết bình luận ...<span class="glyphicon glyphicon-pencil"></span></h4>
                <form role="form" action="comment/{{$tintuc->id}}" method="POST">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-group">
                        <textarea name="NoiDung" class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Gửi</button>
                </form>
            </div>
            @endif
            <hr>

            <!-- Posted Comments -->
            @foreach($tintuc->comment as $cm)
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">{{$cm->user->Ten}}
                        <small>{{$cm->creatAt}}</small>
                    </h4>
                    {{$cm->NoiDung}}
                </div>
            </div>
            @endforeach
        </div>

        <!-- Blog Sidebar Widgets Column -->
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading"><b>Tin liên quan</b></div>
                <div class="panel-body">
                    <!-- item -->
                    @foreach($tinLq as $lq)
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-5">
                            <a href="tintuc/{{$lq->id}}/{{$lq->TieuDeKhongDau}}.html">
                                <img class="img-responsive" src="{{asset('tintuc/'.$lq->Hinh)}}" alt="">
                            </a>
                        </div>
                        <div class="col-md-7">
                            <a href="#"><b>{!! $lq->NoiDung !!}</b></a>
                        </div>
                        <p STYLE="padding-left: 5px">{!! $lq->TomTat !!}</p>
                        <div class="break"></div>
                    </div>
                @endforeach
                    <!-- end item -->

            </div>
            <div class="panel panel-default">
                <div class="panel-heading"><b>Tin nổi bật</b></div>
                <div class="panel-body">

                    <!-- item -->
                    @foreach($tinNB as $nb)
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-5">
                            <a href="tintuc/{{$nb->id}}/{{$nb->TieuDeKhongDau}}.html">
                                <img class="img-responsive" src="{{asset('tintuc/'.$nb->Hinh)}}" alt="">
                            </a>
                        </div>
                        <div class="col-md-7">
                            <a href="#"><b>{!!$nb->NoiDung !!} </b></a>
                        </div>
                        <p STYLE="padding-left: 5px">{!! $nb->TomTat  !!}</p>
                        <div class="break"></div>
                    </div>
                @endforeach
                    <!-- end item -->
                </div>
            </div>

        </div>

    </div>
    <!-- /.row -->
</div>
<!-- end Page Content -->
