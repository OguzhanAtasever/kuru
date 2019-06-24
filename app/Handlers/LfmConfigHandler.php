<?php

namespace App\Handlers;
use Auth; 

class LfmConfigHandler extends \UniSharp\LaravelFilemanager\Handlers\ConfigHandler
{
    public function userField()
    {
        //dosya yüklemek icin yönetici girisi yapılması gerek
        return Auth::guard('yonetim')->user()->id;
    }
}
