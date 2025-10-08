<div class="left-side-bar">
    <div class="side-bar-content" {!! $url = str_replace(request()->root(),'',url()->current()); !!}>
        <div class="panel-group" id="accordion">
            <div class="panel panel-default">
                <!-- -->
            </div>
            <!-- <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse">
                            <img src="{{asset('assets/images/user-icon.png')}}">
                            <strong>Users</strong>
                        </a>
                    </h4>
                </div>
                <div id="collapse" class="panel-collapse collapse {!! str_contains($url,'/admin/users') ? 'in' : '' !!}{!! str_contains($url,'/admin/dashboard') ? 'in' : '' !!}">
                    <div class="panel-body">
                        <div class="accordions-content-link">
                            <ul>
                                <li><a href="{{url('admin/')}}">All Users</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div> -->
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a  href="{{url('admin/dashboard')}}">
                            <i class="fa fa-dashboard"></i> 
                            <strong>Dashboard</strong>
                        </a>
                    </h4>
                </div>
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-bs-toggle="collapse" href="#collapse5" role="button" aria-expanded="false" aria-controls="collapse5">
                        
                            <i class="fa fa-building"></i>
                            <strong>Projects</strong>
                        </a>
                    </h4>
                </div>
                <div id="collapse5" class="panel-collapse collapse {!! str_contains($url,'/admin/projects') ? 'show' : '' !!}">
                    <div class="panel-body">
                        <div class="accordions-content-link">
                            <ul>
                                <li><a href="{{url('admin/projects/')}}">All Projects</a></li>
                                <li><a href="{{url('admin/projects/create')}}">Add Project</a></li>
                                
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-bs-toggle="collapse" href="#collapse2" role="button" aria-expanded="false" aria-controls="collapse2">
                        
                            <i class="fa fa-building"></i>
                            <strong>Properties</strong>
                        </a>
                    </h4>
                </div>
                <div id="collapse2" class="panel-collapse collapse {!! str_contains($url,'/admin/properties') ? 'show' : '' !!}">
                    <div class="panel-body">
                        <div class="accordions-content-link">
                            <ul>
                                <li><a href="{{url('admin/properties/')}}">All Properties</a></li>
                                <li><a href="{{url('admin/properties/create')}}">Add Property</a></li>
                                
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-bs-toggle="collapse" href="#collapse4" role="button" aria-expanded="false" aria-controls="collapse4">
                        
                            <i class="fa fa-user"></i>
                            <strong>Builders</strong>
                        </a>
                    </h4>
                </div>
                <div id="collapse4" class="panel-collapse collapse {!! str_contains($url,'/admin/builders') ? 'show' : '' !!}">
                    <div class="panel-body">
                        <div class="accordions-content-link">
                            <ul>
                                <li><a href="{{url('admin/builders/')}}">All Builders</a></li>
                                <li><a href="{{url('admin/builders/create')}}">Add Builder</a></li>
                                
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-bs-toggle="collapse" href="#collapse6" role="button" aria-expanded="false" aria-controls="collapse6">
                        
                            <i class="fa fa-file"></i>
                            <strong>CMS Pages</strong>
                        </a>
                    </h4>
                </div>
                <div id="collapse6" class="panel-collapse collapse {!! str_contains($url,'/admin/cms-pages') || str_contains($url,'/home-page/project-types') ? 'show' : '' !!}">
                    <div class="panel-body">
                        <div class="accordions-content-link">
                            <ul>
                                <li><a href="{{url('admin/home-page/project-types/')}}">Home Section Project Type</a></li>
                                <li><a href="{{url('admin/cms-pages/about-us/')}}">About Us</a></li>
                                <li><a href="{{url('admin/cms-pages/contact-us/')}}">Contact Us</a></li>
                                <li><a href="{{url('admin/cms-pages/career/')}}">Career</a></li>
                                <li><a href="{{url('admin/cms-pages/our-agents/')}}">Our Agents</a></li>
                                <li><a href="{{url('admin/cms-pages/faqs/')}}">FAQs</a></li>
                                <li><a href="{{url('admin/cms-pages/privacy-policy/')}}">Privacy Policy</a></li>
                                <li><a href="{{url('admin/cms-pages/terms-and-conditions/')}}">Terms & Conditions</a></li>
                                
                                
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-bs-toggle="collapse" href="#collapse7" role="button" aria-expanded="false" aria-controls="collapse7">
                        
                            <i class="fa fa-file"></i>
                            <strong>Blog</strong>
                        </a>
                    </h4>
                </div>
                <div id="collapse7" class="panel-collapse collapse {!! str_contains($url,'/admin/blog') ? 'show' : '' !!}">
                    <div class="panel-body">
                        <div class="accordions-content-link">
                            <ul>
                                <li><a href="{{url('admin/blog/posts')}}">All Posts</a></li>
                                <li><a href="{{url('admin/blog/posts/create')}}">Add New Post</a></li>                                
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-bs-toggle="collapse" href="#collapse8" role="button" aria-expanded="false" aria-controls="collapse8">
                        
                            <i class="fa fa-file"></i>
                            <strong>Features</strong>
                        </a>
                    </h4>
                </div>
                <div id="collapse8" class="panel-collapse collapse {!! str_contains($url,'/features') ? 'show' : '' !!}">
                    <div class="panel-body">
                        <div class="accordions-content-link">
                            <ul>
                                <li><a href="{{url('admin/features')}}">All Features</a></li>
                                <li><a href="{{url('admin/features/create')}}">Add New Post</a></li>                                
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-bs-toggle="collapse" href="#collapse9" role="button" aria-expanded="false" aria-controls="collapse9">
                        
                            <i class="fa fa-file"></i>
                            <strong>Surveys</strong>
                        </a>
                    </h4>
                </div>
                <div id="collapse9" class="panel-collapse collapse {!! str_contains($url,'/surveys') ? 'show' : '' !!}">
                    <div class="panel-body">
                        <div class="accordions-content-link">
                            <ul>
                                <li><a href="{{url('admin/surveys')}}">All Surveys</a></li>
                                <li><a href="{{url('admin/surveys/create')}}">Add New Survey</a></li>                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>    
                    

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">

                        <a data-bs-toggle="collapse" href="#collapse3" role="button" aria-expanded="false" aria-controls="collapse3">
                            <img src="{{asset('assets/images/settings.png')}}">
                            <strong>Settings</strong>
                        </a>
                    </h4>
                </div>
                <div id="collapse3" class="panel-collapse collapse 
                {!! 
                    str_contains($url,'/admin/change-password') ||                        
                    str_contains($url,'/admin/users') ||
                    str_contains($url,'/admin/global-settings') ||
                    str_contains($url,'/admin/global-styling') ||                              
                    str_contains($url,'/admin/logs')                         
                     
                     ? 'show' : '' 
                !!}

                ">
                    <div class="panel-body">
                        <div class="accordions-content-link">
                            <ul>
                                
                                <li><a href="{{url('admin/users')}}">Users</a></li>
                                <li><a href="{{url('admin/global-settings')}}">Global Settings</a></li>
                                <!-- <li><a href="{{url('admin/logs')}}">Logs</a></li>
                                <li><a href="{{url('admin/global-styling')}}">Styling</a></li> -->
                                <li><a href="{{url('admin/change-password')}}">Change Admin Password</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>