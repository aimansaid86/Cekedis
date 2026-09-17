<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ListingSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['title' => 'Peti Sejuk 2 Pintu', 'cat' => 'Barangan Rumah', 'price' => 480, 'cond' => 'Seperti Baru', 'loc' => 'Petaling Jaya, Selangor', 'agoHours' => 2, 'img' => 'cekedis-fridge', 'desc' => 'Peti sejuk 2 pintu jenama Panasonic, digunakan kurang dari setahun. Berfungsi dengan baik, dijual kerana berpindah rumah.', 'seller' => 'Aiman'],
            ['title' => 'Meja Belajar Kayu', 'cat' => 'Perabot', 'price' => 120, 'cond' => 'Baik', 'loc' => 'Shah Alam, Selangor', 'agoHours' => 5, 'img' => 'cekedis-desk', 'desc' => 'Meja belajar kayu solid, ada 2 laci. Sedikit calar di bahagian tepi tapi kukuh digunakan.', 'seller' => 'Nurul'],
            ['title' => 'Basikal Gunung 26"', 'cat' => 'Sukan', 'price' => 230, 'cond' => 'Baik', 'loc' => 'Klang, Selangor', 'agoHours' => 24, 'img' => 'cekedis-bike', 'desc' => 'Basikal gunung 21-speed, tayar baru ditukar bulan lepas. Sesuai untuk mendaki dan harian.', 'seller' => 'Farid'],
            ['title' => 'Beg Galas Kanvas', 'cat' => 'Fesyen', 'price' => 45, 'cond' => 'Seperti Baru', 'loc' => 'Kuala Lumpur', 'agoHours' => 24, 'img' => 'cekedis-bag', 'desc' => 'Beg galas kanvas, jarang digunakan. Muat laptop 14 inci.', 'seller' => 'Aina'],
            ['title' => 'Set Sofa L-Shape', 'cat' => 'Perabot', 'price' => 650, 'cond' => 'Baik', 'loc' => 'Subang Jaya, Selangor', 'agoHours' => 48, 'img' => 'cekedis-sofa', 'desc' => 'Sofa L-shape 5 tempat duduk, fabrik masih elok. Dijual kerana menukar set baru.', 'seller' => 'Haziq'],
            ['title' => 'Telefon Pintar Android', 'cat' => 'Elektronik', 'price' => 390, 'cond' => 'Seperti Baru', 'loc' => 'Ampang, Selangor', 'agoHours' => 48, 'img' => 'cekedis-phone', 'desc' => '128GB storan, baru ditukar skrin. Datang dengan kotak dan charger asal.', 'seller' => 'Sofea'],
            ['title' => 'Almari Baju 3 Pintu', 'cat' => 'Perabot', 'price' => 280, 'cond' => 'Digunakan', 'loc' => 'Cheras, Kuala Lumpur', 'agoHours' => 72, 'img' => 'cekedis-wardrobe', 'desc' => 'Almari kayu 3 pintu dengan cermin. Berfungsi baik, ada kesan penggunaan biasa.', 'seller' => 'Ridzuan'],
            ['title' => 'Mesin Basuh 8kg', 'cat' => 'Barangan Rumah', 'price' => 340, 'cond' => 'Baik', 'loc' => 'Puchong, Selangor', 'agoHours' => 72, 'img' => 'cekedis-washer', 'desc' => 'Mesin basuh automatik 8kg, servis terakhir bulan lepas. Sebab jual: upgrade ke unit lebih besar.', 'seller' => 'Mei Ling'],
            ['title' => 'Rak Buku 5 Tingkat', 'cat' => 'Buku & Hobi', 'price' => 60, 'cond' => 'Digunakan', 'loc' => 'Kajang, Selangor', 'agoHours' => 96, 'img' => 'cekedis-shelf', 'desc' => 'Rak buku kayu 5 tingkat, kukuh dan stabil. Ada kesan lama tapi masih elok digunakan.', 'seller' => 'Faizal'],
            ['title' => 'Cermin Sisi Kereta Myvi', 'cat' => 'Kereta & Motor', 'price' => 75, 'cond' => 'Baik', 'loc' => 'Kuala Lumpur', 'agoHours' => 96, 'img' => 'cekedis-mirror', 'desc' => 'Cermin sisi original Perodua Myvi, keadaan baik, siap wiring.', 'seller' => 'Zulkifli'],
            ['title' => 'Jaket Denim Vintage', 'cat' => 'Fesyen', 'price' => 55, 'cond' => 'Seperti Baru', 'loc' => 'Bangsar, Kuala Lumpur', 'agoHours' => 120, 'img' => 'cekedis-jacket', 'desc' => 'Jaket denim saiz M, gaya vintage. Hanya dipakai beberapa kali.', 'seller' => 'Iman'],
            ['title' => 'Set Golf Separuh', 'cat' => 'Sukan', 'price' => 410, 'cond' => 'Baik', 'loc' => 'Ampang, Selangor', 'agoHours' => 144, 'img' => 'cekedis-golf', 'desc' => 'Set kayu golf 7-piece dengan bag. Sesuai untuk pemula.', 'seller' => 'Danial'],
        ];

        foreach ($items as $item) {
            $category = Category::where('name', $item['cat'])->firstOrFail();
            $seller = User::where('name', $item['seller'])->firstOrFail();

            $listing = Listing::updateOrCreate(
                ['slug' => Str::slug($item['title']).'-'.Str::slug($item['seller'])],
                [
                    'user_id' => $seller->id,
                    'category_id' => $category->id,
                    'title' => $item['title'],
                    'price' => $item['price'],
                    'condition' => $item['cond'],
                    'location' => $item['loc'],
                    'description' => $item['desc'],
                    'image_path' => "https://picsum.photos/seed/{$item['img']}/600/450",
                ],
            );

            // updateOrCreate touches timestamps automatically; back-date via the
            // query builder so "X jam/hari lalu" reflects the seeded ordering.
            $timestamp = now()->subHours($item['agoHours']);
            Listing::whereKey($listing->id)->update([
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ]);
        }
    }
}
