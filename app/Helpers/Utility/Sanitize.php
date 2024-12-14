<?php
namespace App\Helpers\Utility;
use Carbon\Carbon;
use App;

class Sanitize{
    public static function getValueLangByLocale($value, $language = ''){
        $locale = ($language) ? $language : App::getLocale();
        return json_decode($value, true)[$locale];
    }

    public static function showImage($image = ''){
        $image = $image ? $image : 'admin/assets/images/no_img.jpg';
        return asset($image);
    }

    public static function paranoid($string, $allowed = array()){
        $allow = null;
        if (!empty($allowed)) {
            foreach ($allowed as $value)
            {
                $allow .= "\\$value";
            }
        }
        if (!is_array($string)) {
            return preg_replace("/[^{$allow}a-zA-Z0-9]/", '', $string);
        }
        $cleaned = array();
        foreach ($string as $key => $clean) {
            $cleaned[$key] = preg_replace("/[^{$allow}a-zA-Z0-9]/", '', $clean);
        }
        return $cleaned;
    }

    public static function exportDateRange($date_range, $char = '-'){
        $result = [];
        if(!empty($date_range)){
            $tmp = explode($char,$date_range);
            $result['start_day'] = Carbon::parse($tmp[0])->format('Y-m-d H:mm:ss');
            $result['end_day'] = Carbon::parse($tmp[1])->format('Y-m-d H:mm:ss') ;
        }
        return $result;
    }

    public static function stripWhitespace($str) {
        return str_replace(' ', '', $str);
    }

    public static function moveImage($prefix, $image){
        $image->move('images/'.$prefix.'/', $image->getClientOriginalName());
        return $prefix.'/'.$image->getClientOriginalName();
    }
}