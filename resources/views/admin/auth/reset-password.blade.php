@extends('layouts.admin')

@section('content')

    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>{{ __('Change Password') }}</h4>
                </div>
                
            </div>
       

            @include('layouts.partials.messages')

            <div class="user-backend-form-section left-side">

                    <!-- <div class="title">
                        <h4>{{ __('Update Password') }}</h4>
                    </div> -->
                    <form class="change-password-form" action="{!! url('admin/change-password') !!}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="password" class="backend-field form-control" placeholder="Old Password" name="old_password" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="backend-field form-control" placeholder="New Password" name="password" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="backend-field form-control" placeholder="Confirm Password" name="password_confirmation" required>
                        </div>
                        <div class="submit-request-btn pull-right">
                            <a href="{!! route('admin.dashboard') !!}" class="btn btn-sm btn-danger" >{{__('BACK')}}</a>
                            <button type="submit" class="btn btn-sm btn-success">{{__('CHANGE PASSWORD')}}</button>
                        </div>
                    </form>
                </div>
        </div>
    </div>

    

   
@endsection




