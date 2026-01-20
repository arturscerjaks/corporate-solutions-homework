@extends('layouts.app')

@section('title', 'Log In')

@section('content')
<form method="POST" action="/login" class="space-y-5">
    @csrf

    <div>
        <label class="block text-lg font-medium mb-1">
            Email
        </label>
        <input
            type="email"
            name="email"
            required
            autofocus
            class="w-full px-4 py-2 rounded-xs border border-black dark:border-white"
            placeholder="your-email@example.com"
        >
    </div>

    <div>
        <label class="block text-lg font-medium mb-1">
            Password
        </label>
        <input
            type="password"
            name="password"
            required
            class="w-full px-4 py-2 rounded-xs border border-black dark:border-white"
            placeholder="••••••••"
        >
    </div>

    <button
        type="submit"
        class="w-full py-2.5 rounded-xs bg-black hover:bg-gray-800 dark:bg-white dark:hover:bg-gray-200 text-white dark:text-black font-semibold hover:cursor-pointer">
        Sign In
    </button>
</form>
@endsection

