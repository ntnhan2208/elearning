<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Language extends Model
{
//    use LogsActivity;
    protected $table = 'languages';

    protected $fillable = [
        'name','slug','code','flag','status','default'
    ];

    protected static $logAttributes = [
        'name','slug','code','flag','status','default'
    ];

    public $timestamps = true;

    protected $casts = [
        'is_default' => 'boolean'
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeDefault($query)
    {
        return $query->where('default', 1);
    }

    public static function boot()
    {
        parent::boot();

        self::created(function($model){
            if($model->default == 1){
                $model->where('default', 1)->where('id', '!=' , $model->id)->update(['default' => 0]);
            }
        });

        self::updated(function($model){
            if($model->default == 1){
                $model->where('default', 1)->where('id', '!=' , $model->id)->update(['default' => 0]);
            }
        });

        self::deleting(function($model){
            if($model->default == 1){
                $model->first()->update(['default' => 1]);
            }
        });
    }
}
