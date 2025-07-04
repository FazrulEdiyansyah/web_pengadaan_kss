<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Montserrat', sans-serif; }
        .sidebar-transition { transition: width 0.3s; }
        .sidebar-open { width: 270px; }
        .sidebar-closed { width: 56px; }
        @media (max-width: 768px) {
            .sidebar-open { width: 210px; }
        }
    </style>
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="w-full flex items-center justify-between px-10 py-2.5 shadow-sm" style="background-color: #d3d3d3;">
        <div class="flex items-center">
            <img src="{{ asset('build/assets/logo_kss.png') }}" alt="Logo" class="h-10 mr-2">
        </div>
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                <span class="text-gray-700 font-semibold">{{ Auth::user()->name }} (Admin)</span>
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div x-show="open" @click.away="open = false"
                class="absolute right-0 mt-2 w-40 bg-white rounded-md shadow-lg py-2 z-50 border"
                x-cloak>
                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">Logout</button>
                </form>
            </div>
        </div>
    </nav>
    <div class="flex" x-data="{ sidebarOpen: true }">
        <!-- Sidebar -->
        <aside
            :class="['sidebar-transition', sidebarOpen ? 'sidebar-open' : 'sidebar-closed']"
            class="h-screen bg-white shadow-md"
            style="position: relative; min-width: 56px; max-width: 270px;">
            <div class="px-4 pt-6 pb-2 flex justify-start">
                <button class="focus:outline-none" @click="sidebarOpen = !sidebarOpen">
                    <!-- Burger icon -->
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
            <nav class="mt-4">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 font-medium text-[1.1rem] transition text-black hover:bg-blue-50 whitespace-nowrap {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50' : '' }}">
                            <svg class="w-6 h-6 flex-shrink-0" fill="black" viewBox="0 0 24 24">
                                <path d="M3 10.5L12 3l9 7.5V19a2 2 0 0 1-2 2h-3.5a.5.5 0 0 1-.5-.5V15a1 1 0 0 0-1-1h-2a1 1 0 0 0-1 1v5.5a.5.5 0 0 1-.5.5H5a2 2 0 0 1-2-2V10.5z"/>
                            </svg>
                            <span x-show="sidebarOpen" class="text-[1.1rem] font-medium whitespace-nowrap" x-transition>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.approver.management') }}" class="flex items-center gap-3 px-4 py-3 font-medium text-[1.1rem] transition text-black hover:bg-blue-50 whitespace-nowrap {{ request()->routeIs('admin.approver.*') ? 'bg-blue-50' : '' }}">
                            <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                            <span x-show="sidebarOpen" class="text-[1.1rem] font-medium whitespace-nowrap" x-transition>Approver Management</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.vendor.management') }}" class="flex items-center gap-3 px-4 py-3 font-medium text-[1.1rem] transition text-black hover:bg-blue-50 whitespace-nowrap {{ request()->routeIs('admin.vendor.*') ? 'bg-blue-50' : '' }}">
                            <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            <span x-show="sidebarOpen" class="text-[1.1rem] font-medium whitespace-nowrap" x-transition>Vendor Management</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center gap-3 px-4 py-3 font-medium text-[1.1rem] transition text-black hover:bg-blue-50 whitespace-nowrap">
                            <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            <span x-show="sidebarOpen" class="text-[1.1rem] font-medium whitespace-nowrap" x-transition>Reports</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center gap-3 px-4 py-3 font-medium text-[1.1rem] transition text-black hover:bg-blue-50 whitespace-nowrap">
                            <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span x-show="sidebarOpen" class="text-[1.1rem] font-medium whitespace-nowrap" x-transition>Settings</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <script>
                document.addEventListener('alpine:init', () => {
                    Alpine.data('sidebarState', () => ({
                        sidebarOpen: true,
                        sidebarActive: '{{ Route::currentRouteName() }}',
                    }))
                })
            </script>
        </aside>
        <!-- Main Content -->
        <main class="flex-1 bg-gray-100 min-h-screen">
            @if(session('success'))
                <div class="px-8 pt-4">
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                        {{ session('success') }}
                    </div>
                </div>
            @endif
            
            @if(session('error'))
                <div class="px-8 pt-4">
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
