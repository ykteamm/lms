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

            @if(session()->has('natija'))
               <div class="modal fade show" id="Natija"  tabindex="-1" aria-labelledby="exampleModalLabel"  aria-modal="true" role="dialog" style="display: block">
                        <div class="modal-dialog modal-lg" >
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeModalButton"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="text-center">
                                        <img src="{{asset('assets/img/ibrat/natija.jpg')}}" width="200" height="50" alt="">
                                    </div>
                                    <div class="text-center" style="padding: 10px 20px">
                                        <h2 class="fw-700">Test yakunlandi</h2>
                                    </div>
                                    <div class="text-center" style="padding: 10px 30px">
                                        @if($first_group_test->ball <= $natija_result->foiz)
                                            <h5 style="color: #16e116">Muvaffaqiyatli o'tdingiz</h5>
                                        @else
                                            <h5 style="color: red">Muvaffaqiyatsiz urunish</h5>
                                        @endif
                                    </div>
                                    <div style="padding: 10px 10px">
                                        <div class="row align-items-center">
                                            <div class="col-xxl-3 col-xl-3  col-6  mt-20 text-center">
                                                <i class="fas fa-star text-14 lh-1" style="color: blue;"></i>
                                                <br>
                                                <p class="fw-400" style="color: black">O'tish bali</p>
                                                @if($passed == null)
                                                    <div class="col-12 mt-10 text-center">
                                                        <h6 style="color: red">{{$first_group_test ? $first_group_test->ball : null}}</h6>
                                                    </div>
                                                @else
                                                    <div class="col-12 mt-10 text-center">
                                                        <h6 style="color: red">{{$first_group_test->ball}}</h6>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-xxl-3 col-xl-3   col-6  mt-20 text-center">
                                                <i class="fas fa-star text-14 lh-1" style="color: blue;"></i>
                                                <br>
                                                <p class="fw-400" style="color: black">To'plagan balingiz</p>
                                                <div class="col-12 mt-10 text-center">
                                                    @if($first_group_test->ball <= $natija_result->foiz)
                                                        <h6 style="color: white; background: green;">{{$natija_result->foiz}}</h6>
                                                    @else
                                                        <h6 style="color: white; background: red;">{{$natija_result->foiz}}</h6>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-xxl-3 col-xl-3  col-6 mt-20 text-center">
                                                <i class="icon-infinity text-14 lh-1" style="color:blue;"></i>
                                                <br>
                                                <p class="fw-400" style="color: black">Imkoniyat</p>
                                                <div class="col-12 mt-10 text-center">
                                                    <h6 style="color: red">{{$passed->limit}}</h6>
                                                </div>
                                            </div>
                                            <div class="col-xxl-3 col-xl-3 col-6 mt-20 text-center">
                                                <i class="fas fa-gem text-14 lh-1" style="color:blue;"></i>
                                                <br>
                                                <p class="fw-400" style="color: black">Zumrad</p>
                                                <div class="col-12 mt-10 text-center">
                                                    <h6 style="color: red">
                                                        @if($first_group_test->ball <= $natija_result->foiz)
                                                            1
                                                        @else
                                                            0
                                                        @endif
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
            @endif

            @if(session()->has('ishga_kirish_natija'))
               <div class="modal fade show" id="Natija"  tabindex="-1" aria-labelledby="exampleModalLabel"  aria-modal="true" role="dialog" style="display: block">
                        <div class="modal-dialog modal-lg" >
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeModalButton"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="text-center">
                                        <img src="{{asset('assets/img/ibrat/natija.jpg')}}" width="200" height="50" alt="">
                                    </div>
                                    <div class="text-center" style="padding: 10px 20px">
                                        <h2 class="fw-700">Test yakunlandi</h2>
                                    </div>
                                    <div class="text-center" style="padding: 10px 30px">
                                        @if($first_group_test->ball <= $natija_result->foiz)
                                            <h5 style="color: #16e116">Muvaffaqiyatli o'tdingiz</h5>
                                        @else
                                            <h5 style="color: red">Muvaffaqiyatsiz urunish</h5>
                                        @endif
                                    </div>
                                    <div style="padding: 10px 10px">
                                        <div class="row align-items-center">
                                            <div class="col-xxl-3 col-xl-3  col-4  mt-20 text-center">
                                                <i class="fas fa-star text-14 lh-1" style="color: blue;"></i>
                                                <br>
                                                <p class="fw-400" style="color: black">O'tish bali</p>
                                                @if($passed == null)
                                                    <div class="col-12 mt-10 text-center">
                                                        <h6 style="color: red">{{$first_group_test ? $first_group_test->ball : null}}</h6>
                                                    </div>
                                                @else
                                                    <div class="col-12 mt-10 text-center">
                                                        <h6 style="color: red">{{$first_group_test->ball}}</h6>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-xxl-3 col-xl-3   col-4  mt-20 text-center">
                                                <i class="fas fa-star text-14 lh-1" style="color: blue;"></i>
                                                <br>
                                                <p class="fw-400" style="color: black">To'plagan balingiz</p>
                                                <div class="col-12 mt-10 text-center">
                                                    @if($first_group_test->ball <= $natija_result->foiz)
                                                        <h6 style="color: white; background: green;">{{$natija_result->foiz}}</h6>
                                                    @else
                                                        <h6 style="color: white; background: red;">{{$natija_result->foiz}}</h6>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-xxl-3 col-xl-3  col-4 mt-20 text-center">
                                                <i class="icon-infinity text-14 lh-1" style="color:blue;"></i>
                                                <br>
                                                <p class="fw-400" style="color: black">Imkoniyat</p>
                                                <div class="col-12 mt-10 text-center">
                                                    <h6 style="color: red">{{$passed ? $passed->limit : null}}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            @endif


            <div class="row pb-50 mb-10">
                <div class="col-8">
                    <h3 class="text-30 lh-12 fw-600">Salom, {{$user->first_name}}</h3>
                </div>
                <div class="col-1"></div>
                @if($user_check && $user->status ==1)
                    <div class="col-3 text-center">
                        <i class="fas fa-gem text-14 lh-1" style="color:blue;"></i>
                        @if($zumrad != null)
                            {{$zumrad->zumrad}}
                        @else
                            0
                        @endif
                    </div>
                @elseif($user->status == 1 && ($user->rol_id == 'old_user' || $user->rol_id == 'teacher'))
                    <div class="col-3 text-center">
                        <i class="fas fa-gem text-14 lh-1" style="color:blue;"></i>
                        @if($zumrad != null)
                            {{$zumrad->zumrad}}
                        @else
                            0
                        @endif
                    </div>
                @endif
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
    {{--                                    <div class="d-flex items-center">--}}
    {{--                                        <div class="mr-8">--}}
    {{--                                            <img src="{{asset('assets/img/coursesCards/icons/2.svg')}}" alt="icon">--}}
    {{--                                        </div>--}}
    {{--                                        <div class="text-14 lh-1 text-dark-1">3h 56m</div>--}}
    {{--                                    </div>--}}
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
    {{--                                        <div class="d-flex items-center">--}}
    {{--                                            <div class="mr-8">--}}
    {{--                                                <img src="{{asset('assets/img/coursesCards/icons/2.svg')}}" alt="icon">--}}
    {{--                                            </div>--}}
    {{--                                            <div class="text-14 lh-1 text-dark-1">3h 56m</div>--}}
    {{--                                        </div>--}}
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                @elseif($user->status == 1 && $user->rol_id == 'old_user')
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
                                            {{--                                        <div class="d-flex items-center">--}}
                                            {{--                                            <div class="mr-8">--}}
                                            {{--                                                <img src="{{asset('assets/img/coursesCards/icons/2.svg')}}" alt="icon">--}}
                                            {{--                                            </div>--}}
                                            {{--                                            <div class="text-14 lh-1 text-dark-1">3h 56m</div>--}}
                                            {{--                                        </div>--}}
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                @elseif($user->status == 1 && $user->rol_id == 'teacher')
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
                                            {{--                                        <div class="d-flex items-center">--}}
                                            {{--                                            <div class="mr-8">--}}
                                            {{--                                                <img src="{{asset('assets/img/coursesCards/icons/2.svg')}}" alt="icon">--}}
                                            {{--                                            </div>--}}
                                            {{--                                            <div class="text-14 lh-1 text-dark-1">3h 56m</div>--}}
                                            {{--                                        </div>--}}
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                @endif
                </div>
            </div>
    </div>
        @include('user.components.footer')
</div>

@endsection
@section('natija_js')
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            var natijaModal = document.getElementById('Natija');

            if (natijaModal.classList.contains('show')) {
                document.body.classList.add('modal-open');
                var backdrop = document.createElement('div');
                backdrop.classList.add('modal-backdrop', 'show');
                document.body.appendChild(backdrop);
                // .modal-backdrop.show {
                //         opacity: var(--bs-backdrop-opacity);
                //     }
            }
        });
        // Modal yopish uchun JavaScript
        document.getElementById('closeModalButton').addEventListener('click', function () {
            var body = document.body
            var modal = document.getElementById('Natija');
            var backdrop = document.querySelector('.modal-backdrop.show');
            modal.classList.remove('show');
            modal.style.display = 'none';
            body.classList.remove('modal-open');
            if (backdrop) {
                backdrop.remove();
            }
        });
    </script>
@endsection
