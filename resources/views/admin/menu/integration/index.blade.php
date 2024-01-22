<?php
$number = 1;
?>
@extends('admin.layouts.app')
@section('title','Users integration')
@section('dashboard')
    <div class="dashboard__main">
        <div class="dashboard__content bg-light-4">
            @if(session()->has('success'))
                <div class="row">
                    <div class="col-12 ">
                        <div class="alert bg-success-1 alert-dismissible fade show pb-20 pt-20 pl-20 pr-20 rounded-8" role="alert">
                            <div class="text-success-2 lh-1 fw-500">{{session('success')}}</div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            @elseif(session()->has('error'))
                <div class="row">
                    <div class="col-12 ">
                        <div class="alert bg-error-1 alert-dismissible fade show pb-20 pt-20 pl-20 pr-20 rounded-8" role="alert">
                            <div class="text-success-2 lh-1 fw-500">{{session('error')}}</div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            @endif


            <div class="row pb-50 mb-10">
                <div class="col-6">
                    <h1 class="text-30 lh-12 fw-700">Users integration</h1>
                </div>
                <div class="col-6 d-flex justify-content-end">
                    <a href="">
                        <button class="btn btn-success text-white">
                            <i class="fas fa-plus"></i>
                            Create
                        </button>
                    </a>
                </div>
            </div>

            <div class="row y-gap-30">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">T/r</th>
                        <th scope="col">User ID</th>
                        <th scope="col">Fullname</th>
                        <th scope="col">Username</th>
                        <th scope="col">Password</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($passed as $pass)
                        @foreach($user as $use)
                            @if($pass->user_id == $use->id)
                            <tr>
                                <th scope="row">{{$number++}}</th>
                                <td>{{$use->id}}</td>
                                <td>{{$use->first_name}} {{$use->last_name}}</td>
                                <td>{{$use->username}}</td>
                                <td>{{$use->username}}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-4">
                                            <a href="{{'jang_matrix/'. $use->id}}">
                                                <button class="btn btn-primary text-white">
                                                    <i class="fas fa-edit"></i>
                                                    Integration
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @else
                            @endif
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>

        <footer class="footer -dashboard py-30">
            <div class="row items-center justify-between">
                <div class="col-auto">
                    <div class="text-13 lh-1">© 2022 Educrat. All Right Reserved.</div>
                </div>

                <div class="col-auto">
                    <div class="d-flex items-center">
                        <div class="d-flex items-center flex-wrap x-gap-20">
                            <div>
                                <a href="help-center.html" class="text-13 lh-1">Help</a>
                            </div>
                            <div>
                                <a href="terms.html" class="text-13 lh-1">Privacy Policy</a>
                            </div>
                            <div>
                                <a href="#" class="text-13 lh-1">Cookie Notice</a>
                            </div>
                            <div>
                                <a href="#" class="text-13 lh-1">Security</a>
                            </div>
                            <div>
                                <a href="terms.html" class="text-13 lh-1">Terms of Use</a>
                            </div>
                        </div>

                        <button class="button -md -rounded bg-light-4 text-light-1 ml-30">English</button>
                    </div>
                </div>
            </div>
        </footer>
    </div>
@endsection
