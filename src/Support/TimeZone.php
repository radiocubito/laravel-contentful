<?php

namespace Radiocubito\Wordful\Support;

use DateTimeZone;

class TimeZone
{
    public static function all(): array
    {
        $timeZones = array_merge(['UTC'], DateTimeZone::listIdentifiers());

        return array_combine($timeZones, $timeZones);
    }
}
