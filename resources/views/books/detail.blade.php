@extends("layouts.app")
@section("content")

<div class="container">
    @if(Session::has('message'))
    <p class="alert alert-info">{{ Session::get('message') }}</p>
    @endif

    <div class="card"> <div class="card-body">
        <h5 class="card-title">{{ $book->name }}</h5> <div class="card-subtitle mb-2 text-muted small">
        {{ $book->created_at->diffForHumans() }}
        </div>
        <p class="card-text">{{ $book->description }}</p>
        <a class="btn btn-info" href="/books"> Back </a>
        @if($book->author == Auth::user()->name)
       <p class="float-right"> Cannot review your own post</p>
        @else
        <a class="btn btn-danger float-right" onclick="fun('{{$book->name}}','{{$book->id}}')" id='review_id'data-toggle="modal" data-target="reviewModal"> Review </a>
        @endif

    </div>
    <div>
        Average rating is {{$avg}}
    </div>

</div>

@foreach($book->reviews as $review)
<div class="container mt-5">
    <div class="d-flex justify-content-center row">
        <div class="col-md-12">
            <div class="d-flex flex-column comment-section">
                <div class="bg-white p-2">
                    <div class="float-right">
                        <h5 class="text-primary">your support rating is {{$review->rating}} stars</h5>
                    </div>
                    <div class="d-flex flex-row user-info"><img class="rounded-circle" src="https://i.imgur.com/RpzrMR2.jpg" width="40">
                        <div class="d-flex flex-column justify-content-start ml-2"><span class="d-block font-weight-bold name">{{$review->user->name}}</span><span class="date text-black-50">{{ $review->created_at->diffForHumans() }}</span></div>
                    </div>
                    <div class="mt-2">
                        <p class="comment-text">
                            {{ $review->description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach


<!-- Modal -->
<div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Make Review</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form>

                <input type="hidden" id="book-id">
                <div class="form-group">
                    <input type="text" class="form-control" id="book-name">
                </div>

                <div>
                    <input type="checkbox" class="test" value="5" id="5">
                    <label for="5">☆</label>
                    <input type="checkbox" class="test" value="4" id="4">
                    <label for="4">☆</label>
                    <input type="checkbox" class="test" value="3" id="3">
                    <label for="3">☆</label>
                    <input type="checkbox" class="test" value="2" id="2">
                    <label for="2">☆</label>
                    <input type="checkbox" class="test" value="1" id="1">
                    <label for="1">☆</label>
                </div>



                <div class="form-group">
                    <input type="text" class="form-control" id="book-review">
                </div>

                <div class="row btn-sm justify-content-end no-gutters">
                      <button type="button" class="btn btn-secondary mr-3" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary" onclick="makeReview(event)">Post</button>
                </div>
            </form>

        </div>

      </div>
    </div>
  </div>

@endsection



@section("script")

  <script>
      function fun(name,id){
        $('#book-name').val(name);
        $('#book-id').val(id);
        $('#reviewModal').modal('show');
      };
      function makeReview(e){
        e.preventDefault();
        var rate = $('.test:checked').length
        var book_id =  $('#book-id').val();
        var review =  $('#book-review').val();

        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });


        $.ajax({
            type:'POST',
            url:'/reviews',
            data:{
                rating:rate,
                book_id:book_id,
                review:review,
            },

            success:function(response){
                console.log("good to go");
                location.reload(true);

            },
            error:function(response){

            }
        });
        $('#reviewModal').modal('hide');
      }
  </script>

@endsection






