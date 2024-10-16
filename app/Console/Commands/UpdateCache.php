<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use Log;
use Cache;


class UpdateCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'UpdateCache:crom';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command update cache html index';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try{
            $views = [
                'frontend.widget.blog._menu_mobile',
                'frontend.widget.blog._menu',
                'frontend.widget.desktop._menu_top',
                'frontend.widget.desktop._menu',
                'frontend.widget.mobile._menu',
                'frontend.widget.mobile._menu_category',
                'frontend.widget.blog.banner',
                'frontend.widget.blog._section_widget_1',
                'frontend.widget.blog._section_widget_2',
                'frontend.widget.desktop._ads_1',
                'frontend.widget.desktop._section_widget_banner_nature',
                'frontend.widget.desktop._slide',
                'frontend.widget.desktop._banner_sales',
                'frontend.widget.desktop._flash_sales',
                'frontend.widget.desktop._section_widget_1',
                'frontend.widget.desktop._ads_2',
                'frontend.widget.desktop._section_widget_2',
                'frontend.widget.desktop._ads_3',
                'frontend.widget.desktop._section_widget_3',
                'frontend.widget.desktop._ads_4',
                'frontend.widget.desktop._section_widget_category',
                'frontend.widget.desktop._section_widget_article',
                'frontend.widget.desktop._section_widget_banner_nature',
                'frontend.widget.mobile._section_widget_banner_nature',
                'frontend.widget.mobile._slide',
                'frontend.widget.mobile._banner_sales',
                'frontend.widget.mobile._flash_sales',
                'frontend.widget.mobile._section_widget_1',
                'frontend.widget.mobile._section_widget_2',
                'frontend.widget.mobile._section_widget_3',
                'frontend.widget.mobile._section_widget_category',
                'frontend.widget.mobile._section_widget_article',
                'frontend.widget.mobile._section_widget_banner_nature',
            ];
            for($i = 0; $i<count($views); $i++){
                $view = $views[$i];
                $value =  view($view)->render();
                if($value != null && $value != ""){
                    Cache::forever('cache_'.$view, $value);
                }
                else{
                    $myfile = fopen(storage_path() ."/logs/log-job-checkvalueCache.txt", "a") or die("Unable to open file!");
                    $txt = Carbon::now().": ".$view.' - '.$value. ' null ';
                    fwrite($myfile, $txt ."\n");
                    fclose($myfile);
                }
            }
            $myfile = fopen(storage_path() ."/logs/log-job-updateCache.txt", "a") or die("Unable to open file!");
            $txt = Carbon::now().":chạy cronjob: update-cache OK";
            fwrite($myfile, $txt ."\n");
            fclose($myfile);

        }catch (\Exception $e) {
            Log::error($e );
            $myfile = fopen(storage_path() ."/logs/log-job-updateCache.txt", "a") or die("Unable to open file!");
            $txt = Carbon::now().":chạy cronjob: updateCache error";
            fwrite($myfile, $txt ."\n");
            fclose($myfile);
        }
    }
}
