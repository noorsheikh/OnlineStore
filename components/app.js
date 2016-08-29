angular
	.module('onlineStore', [
		'ngRoute'
	])
	.config(['$routeProvider', function($routeProvider) {
		$routeProvider
			.when('/', {
				templateUrl: 'templates/show_products.html',
				controller: 'ProductsController'
			})
			.when('/add_product', {
				templateUrl: 'templates/add_product.html',
				controller: 'ProductsController'
			})
			.when('/update_product', {
				templateUrl: 'templates/update_product.html',
				controller: 'ProductsController'
			})
			.when('/product_details/:id', {
				templateUrl: 'templates/product_details.html',
				controller: 'Productscontroller'
			})
			.otherwise({
				redirectTo: '/'
			});
}]);