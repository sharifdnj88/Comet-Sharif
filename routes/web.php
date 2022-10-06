<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Counter_contact;
use App\Http\Controllers\Admin\AskillController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\VisionController;
use App\Http\Controllers\FrontendPagesController;
use App\Http\Controllers\Admin\PosttagsController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\SubscribeController;
use App\Http\Controllers\Admin\AdminPagesController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\AboutHeaderController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\PostCategoryController;
use App\Http\Controllers\Admin\PortfolioCategoryController;
use App\Http\Controllers\Admin\AdminForgotPasswordController;

//  Admin Pages
Route::group([ 'middleware' => 'admin.redirect' ], function(){
    Route::get('/admin-login', [ AdminPagesController::class, 'ShowLoginPage' ]) ->name('login.page');
    Route::post('/admin-login', [ AdminAuthController::class, 'Login' ]) ->name('admin.login');

    // Admin Forgot Password
    Route::get('/forgot-password', [ AdminForgotPasswordController::class, 'ShowForgotPassword' ] ) -> name('forgot.password.page');
    Route::post('/forgot-password', [ AdminForgotPasswordController::class, 'ForgotPassword' ] ) -> name('forgot.password');
    Route::get('/reset-password/{token?}/{email?}', [ AdminForgotPasswordController::class, 'ResetPasswordLink' ] ) -> name('reset.password');
    Route::post('/reset-password', [ AdminForgotPasswordController::class, 'ResetPassword' ] ) -> name('reset.password');

});

    


//  Admin Auth
Route::group([ 'middleware' => 'admin' ], function(){    

    Route::get('/dashboard', [ AdminPagesController::class, 'ShowDashboard' ]) ->name('admin.dashboard');
    Route::get('/admin-profile', [ AdminProfileController::class, 'ShowAdminProfile' ]) ->name('admin.profile');
    Route::post('/admin-profile', [ AdminProfileController::class, 'AdminProfileChange' ]) ->name('admin.profile.change');
    Route::post('/admin-password', [ AdminProfileController::class, 'AdminPasswordChange' ]) ->name('admin.password.change');
    Route::get('/admin-logout', [ AdminAuthController::class, 'logout' ]) ->name('admin.logout');

    // Permission  Routes
    Route::resource('/permission', PermissionController::class );    
    //  Roll Routes
    Route::resource('/role', RoleController::class );
    //  Admin Routes
    Route::resource('/admin-user', AdminController::class );
    // Status & Trash Route
    Route::get('/admin-status/{id}', [ AdminController::class, 'StatusUpdate' ] ) -> name('admin.status');
    Route::get('/admin-trash', [ AdminController::class, 'TrashUsers' ] ) -> name('admin.trash');
    Route::get('/admin-trash-update/{id}', [ AdminController::class, 'TrashUpdate' ] ) -> name('admin.trash.update');

     //  Slider Routes
     Route::resource('/slider', SliderController::class );
    //  Slider Status
    Route::get('/slider-status/{id}', [ SliderController::class, 'SliderStatus' ] ) -> name('slider.status');
    Route::get('/slider-trash', [ SliderController::class, 'SliderTrash' ] ) -> name('slider.trash');
    Route::get('/slider-trash-update/{id}', [ SliderController::class, 'SliderUpdate' ] ) -> name('slider.trash.update');

    //  Testimonial Routes
    Route::resource('/testimonial', TestimonialController::class );
    //  Client Routes
    Route::resource('/client', ClientController::class );

    //  Vision Routes
    Route::resource('/vision', VisionController::class );
     //  Vision Status
     Route::get('/vision-status/{id}', [ VisionController::class, 'SliderStatus' ] ) -> name('vision.status');
     Route::get('/vision-trash', [ VisionController::class, 'VisionTrash' ] ) -> name('vision.trash');
     Route::get('/vision-trash-update/{id}', [ VisionController::class, 'VisionUpdate' ] ) -> name('vision.trash.update');

     //  About Routes
    Route::resource('/about_header', AboutHeaderController::class );
    Route::resource('/about_skill', AskillController::class );
    // Contact Routes
    Route::resource('/counter-contact', Counter_contact::class);
    // Category Routes
    Route::resource('/portfolio-category', PortfolioCategoryController::class);
    // Portfolio Routes
    Route::resource('/portfolio', PortfolioController::class);
    // Post Tags Routes
    Route::resource('/post-tags', PosttagsController::class);
    // Post Category Routes
    Route::resource('/post-category', PostCategoryController::class);
    // Post Routes
    Route::resource('/post', PostController::class);

       // Post Routes
       Route::resource('/subscribe', SubscribeController::class);

    
});

// Frontend Routes
Route::get('/', [ FrontendPagesController::class, 'ShowFrontendHomePage' ] ) -> name('home.page');
Route::get('/about-page', [ FrontendPagesController::class, 'ShowFrontendAboutPage' ] ) -> name('about.page');
Route::get('/contact-page', [ FrontendPagesController::class, 'ShowFrontendContactPage' ] ) -> name('contact.page');
Route::get('/blog-page', [ FrontendPagesController::class, 'ShowFrontendBlogPage' ] ) -> name('blog.page');
Route::get('/single-blog/{slug}', [ FrontendPagesController::class, 'ShowSingleBlogPage' ] ) -> name('single.blog');
Route::get('/portfolio-single/{slug}', [ FrontendPagesController::class, 'ShowSinglePortfolioPage' ] ) -> name('portfolio.single.page');
Route::get('/post_category/{slug}', [ FrontendPagesController::class, 'ShowBlogPostByCategory' ] ) -> name('blog.post.category');
Route::get('/post_tag/{slug}', [ FrontendPagesController::class, 'ShowBlogPostByTag' ] ) -> name('blog.post.tag');
Route::get('/search/{key}', [ FrontendPagesController::class, 'ShowBlogPostBySearch' ] ) -> name('blog.post.search');



