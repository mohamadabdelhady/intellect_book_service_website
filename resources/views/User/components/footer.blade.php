<div class="ml-4 mr-4">
<hr>
<div class="row">
    <div class="" style="min-width: 100%"></div>
<div class="col-6">
    <p class="h4">book genera</p>
    <ul>
         @foreach($categories as $category)
            <li><a href="{{ route('get-genera', ['genera' => $category->id]) }}">{{$category->name}}</a></li>
        @endforeach
    </ul>
</div>

    <div class="col-6">
        <p class="h4">About this site</p>
        <ul>
            <li><a href="about">About us</a></li>
            <li><a href="contact">contact us</a></li>
            <li>Our social media accounts</li>
            <ul>
                <li><a><i class="fab fa-facebook"></i></a></li>
                <li><a><i class="fab fa-twitter"></i></a></li>
            </ul>
        </ul>
    </div>
<div class="mt-1 ml-3"><hr>All copyright reserved for intellect book service&copy; 2022</div>
</div>
</div>
