<!-- PRIMARY NAV -->
<div id='cssmenu'>
<ul>
	<li>
        <a href='/dashboard' class="home_dashboard">
            @if($user->site_id == 1)
                <img src="/images/logo-white.png" style="width: 200px;padding: 20px 18px 11px 18px;margin-top: 7px;">
            @elseif($user->site_id == 2)
                <img src="/images/logosa.png" style="width: 200px;padding: 20px 18px 11px 18px;margin-top: 7px;">
            @endif


        </a>
    </li>

    @if(in_array('read_pages',$user->permissions()))
        <li id="pages" class='has-sub'><a href='#'><span>Pages</span></a>
            <ul>
                <li id="home"><a href='{{route('admin_pages_update_home')}}'><span>Home</span></a></li>
                <li id="about"><a href='{{route('admin_about_update')}}'><span>About Us</span></a></li>
                <li id="mie"><a href='{{route('admin_pages', 1)}}'><span>International Events</span></a></li>
                <li id="destination_fes"><a href='{{route('admin_pages', 3)}}'><span>Destination Festivals</span></a></li>
                <li id="brand_exp"><a href='{{route('admin_pages', 2)}}'><span>Brand Experiences</span></a></li>
                <li id="partners" class='has-sub'>
                    <a href='#'>
                        <span>Our Partners</span>
                    </a>
                    <ul>
                        <li id="brands"><a href='{{route('admin_pages', 4)}}'><span>Brands</span></a></li>
                        <li id="federations"><a href='{{route('admin_pages', 5)}}'><span>Federations</span></a></li>
                        <li id="sestinations"><a href='{{route('admin_pages', 6)}}'><span>Destinations</span></a></li>

                    </ul>
                </li>

                <li id="news_page"><a href='{{route('admin_pages', 7)}}'><span>News</span></a></li>
                <li id="portfolio"><a href='{{route('admin_pages', 8)}}'><span>Portfolio</span></a></li>
                <li id="contact_view_all"><a href='{{route('admin_contact')}}'><span>Contact</span></a></li>

            </ul>
        </li>
    @endif

    @if(in_array('read_news',$user->permissions()))
        <li id="news" class='has-sub'><a href='#'><span>News Articles</span></a>
        	<ul>
                <li id="news_view_all"><a href='{{route('admin_news')}}'><span>View All</span></a></li>
                @if(in_array('create_news',$user->permissions()))
                <li id="news_new"><a href='{{route('admin_news_create')}}'><span>Create New</span></a></li>
                @endif
            </ul>
        </li>
    @endif

    @if(in_array('read_case_study',$user->permissions()))
        <li id="case_study" class='has-sub'><a href='#'><span>Case Studies</span></a>
            <ul>
                <li id="case_study_view_all"><a href='{{route('admin_case_studies')}}'><span>View All</span></a></li>
                @if(in_array('create_news',$user->permissions()))
                    <li id="case_study_new"><a href='{{route('admin_case_studies_create')}}'><span>Create New</span></a></li>
                @endif
            </ul>
        </li>
    @endif

    @if(in_array('read_team',$user->permissions()))
        <li id="team" class='has-sub'><a href='#'><span>Team</span></a>
            <ul>
                <li id="team_view_all"><a href='{{route('admin_team')}}'><span>View All</span></a></li>
                @if(in_array('create_team',$user->permissions()))
                    <li id="team_new"><a href='{{route('admin_team_create')}}'><span>Create New</span></a></li>
                @endif
            </ul>
        </li>
    @endif

    @if(in_array('read_client',$user->permissions()))
        <li id="client" class='has-sub'><a href='#'><span>Clients</span></a>
            <ul>
                <li id="client_view_all"><a href='{{route('admin_client')}}'><span>View All</span></a></li>
                @if(in_array('create_team',$user->permissions()))
                    <li id="client_new"><a href='{{route('admin_client_create')}}'><span>Create New</span></a></li>
                @endif
            </ul>
        </li>
    @endif

   {{-- <li id="profile"><a href='/dashboard/profile'><span>Profile</span></a></li>--}}
    <li class='last'><a href='/logout'><span>Logout</span></a></li>
</ul>
</div>