@extends('admin.layouts.action_app')
@section('title','Create Users')
@section('action')
    <div class="dashboard__main">
        <div class="dashboard__content bg-light-4">
            <div class="row pb-50 mb-10">
                <div class="col-auto">
                    <h1 class="text-30 lh-12 fw-700">Create users</h1>
                </div>
            </div>

            <div class="row">
                <form class="contact-form respondForm__form row y-gap-20 pt-30" action="{{route('register')}}" method="POST" enctype="multipart/form-data">
                    @csrf
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
                        <input type="tel" name="phone" placeholder="Phone" required>
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
                                {{--                                                <option value="">--Select--</option>--}}
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

                    <div class="col-lg-12">
                        <label for="rol_id" class="text-16 lh-1 fw-500 text-dark-1 mb-10">User Role *</label>
                        <div class="form-group">
                            <select  id="rol_id" name="rol_id" required>
                                <option value="">--Select--</option>
                                <option value="admin">Admin</option>
                                <option value="assistant">Assistant</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12">
{{--                        <button type="submit" name="submit" id="register" class="button -md -green-1 text-dark-1 fw-500 w-1/1">--}}
{{--                            Ro'yxatdan o'tish--}}
{{--                        </button>--}}
                        <button type="submit" name="submit" id="register" class="btn btn-info mt-30">
                            <i class="fas fa-plus"></i>
                            Create
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @include('user.components.footer')
    </div>
@endsection
@section('depdrop')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('assets/js/depdrop.js')}}"></script>
@endsection
