<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\{User, Leave, StationeryRequest, Inventory, StockReport, StockLog, Sadaka};

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $user = Auth::user();
            if (!$user) return;

            $isSupervisor = in_array($user->supervisor_id, [100, 555, 444, 666]);
            $users = $isSupervisor ? User::all() : User::where('id', $user->id)->get();

            $view->with([
                'allstaff'      => $users,
                'leaveTable'    => Leave::with('employee')->when(!$isSupervisor, fn($q) => $q->where('id', $user->id))->get(),
                'requestsTable' => StationeryRequest::when(!$isSupervisor, fn($q) => $q->where('id', $user->id))->get(),
                'stockTable'    => Inventory::all(),
                'sadakas'       => Sadaka::all(),
                'StockLog'      => StockLog::when(!$isSupervisor, fn($q) => $q->where('id', $user->id))->get(),
                'StockReport'   => StockReport::when(!$isSupervisor, fn($q) => $q->where('id', $user->id))->get(),
            ]);
        });
    }
}