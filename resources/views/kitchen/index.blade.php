<!DOCTYPE html>
<html lang="en" ng-app="kitchenApp">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Kontiki</title>

	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/kitchen.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/dark-theme.css') }}" rel="stylesheet">
		
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>		

	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script>

	<script>
	angular.module('kitchenApp', []).controller('kitchenCtl', function($scope, $http) {
	var self = {};
	$scope.app = self;
	self.http = $http;
	self.orders = [];
	self.order_dictionary = {};
	self.refresh_order_items = function(la_order_items) {
		angular.forEach(self.orders, function(existing_order) {
			existing_order.checked = false;
		});
				
		angular.forEach(la_order_items, function(la_order_item) {
			var temp_order;
			if (self.order_dictionary.hasOwnProperty(la_order_item.order_id)) {
				temp_order = self.order_dictionary[la_order_item.order_id];
			}
			else {
				temp_order = new order(la_order_item.order_id, self);
				self.order_dictionary[la_order_item.order_id] = temp_order;
				self.orders.push(temp_order);
			}
			
			temp_order.checked = true;
			temp_order.refresh_item(la_order_item);
		});
		
		angular.forEach(self.orders, function(existing_order) {
			if(existing_order.checked == false){
				var order_index = self.orders.indexOf(existing_order);
				self.orders.splice(order_index, 1);
			}
		});
		
		console.log(self);
	}
	var order_items_api = "/api/kitchen";
	var interval = 3000; // 1000 = 1 second, 3000 = 3 seconds
	
	self.get_update = function() {
		$http.get(order_items_api).then(function success(data) {
				self.refresh_order_items(data);
  				setTimeout(self.get_update, interval);
  			}, function failed (data) {
  			    setTimeout(self.get_update, interval);	
  			});
  
	}
	self.get_update();
});
function order(order_number, app) {
	
	var self = this;
	
	self.checked = false;
	self.order_item_dictionary = {};
	self.order_items = [];
	self.app = app;
	self.order_number = order_number;
	self.refresh_item = function(la_order_item) {
			var temp_order_item;
			if (self.order_item_dictionary.hasOwnProperty(la_order_item.id)){
				temp_order_item = self.order_item_dictionary[la_order_item.id];
			}
			else {
				temp_order_item = new order_item(la_order_item.id, self);
				self.order_item_dictionary[la_order_item.id] = temp_order_item;
				self.order_items.push(temp_order_item);
			}
			temp_order_item.refresh(la_order_item);
	}
	
};
function play_sound(sound_id) {
  var sound = document.getElementById(sound_id);
  sound.play();
}
function order_item(id, order) {
	var self = this;
	self.id = id;
	
	self.quantity = 0;
	self.order = order;
	self.status = "new";
	self.name = "";
	self.refresh = function(la_order_item) {
		self.quantity = la_order_item.quantity;
		self.name = la_order_item.name;
	}
	self.next = function() {
		if (self.status == "new") {
			self.status = "busy";
		} else if (self.status == "busy") {
			self.status = "completed";
			self.complete();
		}
	}
	self.complete = function() {
		
		self.order.app.http.post("/orderItem/complete/" + self.id).then(function success (data) {
		    console.log("successfully completed " + self.name);
			self.remove();
		}, function failure (data) {
		    console.log('failed')
		});
	}
	
	self.remove = function() {
		var order_item_index = self.order.order_items.indexOf(self);
		self.order.order_items.splice(order_item_index, 1);
	}
};
</script>
</head>
<body ng-controller="kitchenCtl">
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Kontiki</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/') }}">Home</a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{ url('/auth/login') }}">Login</a></li>
						<li><a href="{{ url('/auth/register') }}">Register</a></li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>

<h1>Kitchen</h1>
<div class="container">
            <div  id="content" >
            	<div class="order" ng-repeat="order in app.orders" >
            	    Order Number <span class="order_number"> @{{ order.order_number }}</span>
            	    <div class="order_items">
            		    <button class="order_item" ng-class="order_item.status" ng-repeat="order_item in order.order_items" ng-click="order_item.next()">
            			    @{{ order_item.quantity }} x @{{ order_item.name }}
            		    </button>
            	    </div>
            	</div>
            </div>
</div>

<div class="modal fade" id="error" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">You broke it, well done</h4>
      </div>
      <div class="modal-body">
        <h5>Not even Chuck Norris could do it, well done!</h5>
        <h3>@{{app.error_status}}</h3>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

<audio id="ping" src="{{ asset('/ping.mp3') }}" ></audio>

</body>
</html>