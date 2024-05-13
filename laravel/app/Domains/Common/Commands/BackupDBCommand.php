<?php
namespace App\Domains\Common\Commands;

use Illuminate\Console\Command;

class BackupDBCommand extends Command
{
    protected $signature = 'backup-db {frequency}';
    protected $description = 'Makes backups of the database. Don\'t forget to set up "mysql_config_editor set --login-path=local --host=localhost --user=username --password"';

    public function handle() {
        $folder_path = storage_path().'/db-backups/'.$this->argument('frequency');
        if ( !file_exists($folder_path) ) {
            mkdir($folder_path);
        }

        $file_name = date('Y-m-d_H-i').'.sql';
        $file_path = $folder_path.'/'.$file_name;
        $command = 'mysqldump --login-path=local '.env('DB_DATABASE').' > '.$file_path;
        shell_exec($command);

        //zip file
        shell_exec('cd '.$folder_path.' && zip '.$file_name.'.zip '.$file_name);

        //delete raw file
        unlink($file_path);
    }
}
