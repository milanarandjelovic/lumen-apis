<?php

namespace App\Models;

trait Rateable
{
    public function ratings()
    {
       return $this->morphMany(Rating::class, 'rateable');
    }
}
