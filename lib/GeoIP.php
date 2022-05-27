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
    /**
     * @return Client
     * @deprecated use specific method instead ( f.e. getIsoCodeByIp, where lookup is made in the cache table at first glance )
     */
    public static function factory()
    {
        require_once rex_path::addon('kmaxmind', 'vendor/autoload.php');
        $client = new Client(Settings::getValue('account_id'), Settings::getValue('license_key')); //116063
        return $client;
    }

    public static function getIsoCodeByIp(string $ip): ?string
    {
        require_once rex_path::addon('kmaxmind', 'vendor/autoload.php');

        self::removeExpiredEntries();
        $foundCountry = Country::findByIp($ip);

        if ($foundCountry) {
            return $foundCountry->getValue('isocode_a2');
        } else {
            $client   = new Client(Settings::getValue('account_id'), Settings::getValue('license_key')); //116063
            $response = $client->country($ip);
            if ($response->country && $response->country->isoCode) {
                $country = Country::create();
                $country->setValue('ip', $ip);
                $country->setValue('in_european_union', $response->country->isInEuropeanUnion);
                $country->setValue('isocode_a2', $response->country->isoCode);
                $country->save();
                return $response->country->isoCode;
            }
        }
        return null;
    }


    public static function removeExpiredEntries(): void
    {
        $expirationTime = Settings::getValue('cache_expiration_time') ?: 3600;
        $now            = time();

        /** @var Country[] $expiredEntries */
        $expiredEntries = Country::query()->where('createdate', date('Y-m-d H:i:s', $now - $expirationTime), '<')->find();

        foreach ($expiredEntries as $expiredEntry) {
            $expiredEntry->delete();
        }
    }
}