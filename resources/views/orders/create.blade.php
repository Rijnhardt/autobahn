@extends('layouts.order')

@section('content')
    <div ng-app="autobahnApp">
        <div ng-controller="orderCtl">
            
            <div class="container">
                <div class="row">
                    <div  id="content" >
                        <div class="product-group-header">
                            <div class="product_groups">
                        		<button ng-repeat="productGroup in app.productGroups" ng-click=app.setActiveGroup(productGroup) class="product_group">
                        		    @{{ productGroup.name }}
                        		</button>
                        	</div>
                        </div>
                        <button ng-repeat="product in app.activeGroup.products" ng-click="app.addToOrder(product)" class="product">@{{product.name}} - R@{{product.price}}</button>


                    </div>
                    <div id="sidebar">
                        <table class="order_items">
                            <tr><td>&nbsp</td><td class="action">&nbsp</td></tr>
                    		<tr ng-repeat="orderItem in app.order.orderItems">
                    			<td>@{{ orderItem.qty }} x @{{ orderItem.product.name }}</td>
                    			<td>
                    			    <div class="glyphs">
                    			        <button class="decrement change" ng-click=orderItem.decrement()><i class="glyphicon glyphicon-minus"></i></button>
                        				<button class="increment change" ng-click=orderItem.increment()><i class="glyphicon glyphicon-plus"></i></button>
                        				<button class="remove change" ng-click=orderItem.remove()><i class="glyphicon glyphicon-remove"></i></button>
                    			    </div>
                				</td>
                    		</tr>
                    		<tr class="total"><td>Total</td><td>R @{{app.order.total}}</td></tr>
                    		<tr class="tender"><td>Tender</td><td><input class="tender" ng-model="app.order.tender" type="number" placeholder="" ng-blur="app.order.calculate()"/></td></tr>
                    		<tr class="change"><td>Change</td><td>@{{app.order.change}}</td></tr>
                        </table>
                        
                        <button class="tenderamount" ng-click=app.order.addTender(100)>100</button>
                    	<button class="tenderamount" ng-click=app.order.addTender(50)>50</button>
                    	<button class="tenderamount" ng-click=app.order.addTender(20)>20</button>
                    	<button class="tenderamount" ng-click=app.order.addTender(10)>10</button>
                    	<button class="tenderamount" ng-click=app.order.addTender(5)>5</button>
                    	<button class="tenderamount" ng-click=app.order.addTender(2)>2</button>
                    	<button class="tenderamount" ng-click=app.order.addTender(1)>1</button>
                    	<button class="tenderamount" ng-click=app.order.clearTender()>Zero</button>
                    </div>
                </div>
                
                <button class="checkout" ng-click="app.order.checkout()">Check Out</button>
            </div>
            
            <div class="modal fade" id="confirmed-order-mdl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Order Confirmed</h4>
                      </div>
                      <div class="modal-body">
                        <h2>Order Number: @{{app.confirmedOrder.ref}}</h2>
                        <div ng-repeat="item in app.confirmed_order.items" >
                        	<div>@{{item}}</div>
                        </div>
                        <h3>Total: R @{{app.confirmedOrder.total}}</h3>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="modal fade" id="failed-order-mdl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="myModalLabel">You broke it, well done</h4>
                      </div>
                      <div class="modal-body">
                        <h5>Not even Chuck Norris could do it, well done!</h5>
                        <h3>@{{app.errorMessage}}</h3>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
            
        </div>
    </div>
    
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
@endsection