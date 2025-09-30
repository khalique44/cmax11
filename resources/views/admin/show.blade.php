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
                            <a href="{{ route('admin.dashboard') }}" class="btn">Back</a>
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
                                            <label>Date Of Birth :</label>
                                            <span> {{ date('d M Y',strtotime($user->date_of_birth)) }} </span>
                                        </div>
                                    </div>
                                    <div class="form-content">
                                        <div class="form-group">
                                            <label>Payment Status :</label>
                                            <span> {{ ($user->paid_status == true ? 'Paid' : 'Pending') }} </span>
                                        </div>
                                    </div>
                                    <div class="form-content">
                                        <div class="form-group">
                                            <label>Address 1 :</label>
                                            <span> {{ $user->address_1 }} </span>
                                        </div>
                                    </div>
                                    <div class="form-content">
                                        <div class="form-group ">
                                            <label>Country :</label>
                                            <span> {{ @$user->usercountry->name }} </span>
                                        </div>
                                    </div>
                                    <div class="form-content">
                                        <div class="form-group">
                                            <label>City :</label>
                                            <span> {{ $user->city }} </span>
                                        </div>
                                    </div>
                                    <div class="form-content">
                                        <div class="form-group">
                                            <label>Facebook Url :</label>
                                            <span> {{ $user->facebook_url }} </span>
                                        </div>
                                    </div>
                                    <div class="form-content">
                                        <div class="form-group ">
                                            <label>Last Year Member :</label>
                                            <span> {{ $user->last_year_member == true ? 'Yes' : 'No' }}</span>
                                        </div>
                                    </div>
                                    <div class="form-content">
                                        <div class="form-group ">
                                            <label>Registration Year :</label>
                                            <span> {{ $user->registration_year }} </span>
                                        </div>
                                    </div>
                                    @if( $user->subscriptions->count() > 0 )
                                        <div class="subscription">
                                            @foreach($user->subscriptions as $subscription)
                                            @php
                                                $npcHelper = new \App\Http\Helpers\NpcHelper();
                                                $ARBsubscription = \App\Http\Helpers\NpcHelper::getSubscription($subscription->subscription_id);
                                            @endphp
                                            @if($ARBsubscription->getSubscription() && $ARBsubscription->getSubscription() != null)
                                                @php
                                                    $paymentSchedule = @$ARBsubscription->getSubscription()->getPaymentSchedule();
                                                    $start_time_ARB = \Carbon\Carbon::parse(strtotime(date_format($paymentSchedule->getStartDate(),'M d-Y')));
                                                    $start_time_now = \Carbon\Carbon::now();
                                                    $finish_time = \Carbon\Carbon::parse(strtotime(date_format($paymentSchedule->getStartDate(),'M d-Y')))->addMonths($paymentSchedule->getInterval()->getLength())->addDays(1);
                                                    $nextPayment = \Carbon\Carbon::parse(strtotime(date_format($paymentSchedule->getStartDate(),'M d-Y')))->addMonths($paymentSchedule->getInterval()->getLength());
                                                    $diff = (int)$start_time_now->diffInDays($finish_time);
                                                    //$cardNum = $ARBsubscription->getSubscription()->getProfile()->getPaymentProfile()->getPayment()->getCreditCard()->getCardNumber();
                                                @endphp
                                                <div class="form-content">
                                                    <div class="form-group ">
                                                        <label>Subscription Status</label><br>
                                                        <label>Name :</label>
                                                        <span> {{ $ARBsubscription->getSubscription()->getName() }} </span>
                                                        <label>Amount :</label>
                                                        <span> ${{ $ARBsubscription->getSubscription()->getAmount() }} </span>
                                                        <label>Status :</label>
                                                        <span> {{ $ARBsubscription->getSubscription()->getStatus() }} </span>
                                                        <label>Registration Start Date :</label>
                                                        <span> {{ date('d M Y',strtotime($start_time_ARB)) }} </span>
                                                        <label>Registration End Date :</label>
                                                        <span> {{ date('d M Y',strtotime($finish_time)) }} </span>
                                                    </div>
                                                </div>
                                            @else
                                                <script>$('.subscription').css('display','none');</script>
                                            @endif
                                        @endforeach
                                        </div>
                                    @endif
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
                                            <label>Gender :</label>
                                            <span> {{ $user->gender }} </span>
                                        </div>
                                    </div>
                                    <div class="form-content">
                                        <div class="form-group ">
                                            <label>Type :</label>
                                            <span> {{ $user->type }} </span>
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
                                            <label>State :</label>
                                            <span> {{ @$user->userstate->name }} </span>
                                        </div>
                                    </div>
                                    <div class="form-content">
                                        <div class="form-group ">
                                            <label>Acknowledgement:</label>
                                            <span> {{ $user->ack }} </span>
                                        </div>
                                    </div>

                                    <div class="form-content">
                                        <div class="form-group">
                                            <label>Twitter Url :</label>
                                            <span> {{ $user->twitter_url }} </span>
                                        </div>
                                    </div>
                                    <div class="form-content">
                                        <div class="form-group ">
                                            <label>Category :</label>
                                            <span>{{ @$user->cat->name }}</span>
                                        </div>
                                    </div>
                                    @if($user->registration_type)
                                        <div class="form-content">
                                            <div class="form-group ">
                                                <label>Registration Type :</label>
                                                <span> {{ @$user->registration_type->name }} </span>
                                            </div>
                                        </div>
                                    @endif
                                    @if($user->is_admin_user == 1)
                                        <div class="form-content">
                                            <div class="form-group ">
                                                <label>Created By :</label>
                                                <span>Admin</span>
                                            </div>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

