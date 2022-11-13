<?php
require_once plugin_dir_path(__FILE__) . '../entities/index.php';

class ProductCategoryRepository extends BaseRepository {
  function __construct() {
    $this->entity = new ProductCategory();
    $this->tableName = $this->entity->tableName();
  }
  
  function findByTitle($title) {
    global $wpdb;

    $query = "SELECT * FROM {$this->tableName} WHERE title = '{$title}'";
    
    return $wpdb->get_row($query);
  }
}