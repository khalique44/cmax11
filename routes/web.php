<?php

//Route::get('/', 'HomeController@welcome');

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
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






Route::get('/routecache', function (){
    \Illuminate\Support\Facades\Artisan::call('config:cache');
});
Route::get('/routeconfig', function (){
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
});

Route::get('/', [HomeController::class, 'index']);

Route::get('resend-verification-mail/{token}', [HomeController::class, 'resendMail']);
Route::get('waiting-for-approval/{token}', [UsersController::class, 'waitingForApprovalProUser'])->name('waiting-for-approval');


Route::group(['namespace'=>'Auth'],function (){

    
    Route::get('login',  [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login',  [LoginController::class, 'login']);
    Auth::routes(['register' => false]);
    Auth::routes(['password/reset' => false]);
    
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::post('logout',  [LoginController::class, 'logout'])->name('logout');

    Route::get('password/reset', function (){
            return redirect('/login');
    });
    //Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    //Route::get('password/reset/{token}/{email}', 'ResetPasswordController@showResetForm')->name('password.reset');
    //Route::post('password/reset', 'ResetPasswordController@reset')->name('password.update');   

});

//Route::get('email-verification/{token}', 'UsersController@verifyUser')->name('email_verification');


Route::group(['middleware' => ['auth']], function() {

    Route::group(['middleware' => ['verified']], function() {       

        Route::post('change-password','UsersController@changePassword')->name('change_password');
        Route::post('update-address','UsersController@updateAddress')->name('update_address');
        
    });
    Route::get('verify-email','UsersController@verifyEmail')->name('verify_email');
    Route::get('resend-account-verify-email','UsersController@resendEmailVerifyMail')->name('resend_account_verify_email');
    Route::get('dashboard','UsersController@dashboard')->name('dashboard');   
    
   
});

Route::group(array('prefix'=>'admin'), function (){

    //Route::get('/','AdminController@welcome')->name('admin.welcome');

    Route::get('login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login',[LoginController::class, 'login']);
    Route::get('logout',[LoginController::class, 'logout'])->name('admin.logout');
    //https://stackoverflow.com/questions/77101604/target-class-admin-does-not-exist
    Route::group(array('middleware'=>'admin'), function (){
        Route::get('dashboard',[AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('dashboard/get_users',[AdminController::class, 'getUsers'])->name('admin.dashboard.get_users');
        Route::get('dashboard/{id}',[AdminController::class, 'showDashboard'])->name('admin.showDashboard');		

        Route::get('change-password',[ResetPasswordController::class, 'changePassword']);
        Route::post('change-password',[ResetPasswordController::class, 'updatePassword']);

        Route::group(['prefix'=>'blog','namespace'=>'Blog'], function (){
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


        Route::get('cms-pages/about-us', [CmsPage::class,'aboutUs'])->name('cmspages.aboutus');
        Route::get('cms-pages/career', [CmsPage::class,'career'])->name('cmspages.career');
        Route::get('cms-pages/contact-us', [CmsPage::class,'contactUs'])->name('cmspages.contactus');
        Route::post('cms-pages/save-about-us',[CmsPage::class,'saveAboutUs'])->name('cmspages.save-aboutus');
        Route::post('cms-pages/save-career', [CmsPage::class,'saveCareer'])->name('cmspages.save-career');
        Route::post('get-sub-area/{id}', [ProjectController::class,'getSubAreas'])->name('project.get-sub-area');
        Route::post('cms-pages/save-contact-us', [ProjectController::class,'saveContactUs'])->name('cmspages.save-contactus');
        Route::resource('testimonials', TestimonialController::class);
        Route::get('project/update-status', [ProjectController::class,'updateStatus'])->name('project.update-status');
        Route::post('project/update-position', [ProjectController::class,'updatePosition'])->name('project.update-position');
        Route::post('/areas', [MainAreaController::class,'store'])->name('areas.store');
        Route::post('/sub-areas', [SubAreaController::class,'store'])->name('subareas.store');
        
        Route::get('home-page/project-types', [HomePageController::class,'sectionProjectTypes'])->name('home-section.project-types');
        Route::resource('home-page', HomePageController::class);
        Route::resource('features', FeatureController::class);
        Route::get('/feature-data', [FeatureController::class,'getFeatures'])->name('features.data');
        Route::get('feature/update-status', [FeatureController::class,'updateStatus'])->name('feature.update-status');
        Route::post('/media/{media}/set-featured', [MediaController::class,'setFeatured'])->name('media.setFeatured');
        Route::get('/projects/{project}/refresh', [ProjectController::class,'refresh'])->name('projects.refresh');

        


    });
});

//Auth::routes();
Route::get('/home', function () {
    return redirect('/admin/dashboard');
});
Route::get('/admin', function () {
    return redirect('/admin/login');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search-area', [HomeController::class, 'searchArea'])->name('search-area');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.list');
Route::get('/blog/{id}', [BlogController::class, 'show'])->name('show');

Route::get('/projects', [FrontProjectController::class, 'index'])->name('allprojects');
Route::get('/projects/search-results', [FrontProjectController::class, 'searchResults'])->name('search-results');
Route::get('/project/{slug}',  [FrontProjectController::class, 'show'])->name('project.show');
Route::get('/about-us', [CmsPage::class, 'showAboutUs'])->name('aboutus.show');
Route::get('/career', [CmsPage::class, 'showCareer'])->name('career.show');
Route::get('/contact-us', [CmsPage::class, 'showContactUs'])->name('contactus.show');
Route::post('/contact-submit', [CmsPage::class, 'submitContactUs'])->name('contact.submit');
Route::post('/property-submit', [CmsPage::class, 'submitInquiryForm'])->name('property.submit');



Route::post('/compare/add',  [ProjectCompareController::class, 'ajaxAdd'])->name('projects.compare.ajaxAdd');
Route::post('/compare/add-multiple', [ProjectCompareController::class, 'ajaxAddMultiple'])->name('projects.compare.ajaxAddMultiple');
Route::post('/compare/remove', [ProjectCompareController::class, 'ajaxRemove'])->name('projects.compare.ajaxRemove');
Route::post('/compare/clear', [ProjectCompareController::class, 'ajaxClear'])->name('projects.compare.ajaxClear');

Route::get('/compare', [ProjectCompareController::class, 'index'])->name('projects.compare');
Route::get('/compare/add/{id}', [ProjectCompareController::class, 'add'])->name('projects.compare.add');
Route::get('/compare/remove/{id}', [ProjectCompareController::class, 'remove'])->name('projects.compare.remove');
Route::post('/subscribe', [SubscriptionController::class, 'store'])->name('subscribe');
Route::get('/survey', [SurveyController::class, 'index'])->name('survey');






