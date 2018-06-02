<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',  [
	'as' => 'home', 
	'uses' => 'WebsiteController@getHome'
]);

Route::get('/about',  [
	'as' => 'about', 
	'uses' => 'WebsiteController@getAbout'
]);

Route::get('/major-international-events',  [
	'as' => 'mie', 
	'uses' => 'WebsiteController@getEventType'
]);

Route::get('/brand-experiences',  [
    'as' => 'brand_ex', 
    'uses' => 'WebsiteController@getEventType'
]);

Route::get('/destination-festivals',  [
    'as' => 'destination', 
    'uses' => 'WebsiteController@getEventType'
]);

Route::get('/portfolio',  [
	'as' => 'portfolio', 
	'uses' => 'WebsiteController@getPortfolio'
]);

Route::get('/portfolio-search/{client}/{event_type}',  [
    'as' => 'portfolio_search', 
    'uses' => 'WebsiteController@getPortfolioSearch'
]);

Route::get('/portfolio/{id}/{title}',  [
	'as' => 'portfolio_individual', 
	'uses' => 'WebsiteController@getIndividualPortfolio'
]);

Route::get('/our-partners/{page_url}',  [
	'as' => 'partners', 
	'uses' => 'WebsiteController@getPartner'
]);

Route::get('/news',  [
	'as' => 'news', 
	'uses' => 'WebsiteController@getNews'
]);

Route::get('/news/{news_id}/{news_title}',  [
	'as' => 'news_article', 
	'uses' => 'WebsiteController@getNewsArticle'
]);

Route::get('/contact-us',  [
	'as' => 'contact', 
	'uses' => 'WebsiteController@getContact'
]);

//Send Mail Professional
Route::post('/send-mail',  [
    'as' => 'main_contact',
    'uses' => 'ContactController@contact'
]);

// AUTHENTICATION ROUTES
	// LOGIN
		Route::get('/login',  [
	    	'as' => 'login', 
	    	'uses' => 'Auth\AuthController@getLogin'
		]);

		Route::post('/login',  [ 
	    	'uses' => 'Auth\AuthController@postLogin'
		]);			

	// LOGOUT
		Route::get('/logout',  [
	    	'as' => 'logout', 
	    	'uses' => 'Auth\AuthController@getLogout'
		]);						

// PASSWORD RESET LINK REQUEST ROUTES
		Route::get('/password/email',  [
	    	'as' => 'resetPassword', 
	    	'uses' => 'Auth\PasswordController@getEmail'
		]);

		Route::post('/password/email',  [ 
	    	'uses' => 'Auth\PasswordController@postEmail'
		]);

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

//AUTH users only
Route::group(['middleware' => 'auth'], function()
{
	//Admin Interface
	Route::get('/dashboard', 'admin\AdminController@loadUserDashboard');
	//Profile
	Route::get('/dashboard/profile', 'admin\AdminController@loadUserProfile');
	Route::post('/dashboard/profile', 'admin\AdminController@saveUserProfile');


	//Home Slider
    Route::get('/dashboard/pages/home/update',  [
        'as' => 'admin_pages_update_home',
        'uses' => 'admin\AdminController@getHomeUpdate'
    ]);

    Route::post('/dashboard/pages/update/home-slider/upload/',  [
        'as' => 'admin_pages_update_home_slider_upload',
        'uses' => 'admin\AdminController@postPagesUpdateHomeSliderUpload'
    ]);

    Route::post('/dashboard/pages/update/home-slider/delete/{image_id}',  [
        'as' => 'admin_pages_update_home_slider_delete',
        'uses' => 'admin\AdminController@postPagesUpdateHomeSliderDelete'
    ]);

	//About Us
    Route::get('/dashboard/about/update/',  [
        'as' => 'admin_about_update',
        'uses' => 'admin\AdminController@getAboutUpdate'
    ]);

    Route::post('/dashboard/about/update/',  [
        'as' => 'admin_about_update_insert',
        'uses' => 'admin\AdminController@postAboutUpdate'
    ]);

    //Pages
    Route::get('/dashboard/pages/{page_id}',  [
        'as' => 'admin_pages',
        'uses' => 'admin\AdminController@getPages'
    ]);

    Route::get('/dashboard/pages/update/{page_id}',  [
        'as' => 'admin_pages_update',
        'uses' => 'admin\AdminController@getPagesUpdate'
    ]);

    Route::post('/dashboard/pages/update/{page_id}',  [
        'as' => 'admin_pages_update',
        'uses' => 'admin\AdminController@postPagesUpdate'
    ]);

    Route::post('/dashboard/pages/update/features-slider/{page_id}',  [
        'as' => 'admin_pages_update_features_slider',
        'uses' => 'admin\AdminController@postPagesUpdateFeaturesSlider'
    ]);

    Route::post('/dashboard/pages/update/offer-slider/upload/{page_id}',  [
        'as' => 'admin_pages_update_offer_slider_upload',
        'uses' => 'admin\AdminController@postPagesUpdateOfferSliderUpload'
    ]);

    Route::post('/dashboard/pages/update/offer-slider/delete/{image_id}',  [
        'as' => 'admin_pages_update_offer_slider_delete',
        'uses' => 'admin\AdminController@postPagesUpdateOfferSliderDelete'
    ]);


    //Portfolio
    Route::get('/dashboard/portfolio/',  [
        'as' => 'admin_portfolio',
        'uses' => 'admin\AdminController@getPortfolio'
    ]);

    Route::get('/dashboard/portfolio/update/',  [
        'as' => 'admin_portfolio_update',
        'uses' => 'admin\AdminController@getportfolioUpdate'
    ]);

    //Our Partners
    Route::get('/dashboard/our-partners/',  [
        'as' => 'admin_our_partners',
        'uses' => 'admin\AdminController@getOurPartners'
    ]);

    Route::get('/dashboard/our-partners/update/',  [
        'as' => 'admin_our_partners_update',
        'uses' => 'admin\AdminController@getOurPartnersUpdate'
    ]);

    //News

    //News
    Route::get('/dashboard/pages/',  [
        'as' => 'admin_news',
        'uses' => 'admin\AdminController@getNews'
    ]);

    Route::get('/dashboard/news/',  [
        'as' => 'admin_news',
        'uses' => 'admin\AdminController@getNews'
    ]);

    Route::get('/dashboard/news/new/',  [
        'as' => 'admin_news_create',
        'uses' => 'admin\AdminController@getNewsCreate'
    ]);

    Route::get('/dashboard/news/update/{article_id}',  [
        'as' => 'admin_news_update',
        'uses' => 'admin\AdminController@getNewsUpdate'
    ]);

    Route::post('/dashboard/news/store/',  [
        'as' => 'admin_news_insert',
        'uses' => 'admin\AdminController@postNewsInsert'
    ]);

    Route::post('/dashboard/news/update/{article_id}',  [
        'as' => 'admin_news_update',
        'uses' => 'admin\AdminController@postNewsUpdate'
    ]);

    Route::post('/dashboard/news/delete/{article_id}',  [
        'as' => 'admin_news_delete',
        'uses' => 'admin\AdminController@postNewsDelete'
    ]);

    //Case Studies
    Route::get('/dashboard/case-studies/',  [
        'as' => 'admin_case_studies',
        'uses' => 'admin\AdminController@getCaseStudies'
    ]);

    Route::get('/dashboard/case-studies/new/',  [
        'as' => 'admin_case_studies_create',
        'uses' => 'admin\AdminController@getCaseStudiesCreate'
    ]);

    Route::get('/dashboard/case-studies/update/{id}',  [
        'as' => 'admin_case_studies_update',
        'uses' => 'admin\AdminController@getCaseStudiesUpdate'
    ]);

    Route::post('/dashboard/case-studies/insert/',  [
        'as' => 'admin_case_studies_insert',
        'uses' => 'admin\AdminController@postCaseStudiesInsert'
    ]);

    Route::post('/dashboard/case-studies/update/{id}',  [
        'as' => 'admin_case_studies_update',
        'uses' => 'admin\AdminController@postCaseStudiesUpdate'
    ]);

    Route::post('/dashboard/case-studies/update/gallery/upload/{case_study_id}',  [
        'as' => 'admin_case_studies_gallery_upload',
        'uses' => 'admin\AdminController@postCaseStudiesUpdateGalleryUpload'
    ]);

    Route::post('/ /dashboard/case-studies/gallery/photo/edit/{id}',  [
        'as' => 'admin_case_studies_gallery_edit_photo',
        'uses' => 'admin\AdminController@postCaseStudiesUpdateGalleryedit'
    ]);



    Route::post('/dashboard/case-studies/gallery/delete/{id}',  [
        'as' => 'admin_case_studies_gallery_delete',
        'uses' => 'admin\AdminController@postCaseStudiesGalleryDelete'
    ]);

    Route::post('/dashboard/case-studies/delete/{id}',  [
        'as' => 'admin_case_studies_delete',
        'uses' => 'admin\AdminController@postCaseStudiesDelete'
    ]);

    //team
    Route::get('/dashboard/team/',  [
        'as' => 'admin_team',
        'uses' => 'admin\AdminController@getTeam'
    ]);

    Route::get('/dashboard/team/new/',  [
        'as' => 'admin_team_create',
        'uses' => 'admin\AdminController@getTeamCreate'
    ]);

    Route::get('/dashboard/team/update/{user_id}',  [
        'as' => 'admin_team_update',
        'uses' => 'admin\AdminController@getTeamUpdate'
    ]);

    Route::post('/dashboard/team/new/',  [
        'as' => 'admin_team_insert',
        'uses' => 'admin\AdminController@postTeamInsert'
    ]);

    Route::post('/dashboard/team/update/{user_id}',  [
        'as' => 'admin_team_update',
        'uses' => 'admin\AdminController@postTeamUpdate'
    ]);

    Route::post('/dashboard/team/delete/{user_id}',  [
        'as' => 'admin_team_delete',
        'uses' => 'admin\AdminController@postTeamDelete'
    ]);

    //contact
    Route::get('/dashboard/contact/',  [
        'as' => 'admin_contact',
        'uses' => 'admin\AdminController@getContact'
    ]);

    Route::post('/dashboard/contact/update/',  [
        'as' => 'admin_contact_update',
        'uses' => 'admin\AdminController@postContactUpdate'
    ]);

    //Client
    Route::get('/dashboard/client/',  [
        'as' => 'admin_client',
        'uses' => 'admin\AdminController@getClient'
    ]);

    Route::get('/dashboard/client/new/',  [
        'as' => 'admin_client_create',
        'uses' => 'admin\AdminController@getClientCreate'
    ]);

    Route::get('/dashboard/client/update/{client_id}',  [
        'as' => 'admin_client_update',
        'uses' => 'admin\AdminController@getClientUpdate'
    ]);

    Route::post('/dashboard/client/new/',  [
        'as' => 'admin_client_insert',
        'uses' => 'admin\AdminController@postClientInsert'
    ]);

    Route::post('/dashboard/client/update/{client_id}',  [
        'as' => 'admin_client_update',
        'uses' => 'admin\AdminController@postClientUpdate'
    ]);

    Route::post('/dashboard/client/delete/{client_id}',  [
        'as' => 'admin_client_delete',
        'uses' => 'admin\AdminController@postClientDelete'
    ]);



});	