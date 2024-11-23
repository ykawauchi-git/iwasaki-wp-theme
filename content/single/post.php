<?php
/**
 * default template.
 */
$pageName = "single-post";
$singleTag = get_the_tags();
$singleCat = get_the_category();
?>
<section class="<?php echo $pageName;?> single-wrap">
	<div class="<?php echo $pageName;?>__inner">
		<h1 class="<?php echo $pageName;?>__ttl"><?php the_title();?></h1>
		<div class="<?php echo $pageName;?>__info">
			<time class="<?php echo $pageName;?>__date"><?php the_time('Y.m.d'); ?></time>
		</div>
    <?php if($singleTag):?>
    <ul class="<?php echo $pageName;?>__tag">
      <?php
      foreach($singleTag as $tag) :
      // $tag_link = get_tag_link($tag->term_id);
      $tag_name = $tag->name;
      ?>
      <li><?php echo $tag_name; ?></li>
      <?php endforeach;?>
    </ul>
    <?php endif;?>
		<div class="<?php echo $pageName;?>__thumb"><?php the_post_thumbnail();?></div>
		<div class="editor-content">
			<?php the_content(); ?>
			<div class="<?php echo $pageName;?>__sns">
				<a class="<?php echo $pageName;?>__snsItem" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" rel="noopener noreferrer">
					<img class="object_fit" src="<?php echo get_stylesheet_directory_uri();?>/img/common/icn_facebook-navy.svg" alt="">
				</a>
				<a class="<?php echo $pageName;?>__snsItem" href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank" rel="noopener noreferrer">
					<img class="object_fit" src="<?php echo get_stylesheet_directory_uri();?>/img/common/icn_twitter-navy.svg" alt="">
				</a>
				<button class="<?php echo $pageName;?>__snsItem" id="copy" data-url="">
					<img class="object_fit" src="<?php echo get_stylesheet_directory_uri();?>/img/common/icn_link-navy.svg" alt="">
				</button>
			</div>
		</div>
	</div>
	<div class="<?php echo $pageName;?>__new">
		<h2 class="page-subHeading"><span>最新記事</span></h2>
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
		<a href="<?php echo home_url('/news/'); ?>" class="btn__more b">一覧へ戻る</a>
	</div>
</section>
