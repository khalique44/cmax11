@extends('layouts.admin')

@section('content')

    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Registration Type</h4>
                </div>
                <div class="district-back-del-btn-area">
                    <div class="distrcit-back-btn">
                        <div class="district-back-del-btn-area">
                            <button type="button" class="btn btn-danger btn_registration_types_delete" data-toggle="modal" data-target="#DeleteConfirmationModal" data-delete-id="{{$registration_type->id}}">
                                Delete
                            </button>
                            <a href="{{ url('admin/modules/registration_types') }}" data-toggle="" data-target="#search-db-model"  class="btn">Back</a>
                        </div>
                    </div>
                </div>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @include("layouts.partials.messages")
            <div class="row">
                <div class="col-xs-12">
                    <div class="district-form-content">
                        @if(session('message'))
                            <div class="alert alert-danger">
                                <strong>{!! session('message') !!}</strong>
                            </div>
                        @endif
                        <form class="district-fields" method="POST" action='{{ url("admin/modules/registration_types/{$registration_type->id}") }}'>
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <div class="form-group">
                                <label>Name :</label>
                                <input type="text" name="name" value="{!! old('name') ? old('name') : $registration_type->name !!}" class="district-input-field" required >
                            </div>
                            <div class="form-group">
                            </div>
                            <div class="form-group custom-modules-radio-field">
                                <label>Payment Active? :</label>
                                <div class="district-active-radio-field">
                                    <div class="d-radio">
                                        <input type="radio" name="is_payment_active" value="yes" {{ (old('is_payment_active') && old('is_payment_active') == "yes") ? "checked" : $registration_type->is_payment_active == "yes" ? "checked" : "" }}>Yes</input>
                                    </div>
                                    <div class="d-radio">
                                        <input type="radio" name="is_payment_active" value="no"  {{ (old('is_payment_active') && old('is_payment_active') == "no") ? "checked" : $registration_type->is_payment_active == "no" ? "checked" : "" }} >No</input>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group custom-modules-radio-field">
                                <label>Active? :</label>
                                <div class="district-active-radio-field">
                                    <div class="d-radio">
                                        <input type="radio" name="is_active" value="yes" {{ (old('is_active') && old('is_active') == "yes") ? "checked" : $registration_type->is_active == "yes" ? "checked" : "" }} >Yes</input>
                                    </div>
                                    <div class="d-radio">
                                        <input type="radio" name="is_active" value="no" {{ (old('is_active') && old('is_active') == "no") ? "checked" : $registration_type->is_active == "no" ? "checked" : "" }} >No</input>
                                    </div>
                                </div>
                            </div>

                            <div class="Create-district-btn">
                                <button type="submit" href="javascript:void(0);" id="btn_save" class="btn enableOnInput3">
                                    Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script>
        $('.btn_registration_types_delete').on('click',function () {
            var DataDeleteId = $(this).attr('data-delete-id');

            $(".data-delete-form").attr('action', "{{ url('') }}/admin/modules/registration_types/"+DataDeleteId);
        });
    </script>
@endsection
