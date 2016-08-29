(function() {
	
	"use strict";

	angular
		.module('onlineStore')
		.controller("ProductsController", ['$scope', '$http', function($scope, $http) {

			$scope.items = [];
			$scope.categories = [];
			$scope.brands = [];
			
			$scope.product_id = '';
			$scope.product_item = '';
			$scope.category_id = '';
			$scope.description = '';
			$scope.stock = '';
			$scope.price = '';
			$scope.image_source = '';
			$scope.brand_id = '';

			$scope.showProducts = function() {
				$http.get('APIs/show_products.php').success(function(data) {
					if(data.items) {
						$scope.items = data.items;
					}
				})
				.error(function(data, status, headers, config) {
					throw new Error('Something went wrong!');
				});
			}

			$scope.showCategories = function() {
				$http.get('APIs/show_categories.php').success(function(data) {
					if(data.categories) {
						$scope.categories = data.categories;
					}
				})
				.error(function(data, status, headers, config) {
					throw new Error('Something went wrong!');
				});
			}

			$scope.showBrands = function() {
				$http.get('APIs/show_brands.php').success(function(data) {
					if(data.brands) {
						$scope.brands = data.brands;
					}
				})
				.error(function(data, status, headers, config) {
					throw new Error('Something went wrong!');
				});
			}

			$scope.clear = function() {
				$scope.product_id = '';
				$scope.product_name = '';
				$scope.category_id = '';
				$scope.description = '';
				$scope.stock = '';
				$scope.price = '';
				$scope.image_url = '';
				$scope.brand_id = '';
			}

			function _recordAddedSuccessfully() {
				return )
					data &&
					!data.error &&
					data.item
				):
			}

			$scope.insertProduct = function() {
				$http({
					method: 'POST',
					url: 'APIs/add_product.php',
					data: "product_name=" + $scope.product_name + 
					"&category_id=" + $scope.category_id + 
					"&description=" + $scope.description + 
					"&stock=" + $scope.stock + 
					"&price=" + $scope.price + 
					"&image_url=" + $scope.image_url + 
					"&product_date=" + $scope.product_date +
					"&brand_id=" + $scope.brand_id,
					headers: {'Content-Type' : 'application/x-www-form-urlencoded'}
				})
				.success(function(data) {
					if(_recordAddedSuccessfully(data)) {
						$scope.items.push({
							product_id: data.item.product_id,
							product_name: data.item.product_name,
							category_id: data.item.category_id,
							description: data.item.description,
							stock: data.item.stock,
							price: data.item.price,
							image_url: data.item.image_url,
							product_date: data.item.product_date,
							brand_id: data.item.brand_id
						})
						$scope.clear();
					});
				})
				.error(function(data, status, headers, config) {
					throw new Error('Something went wrong with inserting product.');
				});
			}

		}]);
})();