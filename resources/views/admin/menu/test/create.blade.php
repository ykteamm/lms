@extends('admin.layouts.action_app')
@section('title','Create test')
@section('action')
<div class="dashboard__main">
    <div class="dashboard__content bg-light-4">
        <div class="row pb-50 mb-10">
            <div class="col-auto">
                <h1 class="text-30 lh-12 fw-700">Create test</h1>
            </div>
        </div>

        <div class="row">
            <form action="{{route('test.store')}}" method="POST" class="form-group">
                @csrf
                <div class="row">
                    <div class="mb-3">
                        <label for="title" class="form-label fw-700">Question title</label>
                        <input type="text" class="form-control" id="title" name="title">
                        @error('title')
                        <div style="color: red" class="form-text">You are must be write question title!</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <div class="mb-3 mt-30">
                            <label for="variant_a" class="form-label fw-700">Variant A</label>
                            <input type="text" class="form-control" id="variant_a" name="variant_a">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3 mt-30">
                            <label for="variant_b" class="form-label fw-700">Variant B</label>
                            <input type="text" class="form-control" id="variant_b" name="variant_b">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3 mt-30">
                            <label for="variant_c" class="form-label fw-700">Variant C</label>
                            <input type="text" class="form-control" id="variant_c" name="variant_c">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3 mt-30">
                            <label for="variant_d" class="form-label fw-700">Variant D</label>
                            <input type="text" class="form-control" name="variant_d" id="variant_d">
                        </div>
                    </div>
                    <div class="mb-3 mt-30">
                        <label for="answer1" class="form-label fw-700">Answer</label>
                        <select class="form-select" id="answer1" name="answer" >
                            <option value="">Select Answer</option>
                            <option value="A">Variant A</option>
                            <option value="B">Variant B</option>
                            <option value="C">Variant C</option>
                            <option value="D">Variant D</option>
                        </select>
                        @error('answer')
                        <div style="color: red" class="form-text">{{$message}}</div>
                        @enderror
{{--                        <input type="text" class="form-control" id="answer">--}}
                    </div>
                </div>

                <button type="submit" class="btn btn-info mt-30">
                    <i class="fas fa-plus"></i>
                    Create
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
