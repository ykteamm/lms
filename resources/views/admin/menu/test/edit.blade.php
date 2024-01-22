@extends('admin.layouts.action_app')
@section('title','Update test')
@section('action')
    <div class="dashboard__main">
        <div class="dashboard__content bg-light-4">
            <div class="row pb-50 mb-10">
                <div class="col-auto">
                    <h1 class="text-30 lh-12 fw-700">Update test</h1>
                </div>
            </div>

            @foreach($question as $test)
            <div class="row">
                <form action="{{route('test.update',$test->id)}}" method="POST" class="form-group">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="mb-3">
                            <label for="title" class="form-label fw-700">Question title</label>
                            <input type="text" value="{{$test->title}}" class="form-control" id="title" name="title">
                            @error('title')
                            <div style="color: red" class="form-text">You are must be write question title!</div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <div class="mb-3 mt-30">
                                <label for="variant_a" class="form-label fw-700">Variant A</label>
                                <input type="text" value="{{$test->variant_a}}" class="form-control" id="variant_a" name="variant_a">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3 mt-30">
                                <label for="variant_b" class="form-label fw-700">Variant B</label>
                                <input type="text" value="{{$test->variant_b}}" class="form-control" id="variant_b" name="variant_b">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3 mt-30">
                                <label for="variant_c" class="form-label fw-700">Variant C</label>
                                <input type="text" value="{{$test->variant_c}}" class="form-control" id="variant_c" name="variant_c">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3 mt-30">
                                <label for="variant_d" class="form-label fw-700">Variant D</label>
                                <input type="text" value="{{$test->variant_d}}" class="form-control" name="variant_d" id="variant_d">
                            </div>
                        </div>
                        <div class="mb-3 mt-30">
                            <label for="answer" class="form-label fw-700">Answer</label>
                            <select class="form-select" id="answer" name="answer" required>
                                <option @if($test->answer ==null) selected @else @endif value="">Select Answer</option>
                                <option @if($test->answer == "A") selected @else @endif value="A">Variant A</option>
                                <option @if($test->answer == "B") selected @else @endif value="B" >Variant B</option>
                                <option @if($test->answer == "C") selected @else @endif value="C">Variant C</option>
                                <option @if($test->answer == "D") selected @else @endif value="D">Variant D</option>
                            </select>
                            @error('answer')
                            <div style="color: red" class="form-text">You are must be write question title!</div>
                            @enderror
                            {{--                        <input type="text" class="form-control" id="answer">--}}
                        </div>
                    </div>

                    <button type="submit" class="btn btn-info mt-30">
                        <i class="fas fa-edit"></i>
                        Update
                    </button>
                </form>
            </div>
            @endforeach
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
