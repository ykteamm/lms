@extends('admin.layouts.action_app')
@section('title','Update videos')
@section('action')
    <div class="dashboard__main">
        <div class="dashboard__content bg-light-4">
            <div class="row pb-50 mb-10">
                <div class="col-auto">
                    <h1 class="text-30 lh-12 fw-700">Update videos</h1>
                </div>
            </div>

            <div class="row">
                <form action="{{route('video.update',$video->id)}}" method="POST" class="form-group">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="mb-3">
                            <label for="title" class="form-label fw-700">Title</label>
                            <input type="text" value="{{$video->title}}" class="form-control" id="title" name="title">
                            @error('title')
                            <div style="color: red" class="form-text">You are must be write question title!</div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <div class="mb-3 mt-30">
                                <label for="url" class="form-label fw-700">URL</label>
                                <input type="text" value="{{$video->url}}" class="form-control" id="url" name="url">
                            </div>
                            @error('url')
                            <div style="color: red" class="form-text">You are must be write url!</div>
                            @enderror
                        </div>

                        <div class="mb-3 mt-30 col-6">
                            <label for="group_test_id" class="form-label fw-700">Group Test ID</label>
                            <select class="form-select" placeholder="Choose Group Test ID" id="group_test_id" name="group_test_id" required>
                                <option value="">--Select--</option>
                                @foreach($group_test as $test)
                                    <option @if($video->group_test_id == $test->id) selected @else @endif value="{{$test->id}}">{{$test->title}}</option>
                                @endforeach
                            </select>
                            @error('group_test_id')
                            <div style="color: red" class="form-text">You are must be select group test id!</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <div class="mb-3 mt-30 contact-form">
                                <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Textarea</label>
                                <textarea placeholder="Content..." class="form-control" rows="7" name="content_type" style="outline: none;width: 100%;background-color: transparent; border-radius: 8px;border: 1px solid #DDDDDD; font-size: 15px;line-height: 1.5;padding: 15px 22px;transition: all 0.15s cubic-bezier(0.165, 0.84, 0.44, 1);">{{$video->content}}</textarea>
                            </div>
                            @error('content_type')
                            <div style="color: red" class="form-text">You are must be write content!</div>
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
