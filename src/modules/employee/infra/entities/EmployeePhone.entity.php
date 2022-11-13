<?php
class EmployeePhone {
  function __construct() {
    global $wpdb;
    $this->charset = $wpdb->get_charset_collate();
    $this->tableName = $wpdb->prefix . 'employee_phone';

    $this->fkTable = new Employee();
    $this->fkTableName = $this->fkTable->tableName();

    add_action('activate_wp-rest-api/rest-api.php', array($this, 'registerEntity'));
  }

  function registerEntity() {
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');    
    
    dbDelta("CREATE TABLE $this->tableName (
      id VARCHAR(36) NOT NULL DEFAULT '',

      employee_id VARCHAR(36) NOT NULL DEFAULT '',
      phone_number VARCHAR(11) NOT NULL DEFAULT '',
      phone_type ENUM('cellphone', 'residential', 'work'),
      is_whatsapp TINYINT(1) NOT NULL DEFAULT 0,
      principal TINYINT(1) NOT NULL DEFAULT 0,

      created_at TIMESTAMP(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
      updated_at TIMESTAMP(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),

      PRIMARY KEY  (id),
      FOREIGN KEY  (employee_id) REFERENCES $this->fkTableName(id) ON DELETE CASCADE ON UPDATE CASCADE
    ) $this->charset;");
  }

  function tableName() {
    return $this->tableName;
  }
}

$registerEntity = new EmployeePhone();
