@extends('layouts.app')

@section('title', 'View Product')

@section('content')
<div class="mx-auto px-4 py-6">

    <div class="flex flex-col gap-2 mb-2">
        <h1 class="text-2xl font-semibold">
            {{ $product->item_name }}
        </h1>

        <div class="flex gap-2">
            <a
                href="{{ route('products.index') }}"
                class="py-2 px-4 rounded-xs bg-black hover:bg-gray-800 dark:bg-white dark:hover:bg-gray-200 text-white dark:text-black font-semibold"
            >
                Back</a>

            @auth
                @if(auth()->user()->is_admin)
                    <a
                        href="{{ route('products.edit', $product) }}"
                        class="py-2 px-4 rounded-xs bg-black hover:bg-gray-800 dark:bg-white dark:hover:bg-gray-200 text-white dark:text-black font-semibold"
                    >
                        Edit</a>
                @endif
            @endauth
        </div>
    </div>

    <div class="flex flex-col gap-2 bg-gray-100 dark:bg-gray-700 border border-black dark:border-white rounded-xs p-6 text-black dark:text-white">
        <div class="flex justify-between gap-2">
            <span class="font-medium">Item Name</span>
            <span>{{ $product->item_name }}</span>
        </div>

        <div class="flex justify-between gap-2">
            <span class="font-medium">Quantity</span>
            <span>{{ $product->quantity }}</span>
        </div>

        <div class="flex justify-between gap-2">
            <span class="font-medium">Price (excl. VAT)</span>
            <span>{{ number_format($product->price, 2) }}</span>
        </div>

        <div class="flex justify-between gap-2">
            <span class="font-medium">Price (incl. VAT)</span>
            <span>{{ number_format($product->price_with_vat, 2) }}</span>
        </div>
    </div>

    @auth
        @if(auth()->user()->is_admin)
            <div class="mt-6">
                <form
                    action="{{ route('products.destroy', $product) }}"
                    method="POST"
                    onsubmit="return confirm('Delete this product?')"
                >
                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="text-red-600 hover:underline hover:cursor-pointer font-semibold"
                    >
                        Delete Product
                    </button>
                </form>
            </div>
        @endif
    @endauth

</div>
@endsection
