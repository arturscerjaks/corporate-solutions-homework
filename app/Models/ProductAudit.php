<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductAudit extends Model
{
    /**
     * Mass-assignable attributes
     *
     * @var array<string>
     */
    protected $fillable = [
        'product_id',
        'user_id',
        'action',
        'changes',
    ];

    /**
     * Force changes to be array for JSON
     *
     * @var array
     */
    protected $casts = [
        'changes' => 'array',
    ];

    /**
     * Actions are done to a specific product
     *
     * @return BelongsTo<Product, ProductAudit>
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Changes are done by a specific user
     *
     * @return BelongsTo<Product, ProductAudit>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
