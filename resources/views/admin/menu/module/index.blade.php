@extends('admin.layouts.action_app')
@section('title','Module qo\'shish')
@section('action')
    <div class="dashboard__main">
        <div class="dashboard__content bg-light-4">
            <div class="row pb-20 mb-10">
                <div class="col-3">
                    <a href="{{route('course.index')}}" class="btn btn-danger text-white">
                        <i class="fas fa-backward"></i>
                        Orqaga qaytish
                    </a>
                </div>
            </div>
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
            <div class="row pb-20 mb-10">
                <div class="col-6">
                    <h1 class="text-30 lh-12 fw-700">Modullar</h1>
                </div>
                <div class="col-6 d-flex justify-content-end">
                    <button class="btn btn-success text-white" type="button" data-bs-toggle="modal"
                            data-bs-target="#CourseModuleCreate">
                        <i class="fas fa-plus"></i>
                        Yaratish
                    </button>

                    <div class="modal fade" id="CourseModuleCreate" tabindex="-1" aria-labelledby="exampleModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Siz module yaratayapsiz!</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('module.store')}}" method="POST" class="form-group"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" class="form-control" id="course_id" value="{{$course->id}}"
                                               name="course_id">
                                        <div class="row">
                                            <div class="mb-3">
                                                <label for="title" class="form-label fw-700">Module nomi</label>
                                                <input type="text" class="border form-control" id="title" name="title"
                                                       required>
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
                @foreach($module as $modul)
                    @php
                        $lesson =  \App\Models\Lesson::where('module_id', $modul->id)->count()
                    @endphp
                    <div class="side-content ml-10 mr-10 mt-20 col-xl-5 col-lg-5 col-md-5 col-sm-5"
                         style="border: 2px solid #ddd; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                        <a href="{{route('lessons-index', ['module_id' => $modul->id])}}" class="coursesCard -type-1 ">
                            <div class="h-100">
                                <div class="text-17 lh-15 fw-500 text-dark-1 mt-10">
                                    {{$modul->title}}
                                </div>
                                <div class="d-flex items-center justify-content-around  pt-10">
                                    <div class="d-flex items-center">
                                        <div class="mr-8">
                                            <img src="{{asset('assets/img/coursesCards/icons/1.svg')}}" alt="icon">
                                        </div>
                                        <div class="text-14 lh-1">{{$lesson}} lesson</div>
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
                            <div class="col-5 text-center">
                                <button class="btn btn-primary text-white" type="button" data-bs-toggle="modal"
                                        data-bs-target="#CourseModalEdit{{$modul->id}}">
                                    <i class="fas fa-edit"></i>
                                    Tahrirlash
                                </button>
                                {{--                                modal edit--}}
                                <!-- Modal -->
                                <div class="modal fade" id="CourseModalEdit{{$modul->id}}" tabindex="-1"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                    Siz {{$modul->title}} kursini tahrirlamoqchisiz!</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('module.update',$modul->id)}}" method="POST"
                                                      class="form-group" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" value="{{$modul->course_id}}"
                                                           class="form-control" id="course_id" name="course_id">
                                                    <div class="row">
                                                        <div class="mb-3">
                                                            <label for="title" class="form-label fw-700">Module
                                                                nomi</label>
                                                            <input type="text" value="{{$modul->title}}"
                                                                   class="form-control" id="title" name="title">
                                                            @error('title')
                                                            <div style="color: red" class="form-text">{{$message}}</div>
                                                            @enderror

                                                            <label for="status" class="form-label fw-700">Module
                                                                status</label>
                                                            <input type="number" value="{{$modul->status}}"
                                                                   class="form-control" id="status" name="status">
                                                            @error('number')
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
                                <button class="btn btn-danger text-white" type="button" data-bs-toggle="modal"
                                        data-bs-target="#CourseModal{{$modul->id}}">
                                    <i class="fas fa-trash-alt"></i>
                                    O'chirish
                                </button>
                                {{--                                                                modal delete--}}
                                <div class="modal fade" id="CourseModal{{$modul->id}}" tabindex="-1"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog ">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                    Siz {{$modul->title}} moduleni o'chirmoqchisiz!</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('module.destroy',['module' => $modul->id])}}"
                                                      method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" value="{{$modul->course_id}}"
                                                           class="form-control" id="course_id" name="course_id">
                                                    <h3>Sizni ishonchingiz komilmi!</h3>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Yopish
                                                        </button>
                                                        <button type="submit" class="btn btn-danger">
                                                            <i class="fas fa-trash-alt"></i>
                                                            Modulni o'chirish
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
