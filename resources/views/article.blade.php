
@extends('layouts.app')

@section('title')
Article
@endsection


@section('content')

@extends('layouts.navbar')
@section('value')
{{ $judul }}
@endsection

    @foreach ($article as $articles)
        <a href="{{ url('/article/'.$articles->id.'/full') }}" class="text-decoration-none text-dark">
         <!-- Main Content -->
                    <!-- Article Card 1 -->
                <div class="article-card d-flex mt-5">
                    <div class="flex-grow-1">
                        <h2 class="article-title">{{$articles->judul}}</h2>
                        <p>{{$articles->content}}</p>
                        <div class="article-meta">
                            <span class="star">★</span>
                            <span>{{$articles->updated_at}}</span>
                             </div>
                             </div>
                    <div class="ms-3">

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
