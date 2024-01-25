<?php
$t_r = 1;
?>
@extends('admin.layouts.app')
@section('title','Users')
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
                    <h1 class="text-30 lh-12 fw-700">Admin or Assistant </h1>
                </div>
                <div class="col-6 d-flex justify-content-end">
                    <a href="{{route('users.create')}}">
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
{{--                        <th scope="col">Id</th>--}}
                        <th scope="col">Firstname</th>
                        <th scope="col">Lastname</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Username</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $test)
                        <tr>
                            <th scope="row">{{$t_r++}}</th>
{{--                            <th>{{$test->id}}</th>--}}
                            <td>{{$test->first_name}}</td>
                            <td>{{$test->last_name}}</td>
                            <td>{{$test->phone}}</td>
                            <td>{{$test->username}}</td>
                            <td>{{$test->rol_id}}</td>
                            <td>
                                <div class="row">
                                    <div class="col-4">
                                        {{--                                      <button class="btn btn-warning text-white">--}}
                                        {{--                                         <i class="fas fa-eye"></i>--}}
                                        {{--                                         View--}}
                                        {{--                                      </button>--}}
                                    </div>
                                    <div class="col-4">
                                        <a href="{{ route('users.edit', ['user' => $test->id]) }}">
                                            <button class="btn btn-primary text-white">
                                                <i class="fas fa-edit"></i>
                                                Update
                                            </button>
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <button class="btn btn-danger text-white" type="button" data-bs-toggle="modal" data-bs-target="#UsersCheckModal{{$test->id}}">
                                            <i class="fas fa-trash-alt"></i>
                                            Delete
                                        </button>
                                    </div>
                                    {{--                                                                    modal delete--}}
                                    <!-- Modal -->
                                    <div class="modal fade" id="UsersCheckModal{{$test->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete your {{$test->id}}</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('users.destroy',['user' => $test->id])}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <h1>Are you sure?</h1>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-danger">
                                                                <i class="fas fa-trash-alt"></i>
                                                                Delete Users
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    {{--                                                                   end modal delete--}}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @include('user.components.footer')
    </div>
@endsection
