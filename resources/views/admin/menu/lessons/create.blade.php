<?php
use App\Models\Test;
?>
@extends('admin.layouts.action_app')
@section('title','Create lessons')
@section('summernote-editor')
    <!-- include libraries(jQuery, bootstrap) -->
{{--    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">--}}

    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection
@section('action')
    <div class="dashboard__main">
        <div class="dashboard__content bg-light-4">
            <div class="row pb-20 mb-10">
                <div class="col-3">
                    <a href="{{route('lessons-index',['module_id'=>$module_id->module_id])}}" class="btn btn-danger text-white">
                        <i class="fas fa-backward"></i>
                        Orqaga qaytish
                    </a>
                </div>
            </div>


            <div class="row pb-30 mb-10">
                <div class="col-auto">
                    <h1 class="text-30 lh-12 fw-700">Video dars yaratish</h1>
                </div>
            </div>

            <div class="row">
                <form action="{{route('lessons-video-dars')}}" method="POST" class="form-group" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" class="form-control" id="lesson_id" value="{{$lesson_id}}" name="lesson_id" required>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="url" class="form-label fw-700">Video dars URL</label>
                                <input type="text" class="border form-control" id="url" name="url">
                                @error('url')
                                <div style="color: red" class="form-text">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="image" class="form-label fw-700">Video dars rasmi</label>
                                <input type="file" class="form-control" id="image" name="image" accept=".png, .jpg, .jpeg, .pdf" required>
                            </div>
                            @error('image')
                            <div style="color: red" class="form-text">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="video_content" class="form-label fw-700">Video dars description</label>
                                <textarea name="video_content" id="video_content" cols="30" rows="10" required></textarea>
                            </div>
                            @error('video_content')
                            <div style="color: red" class="form-text">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="row mt-20">
                            <div class="col-md-12 text-center">
                                <h3>Video darsga test qo'shish</h3>
                                <hr>
                            </div>
                        </div>



                        <div id="questions-container">
                            <!-- Questions will be dynamically added here -->
                            <div class="question-container mt-30 mb-3 p-5" style="border: 2px solid #ddd; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                <h6 class="mb-20">Savol: 1</h6>
                                <label for="title1" class="form-label fw-700">Question title</label>
                                <input type="text" class="form-control" id="title1" name="questions[1][title]" required>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3 mt-30">
                                            <label for="variant_a1" class="form-label fw-700">Variant A</label>
                                            <input type="text" class="form-control" id="variant_a1" name="questions[1][variants][variant_a]" >
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3 mt-30">
                                            <label for="variant_b1" class="form-label fw-700">Variant B</label>
                                            <input type="text" class="form-control" id="variant_b1" name="questions[1][variants][variant_b]" >
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3 mt-30">
                                            <label for="variant_c1" class="form-label fw-700">Variant C</label>
                                            <input type="text" class="form-control" id="variant_c1" name="questions[1][variants][variant_c]" >
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3 mt-30">
                                            <label for="variant_d1" class="form-label fw-700">Variant D</label>
                                            <input type="text" class="form-control" id="variant_d1" name="questions[1][variants][variant_d]" >
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 mt-30">
                                    <label for="answer1" class="form-label fw-700">Answer</label>
                                    <select class="form-select answer-select" id="answer1" name="questions[1][answer]" required>
                                        <option value="">Select Answer</option>
                                        <option value="A">Variant A</option>
                                        <option value="B">Variant B</option>
                                        <option value="C">Variant C</option>
                                        <option value="D">Variant D</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-primary float-right" id="addQuestionBtn">Add Question</button>

                    <div class="row mt-20">
                        <div class="col-md-12 text-center">
                            <h3>Testga limit, ball va level qo'shish</h3>
                            <hr>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-4">
{{--                            <div class="mb-3">--}}
{{--                                <label for="level" class="form-label fw-700">Level</label>--}}
{{--                                --}}
{{--                                <input type="text" class="border form-control" id="level" name="level" required>--}}
{{--                                @error('level')--}}
{{--                                <div style="color: red" class="form-text">{{$message}}</div>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
                            <div class="mb-3">
                                <label for="level" class="form-label fw-700">Level</label>
                                <select class="form-select answer-select" id="level" name="level" required>
                                    <option value="">--Select--</option>
                                    <option value="Boshlang'ich">Boshlang'ich</option>
                                    <option value="O'rta">O'rta</option>
                                    <option value="Yuqori">Yuqori</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="ball" class="form-label fw-700">Ball</label>
                                <input type="number" class="border form-control" id="ball" name="ball" required>
                                @error('ball')
                                <div style="color: red" class="form-text">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="limit" class="form-label fw-700">Limit</label>
                                <input type="number" class="border form-control" id="limit" name="limit" required>
                                @error('limit')
                                <div style="color: red" class="form-text">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-info mt-50">
                        <i class="fas fa-plus"></i>
                        Yaratish
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
@section('summernote-editor-js')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script type="text/javascript">
        $('#video_content').summernote({
            placeholder:'Tarif...',
            tabsize:2,
            height:300
        })
    </script>
    <script type="text/javascript">
    $(document).ready(function() {
        // Add new question button click event
        $('#addQuestionBtn').click(function() {
            var questionCount = $('.question-container').length + 1;

            var newQuestionHtml = `
                <div class="question-container mt-30 mb-3 p-5" style="border: 2px solid #ddd; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                    <h6 class="mb-20">Savol: ${questionCount}</h6>
                   <label for="title${questionCount}" class="form-label fw-700">Question title</label>
                    <input type="text" class="form-control" id="title${questionCount}" name="questions[${questionCount}][title]" required>

                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3 mt-30">
                                <label for="variant_a${questionCount}" class="form-label fw-700">Variant A</label>
                                <input type="text" class="form-control" id="variant_a${questionCount}" name="questions[${questionCount}][variants][variant_a]" >
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3 mt-30">
                                <label for="variant_b${questionCount}" class="form-label fw-700">Variant B</label>
                                <input type="text" class="form-control" id="variant_b${questionCount}" name="questions[${questionCount}][variants][variant_b]" >
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3 mt-30">
                                <label for="variant_c${questionCount}" class="form-label fw-700">Variant C</label>
                                <input type="text" class="form-control" id="variant_c${questionCount}" name="questions[${questionCount}][variants][variant_c]" >
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3 mt-30">
                                <label for="variant_d${questionCount}" class="form-label fw-700">Variant D</label>
                                <input type="text" class="form-control" id="variant_d${questionCount}" name="questions[${questionCount}][variants][variant_d]" >
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 mt-30">
                        <label for="answer${questionCount}" class="form-label fw-700">Answer</label>
                        <select class="form-select answer-select" id="answer${questionCount}" name="questions[${questionCount}][answer]" required>
                            <option value="">Select Answer</option>
                            <option value="A">Variant A</option>
                            <option value="B">Variant B</option>
                            <option value="C">Variant C</option>
                            <option value="D">Variant D</option>
                        </select>
                    </div>
                    <button type="button" class="btn btn-danger remove-question mt-15">Savolni o'chirish</button>
                </div>
            `;

            $('#questions-container').append(newQuestionHtml);
            $('#answer' + questionCount).select2({
                theme: 'bootstrap4',
                width: 'style',
                placeholder: $('#answer' + questionCount).attr('placeholder'),
                allowClear: Boolean($('#answer' + questionCount).data('allow-clear')),
            });
        });

        // Remove question button click event
        $(document).on('click', '.remove-question', function() {
            $(this).closest('.question-container').remove();
        });

        $('.form-select').each(function() {
            $(this).select2({
                theme: 'bootstrap4',
                width: 'style',
                placeholder: $(this).attr('placeholder'),
                allowClear: Boolean($(this).data('allow-clear')),
            });
        });
    });
</script>
@endsection
