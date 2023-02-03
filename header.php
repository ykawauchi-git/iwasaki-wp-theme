<!doctype html>
<html <?php language_attributes(); ?>>
<head>

	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width,initial-scale=1,viewport-fit=cover,user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div id="Wrapper">

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
						<li><a href="<?php echo home_url('/'); ?>">岩崎学園について</a></li>
						<li><a href="<?php echo home_url('/');?>">岩崎学園グループ</a></li>
						<li><a href="<?php echo home_url('/'); ?>">岩崎学園の学び</a></li>
						<li><a href="<?php echo home_url('/');?>">学生支援</a></li>
						<li><a href="<?php echo home_url( '/' ); ?>">動画で見る岩崎学園</a></li>
					</ul>
					<ul class="common-header__menu contact">
						<li><a href="<?php echo home_url('/'); ?>">保護者の方</a></li>
						<li><a href="<?php echo home_url('/');?>">高校の先生方</a></li>
						<li><a href="<?php echo home_url('/'); ?>">企業の方</a></li>
						<li><a href="<?php echo home_url('/');?>">卒業生の方</a></li>
						<li><a href="<?php echo home_url( '/' ); ?>">教職員採用</a></li>
					</ul>
					<ul class="common-header__menu info">
						<li><a href="<?php echo home_url('/'); ?>" class="contact">お問い合わせ</a></li>
						<li><a href="<?php echo home_url('/');?>" class="document">資料請求</a></li>
						<li><a href="<?php echo home_url('/'); ?>" class="access">アクセス</a></li>
					</ul>
				</nav>

				<nav class="common-header__nav upper">
					<ul class="common-header__menu contact">
						<li><a href="<?php echo home_url('/'); ?>">保護者の方</a></li>
						<li><a href="<?php echo home_url('/');?>">高校の先生方</a></li>
						<li><a href="<?php echo home_url('/'); ?>">企業の方</a></li>
						<li><a href="<?php echo home_url('/');?>">卒業生の方</a></li>
						<li><a href="<?php echo home_url( '/' ); ?>">教職員採用</a></li>
					</ul>
					<ul class="common-header__menu info">
						<li><a href="<?php echo home_url('/'); ?>" class="contact">お問い合わせ</a></li>
						<li><a href="<?php echo home_url('/');?>" class="document">資料請求</a></li>
						<li><a href="<?php echo home_url('/'); ?>" class="access">アクセス</a></li>
					</ul>
				</nav>
				<nav class="common-header__nav lower">
					<ul class="common-header__menu page">
						<li><a href="<?php echo home_url('/'); ?>">岩崎学園について</a></li>
						<li><a href="<?php echo home_url('/');?>">岩崎学園グループ</a></li>
						<li><a href="<?php echo home_url('/'); ?>">岩崎学園の学び</a></li>
						<li><a href="<?php echo home_url('/');?>">学生支援</a></li>
						<li><a href="<?php echo home_url( '/' ); ?>">動画で見る岩崎学園</a></li>
					</ul>
				</nav>
			</div>
		</header>
		<!-- ////ヘッダー -->

    <!-- コンテンツ -->
    <main class="common-main">
      <?php get_template_part('template-parts/common/page-title'); ?>
      <?php
			//パンくず
			if(!is_front_page()){
				get_template_part('template-parts/common/breadcrumbs');
			}?>
