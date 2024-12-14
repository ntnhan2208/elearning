<?php
namespace App\Helpers\Utility;
use Carbon\Carbon;
use App;

class Google2Fa{

    public static function makeSecretCode(){
        $google2fa = app('pragmarx.google2fa');
        return $google2fa->generateSecretKey();
    }

    public static function makeQRImage($user){
        $google2fa = app('pragmarx.google2fa');
        $QRImage = $google2fa->getQRCodeInline(
            config('app.name').$user->name,
            $user->email,
            $user->secret_code
        );
        return $QRImage;
    }
    public static function makeBoth($user){
        $google2fa = app('pragmarx.google2fa');
        $secretCode = $google2fa->generateSecretKey();
        $QRImage = $google2fa->getQRCodeInline(
            config('app.name').$user->name,
            $user->email,
            $user->secret_code
        );
        return ['QRImage' => $QRImage, 'secretCode' => $secretCode];
    }

}
