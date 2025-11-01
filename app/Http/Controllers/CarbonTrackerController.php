<?php

namespace App\Http\Controllers;

use App\Models\CarbonActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarbonTrackerController extends Controller
{
    public function dashboard()
    {
        $today = now()->format('Y-m-d');
        $activities = CarbonActivity::latest()->take(5)->get();
        $todayTotal = $this->getTodayTotal();
        $weekData = $this->getWeekData();
        $categoryData = $this->getCategoryData();
        $weekTotal = collect($weekData)->sum('value');

        return view('carbon-tracker.dashboard', compact(
            'activities',
            'todayTotal',
            'weekData',
            'categoryData',
            'weekTotal'
        ));
    }

    public function input()
    {
        return view('carbon-tracker.input');
    }

    public function insights()
    {
        $todayTotal = $this->getTodayTotal();
        return view('carbon-tracker.insights', compact('todayTotal'));
    }

    public function achievements()
    {
        $activities = CarbonActivity::all();
        $todayTotal = $this->getTodayTotal();
        $weekTotal = $this->getWeekTotal();

        return view('carbon-tracker.achievements', compact(
            'activities',
            'todayTotal',
            'weekTotal'
        ));
    }

    public function storeTransport(Request $request)
    {
        $request->validate([
            'transport_type' => 'required|string',
            'transport_km' => 'required|numeric|min:0'
        ]);

        $factors = CarbonActivity::emissionFactors();
        $emission = $request->transport_km * $factors[$request->transport_type];

        CarbonActivity::create([
            'date' => now(),
            'type' => 'transport',
            'name' => $request->transport_type,
            'emission' => round($emission, 2),
            'details' => [
                'km' => $request->transport_km
            ]
        ]);

        return redirect()->route('dashboard')->with('success', 'Data transportasi berhasil disimpan!');
    }

    public function storeFood(Request $request)
    {
        $request->validate([
            'food_type' => 'required|string',
            'food_portions' => 'required|numeric|min:0'
        ]);

        $factors = CarbonActivity::emissionFactors();
        $emission = $request->food_portions * $factors[$request->food_type];

        CarbonActivity::create([
            'date' => now(),
            'type' => 'food',
            'name' => $request->food_type,
            'emission' => round($emission, 2),
            'details' => [
                'portions' => $request->food_portions
            ]
        ]);

        return redirect()->route('dashboard')->with('success', 'Data makanan berhasil disimpan!');
    }

    public function storeEnergy(Request $request)
    {
        $request->validate([
            'ac_hours' => 'nullable|numeric|min:0',
            'tv_hours' => 'nullable|numeric|min:0'
        ]);

        $acHours = $request->ac_hours ?? 0;
        $tvHours = $request->tv_hours ?? 0;

        if ($acHours > 0 || $tvHours > 0) {
            $factors = CarbonActivity::emissionFactors();
            $emission = ($acHours * $factors['ac_per_hour']) + ($tvHours * $factors['tv_per_hour']);

            CarbonActivity::create([
                'date' => now(),
                'type' => 'energy',
                'name' => 'daily',
                'emission' => round($emission, 2),
                'details' => [
                    'ac_hours' => $acHours,
                    'tv_hours' => $tvHours
                ]
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Data energi berhasil disimpan!');
    }

    private function getTodayTotal()
    {
        return CarbonActivity::whereDate('date', today())
            ->sum('emission') ?? 0;
    }

    private function getWeekTotal()
    {
        return CarbonActivity::whereBetween('date', [now()->subDays(6), now()])
            ->sum('emission') ?? 0;
    }

    private function getWeekData()
    {
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $dateStr = $date->format('Y-m-d');
            $dayTotal = CarbonActivity::whereDate('date', $dateStr)
                ->sum('emission');

            $data[] = [
                'date' => $date->format('m-d'),
                'value' => round($dayTotal ?? 0, 1)
            ];
        }
        return $data;
    }

    private function getCategoryData()
    {
        $todayActivities = CarbonActivity::whereDate('date', today())
            ->select('type', DB::raw('SUM(emission) as total'))
            ->groupBy('type')
            ->get();

        return $todayActivities->map(function ($item) {
            return [
                'name' => ucfirst($item->type),
                'value' => round($item->total ?? 0, 2)
            ];
        });
    }
}