@csrf

<div>
    <label class="block text-sm font-medium mb-1">
        Item Name
    </label>
    <input
        type="text"
        name="item_name"
        value="{{ old('item_name', $product->item_name ?? '') }}"
        required
        class="w-full px-3 py-2 rounded-xs bg-white dark:bg-gray-800 border border-black dark:border-white focus:outline-none"
    >
</div>

<div>
    <label class="block text-sm font-medium mb-1">
        Quantity
    </label>
    <input
        type="number"
        name="quantity"
        min="0"
        value="{{ old('quantity', $product->quantity ?? '') }}"
        required
        class="w-full px-3 py-2 rounded-xs bg-white dark:bg-gray-800 border border-black dark:border-white focus:outline-none"
    >
</div>

<div>
    <label class="block text-sm font-medium mb-1">
        Price (excl. VAT)
    </label>
    <input
        type="number"
        name="price"
        step="0.01"
        min="0"
        value="{{ old('price', $product->price ?? '') }}"
        required
        class="w-full px-3 py-2 rounded-xs bg-white dark:bg-gray-800 border border-black dark:border-white focus:outline-none"
    >
</div>
