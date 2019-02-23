<?php

namespace Changers\Models;

use Illuminate\Database\Eloquent\Model;

class JourneyHistory extends Model
{
    const WALKING_JOURNEY = 'walking';
    const BIKING_JOURNEY = 'biking';
    const DRIVING_JOURNEY = 'driving';
    const FLYING_JOURNEY = 'flying';
    const MOBILITY_TYPES = [self::WALKING_JOURNEY, self::BIKING_JOURNEY , self::DRIVING_JOURNEY , self::FLYING_JOURNEY];

}
