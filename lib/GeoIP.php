<?php

/**
 * @author Kreatif GmbH
 * @author a.platter@kreatif.it
 * Date: 19.05.21
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Kreatif\kmaxmind;

use rex_path;
use GeoIp2\WebService\Client;

class GeoIP
{
    public static function factory()
    {
        require_once rex_path::addon('kmaxmind', 'vendor/autoload.php');
        $client = new Client(Settings::getValue('account_id'), Settings::getValue('license_key')); //116063
        return $client;
    }
}