<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    protected $fillable = [
        'absence_date', 'name', 'position' ,'signature', 'created_at', 'updated_at', 'signature_url', 'email', 'topic_id'
    ];

    protected $appends = [
        'signature_url'
    ];

    public function getSignatureUrlAttribute()
    {
        if (empty($this->signature)) {
            return '/img/icon.png';
        } else {
            return 'upload/' . $this->signature;
        }
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id');
    }

}
