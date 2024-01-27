<?php
use App\Models\Video;
use App\Models\GroupTest;
?>
@extends('admin.layouts.app')
@section('title','Dars qo\'shish')
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

                <div class="row pb-20 mb-10">
                    <div class="col-3">
                        <a href="{{route('module-index',['course_id'=>$module->course_id])}}" class="btn btn-danger text-white">
                            <i class="fas fa-backward"></i>
                            Orqaga qaytish
                        </a>
                    </div>
                </div>

                <div class="row pb-20 mb-10">
                    <div class="col-6">
                        <h1 class="text-30 lh-12 fw-700">Darslar</h1>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
{{--                        <a href="{{route('lessons-create',['module_id' => $module->id]) }}">--}}
{{--                            <button class="btn btn-success text-white">--}}
{{--                                <i class="fas fa-plus"></i>--}}
{{--                                Yaratish--}}
{{--                            </button>--}}
{{--                        </a>--}}
                        <button class="btn btn-success text-white" type="button" data-bs-toggle="modal" data-bs-target="#CourseLessonCreate">
                            <i class="fas fa-plus"></i>
                            Yaratish
                        </button>

                        <div class="modal fade" id="CourseLessonCreate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" >
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Siz dars yaratayapsiz!</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('lessons.store')}}" method="POST" class="form-group" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" class="form-control" id="module_id" value="{{$module->id}}" name="module_id">
                                            <div class="row">
                                                <div class="mb-3">
                                                    <label for="title" class="form-label fw-700">Dars nomi</label>
                                                    <input type="text" class="border form-control" id="title" name="title" required>
                                                    @error('title')
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

                <div class="row">
                    @foreach($lessons as $less)
                        @php
                            $video_dars = Video::where('lesson_id',$less->id)->first();
                            $group = GroupTest::where('lesson_id',$less->id)->first();
                            $quiz = \App\Models\Test::where('lesson_id',$less->id)->count();
                        @endphp
                        <div class="side-content ml-10 mr-10 mt-20 col-xl-5 col-lg-5 col-md-5 col-sm-5" style="border: 2px solid #ddd; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                            <a href="
                            @if( $video_dars && $less->id == $video_dars->lesson_id)
                            {{route('lessons.show',['lesson' => $video_dars->lesson_id])}}
                            @else
                            {{route('lesson-create', ['lesson_id' => $less->id])}}
                            @endif
                            " class="coursesCard -type-1 ">
                                <div class="h-100">
                                    <div class="text-17 lh-15 fw-500 text-dark-1 mt-10">
                                        {{$less->title}}
                                    </div>
                                    <div class="d-flex items-center justify-content-between" style="padding: 15px;">

                                        <div class="d-flex items-center">
                                            <div class="icon-bar-chart-2 text-14 lh-1">
                                                {{$group ? $group->level : 0}}
                                            </div>
                                        </div>

                                        <div class="d-flex items-center">
                                            <div class="icon-puzzle text-14 lh-1">
                                                {{$quiz}}
                                            </div>
                                        </div>
                                        <div class="d-flex items-center">
                                            <div class="icon-star text-14 lh-1">
                                                {{$group ? $group->ball : 0}}
                                            </div>
                                        </div>
                                        <div class="d-flex items-center">
                                            <div class="icon-infinity text-14 lh-1">
                                                {{$group ? $group->limit : 0}}
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </a>
                            <div class="row py-15">
                                <div class="col-5 text-center">
                                    <button class="btn btn-primary text-white" type="button" data-bs-toggle="modal" data-bs-target="#CourseModalEdit{{$less->id}}">
                                        <i class="fas fa-edit"></i>
                                        Tahrirlash
                                    </button>
                                    {{--                                modal edit--}}
                                    <!-- Modal -->
                                    <div class="modal fade" id="CourseModalEdit{{$less->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" >
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Siz {{$less->title}} darsini tahrirlamoqchisiz!</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('lessons.update',$less->id)}}" method="POST" class="form-group" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" value="{{$less->module_id}}" class="form-control" id="module_id" name="module_id">
                                                        <div class="row">
                                                            <div class="mb-3">
                                                                <label for="title" class="form-label fw-700">Dars nomi</label>
                                                                <input type="text" value="{{$less->title}}" class="border form-control" id="title" name="title">
                                                                @error('title')
                                                                <div style="color: red" class="form-text">{{$message}}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary mt-30">
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
                                <div class="col-5 text-center">
                                    <button class="btn btn-danger text-white" type="button" data-bs-toggle="modal" data-bs-target="#CourseModal{{$less->id}}">
                                        <i class="fas fa-trash-alt"></i>
                                        O'chirish
                                    </button>
                                    {{--                                modal delete--}}
                                    <div class="modal fade" id="CourseModal{{$less->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog ">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Siz {{$less->title}} darsini o'chirmoqchisiz!</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('lessons.destroy', ['lesson' => $less->id])}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" value="{{$less->module_id}}" class="form-control" id="module_id" name="module_id">
                                                        <h3>Sizni ishonchingiz komilmi!</h3>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Yopish</button>
                                                            <button type="submit" class="btn btn-danger">
                                                                <i class="fas fa-trash-alt"></i>
                                                                Darsni o'chirish
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

