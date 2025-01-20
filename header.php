<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<!-- Google Tag Manager 202106 Data Management Project -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-M7DLZK3');</script>
	<!-- End Google Tag Manager -->
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width,initial-scale=1,viewport-fit=cover,user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="icon" href="<?php echo get_stylesheet_directory_uri();?>/img/common/favicon.ico" sizes="any">

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-144028859-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-144028859-1'); 
	</script>

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<!-- Google Tag Manager (noscript) 202106 Data Management Project -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M7DLZK3"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->

	<div id="Wrapper">
		<?php /*
		<!-- ヘッダー -->
		<header class="common-header" id="Header">
			<div class="common-header__inner">
				<!-- *** logo *** -->
				<?php if(is_front_page()): ?>
					<h1 class="common-header__logo">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<img src="<?php echo get_stylesheet_directory_uri();?>/img/common/logo_header.svg" alt="学園法人 岩崎学園">
						</a>
					</h1>
				<?php else: ?>
					<div class="common-header__logo">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<img src="<?php echo get_stylesheet_directory_uri();?>/img/common/logo_header.svg" alt="学園法人 岩崎学園">
						</a>
					</div>
				<?php endif; ?>
				<div class="common-header__toggle">
					<span></span>
					<span></span>
					<span></span>
				</div>

				<nav class="common-header__nav sp">
					<ul class="common-header__menu page">
						<li><a href="<?php echo home_url('/about/'); ?>" class="<?php if(is_page('about')){echo "is-current";}?>">岩崎学園について</a></li>
						<li><a href="<?php echo home_url('/group/');?>" class="<?php if(is_page('group')){echo "is-current";}?>">岩崎学園グループ</a></li>
						<li><a href="<?php echo home_url('/philosophy/'); ?>" class="<?php if(is_page('philosophy')){echo "is-current";}?>">岩崎学園の学び</a></li>
						<li><a href="<?php echo home_url('/support/');?>" class="<?php if(is_page('support')){echo "is-current";}?>">学生支援</a></li>
						<li><a href="<?php echo home_url( '/movie/' ); ?>" class="<?php if(is_page('movie')){echo "is-current";}?>">動画で見る岩崎学園</a></li>
					</ul>
					<ul class="common-header__menu contact">
						<li><a href="<?php echo home_url('/for-parents/'); ?>" class="<?php if(is_page('for-parents')){echo "is-current";}?>">保護者の方</a></li>
						<li><a href="<?php echo home_url('/for-teachers/');?>" class="<?php if(is_page('for-teachers')){echo "is-current";}?>">高校の先生方</a></li>
						<li><a href="<?php echo home_url('/for-recruiters/'); ?>" class="<?php if(is_page('for-recruiters')){echo "is-current";}?>">企業の方</a></li>
						<li><a href="<?php echo home_url('/for-graduates/');?>" class="<?php if(is_page('for-graduates')){echo "is-current";}?>">卒業生の方</a></li>
						<li><a href="<?php echo home_url( '/' ); ?>" target="_blank">教職員採用</a></li>
					</ul>
					<ul class="common-header__menu info">
						<li><a href="<?php echo home_url('/contact/'); ?>" class="contact">お問い合わせ</a></li>
						<li><a href="<?php echo home_url('/document/');?>" class="document">資料請求</a></li>
						<li><a href="<?php echo home_url('/access/'); ?>" class="access">アクセス</a></li>
					</ul>
				</nav>

				<nav class="common-header__nav upper">
					<ul class="common-header__menu contact">
						<li><a href="<?php echo home_url('/for-parents/'); ?>">保護者の方</a></li>
						<li><a href="<?php echo home_url('/for-teachers/');?>">高校の先生方</a></li>
						<li><a href="<?php echo home_url('/for-recruiters/'); ?>">企業の方</a></li>
						<li><a href="<?php echo home_url('/for-graduates/');?>">卒業生の方</a></li>
						<li><a href="https://recruit.iwasaki.ac.jp/" target="_blank">教職員採用</a></li>
					</ul>
					<ul class="common-header__menu info">
						<li><a href="<?php echo home_url('/contact/'); ?>" class="contact">お問い合わせ</a></li>
						<li><a href="<?php echo home_url('/document/');?>" class="document">資料請求</a></li>
						<li><a href="<?php echo home_url('/access/'); ?>" class="access">アクセス</a></li>
					</ul>
				</nav>
				<nav class="common-header__nav lower">
					<ul class="common-header__menu page">
						<li><a href="<?php echo home_url('/about/'); ?>" class="<?php if(is_page('about')){echo "is-current";}?>">岩崎学園について</a></li>
						<li><a href="<?php echo home_url('/group/');?>" class="<?php if(is_page('group')){echo "is-current";}?>">岩崎学園グループ</a></li>
						<li><a href="<?php echo home_url('/philosophy/'); ?>" class="<?php if(is_page('philosophy')){echo "is-current";}?>">岩崎学園の学び</a></li>
						<li><a href="<?php echo home_url('/support/');?>" class="<?php if(is_page('support')){echo "is-current";}?>">学生支援</a></li>
						<li><a href="<?php echo home_url( '/movie/' ); ?>" class="<?php if(is_page('movie')){echo "is-current";}?>">動画で見る岩崎学園</a></li>
					</ul>
				</nav>
			</div>
		</header>
		*/?>
		<header class="common-header">
			<div class="common-header__inner">
				<!-- *** logo *** -->
				<?php if(is_front_page()): ?>
				<h1 class="common-header__logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php get_template_part('template-parts/svg/logo');?></a>
				</h1>
				<?php else: ?>
				<div class="common-header__logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php get_template_part('template-parts/svg/logo');?></a>
				</div>
				<?php endif; ?>
				<div class="common-header__toggle">
					<span></span>
					<span></span>
					<span></span>
				</div>
				<nav class="common-header__menu">
					<ul class="common-header__menuList">
						<li class="<?php if(is_page('about')){echo 'current';}?>"><a href="<?php echo home_url('/about/'); ?>">岩崎学園について</a></li>
						<li class="<?php if(is_page('facilities')){echo 'current';}?>"><a href="<?php echo home_url('/facilities/'); ?>">教育事業</a></li>
						<li class="<?php if(is_page('philosophy')){echo 'current';}?>"><a href="<?php echo home_url('/philosophy/'); ?>">産官学・地域連携</a></li>
						<li class="<?php if(is_post_type_archive('career') || is_singular('career')){echo 'current';}?>"><a href="<?php echo home_url('/career/'); ?>">卒業生の活躍</a></li>
						<li class="<?php if(is_page('support')){echo 'current';}?>"><a href="<?php echo home_url('/support/'); ?>">学生支援</a></li>
					</ul>
					<ul class="common-header__btn tabsp-only--flex">
						<li><a href="<?php echo home_url('/contact/'); ?>" class="contact">お問い合わせ</a></li>
						<li><a href="<?php echo home_url('/access/'); ?>" class="access">アクセス</a></li>
					</ul>
				</nav>
				<ul class="common-header__btn pc-only--flex">
					<li><a href="<?php echo home_url('/contact/'); ?>" class="contact">お問い合わせ</a></li>
					<li><a href="<?php echo home_url('/access/'); ?>" class="access">アクセス</a></li>
				</ul>
			</div>
		</header>
		<!-- ////ヘッダー -->

    <!-- コンテンツ -->
    <main class="common-main">
      <?php get_template_part('template-parts/common/page-title'); ?>
      <?php
			if(!is_front_page()){
				get_template_part('template-parts/common/breadcrumbs');
			}
			?>
