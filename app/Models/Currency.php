<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    public static function findByCode(string $code) {
        if (!$code) {
            throw new \Exception('Missing code currency.');
        }

        return self::where('code', $code)->first();
    }
}
