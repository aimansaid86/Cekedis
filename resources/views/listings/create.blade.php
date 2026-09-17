@extends('layouts.app')

@section('content')

<section class="form-page wrap">
  <div class="form-card">
    <h1 class="display" style="text-transform:none;">Jual Barang</h1>
    <form method="POST" action="{{ route('listings.store') }}" enctype="multipart/form-data">
      @csrf
      <div class="field">
        <label>Tajuk Barang</label>
        <input required name="title" type="text" value="{{ old('title') }}" placeholder="contoh: Meja Belajar Kayu">
        @error('title') <p class="field-error">{{ $message }}</p> @enderror
      </div>
      <div class="row2">
        <div class="field">
          <label>Kategori</label>
          <select required name="category_id">
            <option value="">Pilih kategori</option>
            @foreach ($categories as $category)
              <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ $category->name }}</option>
            @endforeach
          </select>
          @error('category_id') <p class="field-error">{{ $message }}</p> @enderror
        </div>
        <div class="field">
          <label>Harga (RM)</label>
          <input required name="price" type="number" min="1" value="{{ old('price') }}" placeholder="150">
          @error('price') <p class="field-error">{{ $message }}</p> @enderror
        </div>
      </div>
      <div class="field">
        <label>Keadaan Barang</label>
        <div class="cond-options">
          @foreach (\App\Models\Listing::CONDITIONS as $cond)
            <label class="cond-opt {{ old('condition') === $cond ? 'sel' : '' }}">
              <input type="radio" name="condition" value="{{ $cond }}" @checked(old('condition') === $cond) required>
              {{ $cond }}
            </label>
          @endforeach
        </div>
        @error('condition') <p class="field-error">{{ $message }}</p> @enderror
      </div>
      <div class="field">
        <label>Lokasi</label>
        <input required name="location" type="text" value="{{ old('location') }}" placeholder="contoh: Petaling Jaya, Selangor">
        @error('location') <p class="field-error">{{ $message }}</p> @enderror
      </div>
      <div class="field">
        <label>Penerangan Ringkas</label>
        <textarea name="description" placeholder="Ceritakan sedikit tentang barang ini, sebab jual, dan apa-apa kecacatan jika ada.">{{ old('description') }}</textarea>
      </div>
      <div class="field">
        <label>Gambar Barang</label>
        <input type="file" name="image" accept="image/*">
        @error('image') <p class="field-error">{{ $message }}</p> @enderror
      </div>
      <button class="btn-submit" type="submit">Siarkan Barang</button>
      <p class="form-note">Barang anda akan terus muncul di senarai Cekedis selepas disiarkan.</p>
    </form>
  </div>
</section>

<script>
  document.querySelectorAll('.cond-opt input').forEach(input => {
    input.addEventListener('change', () => {
      document.querySelectorAll('.cond-opt').forEach(opt => opt.classList.remove('sel'));
      input.closest('.cond-opt').classList.add('sel');
    });
  });
</script>

@endsection
