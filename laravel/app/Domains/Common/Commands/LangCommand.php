<?php
namespace App\Domains\Common\Commands;

use Illuminate\Console\Command;

class LangCommand extends Command
{
    protected $signature = 'lang {--force}';
    protected $description = 'Parses translated text from app and puts them in lang/{lang}.json';

    public function handle() {
        $terms = $this->terms();
        $langs = $this->langs();

        foreach ( $langs as $lang ) {
            $lang_contents = $this->option('force') ? [] : decode_json(file_get_contents('lang/'.$lang.'.json', 'UTF-8'));

            foreach ( $terms as $term ) {
                $lang_contents[$term] = $lang_contents[$term] ?? $term;
            }

            file_put_contents('lang/'.$lang.'.json', json_encode($lang_contents, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
        }
    }

    private function terms() {
        $files = get_files_recursive('app');
        $terms = [];

        foreach ( $files as $file ) {
            $contents = file_get_contents($file);
            preg_match_all('/\_\_\(\'(.*?)\'\)/', $contents, $matches);

            foreach ( $matches[1] as $match ) {
                $terms[] = str_replace("\'", "'", $match);
            }
        }

        return array_unique($terms);
    }

    private function langs() {
        $files = scandir('lang');
        $langs = [];

        foreach ( $files as $file ) {
            if ( preg_match('/\.json/', $file) ) {
                $langs[] = str_replace('.json', '', $file);
            }
        }

        return $langs;
    }
}
