@extends('layouts.admin')

@section('content')

    <div class="right-side-section">
        <div class="right-section-content">

            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>User's Detail</h4>
                </div>
                <div class="district-back-del-btn-area">
                    <div class="distrcit-back-btn">
                        <div class="district-back-del-btn-area">
                            <a href="{{ url('admin/users') }}" class="btn">Back</a>
                        </div>
                    </div>
                </div>
            </div>
            <!--  ===============================  -->
            <!--  ==== User Show        =======  -->
            <!--  ===============================  -->
         <div class="form-sec">
             <div class="row">
                 <div class="col-md-12">
                     <div class="district-form-content add-new-district-form">
                         <div class="form-sec-content">
                             <div class="form-users">
                                 <div class="form-content ">
                                     <div class="form-group">
                                         <label>First Name :</label>
                                         <span> {{ $user->first_name}} </span>
                                     </div>
                                 </div>
                                 <div class="form-content ">
                                     <div class="form-group">
                                         <label>Email :</label>
                                         <span> {{ $user->email }} </span>
                                     </div>
                                 </div>
                                 
                                 
                                 <div class="form-content">
                                     <div class="form-group">
                                         <label>Address 1 :</label>
                                         <span> {{ $user->address_1 }} </span>
                                     </div>
                                 </div>   
                                  <div class="form-content">
                                     <div class="form-group">
                                         <label>Gender :</label>
                                         <span> {{ $user->gender }} </span>
                                     </div>
                                 </div>                             
                                 
                             </div>

                             <div class="form-users">
                                 <div class="form-content ">
                                     <div class="form-group">
                                         <label>Last Name :</label>
                                         <span> {{ $user->last_name }} </span>
                                     </div>
                                 </div>
                                 <div class="form-content ">
                                     <div class="form-group">
                                         <label>Phone :</label>
                                         <span> {{ $user->phone }} </span>
                                     </div>
                                 </div>
                                 <div class="form-content">
                                     <div class="form-group">
                                         <label>Address 2 :</label>
                                         <span> {{ $user->address_2 }} </span>
                                     </div>
                                 </div>                                
                                 <div class="form-content">
                                     <div class="form-group ">
                                         <label>Type :</label>
                                         <span> {{ $user->type }} </span>
                                     </div>
                                 </div>
                                                                 

                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
        </div>
    </div>


@endsection

