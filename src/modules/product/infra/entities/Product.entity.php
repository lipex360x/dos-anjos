<?php
class Product {
  function __construct() {
    global $wpdb;

    $this->charset = $wpdb->get_charset_collate();
    $this->tableName = $wpdb->prefix . 'product';
    
    $this->fkTable = new ProductCategory();
    $this->fkTableName = $this->fkTable->tableName();

    add_action('activate_wp-rest-api/rest-api.php', array($this, 'registerEntity'));
  }

  function registerEntity() {
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');    
    
    dbDelta("CREATE TABLE $this->tableName (
      id varchar(36) NOT NULL DEFAULT '',
      created_by varchar(36) NOT NULL DEFAULT '',

      category_id varchar(36) NOT NULL DEFAULT '',

      title varchar(256) NOT NULL DEFAULT '',
      description longtext NOT NULL DEFAULT '',
      buy_price DECIMAL(5,2) NOT NULL DEFAULT 0,
      sell_price DECIMAL(5,2) DEFAULT 0,
      transfer_fee DECIMAL(2,2) NOT NULL DEFAULT 0,
      status INTEGER NOT NULL DEFAULT 0,

      created_at timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
      updated_at timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
      deleted_at timestamp(6),

      PRIMARY KEY  (id),
      FOREIGN KEY  (category_id) REFERENCES $this->fkTableName(id) ON DELETE CASCADE ON UPDATE CASCADE
    ) $this->charset;");
  }

  function tableName() {
    return $this->tableName;
  }
}

$registerEntity = new Product();
