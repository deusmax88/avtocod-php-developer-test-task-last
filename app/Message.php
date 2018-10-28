<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    /**
     * Разрешим mass-assignment всех полей модели
     *
     * @var array
     */
    protected $guarded = [];

    /*
     * Обратное отношение к модели User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(Models\User::class);
    }
}
