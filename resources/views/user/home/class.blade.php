<div class="wapper">
    <div class="title">
        Tất cả các lớp
    </div>
    <div class="container">
        <div class="row">
            @foreach($class as $item)
                <div class="col-sm-6 col-xl-4 col-md-4 mb-4">
                    <div class="product">
                        <div class="product-image-thumb">
                            <img src="./img/1.jpg">
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