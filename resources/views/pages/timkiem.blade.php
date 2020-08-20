@extends('layout.index')
@section('content')
@endsection
<div class="container">
    <div class="row">
        @include('layout.menu')
        <?php
        function doimau($str,$tukhoa){
           return str_replace($tukhoa,"<span style='color:red;'>$tukhoa</span>",$str);
        }
        ?>
        <div class="col-md-9 ">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color:#337AB7; color:white;">
                    <h4><b>Tim Kiem:{!!doimau($tukhoa,$tukhoa)!!}</b></h4>
                </div>
                @foreach($tintuc as $tt)
                    <div class="row-item row">
                        <div class="col-md-3">
                            <a href="tintuc/{{$tt['id']}}/{{$tt['TieuDeKhongDau']}}.html">
                                <br>
                                <img width="200px" height="200px" class="img-responsive" src="{{asset('tintuc/'.$tt->Hinh)}}" alt="content">
                            </a>
                        </div>
                        <div class="col-md-9">
                            <h3>{!!doimau($tt->TieuDe,$tukhoa)!!}</h3>
                            <p>{!!doimau($tt->TomTat,$tukhoa)!!}</p>
                            <a class="btn btn-primary" href="tintuc/{{$tt['id']}}/{{$tt['TieuDeKhongDau']}}.html">Show more <span class="glyphicon glyphicon-chevron-right"></span></a>
                        </div>
                        <div class="break"></div>
                    </div>
            @endforeach

            {{$tintuc->links()}}
            <!-- Pagination -->
            {{--                <div class="row text-center">--}}
            {{--                    <div class="col-lg-12">--}}
            {{--                        <ul class="pagination">--}}
            {{--                            <li>--}}
            {{--                                <a href="#">&laquo;</a>--}}
            {{--                            </li>--}}
            {{--                            <li class="active">--}}
            {{--                                <a href="#">1</a>--}}
            {{--                            </li>--}}
            {{--                            <li>--}}
            {{--                                <a href="#">2</a>--}}
            {{--                            </li>--}}
            {{--                            <li>--}}
            {{--                                <a href="#">3</a>--}}
            {{--                            </li>--}}
            {{--                            <li>--}}
            {{--                                <a href="#">4</a>--}}
            {{--                            </li>--}}
            {{--                            <li>--}}
            {{--                                <a href="#">5</a>--}}
            {{--                            </li>--}}
            {{--                            <li>--}}
            {{--                                <a href="#">&raquo;</a>--}}
            {{--                            </li>--}}
            {{--                        </ul>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            <!-- /.row -->

            </div>
        </div>

    </div>

</div>
