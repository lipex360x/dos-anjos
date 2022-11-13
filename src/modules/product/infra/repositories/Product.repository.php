<?php
require_once plugin_dir_path(__FILE__) . '../entities/index.php';

class ProductRepository extends BaseRepository {
  function __construct() {
    $this->entity = new Product();
    $this->tableName = $this->entity->tableName();

    $this->fkTable = new ProductCategory();
    $this->fkTableName = $this->fkTable->tableName();
  }

  function list() {
    global $wpdb;

    $query  = "SELECT P.*, PC.title category_title ";
    $query .= "FROM {$this->tableName} P ";
    $query .= "LEFT JOIN {$this->fkTableName} PC ON PC.id = category_id";

    return $wpdb->get_results($query);
  }

  function show($id) {
    global $wpdb;

    $query  = "SELECT P.*, PC.title category_title ";
    $query .= "FROM {$this->tableName} P ";
    $query .= "LEFT JOIN {$this->fkTableName} PC ON PC.id = category_id ";
    $query .= "WHERE P.id = '{$id}'";
    
    return $wpdb->get_row($query);
  }

  function findByTitle($title) {
    global $wpdb;

    $query = "SELECT * FROM {$this->tableName} WHERE title = '{$title}'";
    
    return $wpdb->get_row($query);
  }
}