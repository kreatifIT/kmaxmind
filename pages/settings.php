<?php

/**
 * @author Kreatif GmbH
 * @author a.platter@kreatif.it
 * Date: 01.04.21
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$action = rex_get('action', 'string');
$form   = rex_config_form::factory('kmaxmind');


$field = $form->addTextField('account_id', null, ["class" => "form-control"]);
$field->setLabel('MaxMind Account-ID');

$field = $form->addTextField('license_key', null, ["class" => "form-control"]);
$field->setLabel('MaxMind License key');

$formOutput = $form->get();

$fragment = new rex_fragment();
$fragment->setVar('class', 'edit kmaxmind-panel', false);
$fragment->setVar('body', $formOutput, false);
echo $fragment->parse('core/page/section.php');