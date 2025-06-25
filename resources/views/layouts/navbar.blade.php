
<nav class="navbar navbar-light bg-light">
        <div class="ms-5">
        <a href="/article" class="navbar-brand">Article</a>
        </div>
        <div class="mt-3 me-3">
    <form class="d-flex" method="get" action="@yield('action')">
        <input name="judul" class="form-control me-2" value="@yield('value')" type="search" placeholder="Search">
        <button class="btn btn-outline-success" type="submit"  id="submit">cari</button>
    </form>
</div>

<div class="d-flex me-5">

<a href="/article/write" class="btn btn-outline-primary me-2">Write</a>

<a href="{{ url('/logout') }}" class="btn btn-outline-primary me-2">Logout</a>

    </div>

    </nav>
     <div class="container mt-4">
        <div class="row">
            <!-- Article List -->
            <div class="col-md-8">
