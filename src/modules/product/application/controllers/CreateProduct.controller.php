<?php 
require_once plugin_dir_path(__FILE__) . '../../../../core/helpers/index.php';
require_once plugin_dir_path(__FILE__) . '../useCases/index.php';

class CreateProductController {
  function __construct() {
    $this->route = '/product';
    $this->auth = new Authenticate();
    $this->useCase = new CreateProductUseCase();

    add_action('rest_api_init', array($this, 'registerRoute'));
  }

  function execute($request) {
    // return $this->auth->getHeaders();

    if(!$this->auth->checkUser()) {
      return new WP_Error('permission', 'user not allowed', array('status' => 401));
    }
    
    $data['created_by'] = wp_get_current_user()->user_email;
    $data['category_id'] = sanitize_text_field($request['category_id']);
    $data['title'] = sanitize_text_field($request['title']);
    $data['description'] = sanitize_text_field($request['description']);
    $data['buy_price'] = $request['buy_price'];
    $data['sell_price'] = $request['sell_price'];
    $data['transfer_fee'] = $request['transfer_fee'];

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

$registerController = new CreateProductController();
