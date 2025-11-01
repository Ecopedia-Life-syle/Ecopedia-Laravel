@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-xl shadow p-6">
            <i class="fas fa-bullseye text-emerald-500 text-2xl mb-2"></i>
            <p class="text-sm text-gray-600">Hari Ini</p>
            <p class="text-3xl font-bold">{{ number_format($todayTotal ?? 0, 1) }}</p>
            <p class="text-xs text-gray-500">kg CO₂</p>
        </div>
        <div class="bg-white rounded-xl shadow p-6">
            <i class="fas fa-chart-line text-blue-500 text-2xl mb-2"></i>
            <p class="text-sm text-gray-600">Minggu Ini</p>
            <p class="text-3xl font-bold">{{ number_format($weekTotal ?? 0, 1) }}</p>
            <p class="text-xs text-gray-500">kg CO₂</p>
        </div>
        <div class="bg-white rounded-xl shadow p-6">
            <i class="fas fa-leaf text-teal-500 text-2xl mb-2"></i>
            <p class="text-sm text-gray-600">Pohon Dibutuhkan</p>
            <p class="text-3xl font-bold">{{ ceil(($todayTotal ?? 0) / 0.5) }}</p>
            <p class="text-xs text-gray-500">untuk netralkan</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-xl shadow p-6">
            <h3 class="font-semibold mb-4">Trend 7 Hari</h3>
            <canvas id="weekChart" height="250"></canvas>
        </div>

        <div class="bg-white rounded-xl shadow p-6">
            <h3 class="font-semibold mb-4">Kategori Hari Ini</h3>
            @if(isset($categoryData) && $categoryData->count() > 0)
                <canvas id="categoryChart" height="250"></canvas>
            @else
                <div class="h-64 flex items-center justify-center text-gray-400">
                    Belum ada data hari ini
                </div>
            @endif
        </div>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <h3 class="font-semibold mb-4">Aktivitas Terbaru</h3>
        @if(isset($activities) && $activities->count() > 0)
            @foreach($activities as $activity)
                <div class="flex justify-between p-3 bg-gray-50 rounded-lg mb-2">
                    <div class="flex items-center gap-3">
                        @if($activity->type === 'transport')
                            <i class="fas fa-car text-red-500"></i>
                        @elseif($activity->type === 'food')
                            <i class="fas fa-utensils text-orange-500"></i>
                        @else
                            <i class="fas fa-bolt text-blue-500"></i>
                        @endif
                        <div>
                            <p class="font-medium text-sm">{{ strtoupper(str_replace('_', ' ', $activity->name)) }}</p>
                            <p class="text-xs text-gray-500">{{ $activity->date->format('Y-m-d') }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-red-600">{{ number_format($activity->emission, 2) }}</p>
                        <p class="text-xs text-gray-500">kg CO₂</p>
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-center text-gray-400 py-8">Mulai tracking aktivitas Anda!</p>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Week Chart
    const weekCtx = document.getElementById('weekChart');
    if (weekCtx) {
        const weekChart = new Chart(weekCtx, {
            type: 'line',
            data: {
                labels: @json(isset($weekData) ? collect($weekData)->pluck('date') : []),
                datasets: [{
                    label: 'Emisi CO₂ (kg)',
                    data: @json(isset($weekData) ? collect($weekData)->pluck('value') : []),
                    borderColor: '#10b981',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    // Category Chart
    const categoryCtx = document.getElementById('categoryChart');
    if (categoryCtx) {
        const categoryChart = new Chart(categoryCtx, {
            type: 'pie',
            data: {
                labels: @json(isset($categoryData) ? $categoryData->pluck('name') : []),
                datasets: [{
                    data: @json(isset($categoryData) ? $categoryData->pluck('value') : []),
                    backgroundColor: ['#ef4444', '#f59e0b', '#10b981']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    }
</script>
@endsection