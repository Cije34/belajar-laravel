@extends('layouts.app')

@section('title')
    Article
@endsection


@section('content')
    @extends('layouts.navbar')
@section('value')
    {{ $judul }}
@endsection

@if (session('success'))
    <div class="alert alert-success text-center mt-3" role="alert">
        {{ session('success') }}
    </div>
@endif

@foreach ($article as $articles)
    <a href="{{ url('/article/' . $articles->id . '/full') }}" class="text-decoration-none text-dark">
        <!-- Main Content -->
        <!-- Article Card 1 -->
        <div class="article-card d-flex mt-5">
            <div class="flex-grow-1">
                <h2 class="article-title">{{ $articles->judul }}</h2>
                <p>{{ $articles->content }}</p>
                <div class="article-meta">
                    <span class="star">★</span>
                    <span>{{ $articles->updated_at }}</span>

                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        @can('update', $articles)
                            <a href="article/edit/{{ $articles->id }}" class="btn btn-sm me-2 border" style="background: transparent; color: #000;">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                        @endcan
                        @can('delete', $articles)
                            <a href="article/delete/{{ $articles->id }}" class="btn btn-sm btn-danger">
                                <i class="bi bi-trash"></i> Delete
                            </a>
                        @endcan
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
        {{ $article->links() }}
    </div>
</div>
@endsection
