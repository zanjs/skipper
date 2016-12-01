<?php

namespace Anla\Skipper\Models;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as AuthUser;
use Anla\Skipper\Traits\SkipperUser;

class User extends AuthUser
{
    use SkipperUser;

    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('F jS, Y h:i A');
    }

    public function setCreatedAtAttribute($value)
    {
        $this->attributes['created_at'] = Carbon::parse($value)->format('Y-m-d H:i:s');
    }
}
