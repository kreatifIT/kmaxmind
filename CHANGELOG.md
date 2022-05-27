Changelog
=========


Version 1.1.0 – 26.05.2022
--------------------------
### Neue Features
* GeoIP Country Lookups werden nun aus performanten und finanziellen Gründen gecached und nur wenn Eintrag nicht existiert, findet eine Anfrage an MaxMind statt.
* Neues Konfigurationsfeld `cache_expiration_time`. Dort sollte die Cache Ablaufzeit in Sekunden angepasst werden.
* Neue Methode `GeoIp::getIsoCodeByIp()`, die in der Cache Tabelle nachsieht und sonst einen Lookup an MaxMind macht.

### Deprecated
* Die Funktion `GeoIp::factory()` wurde als deprecated markiert, da sie immer einen Lookup bei MaxMind generiert und somit Kosten verursacht.