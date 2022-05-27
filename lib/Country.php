<?php

namespace Kreatif\kmaxmind;

use yform\usability\Model;


class Country extends Model
{
    const TABLE = '{PREFIX}maxmind_country_cache';

    public static function findByIp(string $ip): ?self
    {
        return parent::query()->where('ip', $ip)->findOne();
    }
}