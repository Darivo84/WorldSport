<!-- FOOTER -->
<footer class="footer">
    <h1 class="heading_white">Contact</h1>

    {{--	<ul class="footer_social">
            <li>
                @if(isset($contact_info->facebook_url) && !empty($contact_info->facebook_url))
                <a href="{{ $contact_info->facebook_url }}" target="_blank">
                @else
                <a href="javascript:void(0);" target="_blank">
                @endif
                    <span class="fa-stack fa-lg">
                        <i class="fa fa-square fa-stack-2x" style="color:#fff;"></i>
                        <i class="fa fa-facebook-square fa-stack-1x" aria-hidden="true"></i>
                    </span>
                </a>
            </li>
            <li>
                @if(isset($contact_info->linked_in_url) && !empty($contact_info->linked_in_url))
                <a href="{{ $contact_info->linked_in_url }}" target="_blank">
                @else
                <a href="javascript:void(0);" target="_blank">
                @endif
                    <span class="fa-stack fa-lg">
                        <i class="fa fa-square fa-stack-2x" style="color:#fff;"></i>
                        <i class="fa fa-linkedin-square fa-stack-1x" aria-hidden="true"></i>
                    </span>
                </a>
            </li>
            <!-- <li>
                <span class="fa-stack fa-lg">
                    <i class="fa fa-square fa-stack-2x" style="color:#fff;"></i>
                    <i class="fa fa-google-plus-square fa-stack-1x" aria-hidden="true"></i>
                </span>
            </li> -->
        </ul>--}}

    <div class="footer_address">

        @if(isset($contact_info->tel) && !empty($contact_info->tel))
            <span>M: <a href="{{ "tel: " .  $contact_info->tel  }}">{{ $contact_info->tel }}</a> </span>
        @endif

      {{--  @if(isset($contact_info->email) && !empty($contact_info->email))
            <span>E: <a href="mailto:{{ $contact_info->email }}">{{ $contact_info->email }}</a></span>
        @endif--}}

        @if(isset($contact_info->address) && !empty($contact_info->address))
            <p>{{ $contact_info->address }}</p>
        @endif
    </div>

    <div class="footer_nav">
        <ul class="clearfix">
            <li><a href="/about">About Us</a></li>
            <li><a href="/major-international-events">Major International Events</a></li>
            <li><a href="/destination-festivals">Destination Festivals</a></li>
            <li><a href="/brand-experiences">Brand Experiences</a></li>
            <li><a href="/portfolio">Portfolio</a></li>
            <li><a href="/our-partners/brands">Partners</a></li>
            <li><a href="/contact-us">Contact us</a></li>
        </ul>
    </div>

    <div class="change_website" >
        <div class="container">
            @if($site_id == 2)
                <a href="http://www.worldsport.ae" target="_blank">Click here to visit <img src="{{asset('images/logo-white.png')}}" alt=""></a>
            @endif

            @if($site_id == 1)
                <a href="http://www.worldsport.co.za" target="_blank">Click here to visit <img src="{{asset('images/logosa.png')}}"
                                                                                                 alt=""></a>
            @endif
            <div class="powered_by" style="color: #c7c7c7; float: right;"  >
                Powered by <a href="http://www.optimalonline.co.za" target="_blank">Optimal Online</a>
            </div>
        </div>
    </div>
</footer>

@if($site_id == 1)
  <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-99791367-1', 'auto');
  ga('send', 'pageview');

</script>
@endif

@if($site_id == 2)
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

 ga('create', 'UA-101124979-1', 'auto');
  ga('send', 'pageview');
</script>
@endif
