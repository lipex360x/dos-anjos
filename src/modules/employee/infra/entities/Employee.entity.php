<?php
class Employee {
  function __construct() {
    global $wpdb;
    $this->charset = $wpdb->get_charset_collate();
    $this->tableName = $wpdb->prefix . 'employee';

    add_action('activate_wp-rest-api/rest-api.php', array($this, 'registerEntity'));
  }

  function registerEntity() {
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');    
    
    dbDelta("CREATE TABLE $this->tableName (
      id VARCHAR(36) NOT NULL DEFAULT '',
      created_by VARCHAR(255) NOT NULL DEFAULT '',

      name VARCHAR(255) NOT NULL DEFAULT '',
      cpf VARCHAR(11) NOT NULL DEFAULT '',
      email VARCHAR(255) NOT NULL DEFAULT '',
      genre ENUM('male', 'female', 'other'),
      status TINYINT(1) NOT NULL DEFAULT 0,

      created_at TIMESTAMP(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
      updated_at TIMESTAMP(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
      deleted_at TIMESTAMP(6),

      PRIMARY KEY  (id),
      CONSTRAINT cpf_unique UNIQUE (cpf)
    ) $this->charset;");
  }

  function tableName() {
    return $this->tableName;
  }
}

$registerEntity = new Employee();
