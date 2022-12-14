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
      id VARCHAR(36) NOT NULL DEFAULT '',
      created_by VARCHAR(255) NOT NULL DEFAULT '',

      category_id VARCHAR(36) NOT NULL DEFAULT '',
      title VARCHAR(255) NOT NULL DEFAULT '',
      description LONGTEXT NOT NULL DEFAULT '',
      buy_price DECIMAL(5,2) NOT NULL DEFAULT 0,
      sell_price DECIMAL(5,2) DEFAULT 0,
      transfer_fee DECIMAL(2,2) NOT NULL DEFAULT 0,
      status INTEGER NOT NULL DEFAULT 0,

      created_at TIMESTAMP(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
      updated_at TIMESTAMP(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
      deleted_at TIMESTAMP(6),

      PRIMARY KEY  (id),
      FOREIGN KEY  (category_id) REFERENCES $this->fkTableName(id) ON DELETE CASCADE ON UPDATE CASCADE
    ) $this->charset;");
  }

  function tableName() {
    return $this->tableName;
  }
}

$registerEntity = new Product();

// DROP TABLE wp_product_category;
// DROP TABLE wp_product;