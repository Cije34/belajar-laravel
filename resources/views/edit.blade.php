@extends('layouts.app')

@section('title')
    Edit
@endsection

@section('content')

    <nav class="navbar navbar-light bg-light">
        <div class="ms-5">
            <a href="/article" class="navbar-brand">Article</a>
        </div>
        <div class="mt-3 me-3">
            <form class="d-flex" method="get" action="@yield('action')">
                <input name="judul" class="form-control me-2" value="@yield('value')" type="search" placeholder="Search">
                <button class="btn btn-outline-success" type="submit" id="submit">cari</button>
            </form>
        </div>

        <div class="d-flex me-5">

            <a class="btn btn-outline-primary me-2 bg-success text-white" id="saveButton">Save</a>

            <a href="{{ url('/logout') }}" class="btn btn-outline-primary me-2">Logout</a>

        </div>
    </nav>

    <style>
        body {
            background-color: #f8f9fa; /* Memberi sedikit warna latar belakang agar form putih menonjol */
        }

        /* Menghilangkan border, shadow, dan mengubah ukuran font pada input Judul */
        .title-input {
            border: 0;
            box-shadow: none !important; /* !important untuk menimpa style focus bootstrap */
            font-size: 2.5rem; /* Ukuran font besar seperti H1 */
            font-weight: 600;
            padding-left: 0;
        }

        /* Menghilangkan border, shadow, dan resize handle pada textarea */
        .story-input {
                border: 0;
                box-shadow: none !important;
                resize: none;
                font-size: 1.1rem;
                line-height: 1.6;
                padding-left: 0;
                min-height: 60vh; /* <- DIUBAH MENJADI LEBIH BESAR & RESPONSIF */
                min-width: 74vh;
        }

        /* Memberi gaya pada icon '+' */
        .add-icon {
            font-size: 1.5rem;
            color: #adb5bd; /* Warna abu-abu muted */
            cursor: pointer;
            transition: transform 0.2s;
        }

        .add-icon:hover {
            color: #212529; /* Warna hitam saat di-hover */
            transform: rotate(90deg);
        }
    </style>

    {{-- java Script --}}

    <script>
        document.addEventListener('DOMContentLoaded',function(){
            const saveButton = document.getElementById('saveButton');
            const articleForm = document.getElementById('articleForm');

            if (saveButton && articleForm) {
            saveButton.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the default action of the <a> tag
                articleForm.submit(); // Submit the form
            });
        }
        });
    </script>

    {{-- body --}}
    <main class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <form action="{{ url('/article/update/'.$article->id.'') }}" method="POST" id="articleForm" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <input type="text" class="form-control title-input" id="judul" name="judul" placeholder="Title" value="{{ $article->judul }}">
                    </div>

                    <div class="d-flex align-items-start mt-4">
                        <i class="bi bi-plus-circle add-icon me-2 mt-1"></i>

                        <textarea class="story-input" class="form-control" id="content" name="content" placeholder="Tell your story...">{{$article->content}}</textarea>
                    </div>

                    <div class="mb-3 mt-4">
                        <label for="image" class="form-label">Upload Image</label>
                        <input class="form-control" type="file" id="image" name="image" accept="image/*" value="{{ $article->image ? asset('storage/' . $article->image->url) : '' }}">
                        @if($article->image)
                            <div class="mt-3">
                                <img src="{{ asset('storage/' . $article->image->url) }}" alt="Current Image" style="max-width: 200px; max-height: 200px;">
                            </div>
                        @endif
                    </div>

                    <label class="form-label">Tags</label>

                    <div class="mb-3">

                        @foreach ($tag as $key => $tags)
                            <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="tag{{$key}}" name="tags[]" value="{{ $tags->id }}"

                            @if ($article->tags->contains($tags->id))
                                checked
                            @endif

                            >
                            <label class="form-check-label" for="tag{{$key}}">{{ $tags->name }}</label>
                        </div>

                        @endforeach


                    </div>

                </form>
            </div>
        </div>
    </main>
@endsection
