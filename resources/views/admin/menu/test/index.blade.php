@extends('admin.layouts.app')
@section('title','Test')
@section('dashboard')
<div class="dashboard__main">
    <div class="dashboard__content bg-light-4">
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


            <div class="row pb-50 mb-10">
            <div class="col-6">
                <h1 class="text-30 lh-12 fw-700">Test</h1>
            </div>
            <div class="col-6 d-flex justify-content-end">
                <a href="{{route('test.create')}}">
                    <button class="btn btn-success text-white">
                        <i class="fas fa-plus"></i>
                        Create
                    </button>
                </a>
            </div>
        </div>


        <div class="row y-gap-30">

            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Title</th>
                    <th scope="col">Variant A</th>
                    <th scope="col">Variant B</th>
                    <th scope="col">Variant C</th>
                    <th scope="col">Variant D</th>
                    <th scope="col">Answer</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($question as $test)
                    <tr>
                        <th scope="row">{{$test->id}}</th>
                        <td>{{$test->title}}</td>
                        <td>{{$test->variant_a}}</td>
                        <td>{{$test->variant_b}}</td>
                        <td>{{$test->variant_c}}</td>
                        <td>{{$test->variant_d}}</td>
                        <td>{{$test->answer}}</td>
                        <td>
                            <div class="row">
                                <div class="col-4">
{{--                                    <button class="btn btn-warning text-white">--}}
{{--                                        <i class="fas fa-eye"></i>--}}
{{--                                        View--}}
{{--                                    </button>--}}
                                </div>
                                <div class="col-4">
                                    <a href="{{ route('test.edit', ['test' => $test->id]) }}">
                                        <button class="btn btn-primary text-white">
                                            <i class="fas fa-edit"></i>
                                            Update
                                        </button>
                                    </a>
                                </div>
                                <div class="col-4">
                                    <button class="btn btn-danger text-white" type="button" data-bs-toggle="modal" data-bs-target="#TestModal{{$test->id}}">
                                        <i class="fas fa-trash-alt"></i>
                                        Delete
                                    </button>
                                </div>
{{--                                modal delete--}}
                                <!-- Modal -->
                                <div class="modal fade" id="TestModal{{$test->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete your {{$test->title}}</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('test.destroy',['test' => $test->id])}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <h1>Are you sure?</h1>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger">
                                                            <i class="fas fa-trash-alt"></i>
                                                            Delete Tests
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
{{--                               end modal delete--}}
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
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
