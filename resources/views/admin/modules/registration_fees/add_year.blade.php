@extends('layouts.admin')

@section('content')

    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Add Registration Year</h4>
                </div>
                <div class="district-back-del-btn-area">
                    <div class="distrcit-back-btn">
                        <a href="{{url('admin/modules/registration_fee')}}" data-toggle="" data-target="#search-db-model"  class="btn">Back</a>
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
                        <form class="district-fields" method="POST" action="{{url('admin/modules/registration_fees/store_year')}}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>Year :</label>
                                <input type="number" step=any name="year" value="{!! old('year') !!}" class="district-input-field" required >
                            </div>
                            <div class="Create-district-btn">
                                <button type="submit" href="javascript:void(0);" id="btn_save" class="btn enableOnInput3">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
