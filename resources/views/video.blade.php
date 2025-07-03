@extends('layouts.app')

@section('title')
    Article
@endsection


@section('content')
    @extends('layouts.navbar')
@section('value')

@endsection

@if (session('success'))
    <div class="alert alert-success text-center mt-3" role="alert">
        {{ session('success') }}
    </div>
@endif

@foreach ($videos as $video)
    <a href="{{ url('/video/show/' . $video->id) }}" class="text-decoration-none text-dark">
        <!-- Main Content -->
        <!-- Video Card 1 -->
        <div class="video-card d-flex mt-5">
            <div class="flex-grow-1">
                <h2 class="video-title">{{ $video->title }}</h2>
                <p>{{ $video->description }}</p>
                <div class="video-meta">
                    <span class="star">★</span>
                    <span>{{ $video->updated_at }}</span>

                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <a href="video/edit/{{ $video->id }}" class="btn btn-sm me-2 border" style="background: transparent; color: #000;">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>
                        <a href="video/delete/{{ $video->id }}" class="btn btn-sm btn-danger">
                            <i class="bi bi-trash"></i> Delete
                        </a>
                    </div>
                    </div>

                </div>

    </a>
@endforeach
</div>
</div>
</div>

<div class="page-item disabled">
    <div class="pagination justify-content-center">
        {{ $videos->links() }}
    </div>
</div>
@endsection
