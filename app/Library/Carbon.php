<?php

declare(strict_types=1);

namespace App\Library;

use Carbon\Carbon as CarbonCarbon;
use Illuminate\Support\Carbon as SupportCarbon;

use const null, true;
use function in_array, is_string;

/**
 * Class Carbon
 *
 * @package App\Extensions
 */
class Carbon extends SupportCarbon
{
    public $tz_fix = null;
    /**
     * @param array|string $name
     * @param mixed $value
     *
     * @return mixed
     * @throws \ReflectionException
     */
    public function set($name, $value = null)
    {
        if (
            is_string($name) &&
            in_array($name, ['timezone_type', 'date', 'timezone'], true)
        ) {
            $this->{$name} = $value;

            return $this;
        }

        return parent::set($name, $value);
    }

    public static function parse($time = null, $tz = null)
    {
        $date = parent::parse($time, $tz);
        $date->tz_fix = $date->getTimezone();
        return $date;
    }
}
