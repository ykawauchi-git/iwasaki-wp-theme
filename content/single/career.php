<?php
$pageName = "single-career";
$careerTtl = get_the_title();
$graduateInfo = get_field('career_graduate_info');
$graduateAlma = $graduateInfo['career_graduate_alma_mater'];
?>
<section class="<?php echo $pageName;?> single-wrap">
  <div class="<?php echo $pageName;?>__info">
    <?php if($careerTtl):?>
    <h1 class="<?php echo $pageName;?>__infoHeading"><?php echo $careerTtl;?></h1>
    <?php endif;?>
    <div class="<?php echo $pageName;?>__infoThumb">
      <?php if ( has_post_thumbnail() ): ?>
        <?php echo get_the_post_thumbnail($post->ID,'full', array('class' => 'object_fit')); ?>
      <?php endif; ?>
    </div>
  </div>
  <div class="<?php echo $pageName;?>__editor">
    <?php the_content();?>
  </div>
  <!-- 他の卒業生たち -->
  <div class="<?php echo $pageName;?>__other">
    <h2 class="page-subHeading"><span>他の卒業生たち</span></h2>
    <ul class="<?php echo $pageName;?>__otherList">
      <?php /*
      $args = array(
        'post_type' => 'career',
        'posts_per_page' => 2,
        'orderby' => 'rand',
        'post__not_in' => array($post -> ID),
      );
      $career_query = new WP_Query($args); if($career_query->have_posts()): while ($career_query->have_posts()): $career_query->the_post();
      get_template_part('content/loop/career');
      endwhile;else:
      echo '<p style="margin-top: 3em;">まだ記事がありません。</p>';
      endif;
      */?>
      <?php if(get_field('career_archive','option')):
        remove_filter ('acf_the_content', 'wpautop');
        the_field("career_archive", 'option');
        elseif (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php get_template_part('content/loop/career');?>
      <?php endwhile; endif;?>
    </ul>
    <a class="btn__more b" href="<?php echo home_url('/career/');?>">一覧へ戻る</a>
  </div>
</section>