<?php
/**
 * default template.
 */
$pageName = "common-single";
?>
<section class="<?php echo $pageName;?>">
	<div class="<?php echo $pageName;?>__inner">
		<div class="<?php echo $pageName;?>__heading page-heading"><span>NEWS</span></div>
		<h1 class="<?php echo $pageName;?>__ttl"><?php the_title();?></h1>
		<div class="<?php echo $pageName;?>__info">
			<time class="<?php echo $secName;?>__date"><?php the_time('Y.m.d'); ?></time>
		</div>
		<div class="<?php echo $pageName;?>__thumb"><?php the_post_thumbnail();?></div>
		<div class="editor-content">
			<?php the_content(); ?>
			<div class="<?php echo $pageName;?>__sns">
				<a href="" target="_blank">
					<img class="object_fit" src="<?php echo get_stylesheet_directory_uri();?>/img/common/icn_facebook-navy.svg" alt="">
				</a>
				<a href="" target="_blank">
					<img class="object_fit" src="<?php echo get_stylesheet_directory_uri();?>/img/common/icn_twitter-navy.svg" alt="">
				</a>
				<a href="" target="_blank">
					<img class="object_fit" src="<?php echo get_stylesheet_directory_uri();?>/img/common/icn_link-navy.svg" alt="">
				</a>
			</div>
		</div>
	</div>
	<div class="<?php echo $pageName;?>__new">
		<h3 class="page-bracketsTtl"><span>最新記事</span></h3>
		<div class="<?php echo $pageName;?>__new-article">
		<?php
			$args = array(
				'posts_per_page' => 3 // 表示件数の指定
			);
			$posts = get_posts( $args );
			foreach ( $posts as $post ): // ループの開始
			setup_postdata( $post ); // 記事データの取得
		?>
		<?php get_template_part('content/loop/post');?>
		<?php
			endforeach; // ループの終了
			wp_reset_postdata(); // 直前のクエリを復元する
		?>
		</div>
		<a href="<?php echo home_url('/about/career'); ?>" class="page-group__contBtn">一覧へ戻る</a>
	</div>
</section>
