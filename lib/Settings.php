<?php

/**
 * @author Kreatif GmbH
 * @author a.platter@kreatif.it
 * Date: 26.04.21
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Kreatif\kmaxmind;

use rex_addon;


class Settings
{

    public static function getAddon()
    {
        return rex_addon::get('kmaxmind');
    }

    public static function getValue($key)
    {
        $addon = self::getAddon();
        return $addon->getConfig($key);
    }
}