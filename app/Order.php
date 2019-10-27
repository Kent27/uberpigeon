<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const STATUS_ON_PROGRESS = 0;
    const STATUS_RECEIVED = 1;
    const STATUS_REJECTED = -1;
}
