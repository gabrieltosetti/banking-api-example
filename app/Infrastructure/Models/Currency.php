<?php

namespace App\Infrastructure\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    /**
     * @param string $code 
     * @return $this|null 
     */
    public static function findByCode(string $code) {
        if (!$code) {
            throw new \Exception('Missing code currency.');
        }

        return self::where('code', $code)->first();
    }
}
