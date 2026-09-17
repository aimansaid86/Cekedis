@extends('layouts.app')

@section('content')

<section class="hero">
  <div class="wrap hero-grid">
    <div>
      <h1 class="display">Barang lama,<br><span>cerita baru.</span></h1>
      <p class="lede">Cekedis ialah pasar barang second dari jiran ke jiran. Jual apa yang tak dipakai, cari apa yang anda perlukan — semuanya di harga yang berbaloi.</p>
      <div class="hero-ctas">
        <a class="btn-primary" href="#listings">Mula Cari Barang</a>
        <a class="btn-ghost" href="{{ auth()->check() ? route('listings.create') : route('register') }}">Jual Barang Anda</a>
      </div>
      <div class="hero-stats">
        <div class="stat"><b>{{ $totalListings }}</b><span>barang disenaraikan</span></div>
        <div class="stat"><b>{{ $totalUsers }}</b><span>pengguna aktif</span></div>
        <div class="stat"><b>RM2.1j</b><span>dijimatkan pembeli</span></div>
      </div>
    </div>
    <div class="hero-visual">
      <div class="price-tag">
        <span class="cond">Seperti Baru</span>
        <img src="https://picsum.photos/seed/cekedis-fridge/320/200" alt="">
        <h3>Peti Sejuk 2 Pintu</h3>
        <div class="price">RM480</div>
      </div>
      <div class="price-tag price-tag-2">
        <span class="cond" style="background:var(--mustard);color:var(--ink);">Baik</span>
        <img src="https://picsum.photos/seed/cekedis-bike/320/200" alt="">
        <h3 style="font-size:15px;">Basikal Gunung</h3>
        <div class="price" style="font-size:22px;">RM230</div>
      </div>
    </div>
  </div>
</section>

<nav class="cats">
  <div class="wrap cats-row">
    <a class="cat-pill {{ $activeCat === 'Semua' ? 'active' : '' }}" href="{{ route('home', ['q' => $q]) }}">Semua</a>
    @foreach ($categories as $category)
      <a class="cat-pill {{ $activeCat === $category->name ? 'active' : '' }}" href="{{ route('home', ['cat' => $category->name, 'q' => $q]) }}">{{ $category->name }}</a>
    @endforeach
  </div>
</nav>

<section class="listings wrap" id="listings">
  <div class="section-head">
    <h2 class="display" style="text-transform:none;">Terkini di Cekedis</h2>
    <span>{{ $listings->count() }} barang dijumpai</span>
  </div>
  <div class="grid">
    @forelse ($listings as $listing)
      <a class="card" href="{{ route('listings.show', $listing) }}">
        <img src="{{ $listing->image_url }}" alt="{{ $listing->title }}">
        <div class="card-body">
          <span class="badge {{ $listing->condition_badge_class }}">{{ $listing->condition }}</span>
          <h4>{{ $listing->title }}</h4>
          <div class="price">RM{{ number_format($listing->price, 0) }}</div>
          <div class="meta"><span>{{ $listing->location }}</span><span>{{ $listing->created_at->diffForHumans() }}</span></div>
        </div>
      </a>
    @empty
      <div class="empty" style="grid-column:1/-1;">Tiada barang dijumpai. Cuba kata kunci atau kategori lain.</div>
    @endforelse
  </div>
</section>

<section class="how wrap" id="how">
  <h2 class="display" style="text-transform:none;">Cara ia berfungsi</h2>
  <div class="how-grid">
    <div class="how-step"><span class="n">01</span><h4>Siarkan barang</h4><p>Ambil gambar, letak harga, tulis penerangan ringkas. Siap dalam masa 2 minit.</p></div>
    <div class="how-step"><span class="n">02</span><h4>Berbual dengan pembeli</h4><p>Jawab soalan terus melalui WhatsApp, tanpa perantara.</p></div>
    <div class="how-step"><span class="n">03</span><h4>Serah & terima</h4><p>Janji temu selamat dekat kawasan anda, tukar barang dengan tunai atau e-wallet.</p></div>
  </div>
</section>

@endsection
