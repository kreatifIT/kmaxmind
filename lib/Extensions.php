<?php


namespace Kreatif\kmaxmind\lib;

use Kreatif\kmaxmind\Country;


class Extensions
{
    public static function init()
    {
        // register model class
        \rex_yform_manager_dataset::setModelClass(Country::getDbTable(), Country::class);
    }
}