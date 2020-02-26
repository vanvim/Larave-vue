@extends('user.layout.master')
@section('title')Các khóa học  @endsection
@section('content')
    {{--tất cả các khoa học--}}
    @include('user.home.course',['courses' => $courses])
    {{--kết thúc tất cả các lớp --}}
@endsection
@section('script')
    <script type="text/javascript" src="./js/student_comment.js"></script>
    <script type="text/javascript" src="./js/slide.js"></script>
    <script type="text/javascript" src="./js/profile_teacher.js"></script>
@endsection

