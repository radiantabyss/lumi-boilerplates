<?php
namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Lumi\Auth\Domains\Team\Commands\ExpireInvitesCommand;
use Lumi\Auth\Domains\User\Commands\ExpireCodesCommand;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        ExpireInvitesCommand::class,
        ExpireCodesCommand::class,
    ];

    protected function commands()
    {
        $this->load(__DIR__.'/../Domains/Common/Commands');

        require base_path('routes/console.php');
    }

    protected function schedule(Schedule $schedule) {
        $schedule->command('lumi-auth:expire-invites')->everyHour();
        $schedule->command('lumi-auth:expire-codes')->everyHour();
    }
}
