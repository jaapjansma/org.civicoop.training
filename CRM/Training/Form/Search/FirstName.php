<?php

class CRM_Training_Form_Search_FirstName extends CRM_Contact_Form_Search_Custom_Base implements CRM_Contact_Form_Search_Interface {

  function buildForm(&$form) {
    CRM_Utils_System::setTitle(ts('First name search'));
    $form->add('text',
      'first_name',
      ts('First Name'),
      TRUE
    );
    $form->setDefaults(array(
      'first_name' => 'Jan',
    ));
    $form->assign('elements', array('first_name'));
  }

  function summary() {
    return NULL;
  }

  function &columns() {
    // return by reference
    $columns = array(
      ts('Contact Id') => 'contact_id',
      ts('Name') => 'first_name',
    );
    return $columns;
  }

  function all($offset = 0, $rowcount = 0, $sort = NULL, $includeContactIDs = FALSE, $justIDs = FALSE) {
    // delegate to $this->sql(), $this->select(), $this->from(), $this->where(), etc.
    return $this->sql($this->select(), $offset, $rowcount, $sort, $includeContactIDs, NULL);
  }

  /**
   * Construct a SQL SELECT clause
   *
   * @return string, sql fragment with SELECT arguments
   */
  function select() {
    return "
      contact_a.id           as contact_id  ,
      contact_a.contact_type as contact_type,
      contact_a.first_name    as first_name
    ";
  }

  /**
   * Construct a SQL FROM clause
   *
   * @return string, sql fragment with FROM and JOIN clauses
   */
  function from() {
    return " FROM civicrm_contact contact_a ";
  }

  function where($includeContactIDs = FALSE) {
    $params = array();
    $where = "contact_a.contact_type   = 'Individual' AND contact_a.first_name LIKE %1";
    $first_name = CRM_Utils_Array::value('first_name', $this->_formValues);
    $params[1] = array('%'.$first_name.'%', 'String');
    return $this->whereClause($where, $params);
  }

  /**
   * Determine the Smarty template for the search screen
   *
   * @return string, template path (findable through Smarty template path)
   */
  function templateFile() {
    return 'CRM/Contact/Form/Search/Custom.tpl';
  }

  /**
   * Modify the content of each row
   *
   * @param array $row modifiable SQL result row
   * @return void
   */
  function alterRow(&$row) {
    $row['first_name'] = 'Voornaam: '.$row['first_name'];
  }
}
