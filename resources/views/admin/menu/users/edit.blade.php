@extends('admin.layouts.action_app')
@section('title','Update Users Check')
@section('action')
    <div class="dashboard__main">
        <div class="dashboard__content bg-light-4">
            <div class="row pb-50 mb-10">
                <div class="col-auto">
                    <h1 class="text-30 lh-12 fw-700">Update Users Check</h1>
                </div>
            </div>

            <div class="row">
                <form action="{{route('users_check.update',$user_check->id)}}" method="POST" class="form-group">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="mb-3">
                            <label for="user_id" class="form-label fw-700">User ID</label>
                            <select class="form-select" placeholder="Choose User ID" id="user_id" name="user_id" required>
                                <option value="">--Select--</option>
                                @foreach($users as $test)
                                    <option @if($user_check->user_id == $test->id) selected @else @endif value="{{$test->id}}">{{$test->first_name}},{{$test->last_name}} | {{$test->username}}|</option>
                                @endforeach
                            </select>
                            @error('user_id')
                            <div style="color: red" class="form-text">You are must be select group test id!</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-3 mt-30">
                            <label for="video" class="form-label fw-700">Video</label>
                            <input type="checkbox" @if($user_check->video == 1) checked @else @endif value="1" class="" id="video" name="video">
                            @error('video')
                            <div style="color: red" class="form-text">You are must be write group test title!</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-3 mt-30">
                            <label for="one_day_apteka" class="form-label fw-700">One Day Apteka</label>
                            <input type="checkbox" @if($user_check->one_day_apteka == 1) checked @else @endif value="1" class="" id="one_day_apteka" name="one_day_apteka">
                            @error('one_day_apteka')
                            <div style="color: red" class="form-text">You are must be write group test title!</div>
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
