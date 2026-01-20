@extends('layouts.app')

@section('title', 'Products')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">

    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-semibold">Products</h1>

        @auth
            @if(auth()->user()->is_admin)
                <a
                    href="{{ route('products.create') }}"
                    class="py-2.5 px-4 rounded-xs bg-black hover:bg-gray-800 dark:bg-white dark:hover:bg-gray-200 text-white dark:text-black font-semibold hover:cursor-pointer"
                >
                    + New Product
                </a>
            @endif
        @endauth
    </div>

    <div class="bg-white shadow rounded-xs overflow-hidden">
        <table class="min-w-full border border-black dark:border-white">
            <thead class="bg-gray-200 dark:bg-gray-800 text-black dark:text-white">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold">
                        Name
                    </th>
                    <th class="px-4 py-3 text-right text-sm font-semibold">
                        Quantity
                    </th>
                    <th class="px-4 py-3 text-right text-sm font-semibold">
                        Price
                    </th>
                    <th class="px-4 py-3 text-right text-sm font-semibold">
                        Price (VAT incl.)
                    </th>
                    <th class="px-4 py-3 text-center text-sm font-semibold">
                        Actions
                    </th>
                </tr>
            </thead>

            <tbody class="divide-y divide-black dark:divide-gray-200 bg-gray-100 dark:bg-gray-700 text-black dark:text-white">
                @forelse($productList as $product)
                    <tr>
                        <td class="px-4 py-3 text-sm">
                            <a
                                href="{{ route('products.show', $product) }}"
                                class="hover:underline font-medium"
                            >
                                {{ $product->item_name }}
                            </a>
                        </td>

                        <td class="px-4 py-3 text-sm text-right">
                            {{ $product->quantity }}
                        </td>

                        <td class="px-4 py-3 text-sm text-right">
                            {{ number_format($product->price, 2) }}
                        </td>

                        <td class="px-4 py-3 text-sm text-right">
                            {{ number_format($product->price_with_vat, 2) }}
                        </td>

                        <td class="px-4 py-3 text-sm text-center space-x-2">
                            <a
                                href="{{ route('products.show', $product) }}"
                                class="hover:underline font-medium"
                            >
                                View</a>

                            @auth
                                @if(auth()->user()->is_admin)
                                    <a
                                        href="{{ route('products.edit', $product) }}"
                                        class="hover:underline font-medium"
                                    >
                                        Edit</a>

                                    <form
                                        action="{{ route('products.destroy', $product) }}"
                                        method="POST"
                                        class="inline"
                                        onsubmit="return confirm('Delete this product?')"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            class="text-red-600 hover:underline hover:cursor-pointer font-medium"
                                        >
                                            Delete
                                        </button>
                                    </form>
                                @endif
                            @endauth
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-6 text-center">
                            No products found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $productList->links() }}
    </div>
</div>
@endsection
