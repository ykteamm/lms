<?php

?>
@extends('admin.layouts.register')
@section('title','Register')
@section('dashboard')
    <div class="content-wrapper  js-content-wrapper">
        <section class="form-page">
            <div class="form-page__content">
                <div class="container">
                    <div class="mt-5">
                        @if($errors->any())
                            <div class="col-12">
                                @foreach($errors->all() as $error)
                                    <div class="alert alert-danger">
                                        {{$error}}
                                    </div>
                                @endforeach
                            </div>
                        @endif

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
                        <div class="col-xl-8 col-lg-9">
                            <div class="px-50 py-50 md:px-25 md:py-25 bg-white shadow-1 rounded-16">
                                <h3 class="text-30 lh-13">Ro'yxatdan o'tish</h3>
                                <p class="mt-10">Allaqachon hisobingiz bormi? <a href="{{route('login-view')}}" class="text-purple-1">Tizimga kirish</a></p>

                                <form class="contact-form respondForm__form row y-gap-20 pt-30" id="phoneForm" action="{{route('register')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-lg-6">
                                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Ismingiz *</label>
                                        <input type="text" name="first_name" placeholder="Firstname" required>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Familyangiz *</label>
                                        <input type="text" name="last_name" placeholder="Lastname" required>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Tug'ilgan kuningiz *</label>
                                        <input type="date"  name="birthday" placeholder="Birthday" required>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Telefon raqam *</label>
                                        <input type="tel" name="phone" class="input-phone" placeholder="+998XX-XXX-XX-XX" required>
                                    </div>

                                    <div class=" col-lg-6">
                                        <label for="region_id" class="text-16 lh-1 fw-500 text-dark-1 mb-10">Viloyat *</label>
                                        <div class="form-group">
                                            <select  id="region_id" name="region_id" required>
                                                <option value="">--Select--</option>
                                                @foreach($region as $test)
                                                    <option value="{{$test->id}}">{{$test->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class=" col-lg-6">
                                        <label for="district_id" class="text-16 lh-1 fw-500 text-dark-1 mb-10">Shahar *</label>
                                        <div class="form-group">
                                            <select id="district_id" name="district_id" required>
{{--                                                <option value="">--Select--</option>--}}
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Rasmingiz *</label>
                                        <input type="file" name="image" placeholder="Image" required accept=".png, .jpg, .jpeg, .pdf">
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Passport Rasmingiz *</label>
                                        <input type="file" name="passport_image" placeholder="Passport Image" required accept=".png, .jpg, .jpeg, .pdf">
                                    </div>

                                    <div class="col-12">
                                        <button type="submit" name="submit" id="register" class="button -md -green-1 text-dark-1 fw-500 w-1/1">
                                            Ro'yxatdan o'tish
                                        </button>
                                    </div>
                                </form>

                                <div class="lh-12 text-dark-1 fw-500 text-center mt-20">
                                    <a href="{{route('login-view')}}" class="text-purple-1">Tizimga kirish</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection

@section('prefix')
            <script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.4.7/cleave.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.4.7/addons/cleave-phone.de.js"></script>
            <script type="text/javascript">
                document.addEventListener('DOMContentLoaded', function () {
                    var cleave = new Cleave('.input-phone', {
                        phone: true,
                        phoneRegionCode: 'UZ',
                        prefix: '+998'
                    });
                });
            </script>
@endsection
