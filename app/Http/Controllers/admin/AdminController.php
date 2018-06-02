<?php

namespace App\Http\Controllers\Admin;

use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Validator;

use App\User;
use App\UserRole;
use App\Photo;
use App\NewsAr;
use App\NewsZa;
use App\Page;
use App\ClientAr;
use App\ClientZa;
use App\Contact;
use App\Team;
use App\AboutUs;
use App\OfferSlider;
use App\HomeSlider;
use App\CaseStudy;
use App\CaseStudyGallery;
use App\CaseStudyGalleryPhoto;
use App\CaseStudyPages;
use App\FeaturesSlider;

use Auth;
use Hash;

/*
|----------------------------------------------------------
|  NOTES
|----------------------------------------------------------
| Site IDs:
|   1: Arabia (ar)
|   2: South Africa (za)
|
*/

class AdminController extends Controller
{

    protected function loadUserDashboard()
    {

        $user = Auth::user();

        return view('admin.dashboard', ['user' => $user]);

    }

    protected function loadUserProfile()
    {

        $user = Auth::user();

        return view('admin.profile', ['user' => $user]);

    }

    protected function saveUserProfile(Request $request)
    {

        $user = Auth::user();
        // echo $user->first_name;
        $this->validate($request, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|max:255',
            'password' => 'min:8'
        ]);

        //First Name
        if (isset($request->first_name))
            $user->first_name = $request->first_name;

        //Last Name
        if (isset($request->last_name))
            $user->last_name = $request->last_name;

        //Email
        if (isset($request->email))
            $user->email = $request->email;

        //Password
        if (isset($request->password) && !empty($request->password))
            $user->password = hash::make($request->password);

        $user->save();

        return redirect('/dashboard/profile')->with('message', 'Details updated successfully!');
    }

    public function NewGuid()
    {

        $s = strtolower(md5(uniqid(rand(), true)));
        $guidText =
            substr($s, 0, 8) . '-' .
            substr($s, 8, 4) . '-' .
            substr($s, 12, 4) . '-' .
            substr($s, 16, 4) . '-' .
            substr($s, 20);
        return $guidText;
    }

    //Dashboard Home Slider
    public function getHomeUpdate()
    {

        $user = Auth::user();

        $home_slider = HomeSlider::where([
            ['site_id', $user->site_id]
        ])->whereNull('deleted_at')->get();

        return view('admin.home.edit', ['user' => $user, 'home_slider' => $home_slider]);
    }

    public function postPagesUpdateHomeSliderUpload(Request $request)
    {

        $user = Auth::user();

        if (in_array('update_pages', $user->permissions())) {

            $file = $request->file('file');
            $file_name = $file->getClientOriginalName();
            $file->move('images/uploads/offer-slider/', $file_name);
            $image_path = '/images/uploads/offer-slider/' . $file_name;

            $image = new HomeSlider();
            $image->image_path = $image_path;
            $image->site_id = $user->site_id;
            $image->save();

        }
    }

    public function postPagesUpdateHomeSliderDelete($image_id)
    {

        $user = Auth::user();

        $image = HomeSlider::find($image_id);

        $date = date('Y-m-d H:i:s');

        if (in_array('delete_pages', $user->permissions())) {

            $image->delete();

        }

        return redirect()->back()->with('success', 'Success! Your image has been deleted.');
    }

    //Dashboard Navigation
    public function getAboutUpdate()
    {

        $user = Auth::user();

        $contact = AboutUs::where('site_id', $user->site_id)->first();

        return view('admin.about-us.edit', ['user' => $user, 'contact' => $contact]);
    }

    public function postAboutUpdate(Request $request)
    {

        $user = Auth::user();

        $about = AboutUs::where('site_id', $user->site_id)->first();

        $validator = Validator::make(input::all(), array(
            "title" => "required|max:255",
            "subtitle" => "required",
            "what_we_do" => "required",
            "cover_img" => 'mimes:jpg,jpeg,tif,png,gif|max:2000|dimensions:width=1000,height=260',
            "events_img" => 'mimes:jpg,jpeg,tif,png,gif|max:2000|dimensions:width=960,height=430',
            "events_img_mobi" => 'mimes:jpg,jpeg,tif,png,gif|max:2000|dimensions:width=500',
            "footer_img" => 'mimes:jpg,jpeg,tif,png,gif|max:2000|dimensions:width=1000,height=415',
        ));

        if ($validator->passes()) {

            $input = $request->all();

            if ($file = $request->file('cover_img')) {

                //unlink(public_path() . '/images/uploads/pages/' . $page->cover_img);

                $name = time() . '-' . $file->getClientOriginalName();

                $file->move('images/uploads/pages/', $name);

                $image_path = '/images/uploads/pages/' . $name;

                $input['cover_img'] = $image_path;
            }

            if ($file = $request->file('events_img')) {

                //unlink(public_path() . '/images/uploads/pages/' . $page->cover_img);

                $name = time() . '-' . $file->getClientOriginalName();

                $file->move('images/uploads/pages/', $name);

                $image_path = '/images/uploads/pages/' . $name;

                $input['events_img'] = $image_path;
            }

            if ($file = $request->file('events_img_mobi')) {

                //unlink(public_path() . '/images/uploads/pages/' . $page->cover_img);

                $name = time() . '-' . $file->getClientOriginalName();

                $file->move('images/uploads/pages/', $name);

                $image_path = '/images/uploads/pages/' . $name;

                $input['events_img_mobi'] = $image_path;
            }

            if ($file = $request->file('footer_img')) {

                //unlink(public_path() . '/images/uploads/pages/' . $page->cover_img);

                $name = time() . '-' . $file->getClientOriginalName();

                $file->move('images/uploads/pages/', $name);

                $image_path = '/images/uploads/pages/' . $name;

                $input['footer_img'] = $image_path;
            }

            $input['title'] = strtoupper(trim($input['title']));

            if (in_array('update_pages', $user->permissions())) {

                //$about->update($input);

                //var_dump($input); exit;

                if(isset($input['cover_img']) && !empty($input['cover_img']))
                    $about->cover_img = $input['cover_img'];

                if(isset($input['title']) && !empty($input['title']))
                    $about->title = $input['title'];

                if(isset($input['subtitle']) && !empty($input['subtitle']))
                    $about->subtitle = $input['subtitle'];

                if(isset($input['events_img']) && !empty($input['events_img']))
                    $about->events_img = $input['events_img'];

                if(isset($input['events_img_mobi']) && !empty($input['events_img_mobi']))
                    $about->events_img_mobi = $input['events_img_mobi'];

                if(isset($input['footer_img']) && !empty($input['footer_img']))
                    $about->footer_img = $input['footer_img'];

                if(isset($input['what_we_do']) && !empty($input['what_we_do']))
                    $about->what_we_do = $input['what_we_do'];

                $about->save();

            }

            return redirect()->back()->with('success', 'Success! Your page has been updated.');

        } else {

            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
    }

    //Pages
    public function getPages($page_id)
    {

        $user = Auth::user();

        $features_slider = FeaturesSlider::where([
            ['page_id', $page_id],
            ['site_id', $user->site_id]
        ])->whereNull('deleted_at')->get();

        $page = Page::where([
            ['page_id', $page_id],
            ['site_id', $user->site_id]
        ])->whereNull('deleted_at')->first();

        return view('admin.pages.index', ['user' => $user, 'page' => $page, 'features_slider' => $features_slider]);
    }

    public function getPagesUpdate($page_id)
    {

        $user = Auth::user();

        $page_id = (int)$page_id;

        $page = Page::where('page_id', $page_id)->where('site_id', $user->site_id)->get();

        if ($page_id == 1 || $page_id == 2 || $page_id == 3) {
            $slider_features = FeaturesSlider::where([
                ['page_id', $page_id],
                ['site_id', $user->site_id]
            ])->whereNull('deleted_at')->get();

            $offer_slider = OfferSlider::where([
                ['page_id', $page_id],
                ['site_id', $user->site_id]
            ])->whereNull('deleted_at')->get();

        } else {
            $offer_slider = null;
            $slider_features = null;
        }

        return view('admin.pages.edit', ['user' => $user, 'page' => $page, 'slider_features' => $slider_features, 'offer_slider' => $offer_slider]);
    }

    public function postPagesUpdate(Request $request, $page_id)
    {

        $user = Auth::user();

        $page_id = (int)$page_id;

        $page = Page::where('page_id', $page_id)->where('site_id', $user->site_id)->first();

        $validator = Validator::make(input::all(), array(
            "title" => "required|max:255",
            "sub_title" => "required",
            "cover_img" => 'mimes:jpg,jpeg,tif,png,gif|max:2000|dimensions:width=1000,height=260',
        ));

        if ($validator->passes()) {

            $input = $request->all();

            if ($file = $request->file('cover_img')) {

                //unlink(public_path() . '/images/uploads/pages/' . $page->cover_img);

                $name = time() . '-' . $file->getClientOriginalName();

                $file->move('images/uploads/pages/', $name);

                $image_path = '/images/uploads/pages/' . $name;

                $input['cover_img'] = $image_path;
            }

            $input['title'] = strtoupper(trim($input['title']));

            // var_dump($input);
            // exit;

            if (in_array('update_pages', $user->permissions())) {

                //$page->update($input);
                if(isset($input['cover_img']) && !empty($input['cover_img']))
                    $page->cover_img = $input['cover_img'];

                $page->title = $input['title'];
                $page->sub_title = $input['sub_title'];

                if(isset($input['offer']) && !empty($input['offer']))
                    $page->what_we_do = $input['offer'];
                
                $page->save();

            }

            return redirect()->back()->with('success', 'Success! Your page has been updated.');

        } else {

            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
    }

    public function postPagesUpdateFeaturesSlider(Request $request, $page_id)
    {

        $user = Auth::user();

        $validator = Validator::make(input::all(), array(
            "features" => "required",
        ));

        if ($validator->passes()) {

            $slider_features = FeaturesSlider::where([
                ['page_id', $page_id],
                ['site_id', $user->site_id]
            ])->whereNull('deleted_at')->get();

            foreach ($slider_features as $feature) {
                $feature->delete();
            }

            $inputs = $request->features;

            if (in_array('update_pages', $user->permissions())) {
                foreach ($inputs as $input) {

                    $feature = new FeaturesSlider;
                    $feature->page_id = $page_id;
                    $feature->site_id = $user->site_id;
                    $feature->description = $input;
                    $feature->save();

                }
            }

            return redirect()->back()->with('success', 'Success! Your features have been created.');

        } else {

            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
    }

    public function postPagesUpdateOfferSliderUpload(Request $request, $page_id)
    {

        $user = Auth::user();

        if (in_array('update_pages', $user->permissions())) {

            $file = $request->file('file');
            $file_name = $file->getClientOriginalName();
            $file->move('images/uploads/offer-slider/', $file_name);
            $image_path = '/images/uploads/offer-slider/' . $file_name;

            $image = new OfferSlider();
            $image->image_path = $image_path;
            $image->site_id = $user->site_id;
            $image->page_id = $page_id;
            $image->save();

        }
    }

    public function postPagesUpdateOfferSliderDelete($image_id)
    {

        $user = Auth::user();

        $image = OfferSlider::find($image_id);

        $date = date('Y-m-d H:i:s');

        if (in_array('delete_pages', $user->permissions())) {

            $image->delete();

        }

        return redirect()->back()->with('success', 'Success! Your image has been deleted.');
    }

    //Portfolio
    public function getPortfolio()
    {

        $user = Auth::user();

        return view('admin.portfolio.index', ['user' => $user]);
    }

    public function getPortfolioUpdate()
    {

        $user = Auth::user();

        return view('admin.portfolio.edit', ['user' => $user]);
    }

    //Our Partners
    public function getOurPartners()
    {

        $user = Auth::user();

        return view('admin.our-partners.index', ['user' => $user]);
    }

    public function getOurPartnersUpdate()
    {

        $user = Auth::user();

        return view('admin.our-partners.edit', ['user' => $user]);
    }

    //News
    public function getNews()
    {

        $user = Auth::user();

        $blog_article = null;
        if ($user->site_id == 1)
            $blog_article = NewsAr::whereNull('deleted_at')->orderBy('created_at', 'desc')->paginate(10);
        if ($user->site_id == 2)
            $blog_article = NewsZa::whereNull('deleted_at')->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.news.index', ['user' => $user, 'blog_article' => $blog_article]);
    }

    public function getNewsCreate()
    {

        $user = Auth::user();

        $pages = Page::where('site_id', $user->site_id)->get();

        $case_studies = CaseStudy::where('site_id', $user->site_id)->get();

        return view('admin.news.create', ['user' => $user, 'pages' => $pages, 'case_studies' => $case_studies,]);
    }

    public function getNewsUpdate($article_id)
    {

        $user = Auth::user();

        $pages = Page::where('site_id', $user->site_id)->get();

        $article = null;
        if ($user->site_id == 1)
            $article = NewsAr::where('id', $article_id)->first();
        if ($user->site_id == 2)
            $article = NewsZa::where('id', $article_id)->first();

        $case_studies = CaseStudy::where('site_id', $user->site_id)->get();
        $selected_case_study = CaseStudy::where('id', $article->case_study_id)->first();

        $page = Page::where('page_id', $article->event_type)->get();

        return view('admin.news.edit', ['user' => $user, 'article' => $article, 'pages' => $pages, 'page' => $page, 'case_studies' => $case_studies, 'selected_case_study' => $selected_case_study]);
    }

    public function postNewsInsert(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make(input::all(), array(
            "title" => "required|max:255",
            "description" => "required",
            "date" => "required",
            "image" => "mimes:jpg,jpeg,tif,png,gif|max:2000|dimensions:width=740,height=400",
            "banner" => "required|mimes:jpg,jpeg,tif,png,gif|max:2000|dimensions:width=1000,height=260",

        ));

        if ($validator->passes()) {

            $input = $request->all();

            if ($file = $request->file('image')) {

                $name = time() . '-' . $file->getClientOriginalName();

                $file->move('images/uploads/news', $name);

                $image_path = '/images/uploads/news/' . $name;

                $input['image'] = $image_path;

            }

            if ($file = $request->file('banner')) {

                $name = time() . '-' . $file->getClientOriginalName();

                $file->move('images/uploads/news/banners', $name);

                $image_path = '/images/uploads/news/banners/' . $name;

                $input['banner'] = $image_path;

            }

            if (in_array('create_news', $user->permissions())) {

                $input['title'] = ucwords(trim($input['title']));
                $input['case_study_id'] = (int)$input['case_study_id'];

                if ($user->site_id == 1) {
                    $article = new NewsAr;
                    $article->title = $input['title'];
                    $article->date = $input['date'];
                    $article->url = str_replace(' ', '-', strtolower($input['title']));
                    $article->event_type = $input['event_type'];
                    $article->case_study_id = $input['case_study_id'];
                    $article->description = $input['description'];
                    $article->image = $input['image'];
                    $article->banner = $input['banner'];
                    $article->save();
                }

                if ($user->site_id == 2) {
                    $article = new NewsZa;
                    $article->title = $input['title'];
                    $article->date = $input['date'];
                    $article->url = str_replace(' ', '-', strtolower($input['title']));
                    $article->event_type = $input['event_type'];
                    $article->case_study_id = $input['case_study_id'];
                    $article->description = $input['description'];
                    $article->image = $input['image'];
                    $article->banner = $input['banner'];
                    $article->save();
                }

            }

            return redirect('dashboard/news')->with('success', 'Success! Your article has been created.');

        } else {

            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
    }

    public function postNewsUpdate(Request $request, $article_id)
    {

        $user = Auth::user();

        $validator = Validator::make(input::all(), array(
            "title" => "required|max:255",
            "date" => "required|max:255",
            "description" => "required",
            "image" => "required|mimes:jpg,jpeg,tif,png,gif|max:2000|dimensions:width=740,height=400",
            "banner" => "required|mimes:jpg,jpeg,tif,png,gif|max:2000|dimensions:width=1000,height=260",
        ));

        if ($validator->passes()) {

            $article = null;
            if ($user->site_id == 1)
                $article = NewsAr::findOrFail($article_id);

            if ($user->site_id == 2)
                $article = NewsZa::findOrFail($article_id);

            $input = $request->all();

            if ($file = $request->file('image')) {

                //unlink(public_path() . '/images/uploads/news/' . $article->image);

                $name = time() . '-' . $file->getClientOriginalName();

                $file->move('images/uploads/news', $name);

                $image_path = '/images/uploads/news/' . $name;

                $input['image'] = $image_path;
            }

            if ($file = $request->file('banner')) {


                //unlink(public_path() . '/images/uploads/news/' . $article->image);

                $name = time() . $file->getClientOriginalName();

                $file->move('images/uploads/news/banners', $name);

                $image_path = '/images/uploads/news/banners/' . $name;

                $input['banner'] = $image_path;
                $article->banner = $input['banner'];
            }

            $input['title'] = ucwords(trim($input['title']));

            if (in_array('update_news', $user->permissions())) {

                $article->update($input);
                $article->case_study_id = $input['case_study_id'];
                $article->date = $input['date'];
                $article->url = str_replace(' ', '-', strtolower($input['title']));
                $article->save();

            }

            return redirect()->back()->with('success', 'Success! Your article has been updated.');

        } else {

            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
    }

    public function postNewsDelete($article_id)
    {

        $user = Auth::user();

        $article = null;
        if ($user->site_id == 1)
            $article = NewsAr::find($article_id);
        if ($user->site_id == 2)
            $article = NewsZa::find($article_id);

        $date = date('Y-m-d H:i:s');

        if (in_array('delete_news', $user->permissions())) {

            $article->delete();

            return redirect()->back()->with('success', 'Success! Your article has been deleted.');

        } else

            return 'You do not have permission to delete this.';
    }

    //Case Studies
    public function getCaseStudies()
    {

        $user = Auth::user();

        $case_studies = CaseStudy::where('site_id', $user->site_id)->whereNull('deleted_at')->paginate(10);

        return view('admin.case-studies.index', ['user' => $user, 'case_studies' => $case_studies,]);
    }

    public function getCaseStudiesCreate()
    {

        $user = Auth::user();

        $pages = Page::where('site_id', $user->site_id)->get();

        if ($user->site_id == 1) {
            $clients = ClientAr::whereNull('deleted_at')->orderBy('name')->get();
        }

        if ($user->site_id == 2) {
            $clients = ClientZa::whereNull('deleted_at')->orderBy('name')->get();
        }

        return view('admin.case-studies.create', ['user' => $user, 'pages' => $pages, 'clients' => $clients]);
    }

    public function getCaseStudiesUpdate($id)
    {

        $user = Auth::user();

        $case_study = CaseStudy::where('id', $id)->whereNull('deleted_at')->first();

        $pages = Page::where('site_id', $user->site_id)->get();
        $page = Page::where('page_id', $case_study->page_id)->get();

        $page_ids = CaseStudyPages::where([
            ['case_study_id', $case_study->id],
        ])->whereNull('deleted_at')->lists('page_id');

        $selected_pages = Page::whereIn('page_id', $page_ids)->where('site_id', $user->site_id)->get();
        $gallery = CaseStudyGallery::where('case_study_id', $id)->first();

        if ($user->site_id == 1) {
            $clients = ClientAr::whereNull('deleted_at')->orderBy('name')->get();
            $selected_client = ClientAr::where('id', $case_study->client_id)->whereNull('deleted_at')->orderBy('name')->first();
        }

        if ($user->site_id == 2) {
            $clients = ClientZa::whereNull('deleted_at')->orderBy('name')->get();
            $selected_client = ClientZa::where('id', $case_study->client_id)->whereNull('deleted_at')->orderBy('name')->first();
        }

        $gallery_photos = null;
        if (!empty($gallery)) {
            $gallery_photos = CaseStudyGalleryPhoto::where('gallery_id', $gallery->id)->get();
        }

        return view('admin.case-studies.edit', ['user' => $user, 'case_study' => $case_study, 'gallery_photos' => $gallery_photos, 'page' => $page, 'pages' => $pages, 'selected_pages' => $selected_pages, 'clients' => $clients, 'selected_client' => $selected_client,]);
    }

    public function postCaseStudiesInsert(Request $request)
    {

        $user = Auth::user();

        $validator = Validator::make(input::all(), array(
            "description" => "required",
            "page_id" => "required",
            "cs_image" => "required|mimes:jpg,jpeg,tif,png,gif|max:2000|dimensions:width=1000,height=667",
            "cover_image" => "required|mimes:jpg,jpeg,tif,png,gif|max:2000|dimensions:width=1000,height=260",
            "brand_image" => "required|mimes:jpg,jpeg,tif,png,gif|max:2000|dimensions:width=300,height=300",
            "info_image" => "mimes:jpg,jpeg,tif,png,gif|max:2000",
            "info_image_mobi" => "mimes:jpg,jpeg,tif,png,gif|max:2000|dimensions:width=500",
            "client" => "required",
            "width" => "required",
        ));

        if ($validator->passes()) {
            $input = $request->all();

            if ($file = $request->file('cs_image')) {

                $name = time() . '-cs-' . $file->getClientOriginalName();

                $file->move('images/uploads/case-study', $name);

                $image_path_cs = '/images/uploads/case-study/' . $name;

                $input['cs_image'] = $image_path_cs;
            }

            if ($file = $request->file('cover_image')) {

                $name = time() . '-ci-' . $file->getClientOriginalName();

                $file->move('images/uploads/case-study', $name);

                $image_path_ci = '/images/uploads/case-study/' . $name;

                $input['cover_image'] = $image_path_ci;
            }

            if ($file = $request->file('brand_image')) {

                $name = time() . '-bi-' . $file->getClientOriginalName();

                $file->move('images/uploads/case-study', $name);

                $image_path_bi = '/images/uploads/case-study/' . $name;

                $input['brand_image'] = $image_path_bi;
            }

            if ($file = $request->file('info_image')) {

                $name = time() . '-ii-' . $file->getClientOriginalName();

                $file->move('images/uploads/case-study', $name);

                $image_path_ii = '/images/uploads/case-study/' . $name;

                $input['info_image'] = $image_path_ii;

            }else{
                $input['info_image'] = NULL;
            }

            if ($file = $request->file('info_image_mobi')) {

                $name = time() . '-iim-' . $file->getClientOriginalName();

                $file->move('images/uploads/case-study', $name);

                $image_path_iim = '/images/uploads/case-study/' . $name;

                $input['info_image_mobi'] = $image_path_iim;

            }else{
                $input['info_image_mobi'] = NULL;
            }

            if (in_array('create_case_study', $user->permissions())) {
                $case_study = new CaseStudy();
                $case_study->title = $input['title'];
                $case_study->url = str_replace(' ', '-', strtolower($input['title']));
                $case_study->description = $input['description'];
                $case_study->cs_img_url = $input['cs_image'];
                $case_study->cover_img_url = $input['cover_image'];
                $case_study->brand_img_url = $input['brand_image'];
                $case_study->web_url = $input['web_url'];
                $case_study->facebook_url = $input['facebook_url'];
                $case_study->twitter_url = $input['twitter_url'];
                $case_study->instagram_url = $input['instagram_url'];
                $case_study->pinterest_url = $input['pinterest_url'];
                $case_study->width = $input['width'];
                $case_study->client_id = $input['client'];
                $case_study->site_id = $user['site_id'];
                $case_study->info_img_url = $input['info_image'];
                $case_study->info_img_mobi_url = $input['info_image_mobi'];
                $case_study->save();

                foreach ($input['page_id'] as $page_id) {
                    $case_study->pages()->attach($page_id);
                }
            }

            return redirect()->back()->with('success', 'Success! Your Case Study has been created.');

        } else {

            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
    }

    public function postCaseStudiesUpdate(Request $request, $id)
    {

        $user = Auth::user();

        $case_study = CaseStudy::where('id', $id)->first();

        $validator = Validator::make(input::all(), array(
            "description" => "required",
            "title" => "required",
            "page_id" => "required",
            "width" => "required",
            "cs_image" => "mimes:jpg,jpeg,tif,png,gif|max:2000|dimensions:width=1000,height=667",
            "cover_image" => "mimes:jpg,jpeg,tif,png,gif|max:2000|dimensions:width=1000,height=260",
            "brand_image" => "mimes:jpg,jpeg,tif,png,gif|max:2000|dimensions:width=300,height=300",
            "info_image" => "mimes:jpg,jpeg,tif,png,gif|max:2000",
            "info_image_mobi" => "mimes:jpg,jpeg,tif,png,gif|max:2000|dimensions:width=500",
        ));

        if ($validator->passes()) {
            $input = $request->all();

            if ($file = $request->file('cs_image')) {

                $name = time() . '-cs-' . $file->getClientOriginalName();

                $file->move('images/uploads/case-study', $name);

                $image_path_cs = '/images/uploads/case-study/' . $name;

                $case_study->cs_img_url = $image_path_cs;
            }

            if ($file = $request->file('cover_image')) {

                $name = time() . '-ci-' . $file->getClientOriginalName();

                $file->move('images/uploads/case-study', $name);

                $image_path_ci = '/images/uploads/case-study/' . $name;

                $case_study->cover_img_url = $image_path_ci;
            }

            if ($file = $request->file('brand_image')) {

                $name = time() . '-bi-' . $file->getClientOriginalName();

                $file->move('images/uploads/case-study', $name);

                $image_path_bi = '/images/uploads/case-study/' . $name;

                $case_study->brand_img_url = $image_path_bi;
            }

            if ($file = $request->file('info_image')) {

                $name = time() . '-ii-' . $file->getClientOriginalName();

                $file->move('images/uploads/case-study', $name);

                $image_path_ii = '/images/uploads/case-study/' . $name;

                $case_study->info_img_url = $image_path_ii;
            }

            if ($file = $request->file('info_image_mobi')) {

                $name = time() . '-iim-' . $file->getClientOriginalName();

                $file->move('images/uploads/case-study', $name);

                $image_path_iim = '/images/uploads/case-study/' . $name;

                $case_study->info_img_url = $image_path_iim;
            }

            if (in_array('create_case_study', $user->permissions())) {

                $case_study->title = $input['title'];
                $case_study->description = $input['description'];
                $case_study->url = str_replace(' ', '-', strtolower($input['title']));
                $case_study->client_id = $input['client'];
                $case_study->width = $input['width'];
                $case_study->site_id = $user['site_id'];
                $case_study->web_url = $input['web_url'];
                $case_study->facebook_url = $input['facebook_url'];
                $case_study->twitter_url = $input['twitter_url'];
                $case_study->instagram_url = $input['instagram_url'];
                $case_study->pinterest_url = $input['pinterest_url'];
                $case_study->save();

                $case_study_pages = CaseStudyPages::where([
                    ['case_study_id', $id],
                ])->get();

                foreach ($case_study_pages as $item) {
                    $item->delete();
                }

                foreach ($input['page_id'] as $page_id) {
                    $case_study->pages()->attach($page_id);
                }
            }

            return redirect()->back()->with('success', 'Success! Your Case Study has been updated.');

        } else {

            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
    }

    public function postCaseStudiesUpdateGalleryUpload(Request $request, $case_study_id)
    {

        $user = Auth::user();

        if (in_array('update_case_study', $user->permissions())) {

            $gallery = CaseStudyGallery::where('case_study_id', $case_study_id)->first();

            if (empty($gallery)) {
                $gallery = new CaseStudyGallery();
                $gallery->site_id = $user->site_id;
                $gallery->case_study_id = $case_study_id;
                $gallery->save();
            }

            $file = $request->file('file');
            $file_name = $file->getClientOriginalName();
            $file->move('images/uploads/case-study/', $file_name);
            $image_path = '/images/uploads/case-study/' . $file_name;

            $photo = new CaseStudyGalleryPhoto();
            $photo->gallery_id = $gallery->id;
            $photo->image_url = $image_path;
            $photo->width = 0;
            $photo->save();
        }
    }

    public function postCaseStudiesUpdateGalleryedit(Request $request, $id){

        $user = Auth::user();

        $image = CaseStudyGalleryPhoto::find($id);

        $image->width = $request->width;

        $image->save();

        return redirect()->back()->with('success', 'Success! Your image has been updated.');

    }

    public function postCaseStudiesGalleryDelete($image_id)
    {

        $user = Auth::user();

        $image = CaseStudyGalleryPhoto::find($image_id);

        $date = date('Y-m-d H:i:s');

        if (in_array('delete_case_study', $user->permissions())) {

            $image->delete();

        }

        return redirect()->back()->with('success', 'Success! Your image has been deleted.');
    }

    public function postCaseStudiesDelete($id)
    {

        $user = Auth::user();

        $case_study = CaseStudy::where('id', $id)->first();

        $date = date('Y-m-d H:i:s');

        if (in_array('delete_case_study', $user->permissions())) {

            $case_study->delete();

            return redirect()->back()->with('success', 'Success! Your Case Study has been deleted.');

        } else

            return 'You do not have permission to delete this.';
    }

    //team
    public function getTeam()
    {

        $user = Auth::user();

        $team = Team::where('site_id', $user->site_id)->paginate(10);

        return view('admin.team.index', ['user' => $user, 'team' => $team,]);
    }

    public function getTeamCreate()
    {

        $user = Auth::user();

        return view('admin.team.create', ['user' => $user,]);
    }

    public function postTeamInsert(Request $request)
    {

        $user = Auth::user();

        $validator = Validator::make(input::all(), array(
            "first_name" => "required",
            "last_name" => "required",
            "email" => "required",
            "title" => "required",
            "image" => "required|mimes:jpg,jpeg,tif,png,gif|max:2000",
            "linkedin_url" => "required",

        ));

        if ($validator->passes()) {

            $team_memeber = new Team();

            $input = $request->all();

            if (in_array('update_team', $user->permissions())) {

                if ($file = $request->file('image')) {

                    $name = time() . '-' . $file->getClientOriginalName();

                    $file->move('images/uploads/team', $name);

                    $image_path = '/images/uploads/team/' . $name;

                    $team_memeber->image = $image_path;
                }

                $team_memeber->first_name = $input['first_name'];
                $team_memeber->last_name = $input['last_name'];
                $team_memeber->email = $input['email'];
                $team_memeber->title = $input['title'];
                $team_memeber->linkedin_url = $input['linkedin_url'];
                $team_memeber->site_id = $user->site_id;
                $team_memeber->save();

                $team = Team::where('site_id', $user->site_id)->paginate(10);

                return view('admin.team.index', ['user' => $user, 'team' => $team,])->with('success', 'Success! Your team member has been created.');
            }

        } else {

            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
    }

    public function getTeamUpdate($user_id)
    {

        $user = Auth::user();

        $team_member = Team::where('id', $user_id)->first();

        return view('admin.team.edit', ['user' => $user, 'team_member' => $team_member,]);
    }

    public function postTeamUpdate(Request $request, $user_id)
    {

        $user = Auth::user();

        $validator = Validator::make(input::all(), array(
            "first_name" => "required",
            "last_name" => "required",
            "email" => "required",
            "title" => "required",
            "linkedin_url" => "required",
           /* "image" => "required|mimes:jpg,jpeg,tif,png,gif|max:2000"*/
        ));

        if ($validator->passes()) {

            $team_member = Team::where('id', $user_id)->first();

            $input = $request->all();

            if (in_array('update_team', $user->permissions())) {

                if ($file = $request->file('image')) {

                    $name = time() . '-' . $file->getClientOriginalName();

                    $file->move('images/uploads/team', $name);

                    $image_path = '/images/uploads/team/' . $name;

                    $input['image'] = $image_path;
                }

                $team_member->update($input);

                return redirect()->back()->with('success', 'Success! Your team member has been updated.');;
            }

        } else {

            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
    }

    public function postTeamDelete($id)
    {

        $user = Auth::user();

        $team_member = Team::where('id', $id)->first();

        $date = date('Y-m-d H:i:s');

        if (in_array('delete_team', $user->permissions())) {

            $team_member->delete();

            return redirect()->back()->with('success', 'Success! Your team member has been deleted.');

        } else

            return 'You do not have permission to delete this.';
    }

    //contact
    public function getContact()
    {

        $user = Auth::user();

        $contact = Contact::where('site_id', $user->site_id)->get();

        return view('admin.contact.edit', ['user' => $user, 'contact' => $contact,]);
    }

    public function postContactUpdate(Request $request)
    {

        $user = Auth::user();

        $contact = Contact::where('site_id', $user->site_id)->get();

        $validator = Validator::make(input::all(), array(
            "google_map_link" => "required",
            "address" => "required",
            "tel" => "required",
            "email" => "required",
            "description" => "required|max:2000",
            "facebook_url" => "required",
            "linked_in_url" => "required",
            "google_plus_url" => "required",
            //"cover_img" => "mimes:jpg,jpeg,tif,png,gif|max:2000",
        ));

        if ($validator->passes()) {

            $contact = Contact::where('site_id', $user->site_id)->first();

            $input = $request->all();

            // if ($file = $request->file('cover_img')) {

            //     $name = time() . '-' . $file->getClientOriginalName();

            //     $file->move('images/uploads/contact', $name);

            //     $image_path = '/images/uploads/contact/' . $name;

            //     $input['cover_img'] = $image_path;

            // }

            if (in_array('update_contact', $user->permissions())) {

                $contact->update($input);

                //$contact->cover_img = $input['cover_img'];
                $contact->save();

                return redirect()->back()->with('success', 'Success! Your contact details have been updated.');
            }

        } else {

            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
    }

    //client
    public function getClient()
    {
        $user = Auth::user();

        if($user->site_id == 1)
            $client = ClientAr::whereNull('deleted_at')->paginate(10);
        elseif($user->site_id == 2)
            $client = ClientZa::whereNull('deleted_at')->paginate(10);

        return view('admin.client.index', ['user' => $user, 'client' => $client,]);
    }

    public function getClientCreate()
    {
        $user = Auth::user();

        return view('admin.client.create', ['user' => $user,]);
    }

    public function postClientInsert(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make(input::all(), array(
            "name" => "required"
        ));

        if ($validator->passes()) {

            if($user->site_id == 1)
                $new_client = new ClientAr();
            elseif($user->site_id == 2)
                $new_client = new ClientZa();            

            $input = $request->all();

            if (in_array('update_client', $user->permissions())) {

                $new_client->name = $input['name'];
                $new_client->save();

                if($user->site_id == 1)
                    $client = ClientAr::whereNull('deleted_at')->paginate(10);
                elseif($user->site_id == 2)
                    $client = ClientZa::whereNull('deleted_at')->paginate(10);

                return view('admin.client.index', ['user' => $user, 'client' => $client,])->with('success', 'Success! Client has been created.');;
            }

        } else {

            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
    }

    public function getClientUpdate($client_id)
    {
        $user = Auth::user();

        if($user->site_id == 1)
            $client = ClientAr::where('id', $client_id)->first();
        elseif($user->site_id == 2)
            $client = ClientZa::where('id', $client_id)->first();

        return view('admin.client.edit', ['user' => $user, 'client' => $client,]);
    }

    public function postClientUpdate(Request $request, $client_id)
    {
        $user = Auth::user();

        $validator = Validator::make(input::all(), array(
            "name" => "required"
        ));

        if ($validator->passes()) {

            if($user->site_id == 1)
                $client = ClientAr::where('id', $client_id)->first();
            elseif($user->site_id == 2)
                $client = ClientZa::where('id', $client_id)->first();

            $input = $request->all();

            if (in_array('update_client', $user->permissions())) {

                $client->update($input);

                return redirect()->back()->with('success', 'Success! Your team member has been updated.');;
            }

        } else {

            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
    }

    public function postClientDelete($id)
    {
        $user = Auth::user();

        if($user->site_id == 1)
            $client = ClientAr::where('id', $id)->first();
        elseif($user->site_id == 2)
            $client = ClientZa::where('id', $id)->first();

        $date = date('Y-m-d H:i:s');

        if (in_array('delete_client', $user->permissions())) {

            $client->delete();

            return redirect()->back()->with('success', 'Success! Client has been deleted.');

        } else

            return 'You do not have permission to delete this.';
    }


}
