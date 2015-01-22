<?php

require_once 'training.civix.php';

function training_civicrm_validateForm( $formName, &$fields, &$files, &$form, &$errors ) {
  if ($formName == 'CRM_Contact_Form_Contact') {
    //CRM_Core_Error::debug($fields);    CRM_Core_Error::debug($errors); exit();
    foreach($fields['address'] as $address_nummer => $address) {
      if (empty($address['postal_code'])) {
        $errors['address['.$address_nummer.'][postal_code]'] = ts('Postal code is required');
      }
    }
  }
}

function _getMenuKeyMax($menuArray) {
  $max = array(max(array_keys($menuArray)));
  foreach ($menuArray as $v) {
    if (!empty($v['child'])) {
      $max[] = _getMenuKeyMax($v['child']);
    }
  }
  return max($max);
}

function training_civicrm_navigationMenu(&$params) {
  //  Get the maximum key of $params
  $maxKey = _getMenuKeyMax($params);
  $params[$maxKey + 1] = array(
      'attributes' => array(
          'label' => 'Training',
          'name' => 'Training',
          'url' => null,
          'permission' => null,
          'operator' => null,
          'separator' => null,
          'parentID' => null,
          'navID' => $maxKey + 1,
          'active' => 1
      ),
      'child' => array(
          '1' => array(
              'attributes' => array(
                  'label' => 'Greeter',
                  'name' => 'Greeter',
                  'url' => 'civicrm/greeter',
                  'permission' => 'access CiviCRM',
                  'operator' => null,
                  'separator' => 1,
                  'parentID' => $maxKey + 1,
                  'navID' => $maxKey + 2,
                  'active' => 1
              ),
              'child' => null
          )));
}

/**
 * Implementation of hook_civicrm_config
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function training_civicrm_config(&$config) {
  _training_civix_civicrm_config($config);
}

/**
 * Implementation of hook_civicrm_xmlMenu
 *
 * @param $files array(string)
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function training_civicrm_xmlMenu(&$files) {
  _training_civix_civicrm_xmlMenu($files);
}

/**
 * Implementation of hook_civicrm_install
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function training_civicrm_install() {
  _training_civix_civicrm_install();
}

/**
 * Implementation of hook_civicrm_uninstall
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function training_civicrm_uninstall() {
  _training_civix_civicrm_uninstall();
}

/**
 * Implementation of hook_civicrm_enable
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function training_civicrm_enable() {
  _training_civix_civicrm_enable();
}

/**
 * Implementation of hook_civicrm_disable
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function training_civicrm_disable() {
  _training_civix_civicrm_disable();
}

/**
 * Implementation of hook_civicrm_upgrade
 *
 * @param $op string, the type of operation being performed; 'check' or 'enqueue'
 * @param $queue CRM_Queue_Queue, (for 'enqueue') the modifiable list of pending up upgrade tasks
 *
 * @return mixed  based on op. for 'check', returns array(boolean) (TRUE if upgrades are pending)
 *                for 'enqueue', returns void
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function training_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _training_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implementation of hook_civicrm_managed
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function training_civicrm_managed(&$entities) {
  _training_civix_civicrm_managed($entities);
}

/**
 * Implementation of hook_civicrm_caseTypes
 *
 * Generate a list of case-types
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function training_civicrm_caseTypes(&$caseTypes) {
  _training_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implementation of hook_civicrm_alterSettingsFolders
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function training_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _training_civix_civicrm_alterSettingsFolders($metaDataFolders);
}
