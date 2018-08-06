<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Vacancy;
use phpDocumentor\Reflection\Types\Self_;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    static function upgrade($page = 1)
    {

        $apiUrl = "https://api.hh.ru/vacancies/?page=$page";
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $apiUrl);
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 1);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Your application name');
        $query = curl_exec($curl_handle);
        curl_close($curl_handle);

        $data = json_decode($query);
        if (isset($data->page) && $page < 3) {
            foreach ($data->items as $item) {
                $vacancy = new Vacancy();
                $vacancy->name = $item->name;
                $vacancy->area = $item->area->name;
                $vacancy->url = $item->alternate_url;
                if (isset($item->salary->to)) {
                    $vacancy->salaryTo = $item->salary->to;
                } else {
                    $vacancy->salaryTo = 0;
                }
                if (isset($item->salary->from)) {
                    $vacancy->salaryFrom = $item->salary->from;
                } else {
                    $vacancy->salaryFrom = 0;
                }
                if (isset($item->salary->currency)) {
                    $vacancy->currency = $item->salary->currency;
                } else {
                    $vacancy->currency = 'null';
                }
                $vacancy->timestamps = false;
                $vacancy->save();
            }
            return self::upgrade($page + 1);
        } else {
            return;
        }
    }


    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {self::upgrade(1);});
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
