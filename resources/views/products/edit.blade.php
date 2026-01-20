@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-6">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold">
            Edit Product
        </h1>

        <a
            href="{{ url()->previous() }}"
            class="py-2 px-4 rounded-xs bg-gray-300 hover:bg-gray-400 dark:bg-gray-600 dark:hover:bg-gray-500 text-black dark:text-white font-semibold"
        >
            Back</a>
    </div>

    @if ($errors->any())
        <div class="mb-4 border border-red-600 bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200 rounded-xs p-3">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        method="POST"
        action="{{ route('products.update', $product) }}"
        class="bg-gray-100 dark:bg-gray-700 border border-black dark:border-white rounded-xs p-6 space-y-5 text-black dark:text-white"
    >
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium mb-1">
                Item Name
            </label>
            <input
                type="text"
                name="item_name"
                value="{{ old('item_name', $product->item_name) }}"
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
                value="{{ old('quantity', $product->quantity) }}"
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
                value="{{ old('price', $product->price) }}"
                required
                class="w-full px-3 py-2 rounded-xs bg-white dark:bg-gray-800 border border-black dark:border-white focus:outline-none"
            >
        </div>

        <div class="flex justify-end gap-3 pt-4">
            <a
                href="{{ route('products.show', $product) }}"
                class="py-2.5 px-4 rounded-xs bg-gray-300 hover:bg-gray-400 dark:bg-gray-600 dark:hover:bg-gray-500 text-black dark:text-white font-semibold"
            >
                Cancel
            </a>

            <button
                type="submit"
                class="py-2.5 px-4 rounded-xs bg-black hover:bg-gray-800 dark:bg-white dark:hover:bg-gray-200 text-white dark:text-black font-semibold hover:cursor-pointer"
            >
                Save Changes
            </button>
        </div>
    </form>

</div>
@endsection
