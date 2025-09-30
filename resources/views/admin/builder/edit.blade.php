@extends('layouts.admin')

@section('content')
    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Edit Builder</h4>
                </div>
                <div class="district-back-del-btn-area">
                    <div class="distrcit-back-btn">
                        <a href="{{url('admin/builders/')}}" data-toggle="" data-target="#search-db-model"  class="btn">Back</a>

                    </div>
                </div>
            </div>
            <!--  ===============================  -->
            <!--  ======= Builders Section ===========  -->
            <!--  ===============================  -->
            <div class="container mt-3">
                <div class="row">
                    <div class="ajax-msg"></div>
                    <div class="col-xs-12">
                        <div class="">
                            
                            <form class="has-filepond" method="POST"  enctype="multipart/form-data" id="builder-form-update">
                                 {{csrf_field()}}
                                @method('PUT')
                                <input type="hidden" name="builder_id" value="{{ $record->id }}">
                                    
                                <div class="col-xs-12 mb-3 mt-3">
                                    <div class="form-group">
                                        <label>*Builder Name :</label>
                                        <input type="text" name="builder_name" id="builder_name" title="enter builder name!" class="district-input-field form-control" placeholder="Builder Name" required value="{{old('builder_name',$record->builder_name)}}">                                    
                                    </div>
                                </div>

                                <div class="col-xs-12 mb-3 mt-3">
                                    <div class="form-group">
                                        <label>*Email :</label>
                                        <input type="text" name="email" id="email" title="enter email!" class="district-input-field form-control" placeholder="Email Address"  value="{{old('email',$record->email)}}">                                    
                                    </div>
                                </div>


                                <div class="col-xs-12 mb-3 mt-3">
                                    <div class="form-group">
                                        <label>*Mobile Number :</label>
                                        <input type="text" name="mobile_number" id="mobile_number" title="Enter mobile number!" class="district-input-field form-control" molaceholder="Mobile Number"  value="{{old('mobile_number',$record->mobile_number)}}">                                    
                                    </div>
                                </div>


                                <div class="col-xs-12 mb-3 mt-3">
                                    <div class="form-group">
                                        <label>*Address :</label>
                                        <input type="text" name="address" id="address" title="Enter Address!" class="district-input-field form-control" molaceholder="Address"  value="{{old('address',$record->address)}}">                                    
                                    </div>
                                </div>                                
                               
                                
                                <div class="col-xs-12 mb-3 mt-3">   
                                    <div class="form-group">
                                        <!-- File Upload -->
                                        <div class="pond-container">
                                            <label>Upload Images</label>
                                            <input type="file" name="filepond[]" id="filepond" multiple class="filepond">
                                            <input type="hidden" id="uploaded-files" name="uploaded_files[]" />
                                            <input type="hidden" id="deleted-files" name="deleted_files[]" />
                                        </div>

                                        <div class="uploaded-images file-pond-preview-wrapper" id="uploaded-preview" id="uploaded-preview" data-upload-type="default" data-allow-reorder="true" data-max-files="10" data-collection="default" data-preview="uploaded-preview">
                                            @if(isset($record))
                                                @foreach($record->getMedia('images') as $media)
                                                <div class="preview-box remove-media" data-media-id="{{ $media->id }}">
                                                    <div>
                                                        <img src="{{ str_replace('storage','storage/app/public',$media->getUrl()) }}" alt="uploaded" style="width: 150px;">
                                                    </div>
                                                    <div>
                                                        <span title="Remove" class="remove-media " >Remove</span>
                                                    </div>
                                                </div>
                                                @endforeach
                                            @endif


                                            @php 
                                                $existingImages = $record->getMedia('images')->map(function ($media) {
                                                    return [
                                                        'source' => $media->id,
                                                        'options' => [
                                                            'type' => 'local',
                                                            'file' => [
                                                                'name' => $media->file_name,
                                                                'size' => $media->size,
                                                                'type' => $media->mime_type,
                                                            ],
                                                            'metadata' => [
                                                                'poster' => $media->getUrl() // or getFullUrl()
                                                            ]
                                                        ]
                                                    ];
                                                });
                                            @endphp

                                            
                                        </div>
                                        
                                    </div>


                                </div>  

                                                          

                                <div class="col-xs-12 mb-3 mt-3">
                                    <div class="form-group">
                                       
                                        <div class="form-check form-switch">
                                          <input class="form-check-input" type="checkbox" id="is_active" name="is_active" {{ $record->is_active == 1 ? 'checked' : '' }}>
                                          <label class="form-check-label" for="is_active">Status</label>
                                        </div>                                    
                                    </div>
                                </div>   

                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <button type="submit" href="javascript:void(0);" id="btn_save" class="btn btn-success">
                                            Save
                                        </button>
                                        
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection
@section('scripts')



@endsection