<?php
use App\Models\Test;
?>
@extends('admin.layouts.action_app')
@section('title','Video dars')
@section('summernote-editor')
    <!-- include libraries(jQuery, bootstrap) -->
{{--    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">--}}
{{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">--}}
    <!-- include summernote css/js -->
{{--    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />--}}
    <style>
        .panel-heading,.note-toolbar{
            border: 1px solid black;
        }
        .note-btn-group,.btn-group{
            border: 1px solid black;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection
@section('action')
    <div class="dashboard__main">
        <div class="dashboard__content bg-light-4">

            <div class="row pb-20 mb-10">
                <div class="col-3">
                    <a href="{{route('lessons-index',['module_id'=>$lesson_id->module_id])}}" class="btn btn-danger text-white">
                        <i class="fas fa-backward"></i>
                        Orqaga qaytish
                    </a>
                </div>
            </div>

            @if(session()->has('success'))
                <div class="row">
                    <div class="col-12 ">
                        <div class="alert bg-success-1 alert-dismissible fade show pb-20 pt-20 pl-20 pr-20 rounded-8" role="alert">
                            <div class="text-success-2 lh-1 fw-500">{{session('success')}}</div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            @elseif(session()->has('error'))
                <div class="row">
                    <div class="col-12 ">
                        <div class="alert bg-error-1 alert-dismissible fade show pb-20 pt-20 pl-20 pr-20 rounded-8" role="alert">
                            <div class="text-success-2 lh-1 fw-500">{{session('error')}}</div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="col-10">
                    <h1 class="text-30 lh-12 fw-700">{{$lesson_id->title}}</h1>
                </div>
                <div class="col-2">

                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="fas fa-edit"></i>
                        Tahrirlash
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl mt-50">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Siz {{$lesson_id->title}} darsini tahrirlayapsiz!</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body ">
                                    <form action="{{ route('lesson-video-dars-update',['video_id' => $video_dars->id]) }}" method="POST" class="form-group" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" class="form-control" id="lesson_id" value="{{$video_dars->lesson_id}}" name="lesson_id" required>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label for="url" class="form-label fw-700">Video dars URL</label>
                                                    <input type="text" class="border form-control" value="{{$video_dars->url}}" id="url" name="url" required>
                                                    @error('url')
                                                    <div style="color: red" class="form-text">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label for="image" class="form-label fw-700">Video dars rasmi</label>
                                                    @if($video_dars->image)
                                                        <br>
                                                        <div style="width: 200px; height: 150px; overflow: hidden; text-align: center; display: flex; align-items: center; justify-content: center;">
                                                            <img src="{{ asset('storage/' . $video_dars->image) }}" alt="" style="max-width: 100%; max-height: 100%; border: 2px solid #ddd; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                                        </div>
                                                        <br><br>
                                                    @endif
                                                    <input type="file" class="form-control" id="image" name="image" accept=".png, .jpg, .jpeg, .pdf">
                                                </div>
                                                @error('image')
                                                <div style="color: red" class="form-text">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label for="video_content" class="form-label fw-700">Video dars description</label>
                                                    <textarea name="video_content" id="video_content" cols="30" rows="10" required>{{$video_dars->content}}</textarea>
                                                </div>
                                                @error('video_content')
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
                </div>
            </div>

            <div class="row">
                <div class="col-xxl-12 col-xl-12 col-lg-12">
                    <div class="relative">

                        <div style="text-align: center">
                            <img class="w-full h-full rounded-16" src="{{asset('storage/'.$video_dars->image)}}" alt="image" width="350" height="80" style="border: 2px solid #ddd; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                        </div>

                        <div class="absolute-full-center d-flex justify-center items-center">
                            <a href="{{$video_dars->url}}" class="d-flex justify-center items-center size-60 rounded-full bg-white js-gallery" data-gallery="gallery1">
                                <div class="icon-play text-18"></div>
                            </a>
                        </div>
                    </div>

                    <div class="mt-20 lg:mt-20">
                        <h4 class="text-18 fw-500">Ta'rif</h4>
                        <div class="mt-30">
                            {!! $video_dars->content !!}
                        </div>

                        <div class="mt-60">
                            <div class="row">
                                <div class="col-10">
                                    <h4 class="text-20 mb-30">Testlar ro'yxati</h4>
                                </div>
                                <div class="col-2">
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleTest">
                                        <i class="fas fa-plus"></i>
                                        Test yaratish
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleTest" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg mt-50">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Siz {{$video_dars->title}} darsiga test qo'shayapsiz!</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body ">
                                                    <form action="{{route('test.store')}}" method="POST" class="form-group">
                                                        <input type="hidden" value="{{$video_dars->lesson_id}}" name="lesson_id">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="mb-3">
                                                                <label for="title" class="form-label fw-700">Question title</label>
                                                                <input type="text" class="form-control border" id="title" name="title" required>
                                                                @error('title')
                                                                <div style="color: red" class="form-text">You are must be write question title!</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="mb-3 mt-10">
                                                                    <label for="variant_a" class="form-label fw-700">Variant A</label>
                                                                    <input type="text" class="form-control border" id="variant_a" name="variant_a" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="mb-3 mt-10">
                                                                    <label for="variant_b" class="form-label fw-700">Variant B</label>
                                                                    <input type="text" class="form-control border" id="variant_b" name="variant_b" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="mb-3 mt-10">
                                                                    <label for="variant_c" class="form-label fw-700">Variant C</label>
                                                                    <input type="text" class="form-control border" id="variant_c" name="variant_c" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="mb-3 mt-10">
                                                                    <label for="variant_d" class="form-label fw-700">Variant D</label>
                                                                    <input type="text" class="form-control border" name="variant_d" id="variant_d" required>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 mt-30">
                                                                <label for="answer1" class="form-label fw-700">Answer</label>
                                                                <select class="form-select" id="answer1" name="answer" required>
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
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="row x-gap-100 justfiy-between">
                                @foreach($tests as $test)
                                <div class="col-6 mt-20 ">
                                    <div class="border pl-10 pr-10 pt-10 pb-10">
                                        <h4 class="text-center">{{$test->title}}</h4>
                                        <p><span class="text-black fw-700">A:</span>{{$test->variant_a}}</p>
                                        <p><span class="text-black fw-700">B:</span> {{$test->variant_b}}</p>
                                        <p><span class="text-black fw-700">C:</span>{{$test->variant_c}}</p>
                                        <p><span class="text-black fw-700">D:</span>{{$test->variant_d}}</p>
                                        <p><span class="text-black fw-700">Answer: </span> {{$test->answer}}</p>

                                        <div class="text-center py-20">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#EditTest{{$test->id}}">
                                                <i class="fas fa-edit"></i>
                                                Testni tahrirlash
                                            </button>
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade" id="EditTest{{$test->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg mt-50">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Siz {{$test->title}} testini tahrirlayapsiz!</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body ">
                                                        <form action="{{route('test.update',$test->id)}}" method="POST" class="form-group">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" value="{{$video_dars->lesson_id}}" name="lesson_id">
                                                            <div class="row">
                                                                <div class="mb-3">
                                                                    <label for="title" class="form-label fw-700">Question title</label>
                                                                    <input type="text" value="{{$test->title}}" class="border form-control" id="title" name="title" required>
                                                                    @error('title')
                                                                    <div style="color: red" class="form-text">You are must be write question title!</div>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="mb-3 mt-10">
                                                                        <label for="variant_a" class="form-label fw-700">Variant A</label>
                                                                        <input type="text" value="{{$test->variant_a}}" class="border form-control" id="variant_a" name="variant_a" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="mb-3 mt-10">
                                                                        <label for="variant_b" class="form-label fw-700">Variant B</label>
                                                                        <input type="text" value="{{$test->variant_b}}" class="form-control border" id="variant_b" name="variant_b" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="mb-3 mt-10">
                                                                        <label for="variant_c" class="form-label fw-700">Variant C</label>
                                                                        <input type="text" value="{{$test->variant_c}}" class="form-control border" id="variant_c" name="variant_c" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="mb-3 mt-10">
                                                                        <label for="variant_d" class="form-label fw-700">Variant D</label>
                                                                        <input type="text" value="{{$test->variant_d}}" class="form-control border" name="variant_d" id="variant_d" required>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3 mt-30">
                                                                    <label for="answer" class="form-label fw-700">Answer</label>
                                                                    <select class="form-select" id="answer" name="answer" required>
                                                                        <option @if($test->answer == null) selected @else @endif value="">Select Answer</option>
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

                                                            <div class="text-center">
                                                                <button type="submit" class="btn btn-primary mt-30">
                                                                    <i class="fas fa-edit"></i>
                                                                    Tahrirlash
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="mt-60">
                            <div class="row">
                                <div class="col-8">
                                    <h2 class="text-20">Testni qoidalari</h2>
                                </div>
                                <div class="col-4">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#TestQoida">
                                        <i class="fas fa-edit"></i>
                                        Test qoidalarini tahrirlash
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="TestQoida" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg mt-50">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Siz test qoidalarini tahrirlayapsiz!</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body ">
                                                    <form action="{{route('lesson-group-test-update',['id'=>$group_test->id])}}" method="POST" class="form-group">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" value="{{$video_dars->lesson_id}}" name="lesson_id">
                                                        <div class="row">
                                                            <div class="mb-3">
                                                                <label for="level" class="form-label fw-700">Level</label>
                                                                <input type="text" value="{{$group_test->level}}" class="border form-control" id="level" name="level" required>
                                                                @error('level')
                                                                <div style="color: red" class="form-text">{{$message}}</div>
                                                                @enderror
                                                            </div>

                                                           <div class="col-6">
                                                               <div class="mb-3">
                                                                   <label for="ball" class="form-label fw-700">Ball</label>
                                                                   <input type="number" value="{{$group_test->ball}}" class="border form-control" id="ball" name="ball" required>
                                                                   @error('ball')
                                                                   <div style="color: red" class="form-text">{{$message}}</div>
                                                                   @enderror
                                                               </div>
                                                           </div>

                                                            <div class="col-6">
                                                                <div class="mb-3">
                                                                    <label for="limit" class="form-label fw-700">Limit</label>
                                                                    <input type="number" value="{{$group_test->limit}}" class="border form-control" id="limit" name="limit" required>
                                                                    @error('limit')
                                                                    <div style="color: red" class="form-text">{{$message}}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="text-center">
                                                            <button type="submit" class="btn btn-primary mt-30">
                                                                <i class="fas fa-edit"></i>
                                                                Tahrirlash
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <ul class="ul-list y-gap-15 pt-30">
                                <h4 class="text-20"> Dars: {{$lesson_id->title}}</h4>
                                <li><span class="text-black fw-700">Daraja: </span>{{$group_test->level}}</li>
                                <li><span class="text-black fw-700">Ball: </span>{{$group_test->ball}}</li>
                                <li><span class="text-black fw-700">Limit: </span>{{$group_test->limit}}</li>
                            </ul>
                        </div>
                    </div>

                </div>
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
            height:300,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['height', ['height']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['codeview', 'help']],
            ],
            fontNames: ['Helvetica','Verdana','Georgia','Arial','Times New Roman','Arial Black', 'Comic Sans MS', 'Merriweather','GT Walsheim Pro'],
            addDefaultFonts: false,
            fontSizeUnits: ['px'],
        })
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            // Add new question button click event
            $('#addQuestionBtn').click(function() {
                var questionCount = $('.question-container').length + 1;

                var newQuestionHtml = `
                <div class="question-container mt-30 mb-3 p-5" style="border: 2px solid #ddd; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                   <label for="title${questionCount}" class="form-label fw-700">Question title</label>
                    <input type="text" class="form-control" id="title${questionCount}" name="questions[${questionCount}][title]" required>

                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3 mt-30">
                                <label for="variant_a${questionCount}" class="form-label fw-700">Variant A</label>
                                <input type="text" class="form-control" id="variant_a${questionCount}" name="questions[${questionCount}][variants][variant_a]" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3 mt-30">
                                <label for="variant_b${questionCount}" class="form-label fw-700">Variant B</label>
                                <input type="text" class="form-control" id="variant_b${questionCount}" name="questions[${questionCount}][variants][variant_b]" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3 mt-30">
                                <label for="variant_c${questionCount}" class="form-label fw-700">Variant C</label>
                                <input type="text" class="form-control" id="variant_c${questionCount}" name="questions[${questionCount}][variants][variant_c]" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3 mt-30">
                                <label for="variant_d${questionCount}" class="form-label fw-700">Variant D</label>
                                <input type="text" class="form-control" id="variant_d${questionCount}" name="questions[${questionCount}][variants][variant_d]" required>
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
