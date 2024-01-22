@extends('admin.layouts.action_app')
@section('title','Update lessons')
@section('action')
    <div class="dashboard__main">
        <div class="dashboard__content bg-light-4">
            <div class="row pb-50 mb-10">
                <div class="col-auto">
                    <h1 class="text-30 lh-12 fw-700">Update lessons</h1>
                </div>
            </div>

            <div class="row">
                <form action="{{route('lessons.update',$lessons->id)}}" method="POST" class="form-group">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="mb-3">
                            <label for="title" class="form-label fw-700">Lessons title</label>
                            <input type="text" value="{{$lessons->title}}" class="form-control" id="title" name="title">
                            @error('title')
                            <div style="color: red" class="form-text">You are must be write question title!</div>
                            @enderror
                        </div>

                        <div class="mb-3 mt-30 col-4">
                            <label for="course_id" class="form-label fw-700">Course ID</label>
                            <select class="form-select" placeholder="Choose Course ID" id="course_id" name="course_id">
                                <option value="">--Select--</option>
                                @foreach($course as $test)
                                    <option @if($lessons->course_id == $test->id) selected @else @endif value="{{$test->id}}">{{$test->title}}</option>
                                @endforeach
                            </select>
                            @error('course_id')
                            <div style="color: red" class="form-text">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="mb-3 mt-30 col-4">
                            <label for="video_id" class="form-label fw-700">Video ID</label>
                            <select class="form-select" placeholder="Choose Video ID" id="video_id" name="video_id">
                                <option value="">--Select--</option>
                                @foreach($video as $test)
                                    <option @if($lessons->video_id == $test->id) selected @else @endif value="{{$test->id}}">{{$test->title}}</option>
                                @endforeach
                            </select>
                            @error('group_test_id')
                            <div style="color: red" class="form-text">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="mb-3 mt-30 col-4">
                            <label for="medicine_id" class="form-label fw-700">Medicine ID</label>
                            <select class="form-select" placeholder="Choose Medicine ID" id="medicine_id" name="medicine_id">
                                <option value="">--Select--</option>
                                @foreach($medicine as $test)
                                    <option @if($lessons->medicine_id == $test->id) selected @else @endif value="{{$test->id}}">{{$test->title}}</option>
                                @endforeach
                            </select>
                            @error('medicine_id')
                            <div style="color: red" class="form-text">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-info mt-30">
                        <i class="fas fa-edit"></i>
                        Update
                    </button>
                </form>
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
