<!DOCTYPE html>
<html lang="ms">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $title ?? 'Cekedis — Pasar Barang Second' }}</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Big+Shoulders+Display:wght@600;700;800&family=IBM+Plex+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

<header>
  <div class="header-inner">
    <a class="logo" href="{{ route('home') }}"><span class="dot"></span>Cekedis</a>
    <form class="search-bar" action="{{ route('home') }}" method="GET">
      <input name="q" type="text" value="{{ $q ?? '' }}" placeholder="Cari barang second... contoh: peti sejuk, basikal">
      <button type="submit">Cari</button>
    </form>
    <div class="header-actions">
      @auth
        <a class="btn-sell" href="{{ route('listings.create') }}">+ Jual Barang</a>
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
          @csrf
          <button class="btn-text" type="submit">Log Keluar</button>
        </form>
      @else
        <a class="btn-text" href="{{ route('login') }}">Log Masuk</a>
        <a class="btn-sell" href="{{ route('register') }}">+ Jual Barang</a>
      @endauth
    </div>
  </div>
</header>

@if (session('status'))
  <div class="toast">{{ session('status') }}</div>
@endif

@yield('content')

<footer>
  <div class="wrap">
    <div class="footer-grid">
      <div>
        <div class="logo"><span class="dot"></span>Cekedis</div>
        <p class="lede">Pasar barang second yang mesra, selamat dan mudah — untuk komuniti anda.</p>
      </div>
      <div class="footer-links">
        <div><h5>Cekedis</h5><a href="{{ route('home') }}">Tentang Kami</a><a href="{{ route('home') }}#how">Cara Ia Berfungsi</a><a href="mailto:hello@cekedis.my">Bantuan</a></div>
        <div><h5>Keselamatan</h5><a href="mailto:hello@cekedis.my">Panduan Selamat</a><a href="mailto:hello@cekedis.my">Laporkan Masalah</a></div>
        <div><h5>Hubungi</h5><a href="mailto:hello@cekedis.my">hello@cekedis.my</a></div>
      </div>
    </div>
    <div class="footer-bottom">
      <span>© {{ date('Y') }} Cekedis. Hak cipta terpelihara.</span>
      <span>Dibina dengan mesra untuk pasar tempatan.</span>
    </div>
  </div>
</footer>

</body>
</html>
