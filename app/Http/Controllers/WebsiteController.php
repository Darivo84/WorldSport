<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use App\AboutUs;
use App\CaseStudy;
use App\CaseStudyGallery;
use App\CaseStudyGalleryPhoto;
use App\CaseStudyPages;
use App\ClientAr;
use App\ClientZa;
use App\Contact;
use App\FeaturesSlider;
use App\HomeSlider;
use App\NewsAr;
use App\NewsZa;
use App\OfferSlider;
use App\Page;
use App\Photo;
use App\Service;
use App\Team;
use Auth;
use Hash;
use Input;
use Mail;
use Validator;
use Redirect;

class WebsiteController extends Controller
{

    public function getHome(Request $request)
    {

        $domain = $this->getDomain($request);

        $site_id = DB::table('sites')->whereNull('deleted_at')->where('url', $domain)->first();
        $site_id = $site_id->site_id;

        $home = HomeSlider::whereNull('deleted_at')->where('site_id', $site_id)->orderBy('created_at')->get();

        $contact_info = Contact::whereNull('deleted_at')->where('site_id', $site_id)->first();

        return view('/pages/home', ['site_id' => $site_id, 'home' => $home, 'contact_info' => $contact_info]);
    }

    public function getAbout(Request $request)
    {

        $domain = $this->getDomain($request);
        $site_id = DB::table('sites')->whereNull('deleted_at')->where('url', $domain)->first();
        $site_id = $site_id->site_id;

        $about = AboutUs::whereNull('deleted_at')->where('site_id', $site_id)->first();

        $contact_info = Contact::whereNull('deleted_at')->where('site_id', $site_id)->first();

        return view('/pages/about', ['site_id' => $site_id, 'about' => $about, 'contact_info' => $contact_info]);
    }

    public function getEventType(Request $request)
    {

        $domain = $this->getDomain($request);
        $site_id = DB::table('sites')->whereNull('deleted_at')->where('url', $domain)->first();
        $site_id = $site_id->site_id;

        $page_url = $request->path();

        $page = Page::whereNull('deleted_at')->where('site_id', $site_id)->where('url', $page_url)->first();
        $features_slider = FeaturesSlider::whereNull('deleted_at')->where('site_id', $site_id)->where('page_id', $page->page_id)->get();
        $offer_slides = OfferSlider::whereNull('deleted_at')->where('site_id', $site_id)->where('page_id', $page->page_id)->get();

        $case_page_ids = CaseStudyPages::whereNull('deleted_at')->where('page_id', $page->page_id)->lists('case_study_id');
        $case_studies = CaseStudy::whereNull('deleted_at')->where('site_id', $site_id)->whereIn('id', $case_page_ids)->get();

        if ($page_url == 'major-international-events')
            $page_class = 'mie';
        elseif ($page_url == 'brand-experiences')
            $page_class = 'brand_ex';
        elseif ($page_url == 'destination-festivals')
            $page_class = 'destination';

        //var_dump($case_studies); exit;

        $contact_info = Contact::whereNull('deleted_at')->where('site_id', $site_id)->first();

        return view('/pages/events_template', ['site_id' => $site_id, 'page' => $page, 'features_slider' => $features_slider, 'offer_slides' => $offer_slides, 'page_class' => $page_class, 'case_studies' => $case_studies, 'contact_info' => $contact_info]);
    }

    public function getPortfolio(Request $request)
    {

        $domain = $this->getDomain($request);
        $site_id = DB::table('sites')->whereNull('deleted_at')->where('url', $domain)->first();
        $site_id = $site_id->site_id;
        $case_studies = CaseStudy::whereNull('deleted_at')->where('site_id', $site_id)->get();

        $page_url = $request->path();

        $page = Page::whereNull('deleted_at')->where('site_id', $site_id)->where('url', $page_url)->first();

        if ($site_id == 1) {
            $clients = ClientAr::whereNull('deleted_at')->get();
        } elseif ($site_id == 2) {
            $clients = ClientZa::whereNull('deleted_at')->get();
        }

        $contact_info = Contact::whereNull('deleted_at')->where('site_id', $site_id)->first();

        return view('/pages/portfolio', ['site_id' => $site_id, 'page' => $page, 'case_studies' => $case_studies, 'clients' => $clients, 'contact_info' => $contact_info]);
    }

    public function getPortfolioSearch(Request $request, $client, $event_type)
    {

        $domain = $this->getDomain($request);
        $site_id = DB::table('sites')->whereNull('deleted_at')->where('url', $domain)->first();
        $site_id = $site_id->site_id;

        $client_cs = CaseStudy::whereNull('deleted_at')->where('site_id', $site_id)->where('client_id', $client)->get();

        $event_cs_id = CaseStudyPages::whereNull('deleted_at')->where('page_id', $event_type)->lists('case_study_id');
        $event_cs = CaseStudy::whereNull('deleted_at')->where('site_id', $site_id)->whereIn('id', $event_cs_id)->get();

        // var_dump($client_cs);
        // var_dump($event_cs_id);
        //var_dump($event_cs);
        // exit;

        $case_studies = array();

        foreach ($client_cs as $key => $value) {
            # code...
            $case_studies[$value->id]['site_id'] = $value->site_id;
            $case_studies[$value->id]['id'] = $value->id;
            $case_studies[$value->id]['client_id'] = $value->client_id;
            $case_studies[$value->id]['title'] = $value->title;
            $case_studies[$value->id]['url'] = $value->url;
            $case_studies[$value->id]['cover_img_url'] = $value->cover_img_url;
            $case_studies[$value->id]['brand_img_url'] = $value->brand_img_url;
            $case_studies[$value->id]['cs_img_url'] = $value->cs_img_url;
            $case_studies[$value->id]['info_img_url'] = $value->info_img_url;
            $case_studies[$value->id]['description'] = strip_tags(substr($value->description, 0, 120));
            $case_studies[$value->id]['width'] = $value->width;
            $case_studies[$value->id]['created_at'] = $value->created_at;
        }

        foreach ($event_cs as $key => $value) {
            # code...
            $case_studies[$value->id]['site_id'] = $value->site_id;
            $case_studies[$value->id]['client_id'] = $value->client_id;
            $case_studies[$value->id]['title'] = $value->title;
            $case_studies[$value->id]['url'] = $value->url;
            $case_studies[$value->id]['cover_img_url'] = $value->cover_img_url;
            $case_studies[$value->id]['cs_img_url'] = $value->cs_img_url;
            $case_studies[$value->id]['brand_img_url'] = $value->brand_img_url;
            $case_studies[$value->id]['info_img_url'] = $value->info_img_url;
            $case_studies[$value->id]['description'] = strip_tags(substr($value->description, 0, 120));
            $case_studies[$value->id]['width'] = $value->width;
            $case_studies[$value->id]['created_at'] = $value->created_at;
        }

        // var_dump($case_studies);
        // exit;

        return $case_studies;
    }

    public function getIndividualPortfolio(Request $request, $id, $title)
    {

        $domain = $this->getDomain($request);
        $site_id = DB::table('sites')->whereNull('deleted_at')->where('url', $domain)->first();
        $site_id = $site_id->site_id;

        $casestudy = CaseStudy::whereNull('deleted_at')->where('site_id', $site_id)->where('id', $id)->first();


        $gallery = CaseStudyGallery::whereNull('deleted_at')->where('site_id', $site_id)->where('case_study_id', $casestudy->id)->first();
        if (isset($gallery))
            $gallery_images = CaseStudyGalleryPhoto::whereNull('deleted_at')->where('gallery_id', $gallery->id)->get();
        else
            $gallery_images = null;

        if ($site_id == 1) {
            $news = NewsAr::whereNull('deleted_at')->where('case_study_id', $casestudy->id)->orderBy('created_at')->take(2)->get();
        } elseif ($site_id == 2) {
            $news = NewsZa::whereNull('deleted_at')->where('case_study_id', $casestudy->id)->orderBy('created_at')->take(2)->get();
        }

        //var_dump($news); exit;

        //$news = null;

        $contact_info = Contact::whereNull('deleted_at')->where('site_id', $site_id)->first();

        return view('/pages/portfolio_template', ['site_id' => $site_id, 'casestudy' => $casestudy, 'gallery_images' => $gallery_images, 'news' => $news, 'contact_info' => $contact_info]);
    }

    public function getPartner(Request $request, $page_url)
    {

        $domain = $this->getDomain($request);
        $site_id = DB::table('sites')->whereNull('deleted_at')->where('url', $domain)->first();
        $site_id = $site_id->site_id;

        //var_dump($page_url); exit;

        $page = Page::whereNull('deleted_at')->where('site_id', $site_id)->where('url', $page_url)->first();

        $case_page_ids = CaseStudyPages::whereNull('deleted_at')->where('page_id', $page->page_id)->lists('case_study_id');
        $case_studies = CaseStudy::whereNull('deleted_at')->where('site_id', $site_id)->whereIn('id', $case_page_ids)->get();

        if ($page_url == 'brands')
            $links = array('federations', 'destinations');
        elseif ($page_url == 'federations')
            $links = array('brands', 'destinations');
        elseif ($page_url == 'destinations')
            $links = array('brands', 'federations');

        $contact_info = Contact::whereNull('deleted_at')->where('site_id', $site_id)->first();

        return view('/pages/partners_template', ['site_id' => $site_id, 'page' => $page, 'case_studies' => $case_studies, 'links' => $links, 'contact_info' => $contact_info]);
    }

    public function getNews(Request $request)
    {

        $domain = $this->getDomain($request);
        $site_id = DB::table('sites')->whereNull('deleted_at')->where('url', $domain)->first();
        $site_id = $site_id->site_id;

        $page_url = $request->path();

        $page = Page::whereNull('deleted_at')->where('site_id', $site_id)->where('url', $page_url)->first();

        if ($site_id == 1) {
            $news = NewsAr::whereNull('deleted_at')->orderBy('date', 'desc')->get();
        } elseif ($site_id == 2) {
            $news = NewsZa::whereNull('deleted_at')->orderBy('date', 'desc')->get();
        }

        $contact_info = Contact::whereNull('deleted_at')->where('site_id', $site_id)->first();

        return view('/pages/news', ['site_id' => $site_id, 'page' => $page, 'news' => $news, 'contact_info' => $contact_info]);
    }

    public function getNewsArticle(Request $request, $news_id, $news_title)
    {
        $domain = $this->getDomain($request);
        $site_id = DB::table('sites')->whereNull('deleted_at')->where('url', $domain)->first();
        $site_id = $site_id->site_id;

        if ($site_id == 1) {
            $news = NewsAr::whereNull('deleted_at')->where('id', $news_id)->first();
            $news_articles = NewsAr::whereNull('deleted_at')->orderBy('date', 'desc')->take(10)->get();
            $next = NewsAr::whereNull('deleted_at')->where('date', '<', $news->date)->where('id', '!=', $news->id)->orderBy('date', 'decs')->first();
            $previous = NewsAr::whereNull('deleted_at')->where('date', '>', $news->date)->first();
        } elseif ($site_id == 2) {
            $news = NewsZa::whereNull('deleted_at')->where('id', $news_id)->first();
            $news_articles = NewsZa::whereNull('deleted_at')->orderBy('date', 'desc')->take(10)->get();
            $next = NewsZa::whereNull('deleted_at')->where('date', '<', $news->date)->orderBy('date', 'decs')->first();
            $previous = NewsZa::whereNull('deleted_at')->where('date', '>', $news->date)->first();
        }

        // var_dump($previous->id);
        // var_dump($news->id);
        // var_dump($next->id);
        // exit;

        $contact_info = Contact::whereNull('deleted_at')->where('site_id', $site_id)->first();

        return view('/pages/news_article', ['site_id' => $site_id, 'news' => $news, 'news_articles' => $news_articles, 'previous' => $previous, 'next' => $next, 'contact_info' => $contact_info]);
    }

    public function getContact(Request $request)
    {

        $domain = $this->getDomain($request);
        $site_id = DB::table('sites')->whereNull('deleted_at')->where('url', $domain)->first();
        $site_id = $site_id->site_id;

        $contact_info = Contact::whereNull('deleted_at')->where('site_id', $site_id)->first();
        $contacts = Team::whereNull('deleted_at')->where('site_id', $site_id)->get();

        return view('/pages/contact', ['site_id' => $site_id, 'contact_info' => $contact_info, 'contacts' => $contacts]);
    }

    protected function getDomain($request)
    {

        if (substr($request->getHost(), 0, 4) === "www.")
            return substr($request->getHost(), 4);
        else
            return $request->getHost();
    }

}