<?php
/**
 * @author Jaap Jansma (CiviCooP) <jaap.jansma@civicoop.org>
 * @license http://www.gnu.org/licenses/agpl-3.0.html
 */

class CRM_Civivolunteertokens_Roster {

  /**
   * @var  CRM_Civivolunteertokens_Roster
   */
  private static $singleton;

  private $token_name = 'volunteer';

  private $scheduled_reminder_token = false;

  private $activity_type_id;

  private $civivolunteer_custom_group;

  private $civivolunteer_needs_field;

  private $roles;

  private $tableAttributes = 'border="0" style="width: 100%; border-collapse: collapse; text-align: left; font-size: 13px; font-family: Arial, Helvetica, sans-serif; color: #3f3f3f;"';
  private $cellAttributes = 'style="padding: 0.5em 1em 0.5em 0em; width: 33%; border-bottom: 1px dotted silver;"';

  private function __construct() {
    $this->activity_type_id = civicrm_api3('OptionValue', 'getvalue', array('return' => 'value', 'option_group_id' => 'activity_type', 'name' => 'Volunteer'));
    $this->civivolunteer_custom_group = civicrm_api3('CustomGroup', 'getsingle', array('name' => 'CiviVolunteer'));
    $this->civivolunteer_needs_field = civicrm_api3('CustomField', 'getsingle', array('name' => 'Volunteer_Need_Id', 'custom_group_id' => $this->civivolunteer_custom_group['id']));
    $roles = civicrm_api3('OptionValue', 'get', array('option_group' => 'volunteer_role', 'option.limit' => 9999));
    foreach($roles['values'] as $role) {
      $this->roles[$role['value']] = $role['label'];
    }
  }

  /**
   * @return CRM_Civivolunteertokens_Roster
   */
  public static function singleton() {
    if (!self::$singleton) {
      self::$singleton = new CRM_Civivolunteertokens_Roster();
    }
    return self::$singleton;
  }

  public function tokenValues(&$values, $cids, $tokens = array()) {
    $this->scheduled_reminder_token = false;
    if (is_array($values) && isset($values['activity.activity_id'])) {
      $this->scheduled_reminder_token = true;
    }

    if ($this->isTokenInTokens($tokens, 'roster')) {
      $this->rosterToken($values, $cids, 'roster');
    }
    if ($this->isTokenInTokens($tokens, 'roster_fr')) {
      $this->rosterTokenFR($values, $cids, 'roster_fr');
    }
    if ($this->isTokenInTokens($tokens, 'roster_de')) {
      $this->rosterTokenDE($values, $cids, 'roster_de');
    }
    if ($this->isTokenInTokens($tokens, 'roster_nl')) {
      $this->rosterTokenNL($values, $cids, 'roster_nl');
    }
  }

  private function rosterToken(&$values, $cids, $token) {
    $contact_ids = $cids;
    if (!is_array($contact_ids)) {
      $contact_ids = array($contact_ids);
    }

    $tokenValues = array();
    $rosterData = $this->getRosterInformation($contact_ids);
    foreach($contact_ids as $contact_id) {
      $tokenValues[$contact_id] = '';
      if (isset($rosterData[$contact_id])) {
        $strRoster = '<table '.$this->tableAttributes.'><tr><th '.$this->cellAttributes.'>'.ts('Location').'</th><th '.$this->cellAttributes.'>'.ts('Role').'</th><th '.$this->cellAttributes.'>'.ts('Date').'</th></tr>';
        foreach($rosterData[$contact_id] as $rosterLine) {
          $strRoster .= '<tr><td '.$this->cellAttributes.'>'.$rosterLine['project'].'</td><td '.$this->cellAttributes.'>'.$rosterLine['role'].'</td><td '.$this->cellAttributes.'>'.$rosterLine['start_time'].'</td></tr>';
        }
        $strRoster .= '</table>';
        $tokenValues[$contact_id] = $strRoster;
      }
    }

    $this->setTokenValue($values, $cids, $token, $tokenValues);
  }

  private function rosterTokenFR(&$values, $cids, $token) {
    $contact_ids = $cids;
    if (!is_array($contact_ids)) {
      $contact_ids = array($contact_ids);
    }

    $tokenValues = array();
    $rosterData = $this->getRosterInformation($contact_ids);
    foreach($contact_ids as $contact_id) {
      $tokenValues[$contact_id] = '';
      if (isset($rosterData[$contact_id])) {
        $strRoster = '<table '.$this->tableAttributes.'><tr><th '.$this->cellAttributes.'>Lieu</th><th '.$this->cellAttributes.'>Fonction</th><th '.$this->cellAttributes.'>Horaires</th></tr>';
        foreach($rosterData[$contact_id] as $rosterLine) {
          $strRoster .= '<tr><td '.$this->cellAttributes.'>'.$rosterLine['project'].'</td><td '.$this->cellAttributes.'>'.$rosterLine['role'].'</td><td '.$this->cellAttributes.'>'.$rosterLine['start_time'].'</td></tr>';
        }
        $strRoster .= '</table>';
        $tokenValues[$contact_id] = $strRoster;
      }
    }

    $this->setTokenValue($values, $cids, $token, $tokenValues);
  }

  private function rosterTokenNL(&$values, $cids, $token) {
    $contact_ids = $cids;
    if (!is_array($contact_ids)) {
      $contact_ids = array($contact_ids);
    }

    $tokenValues = array();
    $rosterData = $this->getRosterInformation($contact_ids);
    foreach($contact_ids as $contact_id) {
      $tokenValues[$contact_id] = '';
      if (isset($rosterData[$contact_id])) {
        $strRoster = '<table '.$this->tableAttributes.'><tr><th '.$this->cellAttributes.'>Locatie</th><th '.$this->cellAttributes.'>Functie</th><th '.$this->cellAttributes.'>Uurrooster</th></tr>';
        foreach($rosterData[$contact_id] as $rosterLine) {
          $strRoster .= '<tr><td '.$this->cellAttributes.'>'.$rosterLine['project'].'</td><td '.$this->cellAttributes.'>'.$rosterLine['role'].'</td><td '.$this->cellAttributes.'>'.$rosterLine['start_time'].'</td></tr>';
        }
        $strRoster .= '</table>';
        $tokenValues[$contact_id] = $strRoster;
      }
    }

    $this->setTokenValue($values, $cids, $token, $tokenValues);
  }

  private function rosterTokenDE(&$values, $cids, $token) {
    $contact_ids = $cids;
    if (!is_array($contact_ids)) {
      $contact_ids = array($contact_ids);
    }

    $tokenValues = array();
    $rosterData = $this->getRosterInformation($contact_ids);
    foreach($contact_ids as $contact_id) {
      $tokenValues[$contact_id] = '';
      if (isset($rosterData[$contact_id])) {
        $strRoster = '<table '.$this->tableAttributes.'><tr><th '.$this->cellAttributes.'>Ort</th><th '.$this->cellAttributes.'>Funktion</th><th '.$this->cellAttributes.'>Zeitplan</th></tr>';
        foreach($rosterData[$contact_id] as $rosterLine) {
          $strRoster .= '<tr><td '.$this->cellAttributes.'>'.$rosterLine['project'].'</td><td '.$this->cellAttributes.'>'.$rosterLine['role'].'</td><td '.$this->cellAttributes.'>'.$rosterLine['start_time'].'</td></tr>';
        }
        $strRoster .= '</table>';
        $tokenValues[$contact_id] = $strRoster;
      }
    }

    $this->setTokenValue($values, $cids, $token, $tokenValues);
  }

  private function getRosterInformation($contact_ids) {
    $strContactIds = implode(", ", $contact_ids);
    $sql = "SELECT volunteer_project.title, 
            volunteer_need.start_time, 
	    volunteer_need.end_time,
	    volunteer_need.duration,
            volunteer_need.role_id,
            activity_contact.contact_id
            FROM civicrm_activity activity
            INNER JOIN `{$this->civivolunteer_custom_group['table_name']}` activity_volunteer ON activity_volunteer.entity_id = activity.id
            INNER JOIN civicrm_volunteer_need volunteer_need ON volunteer_need.id = activity_volunteer.`{$this->civivolunteer_needs_field['column_name']}`
            INNER JOIN civicrm_volunteer_project volunteer_project ON volunteer_project.id = volunteer_need.project_id
            INNER JOIN civicrm_activity_contact activity_contact ON activity_contact.activity_id = activity.id
            WHERE activity.activity_type_id = '{$this->activity_type_id}'
            AND activity.activity_date_time >= NOW()
            AND volunteer_project.is_active = '1'
            AND activity.is_current_revision = '1' 
            AND activity.is_deleted = '0'
            AND activity_contact.record_type_id = '1'
            AND activity_contact.contact_id IN ({$strContactIds})
            ORDER BY activity_contact.contact_id, activity.activity_date_time";
    $dao = CRM_Core_DAO::executeQuery($sql);
    $return = array();
    while($dao->fetch()) {
      $startTime = new DateTime($dao->start_time);
      $strStartTime = $startTime->format('d-m-Y H:i');
      $strEndTime = '';
      if (!empty($dao->end_datime)) {
        $endTime = new DateTime($dao->end_time);
        $strStartTime .= ' - ' . $endTime->format('H:i');   
      } elseif (!empty($dao->duration)) {
        $startTime->modify('+' . $dao->duration.' minutes');
        $strStartTime .= ' - ' . $startTime->format('H:i');
      }
      $role = '';
      if (isset($this->roles[$dao->role_id])) {
        $role = $this->roles[$dao->role_id];
      }
      $return[$dao->contact_id][] = array(
        'project' => $dao->title,
        'start_time' => $strStartTime,
        'role' => $role,
      );
    }
    foreach($contact_ids as $contact_id) {
        $return[$contact_id][] = array(
            'project' => 'jaap',
            'start_time' => '10 am till 12pm',
            'role' => 'hhhhh ahhh ahh',
        );
    }
    return $return;
  }

  /**
   * Check whether a token is present in the set of tokens.
   *
   * @param $tokens
   * @param $token
   * @return bool
   */
  protected function isTokenInTokens($tokens, $token) {
    if (in_array($token, $tokens)) {
      return true;
    } elseif (isset($tokens[$token])) {
      return true;
    } elseif (isset($tokens[$this->token_name]) && in_array($token, $tokens[$this->token_name])) {
      return true;
    } elseif (isset($tokens[$this->token_name][$token])) {
      return true;
    } elseif ($this->scheduled_reminder_token) {
      return true;
    }
    return FALSE;
  }

  /**
   * Set the value for a token and checks whether cids is an array or not.
   *
   * @param $values
   * @param $cids
   * @param $token
   * @param $tokenValues
   */
  protected function setTokenValue(&$values, $cids, $token, $tokenValues) {
    if (is_array($cids)) {
      foreach ($cids as $cid) {
        $values[$cid][$this->token_name . '.' . $token] = $tokenValues[$cid];
      }
    }
    else {
      $values[$this->token_name . '.' . $token] = $tokenValues[$cids];
    }
  }

}
