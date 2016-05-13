@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            
            <div>
                <a href="/orders/create" class="btn btn-primary">Create Order</a>
                <p>&nbsp;</p>
            </div>
            
            <div class="panel panel-default">
                <div class="panel-heading">Orders</div>

                <div class="panel-body">
                    @forelse ($orders as $order)
                        <div>
                            <p>{{ $order->id }} - R {{ $order->total }}</p>
                        </div>
                    @empty
                        <div>
                            <p>No Orders</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
