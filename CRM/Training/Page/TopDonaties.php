<?php

require_once 'CRM/Core/Page.php';

class CRM_Training_Page_TopDonaties extends CRM_Core_Page {
  function run() {
    // Example: Set the page-title dynamically; alternatively, declare a static title in xml/Menu/*.xml
    CRM_Utils_System::setTitle(ts('Top 10 Donaties'));

    $dao = CRM_Core_DAO::executeQuery("SELECT *
        FROM  `civicrm_contribution` 
        ORDER BY `total_amount` DESC
        LIMIT 0,10");
    
    $topDonaties = array();
    while($dao->fetch()) {
      $topDonaties[] = array(
        'amount' => $dao->total_amount,
        'name' => civicrm_api3('Contact', 'getvalue', array(
          'id' => $dao->contact_id,
          'return' => 'display_name'
        )),
      );
    }
    
    $this->assign('topDonaties', $topDonaties);

    parent::run();
  }
}
