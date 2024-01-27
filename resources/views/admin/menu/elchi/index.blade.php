<?php
$t_r = 1;
?>
@extends('admin.layouts.action_app')

@section('title','Users')
@section('action')
    <div class="dashboard__main">
        <div class="dashboard__content bg-light-4">

            @if($errors->any())
                <div class="col-12">
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger">
                            {{$error}}
                        </div>
                    @endforeach
                </div>
            @endif

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
                    <h1 class="text-30 lh-12 fw-700">Elchilar</h1>
                </div>
                <div class="col-6 d-flex justify-content-end">
                        <button class="btn btn-success text-white" type="button" data-bs-toggle="modal" data-bs-target="#ElchiCreate">
                            <i class="fas fa-plus"></i>
                            Yaratish
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="ElchiCreate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Elchilarni qo'shish</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="contact-form respondForm__form row y-gap-20 pt-30" action="{{route('elchi-create')}}" method="POST"  enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="status" value="1">
                                                <div class="col-lg-6">
                                                    <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Ismingiz *</label>
                                                    <input type="text" name="first_name" placeholder="Firstname" required>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Familyangiz *</label>
                                                    <input type="text" name="last_name" placeholder="Lastname" required>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Tug'ilgan kuningiz *</label>
                                                    <input type="date"  name="birthday" placeholder="Birthday" required>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Telefon raqam *</label>
                                                    <input type="tel" name="phone" class="input-phone" placeholder="Phone" required>
                                                </div>

                                                <div class=" col-lg-6">
                                                    <label for="region_id" class="text-16 lh-1 fw-500 text-dark-1 mb-10">Viloyat *</label>
                                                    <div class="form-group">
                                                        <select  id="region_id" name="region_id" required>
                                                            <option value="">--Select--</option>
                                                            @foreach($region as $test)
                                                                <option value="{{$test->id}}">{{$test->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class=" col-lg-6">
                                                    <label for="district_id" class="text-16 lh-1 fw-500 text-dark-1 mb-10">Shahar *</label>
                                                    <div class="form-group">
                                                        <select id="district_id" name="district_id" required>

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Rasmingiz *</label>
                                                    <input type="file" name="image" placeholder="Image" required>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Passport Rasmingiz *</label>
                                                    <input type="file" name="passport_image" placeholder="Passport Image" required>
                                                </div>

                                                <div class="col-lg-6">
                                                    <label for="rol_id" class="text-16 lh-1 fw-500 text-dark-1 mb-10">User Role *</label>
                                                    <select  id="rol_id" name="rol_id" required>
                                                        <option value="">--Select--</option>
                                                        <option value="old_user">Elchi</option>
                                                        <option value="teacher">Teacher</option>
                                                    </select>
                                                </div>

                                                <div class="col-lg-6">
                                                    <label for="tg_user_id" class="form-label fw-700">TG User *</label>
                                                    <select id="tg_user_id" name="tg_user_id" required>

                                                    </select>
                                                </div>


                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success">
                                                    <i class="fas fa-plus"></i>
                                                    Yaratish
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>


            <div class="row y-gap-30">

                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">T/r</th>
{{--                        <th scope="col">Id</th>--}}
                        <th scope="col">Ism</th>
                        <th scope="col">Familiya</th>
                        <th scope="col">Rasm</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Username</th>
                        <th scope="col">Role</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($elchi as $test)
                        <tr>
                            <th scope="row">{{$t_r++}}</th>
{{--                            <th>{{$test->id}}</th>--}}
                            <td>{{$test->first_name}}</td>
                            <td>{{$test->last_name}}</td>
                            <td>
                                <img src="{{ asset('storage/' . $test->image) }}" width="50" height="30" alt="">
                            </td>
                            <td>{{$test->phone}}</td>
                            <td>{{$test->username}}</td>
                            <td>
                                @if($test->rol_id == 'old_user')
                                    Elchi
                                @elseif($test->rol_id == 'teacher')
                                    Teacher
                                @endif
                            </td>
                            <td>{{$test->status}}</td>
                            <td>
                                <div class="row">
                                    <div class="col-4">
                                        {{--                                      <button class="btn btn-warning text-white">--}}
                                        {{--                                         <i class="fas fa-eye"></i>--}}
                                        {{--                                         View--}}
                                        {{--                                      </button>--}}
                                    </div>
                                    <div class="col-4">
                                        <button class="btn btn-primary text-white" type="button" data-bs-toggle="modal" data-bs-target="#ElchiUpdate{{$test->id}}">
                                            <i class="fas fa-edit"></i>
                                            Update
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="ElchiUpdate{{$test->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Elchini tahrirlash</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="contact-form respondForm__form row y-gap-20 pt-30" action="{{url('/admin/elchi-update/'.$test->id)}}" method="POST"  enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="col-lg-4">
                                                                <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Ismingiz *</label>
                                                                <input type="text" name="first_name" placeholder="Firstname" value="{{$test->first_name}}" required>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Familyangiz *</label>
                                                                <input type="text" name="last_name" placeholder="Lastname" value="{{$test->last_name}}" required>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Tug'ilgan kuningiz *</label>
                                                                <input type="date"  name="birthday" placeholder="Birthday" value="{{$test->birthday}}" required>
                                                            </div>

                                                            <div class=" col-lg-6">
                                                                <label for="region_id" class="text-16 lh-1 fw-500 text-dark-1 mb-10">Viloyat *</label>
                                                                <div class="form-group">
                                                                    <select  id="region_id" name="region_id" required>
                                                                        <option value="">--Select--</option>
                                                                        @foreach($region as $reg)
                                                                            @if($test->region_id == $reg->id)
                                                                            <option selected value="{{$reg->id}}">{{$reg->name}}</option>
                                                                            @else
                                                                            <option value="{{$reg->id}}">{{$reg->name}}</option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class=" col-lg-6">
                                                                <label for="district_id" class="text-16 lh-1 fw-500 text-dark-1 mb-10">Shahar *</label>
                                                                <div class="form-group">
                                                                    <select id="district_id" name="district_id" required>
                                                                        @foreach($district as $dist)
                                                                            @if($dist->region_id == $test->region_id)
                                                                                <option selected value="{{$dist->id}}">{{$dist->name}}</option>
                                                                            @else
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6">
                                                                <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Rasmingiz *</label><br>
                                                                <img src="{{asset('storage/'.$test->image)}}" width="100" height="60" alt=""><br>
                                                                <input type="file" class="mt-15" name="image" placeholder="Image">
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Passport Rasmingiz *</label><br>
                                                                <img src="{{asset('storage/'.$test->passport_image)}}" width="100" height="60" alt=""><br>
                                                                <input type="file" class="mt-15" name="passport_image" placeholder="Passport Image">
                                                            </div>

                                                            <div class="col-lg-5">
                                                                <label for="rol_id" class="text-16 lh-1 fw-500 text-dark-1 mb-10">User Role *</label>
                                                                <div class="form-group">
                                                                    <select  id="rol_id" name="rol_id" required>
                                                                        <option value="">--Select--</option>
                                                                        <option @if($test->rol_id == 'old_user') selected @else @endif value="old_user">Elchi</option>
                                                                        <option @if($test->rol_id == 'teacher') selected @else @endif value="teacher">Teacher</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-5">
                                                                <label for="rol_id" class="text-16 lh-1 fw-500 text-dark-1 mb-10">TG User *</label>
                                                                <div class="form-group">
                                                                    <select  id="tg_user_id" name="tg_user_id" required>
                                                                        <option value="">--Select--</option>
                                                                        @if($test->rol_id == 'old_user')
                                                                            @foreach($data as $da)
                                                                               <option @if($da->user_id == $test->tg_user_id) selected @else @endif value="{{$da->user_id}}">{{$da->first_name}} {{$da->last_name}}</option>
                                                                            @endforeach
                                                                        @elseif($test->rol_id == 'teacher')
                                                                            @foreach($teacher as $teach)
                                                                                <option @if($teach->user_id == $test->tg_user_id) selected @else @endif value="{{$teach->user_id}}">{{$teach->user_first_name}} {{$teach->user_last_name}}</option>
                                                                            @endforeach
                                                                        @else
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-2">
                                                                <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Status *</label>
                                                                <input type="text" name="status" value="{{$test->status}}" required>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">
                                                                    <i class="fas fa-edit"></i>
                                                                    Update
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-4">
                                        <button class="btn btn-danger text-white" type="button" data-bs-toggle="modal" data-bs-target="#ElchiDelete{{$test->id}}">
                                            <i class="fas fa-trash-alt"></i>
                                            O'chirish
                                        </button>
                                    </div>
                                    {{--                                                                    modal delete--}}
                                    <!-- Modal -->
                                    <div class="modal fade" id="ElchiDelete{{$test->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Siz {{$test->first_name}} {{$test->last_name}} elchini o'chirmoqchisiz!</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('elchi-delete',['id' => $test->id])}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <h1>Sizni ishonchingiz komilmi?</h1>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-danger">
                                                                <i class="fas fa-trash-alt"></i>
                                                                Elchini o'chirish
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    {{--                                                                   end modal delete--}}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @include('user.components.footer')
    </div>
@endsection
@section('depdrop')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('assets/js/depdrop.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.4.7/cleave.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.4.7/addons/cleave-phone.de.js"></script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            var cleave = new Cleave('.input-phone', {
                phone: true,
                phoneRegionCode: 'UZ',
                prefix: '+998'
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.form-select').each(function() {
                $(this).select2({
                    theme: 'bootstrap4',
                    width: '200px',
                    placeholder: $(this).attr('placeholder'),
                    allowClear: Boolean($(this).data('allow-clear')),
                });
            });
        });
    </script>
@endsection
