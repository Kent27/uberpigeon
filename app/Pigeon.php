<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Pigeon
 *
 * @property int $id
 * @property string $name
 * @property int $speed
 * @property int $range
 * @property int $cost
 * @property int $downtime
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pigeon newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pigeon newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pigeon query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pigeon whereCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pigeon whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pigeon whereDowntime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pigeon whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pigeon whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pigeon whereRange($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pigeon whereSpeed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pigeon whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pigeon whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Pigeon extends Model
{
    const STATUS_AVAILABLE = 0;
    const STATUS_DELIVERING = 1;
    const STATUS_DOWNTIME = 2;
}
