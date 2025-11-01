@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Transport Form -->
    <div class="bg-white rounded-xl shadow p-6">
        <div class="flex items-center gap-2 mb-4">
            <i class="fas fa-car text-red-500"></i>
            <h3 class="text-xl font-semibold">Transportasi</h3>
        </div>
        <form action="{{ route('activities.transport') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium mb-2">Jenis Kendaraan</label>
                <select name="transport_type" class="w-full p-3 border rounded-lg">
                    <option value="motor">Motor</option>
                    <option value="mobil">Mobil</option>
                    <option value="busway">Busway</option>
                    <option value="kereta">Kereta</option>
                    <option value="sepeda">Sepeda</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium mb-2">Jarak (km)</label>
                <input type="number" step="0.1" name="transport_km" placeholder="10" 
                       class="w-full p-3 border rounded-lg" required>
            </div>
            <button type="submit" class="w-full bg-emerald-600 text-white p-3 rounded-lg font-semibold hover:bg-emerald-700">
                + Tambah Transportasi
            </button>
        </form>
    </div>

    <!-- Food Form -->
    <div class="bg-white rounded-xl shadow p-6">
        <div class="flex items-center gap-2 mb-4">
            <i class="fas fa-utensils text-orange-500"></i>
            <h3 class="text-xl font-semibold">Makanan</h3>
        </div>
        <form action="{{ route('activities.food') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium mb-2">Jenis Makanan</label>
                <select name="food_type" class="w-full p-3 border rounded-lg">
                    <option value="daging_sapi">Daging Sapi</option>
                    <option value="daging_ayam">Daging Ayam</option>
                    <option value="ikan">Ikan</option>
                    <option value="vegetarian">Vegetarian</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium mb-2">Porsi</label>
                <input type="number" step="0.5" name="food_portions" placeholder="1" 
                       class="w-full p-3 border rounded-lg" required>
            </div>
            <button type="submit" class="w-full bg-orange-600 text-white p-3 rounded-lg font-semibold hover:bg-orange-700">
                + Tambah Makanan
            </button>
        </form>
    </div>

    <!-- Energy Form -->
    <div class="bg-white rounded-xl shadow p-6">
        <div class="flex items-center gap-2 mb-4">
            <i class="fas fa-bolt text-blue-500"></i>
            <h3 class="text-xl font-semibold">Energi</h3>
        </div>
        <form action="{{ route('activities.energy') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium mb-2">AC (jam/hari)</label>
                <input type="number" step="0.5" name="ac_hours" placeholder="8" 
                       class="w-full p-3 border rounded-lg">
            </div>
            <div>
                <label class="block text-sm font-medium mb-2">TV/Komputer (jam/hari)</label>
                <input type="number" step="0.5" name="tv_hours" placeholder="4" 
                       class="w-full p-3 border rounded-lg">
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white p-3 rounded-lg font-semibold hover:bg-blue-700">
                + Tambah Energi
            </button>
        </form>
    </div>
</div>
@endsection