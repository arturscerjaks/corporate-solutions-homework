<header class="w-full lg:max-w-4xl text-sm mb-6">
    <nav>
        <ul class="flex sm:flex-row flex-col justify-between items-center gap-4">
            <div class="flex grow justify-end gap-4 sm:flex-row flex-col">
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button
                            type="submit"
                            class="header-link bg-transparent border-0 p-0 cursor-pointer"
                        >
                            Logout
                        </button>
                    </form>
                </li>
            </div>
        </ul>
    </nav>
</header>
