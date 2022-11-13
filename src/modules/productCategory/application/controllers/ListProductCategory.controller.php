<?php 
require_once plugin_dir_path(__FILE__) . '../../../../core/helpers/index.php';
require_once plugin_dir_path(__FILE__) . '../useCases/index.php';

class ListProductCategoryController {
  function __construct() {
    $this->route = '/productCategory';
    $this->auth = new Authenticate();
    $this->useCase = new ListProductCategoryUseCase();

    add_action('rest_api_init', array($this, 'registerRoute'));
  }

  function execute() {
    if(!$this->auth->checkUser()) {
      return new WP_Error('permission', 'user not allowed', array('status' => 401));
    }

    $useCaseResponse = $this->useCase->execute();
    return rest_ensure_response($useCaseResponse);
  }

  // Route
  function registerRoute() {
    $rest_params = array(
      'methods'   => WP_REST_Server::READABLE,
      'callback'  => array($this, 'execute'),
    );
    register_rest_route('api', $this->route, array($rest_params));
  }
}

$registerController = new ListProductCategoryController();
