@extends('layouts.frontLayout.front_design')
@section('content')
    <section id="form" style="margin-top: 20px;"><!--form-->
        <div class="container">
            @if(Session::has('flash_message_error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{!! session('flash_message_error') !!}</strong>
                </div>
            @endif
            <form action="{{url('/checkout')}}" method="post">{{csrf_field()}}
                <div class="row">
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="billing-form"><!--login form-->
                        <h2>Bill To</h2>
                        <div class="form-group">
                            <input name="billing_name" id="billing_name" value="{{$userDetails->name}}" type="text" placeholder="Billing Name" class="form-control" />
                        </div>
                        <div class="form-group">
                            <input name="billing_address" id="billing_address" value="{{$userDetails->address}}" type="text" placeholder="Billing Address" class="form-control" />
                        </div>
                        <div class="form-group">
                            <input name="billing_city" id="billing_city" value="{{$userDetails->city}}" type="text" placeholder="Billing City" class="form-control" />
                        </div>
                        <div class="form-group">
                            <input name="billing_state" id="billing_state" value="{{$userDetails->state}}" type="text" placeholder="Billing State" class="form-control" />
                        </div>
                        <div class="form-group">
                            <select id="billing_country" name="billing_country" class="form-control">
                                <option value="">Select Country</option>
                                @foreach($countries as $country)
                                    <option value="{{$country->country_name}}" @if($country->country_name == $userDetails->country) selected @endif>{{$country->country_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input name="billing_pincode" id="billing_pincode" value="{{$userDetails->pincode}}" type="text" placeholder="Billing Pincode" class="form-control" />
                        </div>
                        <div class="form-group">
                            <input name="billing_mobile" id="billing_mobile" value="{{$userDetails->mobile}}" type="text" placeholder="Billing Mobile" class="form-control" />
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check input" id="copytoshippin">
                            <label for="copytoshippin" class="form-check-label">Shipping Address same as Billing Address</label>
                        </div>
                    </div><!--/login form-->
                </div>
                <div class="col-sm-1">
                    <h2></h2>
                </div>
                <div class="col-sm-4">
                    <div class="shipping-form"><!--sign up form-->
                        <h2>Ship To</h2>
                        <div class="form-group">
                            <input name="shipping_name" id="shipping_name" type="text" placeholder="Shipping Name" class="form-control" />
                        </div>
                        <div class="form-group">
                            <input name="shipping_address" id="shipping_address" type="text" placeholder="Shipping Address" class="form-control" />
                        </div>
                        <div class="form-group">
                            <input name="shipping_city" id="shipping_city" type="text" placeholder="Shipping City" class="form-control" />
                        </div>
                        <div class="form-group">
                            <input name="shipping_state" id="shipping_state" type="text" placeholder="Shipping State" class="form-control" />
                        </div>
                        <div class="form-group">
                            <select id="shipping_country" name="shipping_country" class="form-control">
                                <option value="">Select Country</option>
                                @foreach($countries as $country)
                                    <option value="{{$country->country_name}}">{{$country->country_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input name="shipping_pincode" id="shipping_pincode" type="text" placeholder="Shipping Pincode" class="form-control" />
                        </div>
                        <div class="form-group">
                            <input name="shipping_mobile" id="shipping_mobile" type="text" placeholder="Shipping Mobile" class="form-control" />
                        </div>
                            <button type="submit" class="btn btn-warning">Checkout</button>
                    </div><!--/sign up form-->
                </div>
            </div>
            </form>
        </div>
    </section><!--/form-->



@endsection