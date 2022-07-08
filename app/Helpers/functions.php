<?php

use App\Models\Order;
use App\Models\Setting;
use App\Models\User;
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

function price($value)
{
    return number_format($value, 2, ',','.');
}

function dateToBr($date)
{
    return date('d/m/Y', strtotime($date));
}

function dateTimeToBr($date)
{
    return date('d/m/Y H:m', strtotime($date));
}

function mask($mask,$str){

    $str = str_replace(" ","",$str);

    for($i=0;$i<strlen($str);$i++){
        $mask[strpos($mask,"#")] = $str[$i];
    }

    return $mask;

}

function isPermission($uuid, $permission) {

    $user = User::with('permissions')->find($uuid);

    if ($user->permissions->where('slug', $permission)->first()) {

        echo 'SIM';

    } else {

        echo 'NO';

    }

}