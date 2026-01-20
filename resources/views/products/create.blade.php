@extends('layouts.app')

@section('title', 'Create Product')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-6">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold">Create Product</h1>
        <a
            href="{{ route('products.index') }}"
            class="py-2 px-4 rounded-xs bg-gray-300 hover:bg-gray-400 dark:bg-gray-600 dark:hover:bg-gray-500 text-black dark:text-white font-semibold"
        >
            Back
        </a>
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
        action="{{ route('products.store') }}"
        class="bg-gray-100 dark:bg-gray-700 border border-black dark:border-white rounded-xs p-6 space-y-5 text-black dark:text-white"
    >
        @include('products._form')

        <div class="flex justify-end gap-3 pt-4">
            <a
                href="{{ route('products.index') }}"
                class="py-2.5 px-4 rounded-xs bg-gray-300 hover:bg-gray-400 dark:bg-gray-600 dark:hover:bg-gray-500 text-black dark:text-white font-semibold"
            >
                Cancel</a>

            <button
                type="submit"
                class="py-2.5 px-4 rounded-xs bg-black hover:bg-gray-800 dark:bg-white dark:hover:bg-gray-200 text-white dark:text-black font-semibold hover:cursor-pointer"
            >
                Create Product
            </button>
        </div>
    </form>

</div>
@endsection
