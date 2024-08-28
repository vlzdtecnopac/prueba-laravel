<?php

use function Livewire\Volt\layout;

layout('layouts.guest');
?>
<div>

        <div class="row mt-5 mb-5">
            <div class="col-4"></div>
            <div class="col-2">
                <form action="/test" method="POST">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <button type="submit" id="checkout-test-button" class="btn btn-primary">Checkout (Test)</button>
                </form>
            </div>
            <div class="col-2">
                <form action="/live" method="POST">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <button type="submit" id="checkout-live-button" class="btn btn-success">Checkout (LIVE)</button>
                </form>
            </div>
            <div class="col-4"></div>
        </div>

</div>
