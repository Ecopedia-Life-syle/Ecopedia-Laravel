<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoTrack - Carbon Footprint Tracker</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="min-h-screen bg-gradient-to-br from-emerald-50 to-teal-50">
    <!-- Header -->
    <div class="bg-gradient-to-r from-emerald-600 to-teal-600 text-white p-6 shadow-lg">
        <div class="max-w-6xl mx-auto flex items-center justify-between">
            <div class="flex items-center gap-3">
                <i class="fas fa-leaf text-2xl"></i>
                <div>
                    <h1 class="text-3xl font-bold">EcoTrack</h1>
                    <p class="text-sm text-emerald-100">Carbon Footprint Tracker</p>
                </div>
            </div>
            <div class="text-right">
                <div class="text-4xl font-bold">{{ number_format($todayTotal ?? 0, 1) }}</div>
                <div class="text-sm">kg CO₂ hari ini</div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <div class="bg-white shadow-sm sticky top-0 z-10">
        <div class="max-w-6xl mx-auto px-6 flex gap-6">
            @php
                $navItems = [
                    'dashboard' => 'Dashboard',
                    'input' => 'Input',
                    'insights' => 'Insights',
                    'achievements' => 'Achievements'
                ];
            @endphp
            
            @foreach($navItems as $route => $label)
                <a href="{{ route($route) }}" 
                   class="py-4 px-2 border-b-2 font-medium {{ request()->routeIs($route) ? 'border-emerald-600 text-emerald-600' : 'border-transparent text-gray-500' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-6xl mx-auto p-6">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </div>

    @yield('scripts')
</body>
</html>