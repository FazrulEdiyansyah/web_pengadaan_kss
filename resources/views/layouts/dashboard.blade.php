<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
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
                <span class="text-gray-700 font-semibold">{{ Auth::user()->name }}</span>
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
                        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 font-medium text-[1.1rem] transition text-black hover:bg-blue-50 whitespace-nowrap">
                            <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M3 10.5 12 3l9 7.5V19a2 2 0 0 1-2 2h-3.5a.5.5 0 0 1-.5-.5V15a1 1 0 0 0-1-1h-2a1 1 0 0 0-1 1v5.5a.5.5 0 0 1-.5.5H5a2 2 0 0 1-2-2V10.5z"/>
                            </svg>
                            <span x-show="sidebarOpen" class="text-[1.1rem] font-medium whitespace-nowrap" x-transition>Dashboard</span>
                        </a>
                    </li>
                    <li x-data="{ open: {{ request()->routeIs('spph.*') ? 'true' : 'false' }} }">
                        <button @click="open = !open"
                            class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium text-[1.1rem] transition text-black hover:bg-blue-50 whitespace-nowrap w-full focus:outline-none">
                            <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <rect x="3" y="3" width="7" height="7" stroke-width="2" rx="1"/>
                                <rect x="14" y="3" width="7" height="7" stroke-width="2" rx="1"/>
                                <rect x="3" y="14" width="7" height="7" stroke-width="2" rx="1"/>
                                <rect x="14" y="14" width="7" height="7" stroke-width="2" rx="1"/>
                            </svg>
                            <span x-show="sidebarOpen" class="text-[1.1rem] font-medium whitespace-nowrap" x-transition>Permintaan Penawaran</span>
                            <svg x-show="sidebarOpen" :class="{'rotate-180': open}" class="w-4 h-4 ml-auto transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <ul x-show="open" x-transition class="ml-10 mt-2 space-y-1" x-cloak>
                            <li>
                                <a href="{{ route('spph.create') }}" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-blue-100 text-sm">
                                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 4v16m8-8H4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <span x-show="sidebarOpen" x-transition>Buat SPPH</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('spph.overview') }}" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-blue-100 text-sm">
                                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <circle cx="12" cy="12" r="10" stroke-width="2"/>
                                        <path d="M8 12h8M12 8v8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <span x-show="sidebarOpen" x-transition>Overview SPPH</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li x-data="{ open: false }">
                        <button @click="open = !open"
                            class="flex items-center gap-3 px-4 py-3 font-medium text-[1.1rem] transition text-black hover:bg-blue-50 whitespace-nowrap w-full focus:outline-none">
                            <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <rect x="3" y="3" width="7" height="7" stroke-width="2" rx="1"/>
                                <rect x="14" y="3" width="7" height="7" stroke-width="2" rx="1"/>
                                <rect x="3" y="14" width="7" height="7" stroke-width="2" rx="1"/>
                                <rect x="14" y="14" width="7" height="7" stroke-width="2" rx="1"/>
                            </svg>
                            <span x-show="sidebarOpen" class="text-[1.1rem] font-medium whitespace-nowrap" x-transition>Pembukaan Penawaran</span>
                            <svg x-show="sidebarOpen" :class="{'rotate-180': open}" class="w-4 h-4 ml-auto transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <ul x-show="open" x-transition class="ml-10 mt-2 space-y-1" x-cloak>
                            <li>
                                <a href="#" class="flex items-center gap-2 px-4 py-2 hover:bg-blue-100 text-sm">
                                    <span x-show="sidebarOpen" x-transition>
                                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <circle cx="12" cy="12" r="10" stroke-width="2"/>
                                            <path d="M8 12h8M12 8v8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                    <span x-show="sidebarOpen" x-transition>Overview SPH</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @if(auth()->user()->role === 'approver')
                    <li>
                        <a href="{{ route('approval.index') }}" class="flex items-center gap-3 px-4 py-3 font-medium text-[1.1rem] transition text-black hover:bg-blue-50 whitespace-nowrap">
                            <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span x-show="sidebarOpen" class="text-[1.1rem] font-medium whitespace-nowrap" x-transition>Approval SPPH</span>
                        </a>
                    </li>
                    @endif
                    <li>
                        <a href="#" class="flex items-center gap-3 px-4 py-3 font-medium text-[1.1rem] transition text-black hover:bg-blue-50 whitespace-nowrap">
                            <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <rect x="3" y="3" width="7" height="7" stroke-width="2" rx="1"/>
                                <rect x="14" y="3" width="7" height="7" stroke-width="2" rx="1"/>
                                <rect x="3" y="14" width="7" height="7" stroke-width="2" rx="1"/>
                                <rect x="14" y="14" width="7" height="7" stroke-width="2" rx="1"/>
                            </svg>
                            <span x-show="sidebarOpen" class="text-[1.1rem] font-medium whitespace-nowrap" x-transition>Penetapan Pemenang</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center gap-3 px-4 py-3 font-medium text-[1.1rem] transition text-black hover:bg-blue-50 whitespace-nowrap">
                            <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <rect x="3" y="3" width="7" height="7" stroke-width="2" rx="1"/>
                                <rect x="14" y="3" width="7" height="7" stroke-width="2" rx="1"/>
                                <rect x="3" y="14" width="7" height="7" stroke-width="2" rx="1"/>
                                <rect x="14" y="14" width="7" height="7" stroke-width="2" rx="1"/>
                            </svg>
                            <span x-show="sidebarOpen" class="text-[1.1rem] font-medium whitespace-nowrap" x-transition>Vendor Management</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center gap-3 px-4 py-3 font-medium text-[1.1rem] transition text-black hover:bg-blue-50 whitespace-nowrap">
                            <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <rect x="3" y="3" width="7" height="7" stroke-width="2" rx="1"/>
                                <rect x="14" y="3" width="7" height="7" stroke-width="2" rx="1"/>
                                <rect x="3" y="14" width="7" height="7" stroke-width="2" rx="1"/>
                                <rect x="14" y="14" width="7" height="7" stroke-width="2" rx="1"/>
                            </svg>
                            <span x-show="sidebarOpen" class="text-[1.1rem] font-medium whitespace-nowrap" x-transition>History</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <script>
                document.addEventListener('alpine:init', () => {
                    Alpine.data('sidebarState', () => ({
                        sidebarOpen: true,
                        sidebarActive: '{{ Route::currentRouteName() === "dashboard" ? "dashboard" : "" }}',
                    }))
                })
            </script>
        </aside>
        <!-- Main Content -->
        <main class="flex-1 bg-gray-100 min-h-screen">
            @yield('content')
        </main>
    </div>
</body>
</html>