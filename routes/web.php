<?php

//Route::get('/', 'HomeController@welcome');

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Helpers\FileHelper;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectCompareController;
use App\Http\Controllers\CmsPage;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProjectController as FrontProjectController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\Blog\GeneralSettingController as BlogGeneralSettingController;
use App\Http\Controllers\Admin\Blog\PostController;
use App\Http\Controllers\Admin\ContactUs\GeneralSettingController as ContactGeneralSettingController;
use App\Http\Controllers\Admin\DashboardFrontPage\GeneralSettingController as DashboardGeneralSettingController;
use App\Http\Controllers\Admin\LoginPage\GeneralSettingController as LoginPageGeneralSettingController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\BuilderController;
use App\Http\Controllers\Admin\UsersController as AdminUsersController;
use App\Http\Controllers\Admin\GlobalSettingController;
use App\Http\Controllers\Admin\LogActivityController;
use App\Http\Controllers\Admin\CmsPage as AdminCmsPage;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\MainAreaController;
use App\Http\Controllers\Admin\SubAreaController;
use App\Http\Controllers\Admin\HomePageController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\AreaSurveyController;
use App\Http\Controllers\Admin\HomePage\HomeSettingController;

/* Route::get('/routecache', function (){
    \Illuminate\Support\Facades\Artisan::call('config:cache');
});
Route::get('/routeconfig', function (){
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
}); */

Route::get('/', [HomeController::class, 'index']);

Route::get('resend-verification-mail/{token}', [HomeController::class, 'resendMail']);
Route::get('waiting-for-approval/{token}', [UsersController::class, 'waitingForApprovalProUser'])->name('waiting-for-approval');






Route::group(array('prefix'=>'admin'), function (){

    //Route::get('/','AdminController@welcome')->name('admin.welcome');
    Route::get('secure-login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login',[LoginController::class, 'login']);
    Route::get('logout',[LoginController::class, 'logout'])->name('admin.logout');
    //https://stackoverflow.com/questions/77101604/target-class-admin-does-not-exist
    Route::group(array('middleware'=>'admin'), function (){
       
        Route::get('dashboard',[AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('dashboard/get_users',[AdminController::class, 'getUsers'])->name('admin.dashboard.get_users');
        Route::get('dashboard/{id}',[AdminController::class, 'showDashboard'])->name('admin.showDashboard');		

        Route::get('change-password',[ResetPasswordController::class, 'changePassword']);
        Route::post('change-password',[ResetPasswordController::class, 'updatePassword']);

        Route::group(['prefix'=>'blog'], function (){
            Route::resource('general_settings', GeneralSettingController::class);
            Route::resource('posts', PostController::class);
            Route::post('posts/update_position',[PostController::class, 'updatePosition']);
            Route::get('blog-data', [PostController::class, 'getPosts'])->name('blog.data');
        });

        Route::group(['prefix'=>'contact_us','namespace'=>'ContactUs'], function (){
            Route::resource('general_settings',GeneralSettingController::class);                      
        });

        Route::group(['prefix'=>'dashboard_front','namespace'=>'DashboardFrontPage'], function (){
            Route::resource('general_settings',GeneralSettingController::class);                      
        });

        Route::group(['prefix'=>'login_page','namespace'=>'LoginPage'], function (){
            Route::resource('general_settings',GeneralSettingController::class);                      
        });

        
        Route::resource('projects',ProjectController::class); 
        Route::get('/projects-data', [ProjectController::class,'getProjects'])->name('projects.data');
        Route::get('/projects/add-property/{id}', [ProjectController::class,'addProperty'])->name('add.property');
        Route::get('/projects/edit-property/{id}/{property_id}', [ProjectController::class,'editProperty'])->name('edit.property');

        Route::resource('properties', PropertyController::class); 
        Route::get('/properties-data', [PropertyController::class, 'getProperties'])->name('properties.data');

        

        Route::resource('builders', BuilderController::class); 
        Route::get('/builders-data', [BuilderController::class, 'getBuilders'])->name('builders.data');


        Route::resource('users', UsersController::class);
        Route::get('user/import', [UsersController::class, 'importUsers'])->name('admin.import-users');
        Route::post('user/import', [UsersController::class, 'importUsersStore'])->name('admin.import-users');
        Route::get('user/imported_users', [AdminController::class, 'dashboard'])->name('admin.imported-users');
        Route::get('/users',  [UsersController::class, 'index'])->name('users.index');
        Route::get('/users-data', [UsersController::class, 'getUsers'])->name('users.data');

        Route::get('create/{user_type}', [UsersController::class, 'createUsers']);
        Route::post('store/users', [UsersController::class, 'storeUsers']);        
        
        Route::resource('global-settings', GlobalSettingController::class);
        Route::get('global-styling/reset_color_to_default',[GlobalSettingController::class,'resetColorsDefault'])->name('reset_color_to_default');
        Route::resource('global-styling', GlobalSettingController::class);     

        Route::resource('logs', LogActivityController::class);      



        Route::post('media/upload', [MediaController::class, 'upload'])->name('media.upload');
        Route::get('media/list', [MediaController::class, 'list'])->name('media.list');
        Route::delete('media/delete/{id}', [MediaController::class, 'delete'])->name('media.delete'); 
        Route::get('/media/{media}', function (\Spatie\MediaLibrary\MediaCollections\Models\Media $media) {
            return response()->file($media->getPath());
        });

        Route::post('/upload-temp', function (Request $request) {
            $path = $request->file('file')->store('temp');
            return $path;
        });

        Route::delete('/upload-temp-revert', function (Request $request) {
            $mediaId = trim(file_get_contents('php://input'), '"');

            $media = Media::find($mediaId);

            if ($media) {
                $media->delete(); // will remove file from storage + db
                return response()->json(['deleted' => true]);
            }

            return response()->json(['deleted' => false, 'message' => 'Media not found'], 404);
        });

        Route::get('/media/{media}', function (Media $media) {
            return response()->file($media->getPath());
        });

        Route::delete('/media/{media}', function (Media $media) {
            $media->delete();
            return response()->json(['deleted' => true]);
        });


        Route::get('cms-pages/about-us', [AdminCmsPage::class,'aboutUs'])->name('cmspages.aboutus');
        Route::get('cms-pages/career', [AdminCmsPage::class,'career'])->name('cmspages.career');
        Route::get('cms-pages/contact-us', [AdminCmsPage::class,'contactUs'])->name('cmspages.contactus');
        Route::get('cms-pages/our-agents', [AdminCmsPage::class,'ourAgents'])->name('cmspages.our_agents');
        Route::get('cms-pages/faqs', [AdminCmsPage::class,'faqs'])->name('cmspages.faqs');
        Route::get('cms-pages/privacy-policy', [AdminCmsPage::class,'privacyPolicy'])->name('cmspages.privay-policy');
        Route::get('cms-pages/terms-and-conditions', [AdminCmsPage::class,'termsAndConditions'])->name('cmspages.terms_and_conditions');
        Route::get('home-page/why-choose-us', [AdminCmsPage::class,'whyChooseUs'])->name('home-section.why-choose-us');
        Route::post('cms-pages/save-about-us',[AdminCmsPage::class,'saveAboutUs'])->name('cmspages.save-aboutus');
        Route::post('cms-pages/save-career', [AdminCmsPage::class,'saveCareer'])->name('cmspages.save-career');
        Route::post('cms-pages/save-contact-us', [AdminCmsPage::class,'saveContactUs'])->name('cmspages.save-contactus');
        Route::post('get-sub-area/{id}', [ProjectController::class,'getSubAreas'])->name('project.get-sub-area');
        Route::post('cms-pages/save-our-agents', [AdminCmsPage::class,'saveOurAgents'])->name('cmspages.save-our-agents');
        Route::post('cms-pages/save-faqs', [AdminCmsPage::class,'saveFaqs'])->name('cmspages.save-faqs');
        Route::post('cms-pages/save-privacy-policy', [AdminCmsPage::class,'savePrivacyPolicy'])->name('cmspages.save-privacy-policy');
        Route::post('cms-pages/save-terms-and-conditions', [AdminCmsPage::class,'saveTermsAndConditions'])->name('cmspages.save-terms-and-conditions');
        Route::post('cms-pages/save-why-choose-us', [AdminCmsPage::class,'saveWhyChooseUs'])->name('cms-pages.save-why-choose-us');
        
        Route::resource('testimonials', TestimonialController::class);
        Route::get('project/update-status', [ProjectController::class,'updateStatus'])->name('project.update-status');
        Route::post('project/update-position', [ProjectController::class,'updatePosition'])->name('project.update-position');
        Route::post('/areas', [MainAreaController::class,'store'])->name('areas.store');
        Route::post('/sub-areas', [SubAreaController::class,'store'])->name('subareas.store');
        Route::get('/areas-data', [MainAreaController::class,'getAreas'])->name('areas.data');
        Route::get('/get-subareas', [SubAreaController::class,'getSubAreas'])->name('subareas.data');
        Route::resource('areas', MainAreaController::class);
        Route::resource('subareas', SubAreaController::class);
        Route::get('home-page/popular-locations', [HomePageController::class,'sectionPopularLocations'])->name('home-section.popular-locations');
        Route::put('home-page/update-popular-locations', [HomePageController::class,'updatePopularLocations'])->name('home-section.update-popular-locations');
        Route::get('home-page/dream-property', [HomePageController::class,'sectionDreamProperty'])->name('home-section.dream-property');
        Route::put('home-page/update-dream-property', [HomePageController::class,'updateDreamProperty'])->name('home-section.update-dream-property');
        Route::get('home-page/popular-projects', [HomePageController::class,'sectionPopularProjects'])->name('home-section.popular-projects');
        Route::put('home-page/update-popular-projects', [HomePageController::class,'updatePopularProjects'])->name('home-section.update-popular-projects');

        Route::get('home-page/inquiry-form', [HomePageController::class,'sectionInquiryForm'])->name('home-section.inquiry-form');
        Route::put('home-page/update-inquiry-form', [HomePageController::class,'updateInquiryForm'])->name('home-section.update-inquiry-form');

        Route::get('home-page/latest-blogs', [HomePageController::class,'sectionLatestBlogs'])->name('home-section.latest-blogs');
        Route::put('home-page/update-latest-blogs', [HomePageController::class,'updateLatestBlogs'])->name('home-section.update-latest-blogs');

        Route::get('home-page/home-settings', [HomePageController::class,'sectionHomePage'])->name('home-section.home-settings');
        Route::put('home-page/update-home-settings', [HomePageController::class,'updateHomePage'])->name('home-section.update-home-settings');
        

        Route::get('home-page/project-types', [HomePageController::class,'sectionProjectTypes'])->name('home-section.project-types');
        Route::resource('home-page', HomePageController::class);
        
        Route::resource('features', FeatureController::class);
        Route::get('/feature-data', [FeatureController::class,'getFeatures'])->name('features.data');
        Route::get('feature/update-status', [FeatureController::class,'updateStatus'])->name('feature.update-status');
        Route::post('/media/{media}/set-featured', [MediaController::class,'setFeatured'])->name('media.setFeatured');
        Route::get('/projects/{project}/refresh', [ProjectController::class,'refresh'])->name('projects.refresh');
        Route::resource('surveys',AreaSurveyController::class);
        Route::get('survey-data', [AreaSurveyController::class, 'getSurveys'])->name('surveys.data');
        Route::get('/survey/remove-file/{id}', [AreaSurveyController::class, 'removeFile'])->name('file.remove');
        Route::post('/media/reorder', [MediaController::class, 'reorder'])->name('admin.media.reorder');


    });
});

//Auth::routes();
Route::get('/home', function () {
    return redirect('/admin/dashboard');
});
Route::get('/admin', function () {
    abort(404);
});
Route::get('/admin/login', function () {
    abort(404);
});
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search-area', [HomeController::class, 'searchArea'])->name('search-area');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.list');
Route::get('/blog/{id}', [BlogController::class, 'show'])->name('show');

Route::get('/project', [FrontProjectController::class, 'searchResults'])->name('allprojects');
Route::get('/projects', [FrontProjectController::class, 'searchResults'])->name('allprojects');
Route::get('/projects/search-results', [FrontProjectController::class, 'searchResults'])->name('search-results');
Route::get('/project/{slug}',  [FrontProjectController::class, 'show'])->name('project.show');
Route::get('/about-us', [CmsPage::class, 'showAboutUs'])->name('aboutus.show');
Route::get('/career', [CmsPage::class, 'showCareer'])->name('career.show');
Route::get('/contact-us', [CmsPage::class, 'showContactUs'])->name('contactus.show');
Route::get('/our-agents', [CmsPage::class, 'showOurAgents'])->name('ouragents.show');
Route::get('/faqs', [CmsPage::class, 'showFaqs'])->name('faqs.show');
Route::get('/privacy-policy', [CmsPage::class, 'showPrivacyPolicy'])->name('privacy_policy.show');
Route::get('/terms-and-conditions', [CmsPage::class, 'showTermsAndConditions'])->name('terms_and_conditions.show');
Route::post('/contact-submit', [CmsPage::class, 'submitContactUs'])->name('contact.submit');
Route::post('/property-submit', [CmsPage::class, 'submitInquiryForm'])->name('property.submit');
Route::post('/career-submit', [CmsPage::class, 'submitCareerForm'])->name('career.submit');
Route::post('/project-inquiry-submit', [CmsPage::class, 'submitProjectInquiryForm'])->name('project-inquiry.submit');



Route::post('/compare/add',  [ProjectCompareController::class, 'ajaxAdd'])->name('projects.compare.ajaxAdd');
Route::post('/compare/add-multiple', [ProjectCompareController::class, 'ajaxAddMultiple'])->name('projects.compare.ajaxAddMultiple');
Route::post('/compare/remove', [ProjectCompareController::class, 'ajaxRemove'])->name('projects.compare.ajaxRemove');
Route::post('/compare/clear', [ProjectCompareController::class, 'ajaxClear'])->name('projects.compare.ajaxClear');

Route::get('/compare', [ProjectCompareController::class, 'index'])->name('projects.compare');
Route::get('/compare/add/{id}', [ProjectCompareController::class, 'add'])->name('projects.compare.add');
Route::get('/compare/remove/{id}', [ProjectCompareController::class, 'remove'])->name('projects.compare.remove');
Route::get('/compare/search', [ProjectCompareController::class, 'searchProject'])->name('compare.searchProject');
Route::post('/subscribe', [SubscriptionController::class, 'store'])->name('subscribe');
Route::get('/survey', [SurveyController::class, 'index'])->name('survey');
Route::get('/survey/download/{id}', [SurveyController::class, 'downloadDocument'])->name('file.download');
Route::get('/survey/view/{id}', [SurveyController::class, 'viewDocument'])->name('file.view');
Route::get('/survey/filter-data', [SurveyController::class, 'filterData'])->name('survey.filterData');

Route::get('/file/view/{path}', function ($path) {
    return FileHelper::viewFile($path);
})->where('path', '.*');

Route::get('/{path}', function ($path) {
    return view('pdf-viewer', ['path' => $path]);
})->where('path', '.*');

// Download route
Route::get('/download/{path}', function ($path) {
    return FileHelper::downloadFile($path);
})->where('path', '.*');








