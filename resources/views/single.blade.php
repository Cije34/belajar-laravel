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

                    {{-- <div class="d-flex align-items-center mb-3">
                        <img src="https://via.placeholder.com/40" class="rounded-circle me-2" alt="Author">
                        <div>
                            <strong>Daniel Scott</strong><br>
                            <small class="text-muted">May 23, 2025 • 4 min read</small>
                        </div>
                    </div> --}}

                    <hr>
                    <p class="mt-5">
                        {{ $article->content }}
                    </p>
                    <!-- You can add a list of concepts here -->

                    <p class="mt-4">{{$article->updated_at}}</p>
                </article>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
@endsection
