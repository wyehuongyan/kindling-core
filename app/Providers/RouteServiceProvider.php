<?php namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider {

	/**
	 * This namespace is applied to the controller routes in your routes file.
	 *
	 * In addition, it is set as the URL generator's root namespace.
	 *
	 * @var string
	 */
	protected $namespace = 'App\Http\Controllers';

	/**
	 * Define your route model bindings, pattern filters, etc.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function boot(Router $router)
	{
		parent::boot($router);

		//
        $router->model('user', 'App\Models\User');
        $router->model('piece', 'App\Models\Piece');
        $router->model('outfit', 'App\Models\Outfit');
        $router->model('deliveryOption', 'App\Models\DeliveryOption');
        $router->model('cart', 'App\Models\Cart');
        $router->model('cartItem', 'App\Models\CartItem');
        $router->model('shopOrder', 'App\Models\ShopOrder');
        $router->model('shopOrderRefund', 'App\Models\ShopOrderRefund');
        $router->model('userOrder', 'App\Models\UserOrder');
        $router->model('userShippingAddress', 'App\Models\UserShippingAddress');
	}

	/**
	 * Define the routes for the application.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function map(Router $router)
	{
		$router->group(['namespace' => $this->namespace], function($router)
		{
			require app_path('Http/routes.php');
		});
	}

}
