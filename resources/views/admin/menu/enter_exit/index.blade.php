<?php
$t_r = 0
?>
@extends('admin.layouts.app')
@section('css')
@endsection
@section('title','LMS')
@section('dashboard')
    <div class="dashboard__main">
        <div class="dashboard__content bg-light-4">
            <div class="row pb-50 mb-10">
                <div class="col-12">
                    <a href="{{route('admin')}}" class="btn btn-danger text-white">
                        <i class=" fas fa-backward"></i>
                        Orqaga qaytish
                    </a>
                </div>

                <div class="col-auto mt-20">
                    <h1 class="text-30 lh-12 fw-700">Peshqadamlar</h1>
{{--                    <div class="mt-10">Lorem ipsum dolor sit amet, consectetur.</div>--}}
                </div>
            </div>
            <div class="row y-gap-30">
                <div class="col-12">
                    <div class="rounded-16 bg-white -dark-bg-dark-1 shadow-4 h-100">
                        <div class="tabs -active-purple-2 js-tabs pt-0">
                            <div class="tabs__controls d-flex x-gap-30 items-center pt-20 px-30 border-bottom-light js-tabs-controls">
                                <button class="tabs__button text-light-1 js-tabs-button is-active" data-tab-target=".-tab-item-1" type="button">
                                    Bugun
                                </button>
                                <button class="tabs__button text-light-1 js-tabs-button" data-tab-target=".-tab-item-2" type="button">
                                    Haftalik
                                </button>
                                <button class="tabs__button text-light-1 js-tabs-button" data-tab-target=".-tab-item-3" type="button">
                                    Oylik
                                </button>
                            </div>

                            <div class="tabs__content py-30 px-30 js-tabs-content">
                                <div class="tabs__pane -tab-item-1 is-active">

                                </div>
                                <div class="tabs__pane -tab-item-2">
                                </div>
                                <div class="tabs__pane -tab-item-3">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('user.components.footer')
    </div>
@endsection
