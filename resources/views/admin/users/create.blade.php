@extends('layouts.admin')

@section('content')

    <div class="pre-main-content">
        <div class="right-side-section">
            <div class="right-section-content">
                <div class="admin-sec-btn-area">
                    
                    <div class="district-back-del-btn-area">
                        <div class="distrcit-back-btn">
                            <div class="district-back-del-btn-area">
                                {{-- <a href="{{ route('admin.import-users') }}" data-toggle="" data-target="#search-db-model"  class="btn">Import</a> --}}
                            </div>
                        </div>
                        <div class="distrcit-back-btn">
                            <div class="district-back-del-btn-area">
                                <a href="{{url('admin/users')}}" data-toggle="" data-target="#search-db-model"  class="btn success">{{__('Back')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  ===============================  -->
                <!--  ==== User Create        =======  -->
                <!--  ===============================  -->

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
                <div class="pre-create">
                    <div class="row">
                        <div class="col-xs-12" style="margin-top:50px;">
                            <div class="reg-select-card-section">
                                <div id="sect-1" class="checkbox-btn-option">
                                    <input id="pro-athlete" type="radio" name="reg-select" value="reg-select">
                                    <div for="pro-athlete" class="reg-card-content">
                                        <div class="card-image">
                                            <img src="{!! url('public/assets/images/IFBB.png') !!}">
                                        </div>
                                        <div class="card-title">
                                            <h5>IFBB</h5>
                                        </div>
                                    </div>
                                </div>
                                <div id="sect-2" class="checkbox-btn-option">
                                    <input id="athlete" type="radio" name="reg-select" value="reg-select">
                                    <div for="athlete" class="reg-card-content">
                                        <div class="card-image">
                                            <img src="{!! url('public/assets/images/athlete-icon2.png') !!}">
                                        </div>
                                        <div class="card-title">
                                            <h5>Athlete</h5>
                                        </div>
                                    </div>
                                </div>
                                <div id="sect-3" class="checkbox-btn-option">
                                    <input id="non-athlete" type="radio" name="reg-select" value="reg-select">
                                    <div for="non-athlete" class="reg-card-content">
                                        <div class="card-image">
                                            <img src="{!! url('public/assets/images/athlete-icon-3.png') !!}">
                                        </div>
                                        <div class="card-title">
                                            <h5>Non-Athlete</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="select-section-btn">
                                <a id="btn_click" href="" class="btn"> Create </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        $(document).ready(function () {
            //date = new Date(1990,1,1);
            $('#date_of_birth').datepicker({
                //  defaultDate: date
            });
        });

        var pro_athlete = document.getElementById("pro-athlete");
        var athlete     = document.getElementById("athlete");
        var non_athlete = document.getElementById("non-athlete");

        pro_athlete.onclick = function(){
            $("#btn_click").attr('href','/admin/create/pro-athlete');
            return true;
        };

        athlete.onclick = function(){
            $("#btn_click").attr('href','/admin/create/athlete');
            return true;
        };

        non_athlete.onclick = function(){
            $("#btn_click").attr('href','/admin/create/non-athlete');
            return true;
        };
    </script>
@endsection

