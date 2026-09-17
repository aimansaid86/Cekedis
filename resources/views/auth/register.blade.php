@extends('layouts.app')

@section('content')

<section class="form-page wrap">
  <div class="form-card">
    <h1 class="display" style="text-transform:none;">Daftar Akaun</h1>
    <form method="POST" action="{{ route('register') }}">
      @csrf
      <div class="field">
        <label>Nama Penuh</label>
        <input required name="name" type="text" value="{{ old('name') }}" autofocus>
        @error('name') <p class="field-error">{{ $message }}</p> @enderror
      </div>
      <div class="field">
        <label>E-mel</label>
        <input required name="email" type="email" value="{{ old('email') }}">
        @error('email') <p class="field-error">{{ $message }}</p> @enderror
      </div>
      <div class="field">
        <label>Nombor Telefon (WhatsApp)</label>
        <input required name="phone" type="text" value="{{ old('phone') }}" placeholder="contoh: 60123456789">
        @error('phone') <p class="field-error">{{ $message }}</p> @enderror
      </div>
      <div class="row2">
        <div class="field">
          <label>Kata Laluan</label>
          <input required name="password" type="password">
          @error('password') <p class="field-error">{{ $message }}</p> @enderror
        </div>
        <div class="field">
          <label>Sahkan Kata Laluan</label>
          <input required name="password_confirmation" type="password">
        </div>
      </div>
      <button class="btn-submit" type="submit">Daftar</button>
    </form>
    <p class="form-footnote">Dah ada akaun? <a href="{{ route('login') }}">Log masuk</a></p>
  </div>
</section>

@endsection
