@extends('layouts.admin')

@section('content')

    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Manage Why Choose Us Section</h4>
                </div>
                <div class="district-back-del-btn-area">
                    <div class="distrcit-back-btn">
                        <div class="district-back-del-btn-area">
                            <a href="{{url('admin/')}}" data-toggle="" data-target="#search-db-model"  class="btn">Back</a>
                        </div>
                    </div>
                </div>
            </div>
            

            @if ($errors->any())
                <div class="alert alert-danger">
                    Please remove the following errors.
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @include("layouts.partials.messages")
            <div class="ajax-msg"></div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="district-form-content add-new-district-form">
                        <form action="{{ route('home-section.why-choose-us') }}" method="POST" enctype="multipart/form-data" class="" id="cmspages">
                            @csrf
                            <input type="hidden" class="pg_name" value="save-why-choose-us">
                            <div class="row">                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Title: </label>
                                        <input type="text" name="why_choose_us_title1" id="why_choose_us_title1" class="form-control" value="{{ old('why_choose_us_title1', $why_choose_us_title1 ?? '') }}" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Title 2: </label>
                                        <input type="text" name="why_choose_us_title2" id="why_choose_us_title2" class="form-control" value="{{ old('why_choose_us_title2', $why_choose_us_title2 ?? '') }}" >
                                    </div>
                                </div>
                                
                            </div>    
                            <div class="row">                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Description: </label>
                                        <textarea  name="why_choose_us_description" id="txtEditor" title="enter  description!" class="district-input-field form-control" rows="8" placeholder=""
                                                     >{{ old('why_choose_us_description', $why_choose_us_description ?? '') }}</textarea>
                                    </div>
                                </div>
                            </div>  
                            

                            <div class="row m-3">

                                <div class="col-md-12">
                                    <div class="form-group">
                                       
                                        <button type="submit" class="btn btn-success mt-3">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

