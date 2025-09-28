<header class="bg-base-300 shadow-sm">
    <nav class="navbar container mx-auto">
        <div class="navbar-start">
            <a href="/" class="text-2xl font-semibold">
                Inventory
            </a>
        </div>
        <div class="navbar-center">
            @auth
                <a href="{{ route('dashboard') }}" class="btn btn-ghost text-xl">
                    Dashboard
                </a>
                <a href="{{ route('items.index') }}" class="btn btn-ghost text-xl">
                    Items
                </a>
                <a href="{{ route('warehouses.index') }}" class="btn btn-ghost text-xl">
                    Warehouses
                </a>
            @else
                <a href="/about" class="btn btn-ghost text-xl">
                    About
                </a>
            @endauth
        </div>
        <div class="navbar-end">
            @auth
                <div class="dropdown dropdown-end">
                    <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                        <div class="w-10 rounded-full">
                            <img alt="Avatar" src="{{ Auth::user()->image?->url() }}" />
                        </div>
                    </div>
                    <ul tabindex="0"
                        class="menu menu-sm dropdown-content bg-base-100 rounded-box z-1 mt-3 w-52 p-2 shadow">
                        <li>
                            <a href="{{ route('profile') }}" class="">
                                Profile
                            </a>
                        </li>
                        <li><a>Settings</a></li>
                        <li class="block w-full">
                            <form action="{{ route('sign-out') }}" method="POST" class="block w-full">
                                @csrf
                                <button type="submit" class="block w-full text-left">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <a href="/login" class="btn btn-ghost text-xl">
                    Login
                </a>
                <a href="/register" class="btn btn-ghost text-xl">
                    Register
                </a>
            @endauth
        </div>
    </nav>
</header>
