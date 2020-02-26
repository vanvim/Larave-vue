<div class="wapper" style="margin-top: 300px;">
    <div class="title">
        Tất cả khóa lớp
    </div>
    <div class="container">
        <div class="row">
            @foreach($courses as $course)
                <div class="col-sm-6 col-xl-4 col-md-4 mb-4">
                    <div class="product">
                        <div class="product-image-thumb">
                            <a href="{{ route('khoa_hoc',['name'=>str_slug($course->name), 'id'=>$course->id]) }}">
                                <img src="./img/1.jpg">
                            </a>

                        </div>
                        <div class="name">
                            <a href="{{ route('khoa_hoc',['name'=>str_slug($course->name), 'id'=>$course->id]) }}">
                                <h2>{{$course->name}}</h2>
                            </a>

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