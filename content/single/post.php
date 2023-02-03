<div class="single-post single-wrap">
  <div class="single-post__inner">
    <h2 class="single-post__heading"><?php the_title();?></h2>
    <span class="single-post__date"><?php the_time('Y.m.j');?></span>
    <?php if(has_post_thumbnail()):?>
      <figure class="single-post__thumb"><img src="<?php echo get_the_post_thumbnail_url('' , 'full');?>" alt="<?php the_title();?>" class="object_fit"></figure>
    <?php endif;?>
    <div class="editor-content">
      <?php the_content();?>
    </div>
  </div>
  <div class="single-post__bottom">
    <h2 class="single-post__bottomTtl">関連記事</h2>
    <div class="single-post__bottomRow">
      <?php
        $categories = get_the_category($post->ID);
        $category_ID = array();
        foreach($categories as $category):
          array_push( $category_ID, $category -> cat_ID);
        endforeach ;
        $args = array( 'post_type' => 'post', 'posts_per_page' => 3 ,'post__not_in' => array($post -> ID), 'category__in' => $category_ID, 'orderby' => 'rand',);
        $the_query = new WP_Query($args); if($the_query->have_posts()): while ($the_query->have_posts()): $the_query->the_post();
        get_template_part('content/loop/post');
        endwhile;else:
        echo '<p style="margin-top: 3em;">まだ記事がありません。</p>';
        endif;?>
    </div>
    <h2 class="single-post__bottomTtl">その他の新着記事</h2>
    <div class="single-post__bottomRow">
      <?php
        $args = array( 'post_type' => 'post', 'posts_per_page' => 3 ,'post__not_in' => array($post -> ID),);
        $the_query = new WP_Query($args); if($the_query->have_posts()): while ($the_query->have_posts()): $the_query->the_post();
        get_template_part('content/loop/post');
        endwhile;else:
        echo '<p style="margin-top: 3em;">まだ記事がありません。</p>';
        endif;?>
    </div>
    <a href="<?php echo home_url('/news/');?>" class="btn__more">一覧に戻る</a>
  </div>
</div>