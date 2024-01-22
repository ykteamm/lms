@extends('admin.layouts.action_app')
@section('title','Update group test')
@section('action')
    <div class="dashboard__main">
        <div class="dashboard__content bg-light-4">
            <div class="row pb-50 mb-10">
                <div class="col-auto">
                    <h1 class="text-30 lh-12 fw-700">Update group test</h1>
                </div>
            </div>

            <div class="row">
                <form action="{{route('group_test.update',$groupTest->id)}}" method="POST" class="form-group">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="mb-3">
                            <label for="title" class="form-label fw-700">Group test title</label>
                            <input type="text" value="{{$groupTest->title}}" class="form-control" id="title" name="title">
                            @error('title')
                            <div style="color: red" class="form-text">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="mb-3 mt-30">
                            <label for="test_json" class="form-label fw-700">Test json</label>
                            <div class="form-group">
                                <select multiple placeholder="Choose tests" data-allow-clear="1" id="test_json" name="test_json[]" required>
                                    @foreach($relatedTests as $test)
                                        <option value="{{$test->id}}" {{ in_array($test->id, $testIds) ? 'selected' : '' }}>
                                            {{$test->title}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('test_json')
                            <div style="color: red" class="form-text">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="ball" class="form-label fw-700">Ball</label>
                            <input type="text" value="{{$groupTest->ball}}" class="form-control" id="ball" name="ball">
                            @error('ball')
                            <div style="color: red" class="form-text">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="limit" class="form-label fw-700">Limit</label>
                            <input type="text" value="{{$groupTest->limit}}" class="form-control" id="limit" name="limit">
                            @error('limit')
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
