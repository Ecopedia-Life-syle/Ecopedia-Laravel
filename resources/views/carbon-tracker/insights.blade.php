@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="bg-white rounded-xl shadow p-6">
        <h3 class="text-xl font-semibold mb-4">💡 Tips Pengurangan Emisi</h3>
        <div class="space-y-4">
            <div class="flex gap-4 p-4 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-lg">
                <div class="text-4xl">🚲</div>
                <div>
                    <p class="font-medium">Gunakan transportasi umum atau sepeda</p>
                    <p class="text-sm text-emerald-600 mt-1">Hemat ~3kg CO₂/hari</p>
                </div>
            </div>
            <div class="flex gap-4 p-4 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-lg">
                <div class="text-4xl">🥗</div>
                <div>
                    <p class="font-medium">Kurangi konsumsi daging merah</p>
                    <p class="text-sm text-emerald-600 mt-1">Hemat ~5kg CO₂/hari</p>
                </div>
            </div>
            <div class="flex gap-4 p-4 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-lg">
                <div class="text-4xl">❄️</div>
                <div>
                    <p class="font-medium">Set AC di 25°C, matikan saat keluar</p>
                    <p class="text-sm text-emerald-600 mt-1">Hemat ~2kg CO₂/hari</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <h3 class="text-xl font-semibold mb-4">Target vs Aktual</h3>
        <div class="flex justify-between text-sm mb-2">
            <span>Emisi Hari Ini</span>
            <span class="font-semibold">{{ number_format($todayTotal, 1) }} / 5.5 kg CO₂</span>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-3">
            <!-- PERBAIKAN: Pindahkan logika PHP ke dalam directive Blade -->
            <div class="w-full bg-gray-200 rounded-full h-3">
    @php
        $percentage = min(($todayTotal / 5.5) * 100, 100);
        $color = $todayTotal <= 5.5 ? 'bg-emerald-500' : 'bg-red-500';
    @endphp
    <div class="h-3 rounded-full {{ $color }}" style="width: {{ $percentage }}%"></div>
</div>
        </div>
        <p class="text-xs text-gray-600 mt-2">Target: 5.5 kg CO₂/hari (rata-rata Indonesia)</p>
    </div>

    <div class="bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-xl shadow p-6">
        <h3 class="text-xl font-semibold mb-3">💡 Tahukah Kamu?</h3>
        <ul class="space-y-2 text-sm">
            <li>• 1 kg daging sapi menghasilkan 27 kg CO₂</li>
            <li>• Sepeda vs motor 10km = hemat 1.5 kg CO₂</li>
            <li>• AC 25°C vs 22°C = hemat 20% energi</li>
            <li>• 1 pohon dewasa menyerap 22 kg CO₂/tahun</li>
        </ul>
    </div>
</div>
@endsection