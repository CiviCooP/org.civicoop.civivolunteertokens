<?php

require_once 'civivolunteertokens.civix.php';

/**
 * Implements hook_civicrm_tokens().
 *
 * @link https://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_tokens
 *
 * Provide the tokens defined in this extensions
 */
function civivolunteertokens_civicrm_tokens(&$tokens) {
  $tokens['volunteer'] = array(
    'volunteer.roster' => ts('CiviVolunteer Roster'),
    'volunteer.roster_fr' => ts('CiviVolunteer Roster (French)'),
    'volunteer.roster_de' => ts('CiviVolunteer Roster (German)'),
    'volunteer.roster_nl' => ts('CiviVolunteer Roster (Dutch)'),
  );
}

/**
 * Implements hook__civicrm_tokenValues().
 *
 * @link https://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_tokenValues
 *
 * Provide the implementation of the tokens of this extension
 */
function civivolunteertokens_civicrm_tokenValues(&$values, $cids, $job = null, $tokens = array(), $context = null) {
  $tokenClass = CRM_Civivolunteertokens_Roster::singleton();
  $tokenClass->tokenValues($values, $cids, $tokens);
}

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function civivolunteertokens_civicrm_config(&$config) {
  _civivolunteertokens_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function civivolunteertokens_civicrm_xmlMenu(&$files) {
  _civivolunteertokens_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function civivolunteertokens_civicrm_install() {
  _civivolunteertokens_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_postInstall
 */
function civivolunteertokens_civicrm_postInstall() {
  _civivolunteertokens_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function civivolunteertokens_civicrm_uninstall() {
  _civivolunteertokens_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function civivolunteertokens_civicrm_enable() {
  _civivolunteertokens_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function civivolunteertokens_civicrm_disable() {
  _civivolunteertokens_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function civivolunteertokens_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _civivolunteertokens_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function civivolunteertokens_civicrm_managed(&$entities) {
  _civivolunteertokens_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function civivolunteertokens_civicrm_caseTypes(&$caseTypes) {
  _civivolunteertokens_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function civivolunteertokens_civicrm_angularModules(&$angularModules) {
  _civivolunteertokens_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function civivolunteertokens_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _civivolunteertokens_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *
function civivolunteertokens_civicrm_preProcess($formName, &$form) {

} // */

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_navigationMenu
 *
function civivolunteertokens_civicrm_navigationMenu(&$menu) {
  _civivolunteertokens_civix_insert_navigation_menu($menu, NULL, array(
    'label' => ts('The Page', array('domain' => 'org.civicoop.civivolunteertokens')),
    'name' => 'the_page',
    'url' => 'civicrm/the-page',
    'permission' => 'access CiviReport,access CiviContribute',
    'operator' => 'OR',
    'separator' => 0,
  ));
  _civivolunteertokens_civix_navigationMenu($menu);
} // */
