<?php 
require_once plugin_dir_path(__FILE__) . '../useCases/index.php';

class CreateEmployeeController {
  function __construct() {
    $this->route = '/employee';
    $this->auth = new Authenticate();
    $this->useCase = new CreateEmployeeUseCase();

    add_action('rest_api_init', array($this, 'registerRoute'));
  }

  function execute($request) {
    // return $this->auth->getHeaders();

    if(!$this->auth->checkUser()) {
      return new WP_Error('permission', 'user not allowed', array('status' => 401));
    }
    
    $data['employee']['created_by'] = wp_get_current_user()->user_email;
    
    $data['employee']['name'] = sanitize_text_field($request['name']);
    $data['employee']['cpf'] = $request['cpf'];
    $data['employee']['email'] = sanitize_email($request['email']);
    $data['employee']['genre'] = sanitize_text_field($request['genre']);
    $data['address'] = $request['address'];
    $data['phone'] = $request['phone'];

    // return $data;

    $useCaseResponse = $this->useCase->execute($data);
    return rest_ensure_response($useCaseResponse);
  }

  // Route
  function registerRoute() {
    $rest_params = array(
      'methods'   => WP_REST_Server::CREATABLE,
      'callback'  => array($this, 'execute'),
    );
    register_rest_route('api', $this->route, array($rest_params));
  }
}

$registerController = new CreateEmployeeController();
