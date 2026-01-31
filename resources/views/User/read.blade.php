@include('User.footer')

<div class="container">
    <div class="" id="main_div">
        <div id="app">
        <read_book :file_path="{{json_encode( $book->file_path)}}":name="{{json_encode($book->name)}}" :book_id="{{json_encode($book->id)}}"></read_book>
        </div>
    </div>
</div>
@endsection