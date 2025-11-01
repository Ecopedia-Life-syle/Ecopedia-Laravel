@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="bg-white rounded-xl shadow p-6">
        <h3 class="text-xl font-semibold mb-4 flex items-center gap-2">
            <i class="fas fa-award text-yellow-500"></i>
            Badge & Pencapaian
        </h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="p-6 rounded-xl text-center {{ $activities->count() > 0 ? 'bg-gradient-to-br from-yellow-100 to-orange-100 border-2 border-yellow-400' : 'bg-gray-100 opacity-50' }}">
                <div class="text-5xl mb-2">🌱</div>
                <p class="font-semibold text-sm">Eco Starter</p>
                <p class="text-xs text-gray-600 mt-1">Mulai tracking</p>
                @if($activities->count() > 0)
                    <div class="mt-2 text-emerald-600 text-xs font-semibold">✓ UNLOCKED</div>
                @endif
            </div>
            <div class="p-6 rounded-xl text-center {{ $activities->count() >= 7 ? 'bg-gradient-to-br from-yellow-100 to-orange-100 border-2 border-yellow-400' : 'bg-gray-100 opacity-50' }}">
                <div class="text-5xl mb-2">⚡</div>
                <p class="font-semibold text-sm">Week Warrior</p>
                <p class="text-xs text-gray-600 mt-1">7 hari tracking</p>
                @if($activities->count() >= 7)
                    <div class="mt-2 text-emerald-600 text-xs font-semibold">✓ UNLOCKED</div>
                @endif
            </div>
            <div class="p-6 rounded-xl text-center {{ $todayTotal < 5.5 && $todayTotal > 0 ? 'bg-gradient-to-br from-yellow-100 to-orange-100 border-2 border-yellow-400' : 'bg-gray-100 opacity-50' }}">
                <div class="text-5xl mb-2">💚</div>
                <p class="font-semibold text-sm">Low Carbon</p>
                <p class="text-xs text-gray-600 mt-1">Di bawah target</p>
                @if($todayTotal < 5.5 && $todayTotal > 0)
                    <div class="mt-2 text-emerald-600 text-xs font-semibold">✓ UNLOCKED</div>
                @endif
            </div>
            <div class="p-6 rounded-xl text-center bg-gray-100 opacity-50">
                <div class="text-5xl mb-2">🏆</div>
                <p class="font-semibold text-sm">Eco Hero</p>
                <p class="text-xs text-gray-600 mt-1">30 hari konsisten</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <h3 class="text-xl font-semibold mb-4">Statistik Kamu</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="text-center p-6 bg-gradient-to-br from-emerald-100 to-teal-100 rounded-xl">
                <p class="text-4xl font-bold text-emerald-600">{{ $activities->count() }}</p>
                <p class="text-sm text-gray-600 mt-2">Total Aktivitas Tracked</p>
            </div>
            <div class="text-center p-6 bg-gradient-to-br from-blue-100 to-cyan-100 rounded-xl">
                <p class="text-4xl font-bold text-blue-600">{{ number_format($weekTotal, 0) }}</p>
                <p class="text-sm text-gray-600 mt-2">kg CO₂ Minggu Ini</p>
            </div>
            <div class="text-center p-6 bg-gradient-to-br from-purple-100 to-pink-100 rounded-xl">
                <p class="text-4xl font-bold text-purple-600">{{ ceil($weekTotal / 0.5) }}</p>
                <p class="text-sm text-gray-600 mt-2">Pohon Dibutuhkan</p>
            </div>
        </div>
    </div>

    <div class="bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-xl shadow p-6">
        <h3 class="text-2xl font-bold mb-3">🎯 Keep Going!</h3>
        <p class="text-emerald-100">Setiap langkah kecil membuat perbedaan besar untuk planet kita. Terus tracking dan kurangi jejak karbonmu!</p>
    </div>
</div>
@endsection