@extends('layouts.app')

@section('content')

<section class="detail-page wrap">
  <div class="detail-card">
    <a class="back-link" href="{{ route('home') }}">&larr; Kembali ke senarai</a>
    <img class="detail" src="{{ $listing->image_url }}" alt="{{ $listing->title }}">
    <span class="badge {{ $listing->condition_badge_class }}">{{ $listing->condition }}</span>
    <h2 style="margin:10px 0 2px;">{{ $listing->title }}</h2>
    <div class="detail-price">RM{{ number_format($listing->price, 0) }}</div>
    <div class="detail-meta">
      <span>📍 {{ $listing->location }}</span>
      <span>🕒 Disiarkan {{ $listing->created_at->diffForHumans() }}</span>
      <span>🏷️ {{ $listing->category->name }}</span>
    </div>
    <p class="detail-desc">{{ $listing->description }}</p>
    <div class="seller-row">
      <div class="avatar">{{ mb_strtoupper(mb_substr($listing->user->name, 0, 1)) }}</div>
      <div><p class="name">{{ $listing->user->name }}</p><p>Penjual Cekedis</p></div>
    </div>
    @php
      $waNumber = preg_replace('/\D/', '', $listing->user->phone ?? '');
      $waText = rawurlencode("Hai {$listing->user->name}, saya berminat dengan \"{$listing->title}\" di Cekedis.");
    @endphp
    @if ($waNumber)
      <a class="btn-contact" target="_blank" rel="noopener" href="https://wa.me/{{ $waNumber }}?text={{ $waText }}">Hubungi Penjual di WhatsApp</a>
    @endif
  </div>
</section>

@endsection
