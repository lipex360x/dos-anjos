<?php
class EmployeeAddress {
  function __construct() {
    global $wpdb;
    $this->charset = $wpdb->get_charset_collate();
    $this->tableName = $wpdb->prefix . 'employee_address';

    $this->fkTable = new Employee();
    $this->fkTableName = $this->fkTable->tableName();

    add_action('activate_wp-rest-api/rest-api.php', array($this, 'registerEntity'));
  }

  function registerEntity() {
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');    
    
    dbDelta("CREATE TABLE $this->tableName (
      id VARCHAR(36) NOT NULL DEFAULT '',
      created_by VARCHAR(255) NOT NULL DEFAULT '',

      employee_id VARCHAR(36) NOT NULL DEFAULT '',
      zipcode VARCHAR(8) NOT NULL DEFAULT '',
      street VARCHAR(255)  NOT NULL DEFAULT '',
      complement VARCHAR(255)  NOT NULL DEFAULT '',
      number_address VARCHAR(255)  NOT NULL DEFAULT '',
      district VARCHAR(255)  NOT NULL DEFAULT '',
      city VARCHAR(255)  NOT NULL DEFAULT '',
      state VARCHAR(255) NOT NULL DEFAULT '',
      country VARCHAR(255) NOT NULL DEFAULT '',

      created_at TIMESTAMP(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
      updated_at TIMESTAMP(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
      deleted_at TIMESTAMP(6),

      PRIMARY KEY  (id),
      FOREIGN KEY  (employee_id) REFERENCES $this->fkTableName(id) ON DELETE CASCADE ON UPDATE CASCADE
    ) $this->charset;");
  }

  function tableName() {
    return $this->tableName;
  }
}

$registerEntity = new EmployeeAddress();
