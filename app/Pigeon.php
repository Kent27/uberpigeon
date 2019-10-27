<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pigeon extends Model
{
    const STATUS_AVAILABLE = 0;
    const STATUS_DELIVERING = 1;
    const STATUS_DOWNTIME = 2;
}
