<?php
require_once plugin_dir_path(__FILE__) . '../entities/index.php';

class ProductRepository {
  function __construct() {
    $this->entity = new Product();
    $this->tableName = $this->entity->tableName();

    $this->fkTable = new ProductCategory();
    $this->fkTableName = $this->fkTable->tableName();
  }
  
  function create($data) {
    global $wpdb;
    $wpdb->show_errors();

    $data['id'] = wp_generate_uuid4();
    $this->tableName;

    $commit = $wpdb->insert($this->tableName, $data);

    $query = "SELECT * FROM {$this->tableName} ORDER BY created_at DESC";
    $getData = $wpdb->get_row($query);

    if($commit) {
      $response = [
        'code' => 200,
        'message' => 'created',
        'data' => $getData
      ];
    } else {
      
      $response = [
        'code' => 400,
        'message' => 'failed',
        'data' => null
      ];
    }

    return $response;
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

  function delete($id) {
    global $wpdb;

    $query = "SELECT * FROM {$this->tableName} WHERE id = '{$id}'";
    $deletedRow = $wpdb->get_row($query);

    $commit = $wpdb->delete($this->tableName, array('id' => $id));

    if($commit) {
      $response = [
        'code' => 200,
        'message' => 'removed',
        'data' => $deletedRow
      ];
    } else {
      $wpdb->show_errors();
      $response = [
        'code' => 200,
        'message' => 'no deleted',
        'data' => null
      ];
    }

    return $response;
  }

  function update($id, $updateData) {
    global $wpdb;
    $commit = $wpdb->update($this->tableName, $updateData, array('id' => $id));

    $query = "SELECT * FROM {$this->tableName} ORDER BY created_at DESC";
    $getData = $wpdb->get_row($query);
    
    if($commit) {
      $response = [
        'code' => 200,
        'message' => 'updated',
        'data' => $this->show($id)
      ];
    } else {
      $wpdb->show_errors();
      $response = [
        'code' => 200,
        'message' => 'no updated',
        'data' => null
      ];
    }

    return $response;
  }

  function getSchema() {
    global $wpdb;

    $query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '{$this->tableName}'";
    $data = $wpdb->get_results($query);
    
    $schema = array();
    foreach ($data as $key => $value) {
      if (
        $value->COLUMN_NAME === 'id' || 
        $value->COLUMN_NAME === 'created_by' ||
        $value->COLUMN_NAME === 'created_at' ||
        $value->COLUMN_NAME === 'updated_at' ||
        $value->COLUMN_NAME === 'deleted_at'
      ) continue;

      array_push($schema, $value->COLUMN_NAME);
    }

    return $schema;
  }
}