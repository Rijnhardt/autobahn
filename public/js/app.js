(function() {

    'use strict';

    var app = angular.module('autobahnApp', []);

    
    app.controller('orderCtl', function ($scope, $http) {
        
        var self = {};
        
        $scope.app = self;
        
        self.http = $http;
        self.productGroups = [];
        self.order = new order(self);
        self.activeGroup = null;
        
        self.init = function () {
            
            self.getProducts();
            
            if (self.activeGroup == null) {
                self.activeGroup = self.productGroups[0];
            }
        }

        self.getProducts = function () {
            self.http({
                method : "GET",
                url : "/api/products"
            }).then(function success(response) {
                self.productGroups = response.data;
            }, function error(response) {
                self.errorMessage = response.statusText;
                console.log('error:', $scope.errorMessage);
            });  
        }
        
        self.init();
        
        self.addToOrder = function (product) {
            var item = self.addToOrderWithoutCalculate(product);
            self.order.calculate();
            return item;
        };
        
        self.addToOrderWithoutCalculate = function (product) {
            var found = null;
            
            angular.forEach(self.order.orderItems, function(orderItem) {
                if (orderItem.product.id == product.id) {
                    orderItem.incrementWithoutCalculate();
                    found = orderItem;
                }
            });
            
            if (found == null) {
                found = new orderItem(product, self.order);
                self.order.orderItems.push(found);
                self.order.calculate();
            }
        };
        
        self.setActiveGroup = function (group) {
            self.activeGroup = group;
        }

    });
    
    function orderItem (product, order)
    {
        
        var self = this;
        
        self.product = product;
        self.qty = 1;
        self.total = product.price;
        self.order = order;
        
        self.removeWithoutCalculate = function () {
            var index = self.order.orderItems.indexOf(self);
            if (index !== -1) {
                self.order.orderItems.splice(index, 1);
            }
        }
        
        self.remove = function () {
            self.removeWithoutCalculate();
            self.order.calculate();
        }
        
        self.decrementWithoutCalculate = function () {
            self.qty -= 1;
            
            if (! self.qty >= 1) {
                self.remove();
            }
            
        }
        
        self.decrement = function () {
            self.decrementWithoutCalculate();
            self.order.calculate();
        }
        
        self.incrementWithoutCalculate = function () {
            self.qty += 1;
        }
        
        self.increment = function () {
            self.incrementWithoutCalculate();
            self.order.calculate();
        }
    }
    
    function order (app) {
        var self = this;
        
        self.total = 0;
        self.app = app;
        self.tender = null;
        self.change = 0;
        
        self.orderItems = [];
        
        
        self.checkout = function () {
            var items = [];
            
            angular.forEach(self.orderItems, function (orderItem) {
                items.push({
                    "product_id": orderItem.product.id,
                    "qty": orderItem.qty
                });
            });
            
            console.log(items);
            
            self.app.http({
               method: 'POST',
               url: '/orders',
               data: angular.toJson(items),
               headers : {
                   'Content-Type': 'application/json'
               }
            }).then(function success(response) {
               self.app.confirmedOrder = response.data
               console.log('confirmed', self.app.confirmedOrder)
               console.log($("confirmed-order-mdl"));
               $("#confirmed-order-mdl").modal('show');
               self.clear();
            }, function failure(response) {
                self.app.errorMessage = response.data;
                console.log('failed', self.app.errorMessage)
                $("#failed-order-mdl").modal('show');
            });
        }
        
        self.clear = function () {
            self.orderItems = [];
            self.tender = null;
            self.calculate();
        };
            
        self.calculate = function () {
            self.total = 0;
            
            angular.forEach(self.orderItems, function(orderItem) {
                self.total = self.total + (orderItem.product.price * orderItem.qty);
            })
            
            self.total = Math.round(self.total * 100, 2) / 100;
            
            console.log('self', self);
            console.log('app', app);
            
            if (!isNaN(self.tender) && self.tender != 0.0 && self.tender != null) {
                self.change = "R" + (self.tender - self.total);
            }
            else {
                self.change = "";
            }
        };
        
        self.addTender = function(amount) {
            self.tender += amount;
            self.calculate();
        };
        
        self.clearTender = function () {
            self.tender = 0;
            self.calculate();
        };
        
    }
    
})();