@extends('layouts.app')

@section('title')
Single
@endsection

@section('content')
        <body class="bg-light">

        @extends('layouts.navbar')

        @section('action')
        {{ url('/article?judul='.$judul.'') }}
        @endsection

        @section('value')
        {{ $judul }}
        @endsection

    <!-- Main Content -->
    <div class="container mt-5">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 mb-4">
                <div class="p-3 bg-white shadow-sm rounded">
                    <h5>Kunjungi Github saya di</h5>
                    <p class="small text-muted">
                        <a href="https://github.com/Cije34/">https://github.com/Cije34/</a>
                    </p>
                    <a href="https://github.com/Cije34/" class="btn btn-primary btn-sm">Follow</a>
                </div>
            </div>

            <!-- Article Content -->
            <div class="mb-5 col-md-9">
                <article class="bg-white p-4 rounded shadow-sm">
                    <h1 class="mb-3">{{$article->judul}}</h1>

                    <div class="d-flex align-items-center mb-3">
                        <img src="https://via.placeholder.com/40" class="rounded-circle me-2" alt="Author">
                        <div>
                            <strong>Daniel Scott</strong><br>
                            <small class="text-muted">May 23, 2025 • 4 min read</small>
                        </div>
                    </div>

                    @if($article->image)
                    <img src="{{ asset('storage/'.$article->image->url) }}" class="img-fluid mb-3" alt="Article Image">
                    @endif


                    <hr>
                    <p class="mt-5">
                        {{ $article->content }}
                    </p>

                    <div class="mt-4">
                        <h6>Tags:</h6>
                        @foreach ($article->tags as $tag)
                            <div>
                                #{{$tag->name}}
                            </div>
                        @endforeach
                    </div>
                    <!-- You can add a list of concepts here -->

                    <p class="mt-4">{{$article->updated_at}}</p>
                </article>
            </div>
        </div>
    </div>

    <!-- Display Comments -->
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="bg-white p-4 rounded shadow-sm">
                    <h5 class="mb-4">Comments</h5>
                    @if($article->comments->isEmpty())
                        <p class="text-muted">No comments yet. Be the first to comment!</p>
                    @else
                        @foreach($article->comments as $comment)
                            <div class="mb-3 border-bottom pb-2">
                                <strong>{{ $comment->user->name ?? 'Anonymous' }}</strong>
                                <span class="text-muted small ms-2">{{ $comment->created_at }}</span>
                                <p class="mb-1 mt-2">{{ $comment->body }}</p>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Comments Section -->
    @if (session('success'))
    <div class="alert alert-success text-center mt-3" role="alert">
        {{ session('success') }}
    </div>
    @endif

    <div class="container mt-5 border p-4 rounded">
        <form action="{{url('/article/comment/'.$article->id)}}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Your Comment</label>
                <input type="hidden" name="article_id" value="{{$article->id}}">
                <textarea class="form-control" name="body" rows="3" placeholder="Write a comment..."></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Comment</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
@endsection
