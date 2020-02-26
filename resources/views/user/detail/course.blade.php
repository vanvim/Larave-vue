@extends('user.layout.master')
@section('title')Các khóa học  @endsection
@section('content')
    <div class="container-fluid">
        {{$courses}}
        @include('user.home.class',['class' => $class])
    </div>
@endsection
@section('script')
    <script type="text/javascript" src="./js/student_comment.js"></script>
    <script type="text/javascript" src="./js/slide.js"></script>
    <script type="text/javascript" src="./js/profile_teacher.js"></script>
@endsection

