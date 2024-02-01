<?php
$t_r = 0
?>
@extends('user.layouts.app')
@section('css')
@endsection
@section('title','LMS')
@section('dashboard')
    <div class="dashboard__main">
        <div class="dashboard__content bg-light-4">
            <div class="row pb-50 mb-10">
                <div class="col-auto">
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
                                    Butun davr
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
                                    <ul class="list-group">
                                        @foreach($rankedResults as $statistic)
                                            @if($statistic['rank'] == 1)
                                            <li class="mt-15 list-group-item d-flex justify-content-between align-items-center" style="border: 1px solid rgb(221 176 96); border-radius: 20px;background: #ecebeb;">
                                                <img width="25" src="{{asset('assets/img/medal/awwards-01.png')}}" alt="">
                                                <div class="relative d-flex items-center text-center">
                                                    <img class="size-40 img-fluid"  src="{{asset('storage/'.$statistic['image'])}}" style="border-radius: 50px;" alt="image">
                                                </div>
                                                <span class="text-center" style="overflow: hidden; white-space: nowrap;text-overflow: ellipsis; margin-left: 10px ;color: #212529;font-size: 15px; line-height: 1.7;font-family: 'GT Walsheim Pro', sans-serif;font-weight: 400">
                                                    {{$statistic['first_name']}}
                                                </span>
                                                <span class="badge rounded-pill" style="color: black;">
                                                    <i class="fas fa-graduation-cap text-14 lh-1" style="color: blue"></i>
                                                    {{$statistic['average_foiz']}}
                                                </span>
                                                <span class="badge rounded-pill" style="color: black;">
                                                    <i class="fas fa-gem text-14 lh-1" style="color:blue;"></i>
                                                    {{$statistic['zumrad']}}
                                                </span>
                                            </li>
                                            @elseif($statistic['rank'] == 2)
                                            <li class="mt-15 list-group-item d-flex justify-content-between align-items-center" style="border: 1px solid rgb(179 181 182); border-radius: 20px;background: #ecebeb;">
                                                <img width="25" src="{{asset('assets/img/medal/awwards-03.png')}}" alt="">
                                                <div class="relative d-flex items-center text-center">
                                                    <img class="size-40 img-fluid"  src="{{asset('storage/'.$statistic['image'])}}" style="border-radius: 50px;" alt="image">
                                                </div>
                                                <span class="text-center" style="overflow: hidden; white-space: nowrap;text-overflow: ellipsis; margin-left: 10px ;color: #212529;font-size: 15px; line-height: 1.7;font-family: 'GT Walsheim Pro', sans-serif;font-weight: 400">
                                                    {{$statistic['first_name']}}
                                                </span>
                                                <span class="badge rounded-pill" style="color: black;">
                                                    <i class="fas fa-graduation-cap text-14 lh-1" style="color: blue"></i>
                                                    {{$statistic['average_foiz']}}
                                                </span>
                                                <span class="badge rounded-pill" style="color: black;">
                                                    <i class="fas fa-gem text-14 lh-1" style="color:blue;"></i>
                                                    {{$statistic['zumrad']}}
                                                </span>
                                            </li>
                                            @elseif($statistic['rank'] == 3)
                                            <li class="mt-15 list-group-item d-flex justify-content-between align-items-center" style="border: 1px solid #d57600; border-radius: 20px;background: #ecebeb;">
                                                <img width="25" src="{{asset('assets/img/medal/awwards-02.png')}}" alt="">
                                                <div class="relative d-flex items-center text-center">
                                                    <img class="size-40 img-fluid"  src="{{asset('storage/'.$statistic['image'])}}" style="border-radius: 50px;" alt="image">
                                                </div>
                                                <span class="text-center" style="overflow: hidden; white-space: nowrap;text-overflow: ellipsis; margin-left: 10px ;color: #212529;font-size: 15px; line-height: 1.7;font-family: 'GT Walsheim Pro', sans-serif;font-weight: 400">
                                                    {{$statistic['first_name']}}
                                                </span>
                                                <span class="badge rounded-pill" style="color: black;">
                                                    <i class="fas fa-graduation-cap text-14 lh-1" style="color: blue"></i>
                                                    {{$statistic['average_foiz']}}
                                                </span>
                                                <span class="badge rounded-pill" style="color: black; ">
                                                    <i class="fas fa-gem text-14 lh-1" style="color:blue;"></i>
                                                    {{$statistic['zumrad']}}
                                                </span>
                                            </li>
                                            @else
                                                <li class="mt-15 list-group-item d-flex justify-content-between align-items-center" style="border: 1px solid white; background: #ecebeb; border-radius: 20px">
                                                    <span class="ml-10 mr-15">
                                                        {{$statistic['rank']}}
                                                    </span>
                                                    <div class="relative d-flex items-center text-center">
                                                        <img class="size-40 img-fluid"  src="{{asset('storage/'.$statistic['image'])}}" style="border-radius: 50px;" alt="image">
                                                    </div>
                                                    <span class="text-center" style="overflow: hidden; white-space: nowrap;text-overflow: ellipsis; margin-left: 10px ;color: #212529;font-size: 15px; line-height: 1.7;font-family: 'GT Walsheim Pro', sans-serif;font-weight: 400">
                                                        {{$statistic['first_name']}}
                                                    </span>
                                                    <span class="badge rounded-pill" style="color: black;">
                                                        <i class="fas fa-graduation-cap text-14 lh-1" style="color: blue"></i>
                                                        {{$statistic['average_foiz']}}
                                                    </span>
                                                    <span class="badge rounded-pill" style="color: black; ">
                                                        <i class="fas fa-gem text-14 lh-1" style="color:blue;"></i>
                                                        {{$statistic['zumrad']}}
                                                    </span>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
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
