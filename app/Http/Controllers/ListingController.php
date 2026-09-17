<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Listing;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ListingController extends Controller
{
    public function index(Request $request): View
    {
        $categories = Category::orderBy('name')->get();
        $activeCat = $request->query('cat', 'Semua');
        $q = trim((string) $request->query('q', ''));

        $listings = Listing::with(['category', 'user'])
            ->when($activeCat !== 'Semua', fn ($query) => $query->whereHas(
                'category',
                fn ($cat) => $cat->where('name', $activeCat)
            ))
            ->when($q !== '', fn ($query) => $query->where(
                fn ($sub) => $sub->where('title', 'like', "%{$q}%")
                    ->orWhereHas('category', fn ($cat) => $cat->where('name', 'like', "%{$q}%"))
            ))
            ->latest()
            ->get();

        return view('home', [
            'categories' => $categories,
            'listings' => $listings,
            'activeCat' => $activeCat,
            'q' => $q,
            'totalListings' => Listing::count(),
            'totalUsers' => \App\Models\User::count(),
        ]);
    }

    public function show(Listing $listing): View
    {
        $listing->load(['category', 'user']);

        return view('listings.show', ['listing' => $listing]);
    }

    public function create(): View
    {
        return view('listings.create', ['categories' => Category::orderBy('name')->get()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'price' => ['required', 'numeric', 'min:1'],
            'condition' => ['required', Rule::in(Listing::CONDITIONS)],
            'location' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:4096'],
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('listings', 'public');
        }

        $listing = Listing::create([
            'user_id' => Auth::id(),
            'category_id' => $data['category_id'],
            'title' => $data['title'],
            'slug' => Str::slug($data['title']).'-'.Str::random(6),
            'price' => $data['price'],
            'condition' => $data['condition'],
            'location' => $data['location'],
            'description' => $data['description'] ?: 'Tiada penerangan tambahan.',
            'image_path' => $imagePath,
        ]);

        return redirect()->route('listings.show', $listing)
            ->with('status', 'Barang anda berjaya disiarkan!');
    }
}
