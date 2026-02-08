<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Process;
use App\Models\Deadline;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $counts = [
            'clients' => $user->clients()->count(),
            'processes' => $user->processes()->where('status', 'Em Andamento')->count(),
            'deadlines' => $user->deadlines()->where('status', 'Pendente')->count(),
        ];

        // Get recent deadlines
        $upcomingDeadlines = $user->deadlines()
            ->where('status', 'Pendente')
            ->orderBy('due_date', 'asc')
            ->take(5)
            ->get();

        return view('dashboard', compact('counts', 'upcomingDeadlines'));
    }
}
