<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Coupon extends Model
{
    /** @use HasFactory<\Database\Factories\CouponFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'discount',
        'valid_until',
    ];

    /**
     * Convert the coupon name to uppercase.
     */
    public function setNameAttribute(string $value): void
    {
        $this->attributes['name'] = Str::upper($value);
    }

    /**
     * Check if the coupon is still valid.
     */
    public function checkIsValid(): bool
    {
        return Carbon::parse($this->valid_until)->greaterThan(Carbon::now());
    }
}
