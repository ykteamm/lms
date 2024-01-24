<?php
use App\Models\Module;
?>
@extends('user.layouts.app')
@section('title','LMS')
@section('dashboard')
    <div class="dashboard__main">
        <div class="dashboard__content bg-light-4">

            @if(session()->has('ishga_kira_olmadi') )
                <div class="row">
                    <div class="col-12 ">
                        <div class="alert bg-error-1 alert-dismissible fade show pb-20 pt-20 pl-20 pr-20 rounded-8" role="alert">
                            <div class="text-error-2 lh-1 fw-500">
                                {{session('ishga_kira_olmadi')}}
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            @endif

            @if(session()->has('ishga_kirish') )
                <div class="row">
                    <div class="col-12 ">
                        <div class="alert bg-success-1 alert-dismissible fade show pb-20 pt-20 pl-20 pr-20 rounded-8" role="alert">
                            <div class="text-success-2 lh-1 fw-500">
                                {{session('ishga_kirish')}}
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            @endif


            <div class="row pb-50 mb-10">
                <div class="col-auto">
                    <h3 class="text-30 lh-12 fw-600">Salom, {{$user->first_name}}</h3>
                </div>
            </div>


            <div class="container mt-30">
                <div class="row">
            @if($user->status == 0)
                @if($first_course != null && !$passed)
                    <div class="side-content pt-20 pb-20 mb-15 col-xl-4 col-lg-6 col-md-4 col-sm-6" style="border: 2px solid #ddd; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                        <a href="{{url('user/lesson-show/'. $first_lesson->id)}}" class="coursesCard -type-1 ">
                            <div class="relative">
                                <div class="coursesCard__image overflow-hidden rounded-8">
                                    <div style="width: 100%; height: 200px; overflow: hidden; text-align: center; display: flex; align-items: center; justify-content: space-evenly;">
                                        <img src="{{ asset('storage/' . $first_course->image) }}" alt="" style="max-width: 100%; max-height: 100%; border: 2px solid #ddd; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                    </div>
                                    <div class="coursesCard__image_overlay rounded-8"></div>
                                </div>
                            </div>

                            <div class="h-100 pt-15">
                                <div class="text-17 lh-15 fw-500 text-dark-1 mt-10 text-center">
                                    {{$first_course->title}}
                                </div>
                                <div class="d-flex items-center justify-content-evenly pt-10">
                                    <div class="d-flex items-center">
                                        <div class="mr-8">
                                            <img src="{{asset('assets/img/coursesCards/icons/1.svg')}}" alt="icon">
                                        </div>
                                        <div class="text-14 lh-1 text-dark-1">{{$first_module_count}} module</div>
                                    </div>
                                    <div class="d-flex items-center">
                                        <div class="mr-8">
                                            <img src="{{asset('assets/img/coursesCards/icons/2.svg')}}" alt="icon">
                                        </div>
                                        <div class="text-14 lh-1 text-dark-1">3h 56m</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @else
                @endif
            @elseif($user->status == 1 && $user_check)
                    @foreach($course as $test)
                        @php
                            $module =  Module::where('course_id', $test->id)->count()
                        @endphp
                        <div class="side-content pt-20 pb-20 mb-15 col-xl-4 col-lg-6 col-md-4 col-sm-6" style="border: 2px solid #ddd; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                            <a href="{{url('user/module/'.$test->id)}}" class="coursesCard -type-1 ">
                                <div class="relative">
                                    <div class="coursesCard__image overflow-hidden rounded-8">
                                        <div style="width: 100%; height: 200px; overflow: hidden; text-align: center; display: flex; align-items: center; justify-content: space-evenly;">
                                            <img src="{{ asset('storage/' . $test->image) }}" alt="" style="max-width: 100%; max-height: 100%; border: 2px solid #ddd; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                        </div>
                                        <div class="coursesCard__image_overlay rounded-8"></div>
                                    </div>
                                </div>

                                <div class="h-100 pt-15">
                                    <div class="text-17 lh-15 fw-500 text-dark-1 mt-10 text-center">
                                        {{$test->title}}
                                    </div>
                                    <div class="d-flex items-center justify-content-evenly pt-10">
                                        <div class="d-flex items-center">
                                            <div class="mr-8">
                                                <img src="{{asset('assets/img/coursesCards/icons/1.svg')}}" alt="icon">
                                            </div>
                                            <div class="text-14 lh-1 text-dark-1">{{$module}} module</div>
                                        </div>
                                        <div class="d-flex items-center">
                                            <div class="mr-8">
                                                <img src="{{asset('assets/img/coursesCards/icons/2.svg')}}" alt="icon">
                                            </div>
                                            <div class="text-14 lh-1 text-dark-1">3h 56m</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
            @endif
                </div>
            </div>

{{--                  <div class="container mt-30">--}}
{{--                      <div class="row justify-content-center">--}}
{{--                          <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">--}}
{{--                              <a href="{{ url('user/first') }}">--}}
{{--                                  <div class="relative">--}}
{{--                                      <div class="coursesCard__image overflow-hidden rounded-top-8">--}}
{{--                                          <img class="w-1/1" src="{{asset('assets/img/coursesCards/img_2.png')}}" style="height: 180px;"  alt="image">--}}
{{--                                          <div class="coursesCard__image_overlay rounded-top-8"></div>--}}
{{--                                      </div>--}}
{{--                                  </div>--}}
{{--                                  <div class="h-100 pt-20 pb-15 px-30">--}}
{{--                                      <div class="text-17 lh-15 fw-500 text-dark-1 mt-10">Ishga kirish testi</div>--}}
{{--                                      <div class="d-flex x-gap-10 items-center pt-10">--}}
{{--                                          <div class="d-flex items-center">--}}
{{--                                              <div class="mr-8">--}}
{{--                                                  <img src="{{asset('assets/img/coursesCards/icons/1.svg')}}" alt="icon">--}}
{{--                                              </div>--}}
{{--                                              <div class="text-14 lh-1">3 ta imkoniyat bor</div>--}}
{{--                                          </div>--}}
{{--                                          <div class="d-flex items-center">--}}
{{--                                              <div class="mr-8">--}}
{{--                                                  <img src="{{asset('assets/img/coursesCards/icons/2.svg')}}" alt="icon">--}}
{{--                                              </div>--}}
{{--                                              <div class="text-14 lh-1">3h 56m</div>--}}
{{--                                          </div>--}}
{{--                                      </div>--}}
{{--                                  </div>--}}
{{--                              </a>--}}
{{--                          </div>--}}
{{--                      </div>--}}
{{--                  </div>--}}







        <footer class="footer -dashboard py-30">
            <div class="row items-center justify-between">
                <div class="col-auto">
                    <div class="text-13 lh-1">© 2024 Novatio. All Right Reserved.</div>
                </div>

                <div class="col-auto">
                    <div class="d-flex items-center">
                        <div class="d-flex items-center flex-wrap x-gap-20">
                            <div>
                                <a href="" class="text-13 lh-1">Help</a>
                            </div>
                            <div>
                                <a href="" class="text-13 lh-1">Privacy Policy</a>
                            </div>
                            <div>
                                <a href="#" class="text-13 lh-1">Cookie Notice</a>
                            </div>
                            <div>
                                <a href="#" class="text-13 lh-1">Security</a>
                            </div>
                            <div>
                                <a href="" class="text-13 lh-1">Terms of Use</a>
                            </div>
                        </div>

                        <button class="button -md -rounded bg-light-4 text-light-1 ml-30">English</button>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>

@endsection

