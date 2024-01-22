@extends('admin.layouts.action_app')
@section('title','Update raspisaniya')
@section('action')
    <div class="dashboard__main">
        <div class="dashboard__content bg-light-4">
            <div class="row pb-50 mb-10">
                <div class="col-auto">
                    <h1 class="text-30 lh-12 fw-700">Update raspisaniya</h1>
                </div>
            </div>

            <div class="row">
                <form action="{{route('raspisaniya.update',$raspisaniya->id)}}" method="POST" class="form-group">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="mb-3">
                            <label for="title" class="form-label fw-700">Raspisaniya title</label>
                            <input type="text" value="{{$raspisaniya->title}}" class="form-control" id="title" name="title" required>
                            @error('title')
                            <div style="color: red" class="form-text">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="mb-3 mt-30">
                            <label for="lesson_id" class="form-label fw-700">Lesson ID</label>
                            <div class="form-group">
                                <select multiple placeholder="Choose tests" data-allow-clear="1" id="lesson_id" name="lesson_id[]" required>
                                    @foreach($relatedTests as $test)
                                        <option value="{{$test->id}}" {{ in_array($test->id, $testIds) ? 'selected' : '' }}>
                                            {{$test->title}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('lesson_id')
                            <div style="color: red" class="form-text">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="day" class="form-label fw-700">Day</label>
                            <input type="number" value="{{$raspisaniya->day}}" class="form-control" id="day" name="day" required>
                            @error('day')
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
