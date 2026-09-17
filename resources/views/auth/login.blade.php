@extends('layouts.app')

@section('content')

<section class="form-page wrap">
  <div class="form-card">
    <h1 class="display" style="text-transform:none;">Log Masuk</h1>
    <form method="POST" action="{{ route('login') }}">
      @csrf
      <div class="field">
        <label>E-mel</label>
        <input required name="email" type="email" value="{{ old('email') }}" autofocus>
        @error('email') <p class="field-error">{{ $message }}</p> @enderror
      </div>
      <div class="field">
        <label>Kata Laluan</label>
        <input required name="password" type="password">
      </div>
      <button class="btn-submit" type="submit">Log Masuk</button>
    </form>
    <p class="form-footnote">Belum ada akaun? <a href="{{ route('register') }}">Daftar di sini</a></p>
  </div>
</section>

@endsection
