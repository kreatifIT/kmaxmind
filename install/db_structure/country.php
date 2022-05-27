<?php

use Kreatif\kmaxmind\Country;
use yform\usability\Usability;


$table = Country::getDbTable();
$prio  = 0;

Usability::ensureValueField($table, 'ip', 'ip', [
    'prio' => $prio++,
], [
    'list_hidden' => 1,
    'search'      => 0,
    'label'       => 'IP',
    'db_type'     => 'varchar(191)',
]);

Usability::ensureValueField($table, 'in_european_union', 'choice', [
    'list_hidden' => 1,
    'search'      => 0,
    'default'     => 1,
    'label'       => 'In Europa',
    'prio'        => $prio++,
], [
    'db_type'    => 'text',
    'choices'    => json_encode(['Ja' => '1', 'Nein' => '0']),
    'attributes' => json_encode(['readonly' => 'readonly']),
]);


Usability::ensureValueField($table, 'isocode_a2', 'text', [
    'prio' => $prio++,
], [
    'list_hidden' => 1,
    'search'      => 0,
    'label'       => 'ISO 3166-1 alpha-2',
    'db_type'     => 'varchar(191)',
]);

Usability::ensureValidateField($table, 'isocode_a2', 'empty', [
    'prio' => $prio++,
], [
    'message'      => 'Der Platzhalter muss eindeutig sein',
]);

Usability::ensureValueField($table, 'createdate', 'datestamp', [
    'prio'        => $prio++,
], [
    'list_hidden' => 1,
    'search'      => 0,
    'db_type'    => 'datetime',
    'label'      => 'Erstellt am',
    'format'     => 'Y-m-d H:i:s',
    'only_empty' => 1,
    'show_value' => 1,
]);


$yTable = \rex_yform_manager_table::get($table);
\rex_yform_manager_table_api::generateTableAndFields($yTable);

