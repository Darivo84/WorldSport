<!-- NAV BAR -->
<header>
	<nav class="nav_box" id="nav_box">
		<a href="/" class="home_link">
			@if($site_id == 1)
				<img src="/images/header_logo.png">
			@elseif($site_id == 2)
				<img src="/images/logosa-blk.png">
			@endif
		</a>
		<ul class="desktop">
			<li><a href="/about">About us</a></li>
			<li><a href="/major-international-events">Major international events</a></li>
			<li><a href="/destination-festivals">Destination festivals</a></li>
			<li><a href="/brand-experiences">Brand experiences</a></li>
			<li><a href="/portfolio">Portfolio</a></li>
			<li class="second_lvl">
				<a href="javascript:void(0);">Partners</a>
				<ul class="second_lvl_ul">
					<li><a href="/our-partners/brands">Brands</a></li>
					<li><a href="/our-partners/federations">Federations</a></li>
					<li><a href="/our-partners/destinations">Destinations</a></li>
				</ul>
			</li>
			<li><a href="/news">News</a></li>
			<li><a href="/contact-us">Contact</a></li>
		</ul>
		<a href="javascript:void(0);" class="mobile mobile_nav_btn arrow-down tablet"></a>
		<ul class="mobile mobile_nav">
			<li><a href="/about">About us</a></li>
			<li><a href="/major-international-events">Major international events</a></li>
			<li><a href="/destination-festivals">Destination festivals</a></li>
			<li><a href="/brand-experiences">Brand experiences</a></li>
			<li><a href="/portfolio">Portfolio</a></li>
			<li class="second_lvl">
				<a href="javascript:void(0);">Partners</a>
				<ul class="second_lvl_ul">
					<li><a href="/our-partners/brands">Brands</a></li>
					<li><a href="/our-partners/federations">Federations</a></li>
					<li><a href="/our-partners/destinations">Destinations</a></li>
				</ul>
			</li>
			<li><a href="/news">News</a></li>
			<li><a href="/contact-us">Contact</a></li>
		</ul>
	</nav>

	<script>
		$(document).ready(function() {
			$('.mobile_nav_btn').on('click', function(){
				if($(this).hasClass('arrow-down'))
					$(this).removeClass('arrow-down').addClass('arrow-up');
				else
					$(this).removeClass('arrow-up').addClass('arrow-down');

				$('.mobile_nav').toggle();
			});
		});
	</script>
</header>