<?php
/**
 * status.php
 *
 * Backend of Team module - Team status management
 *
 * @version     1.8
 * @link http://www.nuked-klan.org Clan Management System for Gamers
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @copyright 2001-2015 Nuked-Klan (Registred Trademark)
 */
defined('INDEX_CHECK') or die('You can\'t run this file alone.');

if (! adminInit('Team'))
    return;

require_once 'Includes/nkAction.php';

nkAction_setParams(array(
    'dataName'              => 'teamStatus',
    'tableName'             => TEAM_STATUS_TABLE,
    'titleField_dbTable'    => 'name'
));


/**
 * Callback function for nkAction_list & nkAction_edit functions.
 * Return page title of current action.
 *
 * @param int $id : The Team member id.
 * @return string : The Team title for list or add / edit form.
 */
function getTeamStatusTitle($id = null) {
    global $op;

    if ($op == 'edit') {
        if ($id === null)
            return __('TEAM_STATUS_MANAGEMENT') .' - '. __('ADD_TEAM_STATUS');
        else
            return __('TEAM_STATUS_MANAGEMENT') .' - '. __('EDIT_THIS_TEAM_STATUS');
    }

    return __('TEAM_STATUS_MANAGEMENT');
}

/* Team status save form function */

/**
 * Callback function for nkAction_edit functions.
 * Additional process after check Team status form.
 * Check Team status options fields.
 *
 * @param array $data : The valid data issue of form submission.
 * @param int $id : The Team status id.
 * @return bool
 */
function postCheckformTeamStatusValidation($data, $id) {
    if ($id === null) {
        $check = nkDB_totalNumRows(
            'FROM '. TEAM_STATUS_TABLE .'
            WHERE name = '. nkDB_escape($data['name'])
        );

        if ($check >= 1) {
            printNotification(__('TEAM_STATUS_ALREADY_EXIST'), 'error');
            return false;
        }
    }

    return true;
}


// Action handle
switch ($GLOBALS['op']) {
    case 'edit' :
        // Display Team status form for addition / editing.
        nkAction_edit();
        break;

    case 'save' :
        // Save / modify Team status.
        nkAction_save();
        break;

    case 'delete' :
        // Delete Team status.
        nkAction_delete();
        break;

    default:
        // Display Team status list.
        nkAction_list();
        break;
}

?>