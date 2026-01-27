<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\ProductAudit;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;
use Illuminate\Support\Facades\Auth;

class ProductObserver implements ShouldHandleEventsAfterCommit
{
    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        $this->logAudit($product, 'create', $this->formatChanges($product));
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        $this->logAudit($product, 'update', $this->formatChanges($product));
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        $this->logAudit($product, 'delete');
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        $this->logAudit($product, 'restored');
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        $this->logAudit($product, 'force delete');
    }

    /**
     * Should log all actions done to products other than retrieving
     *
     * @param Product $product
     * @param string $action
     * @param array $changes
     * @return void
     */
    protected function logAudit(Product $product, string $action, ?array $changes = null)
    {
        ProductAudit::create([
            'product_id' => $product?->id,
            'user_id' => Auth::id(),
            'action' => $action,
            'changes' => $changes,
        ]);
    }

    /**
     * Format the changes done to Product for ProductAudit
     *
     * @param Product $product
     * @return array{item_name: mixed, price: mixed, quantity: mixed}
     */
    protected function formatChanges(Product $product)
    {
        return [
            'item_name' => $product->item_name,
            'quantity' => $product->quantity,
            'price' => $product->price
        ];
    }
}
