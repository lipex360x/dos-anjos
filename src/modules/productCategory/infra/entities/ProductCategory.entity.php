<?php
class ProductCategory {
  function __construct() {
    global $wpdb;
    $this->charset = $wpdb->get_charset_collate();
    $this->tableName = $wpdb->prefix . 'product_category';

    add_action('activate_wp-rest-api/rest-api.php', array($this, 'registerEntity'));
  }

  function registerEntity() {
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');    
    
    dbDelta("CREATE TABLE $this->tableName (
      id varchar(36) NOT NULL DEFAULT '',
      created_by VARCHAR(255) NOT NULL DEFAULT '',

      title varchar(255) NOT NULL DEFAULT '',

      created_at timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
      updated_at timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
      deleted_at timestamp(6),

      PRIMARY KEY  (id)
    ) $this->charset;");
  }

  function tableName() {
    return $this->tableName;
  }
}

$registerEntity = new ProductCategory();
