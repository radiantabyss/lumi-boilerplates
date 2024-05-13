<?php
namespace App\Domains\Common\Commands;

use Illuminate\Console\Command;
use Lumi\Core\MailSender;
use App\Domains\Common\Mail\MonitorLogsMail;

//every 5 minutes
class MonitorLogsCommand extends Command
{
    protected $signature = 'monitor-logs';
    protected $description = 'Checks if has been a change in the logs.';

    public function handle()
    {
        if ( config('app.env') != 'production' ) {
            return;
        }

        $files = scandir(storage_path().'/logs');
        $send = false;

        foreach ( $files as $file ) {
            if ( in_array($file, ['.', '..', '.gitignore']) ) {
                continue;
            }

            if ( $file == '0_sent' ) {
                break;
            }

            $send = true;
        }

        if ( $send ) {
            MailSender::send(MonitorLogsMail::class, env('MONITOR_LOGS_EMAIL'));
            file_put_contents(storage_path().'/logs/0_sent', '1');
        }
    }
}
