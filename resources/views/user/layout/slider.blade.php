<div class="container-fluid">
    <div id="slideshow">
        @foreach($upload as $item)
            <img src="./img/{{$item->image_name}}">
        @endforeach
    </div>
</div>
