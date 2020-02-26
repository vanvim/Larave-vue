@extends('user.layout.master')
@section('title')Quản lý khoá học @endsection
@section('slider')
{{--    các khóa học--}}
    @include('user.layout.slider',['upload' => $upload])
{{--    kết thúc các khóa học--}}
@endsection

@section('content')
{{--tất cả các khóa học--}}
@include('user.home.course',['courses' => $courses])
{{--kết thúc tất cả các khóa học --}}

{{--    các lớp học đang giảm giá--}}
<div class="wapper" style=" background:#fff0aa; padding: 20px; margin: 10px">
    <div class="title">
        Các lớp học đang giảm giá
    </div>
    <div class="container">
        <div class="row">
            @foreach($class as $item)
                <div class="col-sm-6 col-xl-4 col-md-4 mb-4">
                    <div class="product">
                        <div class="product-image-thumb">
                            <img src="./img/2.jpg">
                        </div>
                        <div class="name">
                            <h2>{{$item->name}}</h2>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
        <div class="all">
            <a href=""> Xem tất cả <i class="fa fa-arrow-right"></i></a>
        </div>
    </div>

</div>
{{--kết thúc các lớp học đang giảm giá--}}

{{--thông tin giảng viên--}}
@include('user.home.teacher')
{{--kết thúc thông tin giảng viên--}}

{{--tất cả các lớp học--}}
@include('user.home.class',['class' => $class])
{{--kết thúc tất cả các lớp --}}

{{--nhận xét của các học viên--}}
@include('user.home.comment_student')
{{--    kết thúc nhận xét--}}

@endsection
@section('script')
    <script type="text/javascript" src="./js/student_comment.js"></script>
    <script type="text/javascript" src="./js/slide.js"></script>
    <script type="text/javascript" src="./js/profile_teacher.js"></script>
@endsection

