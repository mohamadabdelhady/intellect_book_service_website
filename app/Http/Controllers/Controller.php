<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function user_settings()
    {
return view('pages.settings');
    }
    public function query()
    {
        for($i=0;$i<=100;$i++ )
        {
            DB::select (DB::raw("INSERT INTO `audio_books` (`id`, `name`, `author`, `text`, `cover_img`, `rating`, `narrator`, `created_at`, `updated_at`) VALUES (NULL, 'The Great Gatsby', 'F. Scott Fitzgerald', ';lkfj;ofjlaskdjfl;a', '5.jpeg', '4', 'Mohamad abdelhady', '2021-12-09 22:40:18', '2021-12-09 22:40:18');"));
            echo "dfjjf";
        }

    }
}
