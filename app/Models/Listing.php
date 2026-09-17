<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

#[Fillable(['user_id', 'category_id', 'title', 'slug', 'price', 'condition', 'location', 'description', 'image_path'])]
class Listing extends Model
{
    public const CONDITIONS = ['Seperti Baru', 'Baik', 'Digunakan'];

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo<Category, $this>
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected function imageUrl(): Attribute
    {
        return Attribute::get(function () {
            if (! $this->image_path) {
                return null;
            }

            return str_starts_with($this->image_path, 'http')
                ? $this->image_path
                : Storage::disk('public')->url($this->image_path);
        });
    }

    protected function conditionBadgeClass(): Attribute
    {
        return Attribute::get(fn () => match ($this->condition) {
            'Seperti Baru' => 'baru',
            'Baik' => 'baik',
            default => 'digunakan',
        });
    }
}
