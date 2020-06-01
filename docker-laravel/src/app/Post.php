<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    /**
     * Declare soft dalete.
     *
     * @var array
     */
    use SoftDeletes;
    protected $table = 'posts';
    protected $dates = ['deleted_at'];
    /**
     * リレーション (従属の関係)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() // 単数形
    {
        return $this->belongsTo('App\User')
        ->latest();
    }
    public function reviews()
    {
        return $this->hasMany('App\Review')
        ->latest();
    }
}
