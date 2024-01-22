<?php
?>
@extends('admin.layouts.register')
@section('title','Login')
@section('dashboard')
    <div class="content-wrapper  js-content-wrapper">

        <section class="form-page js-mouse-move-container">

            <div class="form-page__content lg:py-50">
                <div class="container">
                    <div class="mt-5">
{{--                        @if($errors->any())--}}
{{--                            <div class="col-12">--}}
{{--                                @foreach($errors->all() as $error)--}}
{{--                                    <div class="alert alert-danger">--}}
{{--                                        {{$error}}--}}
{{--                                    </div>--}}
{{--                                @endforeach--}}
{{--                            </div>--}}
{{--                        @endif--}}

                        @if(session()->has('error'))
                            <div class="alert alert-danger">
                                {{session('error')}}
                            </div>
                        @endif

                        @if(session()->has('success'))
                            <div class="alert alert-success">
                                {{session('success')}}
                            </div>
                        @endif
                    </div>
                    <div class="row justify-center items-center">
                        <div class="col-xl-7 col-lg-8">
                            <div class="px-50 py-50 md:px-25 md:py-25 bg-white shadow-1 rounded-16">
                                <h3 class="text-30 lh-13">Tizimga kirish</h3>
                                <p class="mt-10">Sizda akkaunt mavjud emasmi?
                                    <a href="{{route('register-view')}}" class="text-purple-1">Ro'yxatdan o'tish</a>
                                </p>

                                <form class="contact-form respondForm__form row y-gap-20 pt-30" method="POST" autocomplete="off" action="{{route('login')}}">
                                    @csrf
                                    <div class="col-12">
                                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Login</label>
                                        <input type="text" name="username" placeholder="Login" required>
                                    </div>
                                    <div class="col-12">
                                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Parol</label>
                                        <input type="password" name="password" placeholder="Parol" required>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" name="submit" id="submit_login" class="button -md -green-1 text-dark-1 fw-500 w-1/1">
                                            Kirish
                                        </button>
                                    </div>
                                </form>

                                <div class="lh-12 text-dark-1 fw-500 text-center mt-20">
                                    <a href="{{route('register-view')}}" class="text-purple-1">Ro'yxatdan o'tish</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

@endsection
