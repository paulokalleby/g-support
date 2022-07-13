<?php

use Carbon\Carbon;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

function settings($param = null)
{
    $setting = Setting::get()->first();

    if ($param) {

        return $setting->$param;

    }

    return $setting;

}

function orImage($image, $option)
{

    if ($image != null && Storage::disk('public')->exists($image)) {

        return asset('storage/'.$image);

    }else {

        return url('images/static/'.$option);

    }

}

function dateToBr($date)
{
    return Carbon::make($date)->format('d/m/Y');
}

function dateTimeToBr($date)
{
    return Carbon::make($date)->format('d/m/Y H:i:s');
}
