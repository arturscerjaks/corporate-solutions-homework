<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'item_name',
        'quantity',
        'price'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<string>
     */
    protected $appends = [
        'price_with_vat',
    ];

    /**
     * Determine if the user is an administrator.
     */
    protected function priceWithVat(): Attribute
    {
        return new Attribute(
            get: function () {
                $vatRate = config('tax.vat_rate') / 100;
                return round($this->price * (1 + $vatRate), 2);
            },
        );
    }
}
