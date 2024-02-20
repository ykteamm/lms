<?php

use App\Models\Module;

?>
@extends('admin.layouts.app')
@section('title','Courses')
@section('dashboard')
    <div class="dashboard__main">
        <div class="dashboard__content bg-light-4">
            @if(session()->has('success'))
                <div class="row">
                    <div class="col-12 ">
                        <div class="alert bg-success-1 alert-dismissible fade show pb-20 pt-20 pl-20 pr-20 rounded-8"
                             role="alert">
                            <div class="text-success-2 lh-1 fw-500">{{session('success')}}</div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            @elseif(session()->has('error'))
                <div class="row">
                    <div class="col-12 ">
                        <div class="alert bg-error-1 alert-dismissible fade show pb-20 pt-20 pl-20 pr-20 rounded-8"
                             role="alert">
                            <div class="text-success-2 lh-1 fw-500">{{session('error')}}</div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            @endif


            <div class="row pb-50 mb-10">
                <div class="col-6">
                    <h1 class="text-30 lh-12 fw-700">Kurslar</h1>
                </div>
                <div class="col-6 d-flex justify-content-end">
                    <button class="btn btn-success text-white" type="button" data-bs-toggle="modal"
                            data-bs-target="#CourseModalCreate">
                        <i class="fas fa-plus"></i>
                        Yaratish
                    </button>

                    <div class="modal fade" id="CourseModalCreate" tabindex="-1" aria-labelledby="exampleModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Siz kurs yaratayapsiz!</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('course.store')}}" method="POST" class="form-group"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="mb-3">
                                                <label for="title" class="form-label fw-700">Kurs nomi</label>
                                                <input type="text" class="border form-control" id="title" name="title"
                                                       required>
                                                @error('title')
                                                <div style="color: red" class="form-text">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div class="col-6">
                                                <div class="mb-3 mt-30">
                                                    <label for="image" class="form-label fw-700">Kurs rasmi</label>
                                                    <input type="file" class="form-control" id="image" name="image"
                                                           accept=".png, .jpg, .jpeg, .pdf" required>
                                                </div>
                                                @error('image')
                                                <div style="color: red" class="form-text">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-info mt-30">
                                            <i class="fas fa-plus"></i>
                                            Yaratish
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row py-20 pl-20 pr-20">
                @foreach($course as $test)
                    @php
                        $module =  Module::where('course_id', $test->id)->count()
                    @endphp
                    <div class="side-content pt-20 pb-20 mb-15 col-xl-4 col-lg-6 col-md-4 col-sm-6"
                         style="border: 2px solid #ddd; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                        <a href="{{route('module-index', ['course_id' => $test->id])}}" class="coursesCard -type-1 ">
                            <div class="relative">
                                <div class="coursesCard__image overflow-hidden rounded-8">
                                    <div
                                        style="width: 100%; height: 200px; overflow: hidden; text-align: center; display: flex; align-items: center; justify-content: space-evenly;">
                                        <img src="{{ asset('storage/' . $test->image) }}" alt=""
                                             style="max-width: 100%; max-height: 100%; border: 2px solid #ddd; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                    </div>
                                    <div class="coursesCard__image_overlay rounded-8"></div>
                                </div>
                            </div>

                            <div class="h-100 pt-15">
                                <div class="text-17 lh-15 fw-500 text-dark-1 mt-10">
                                    {{$test->title}}
                                </div>
                                <div class="d-flex items-center justify-content-evenly pt-10">
                                    <div class="d-flex items-center">
                                        <div class="mr-8">
                                            <img src="{{asset('assets/img/coursesCards/icons/1.svg')}}" alt="icon">
                                        </div>
                                        <div class="text-14 lh-1">{{$module}} module</div>
                                    </div>
                                    <div class="d-flex items-center">
                                        <div class="mr-8">
                                            <img src="{{asset('assets/img/coursesCards/icons/2.svg')}}" alt="icon">
                                        </div>
                                        <div class="text-14 lh-1">3h 56m</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div class="row py-15">
                            <div class="col-12 text-center">
                                <button class="btn btn-primary text-white" type="button" data-bs-toggle="modal"
                                        data-bs-target="#CourseModalEdit{{$test->id}}">
                                    <i class="fas fa-edit"></i>
                                    Tahrirlash
                                </button>
                                {{--                                modal edit--}}
                                <!-- Modal -->
                                <div class="modal fade" id="CourseModalEdit{{$test->id}}" tabindex="-1"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Siz {{$test->title}}
                                                    kursini tahrirlamoqchisiz!</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('course.update',$test->id)}}" method="POST"
                                                      class="form-group" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row">
                                                        <div class="mb-3">
                                                            <label for="title" class="form-label fw-700">Kursni
                                                                nomi</label>
                                                            <input type="text" value="{{$test->title}}"
                                                                   class="border form-control" id="title" name="title">
                                                            @error('title')
                                                            <div style="color: red" class="form-text">{{$message}}</div>
                                                            @enderror
                                                        </div>
                                                        @if(auth()->user()->rol_id == 'admin')
                                                            <div class="mb-3">
                                                                <label for="status" class="form-label fw-700">Kurs
                                                                    Status</label>
                                                                <input type="text" value="{{$test->status}}"
                                                                       class="border form-control" id="status"
                                                                       name="status">
                                                                @error('status')
                                                                <div style="color: red"
                                                                     class="form-text">{{$message}}</div>
                                                                @enderror
                                                            </div>
                                                        @else
                                                            <input type="hidden" name="status" value="{{$test->status}}"
                                                                   id="status">
                                                        @endif
                                                        <div class="col-6">
                                                            <div class="mb-3 mt-30">
                                                                <label for="image" class="form-label fw-700">Kurs
                                                                    rasmi</label>
                                                                @if($test->image)
                                                                    <br>
                                                                    <div
                                                                        style="width: 200px; height: 150px; overflow: hidden; text-align: center; display: flex; align-items: center; justify-content: center;">
                                                                        <img
                                                                            src="{{ asset('storage/' . $test->image) }}"
                                                                            alt=""
                                                                            style="max-width: 100%; max-height: 100%; border: 2px solid #ddd; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                                                    </div>
                                                                    <br><br>
                                                                @endif
                                                                <input type="file" class="form-control" id="image"
                                                                       name="image" accept=".png, .jpg, .jpeg, .pdf">
                                                            </div>
                                                            @error('image')
                                                            <div style="color: red" class="form-text">{{$message}}</div>
                                                            @enderror
                                                        </div>

                                                    </div>
                                                    <button type="submit" class="btn btn-info mt-30">
                                                        <i class="fas fa-edit"></i>
                                                        Tahrirlash
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--                             end edit modal--}}
                            </div>
                            <div class="col text-center">
                                {{--                                <button class="btn btn-danger text-white" type="button" data-bs-toggle="modal" data-bs-target="#CourseModal{{$test->id}}">--}}
                                {{--                                    <i class="fas fa-trash-alt"></i>--}}
                                {{--                                    O'chirish--}}
                                {{--                                </button>--}}
                                {{--                                modal delete--}}
                                <div class="modal fade" id="CourseModal{{$test->id}}" tabindex="-1"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog ">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Siz {{$test->title}}
                                                    kursini o'chirmoqchisiz!</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('course.destroy',['course' => $test->id])}}"
                                                      method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <h3>Sizni ishonchingiz komilmi!</h3>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Yopish
                                                        </button>
                                                        <button type="submit" class="btn btn-danger">
                                                            <i class="fas fa-trash-alt"></i>
                                                            Kursni o'chirish
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--                               end modal delete--}}
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>

        @include('user.components.footer')
    </div>
@endsection
