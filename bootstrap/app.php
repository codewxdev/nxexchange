<?php

use App\Models\Signal;
use App\Models\Trade;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'auth' => \App\Http\Middleware\AuthMiddleware::class,
            'isAdmin' => \App\Http\Middleware\RoleCheck::class,
            'checkUserStatus' => \App\Http\Middleware\CheckUserStatus::class,
            

        ]);
        // $middleware->appendToGroup('web', [
        //     \App\Http\Middleware\SetLanguage::class,
        // ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->withSchedule(function (Schedule $schedule) {  // اب یہ صحیح ہے
        // Signal cleanup - ہر منٹ
        $schedule->call(function () {
            Signal::whereNotNull('end_time')
                ->where('end_time', '<', now())
                ->where('status', 'active')
                ->update(['status' => 'expired']);
        })->everyMinute();

        // Trading volume progress check - ہر 5 منٹ
        // $schedule->call(function () {
        //     TradingVolume::where('status', 'active')
        //         ->where('completion_date', '<', now())
        //         ->update(['status' => 'cancelled']);
        // })->everyFiveMinutes();

        // Expired trades cleanup - ہر 10 منٹ
        $schedule->call(function () {
            Trade::where('status', 'pending')
                ->where('created_at', '<', now()->subHours(2))
                ->update(['status' => 'expired']);
        })->everyTenMinutes();
    })
    ->create();
