<?php $pageName = "archive-career";?>

<div class="<?php echo $pageName;?> archive-wrap">
  <h1 class="<?php echo $pageName;?>__heading page-heading"><span>学園の卒業生・就職実績</span></h1>
  <div class="<?php echo $pageName;?>__intro">
  <?php echo get_field('career_intro','option');?>
  </div>
  <div class="<?php echo $pageName;?>__inner">
    <?php if(get_field('career_archive','option')):
      remove_filter ('acf_the_content', 'wpautop');
      the_field("career_archive", 'option');
      elseif (have_posts()) : while (have_posts()) : the_post(); ?>
      <?php get_template_part('content/loop/career');?>
    <?php endwhile; endif;?>
  </div>
  <?php if(have_rows('career_employment', 'option')):?>
  <div class="<?php echo $pageName;?>__employment">
    <h2>就職実績（一部抜粋）</h2>
    <ul class="<?php echo $pageName;?>__employmentGroup">
      <?php
      while(have_rows('career_employment', 'option')): the_row();
      $employmentField = get_sub_field('career_employment_field');
      ?>
      <li>
        <?php if($employmentField):?>
        <h3><?php echo $employmentField;?></h3>
        <?php endif;?>
        <?php if(have_rows('career_employment_list', 'option')):?>
        <ul class="<?php echo $pageName;?>__employmentList">
          <?php
          while(have_rows('career_employment_list', 'option')): the_row();
          $employmentCompanyName = get_sub_field('career_employment_company_name');
          if($employmentCompanyName):
          ?>
          <li><span>・</span><?php echo $employmentCompanyName;?></li>
          <?php endif; endwhile;?>
        </ul>
        <?php endif;?>
      </li>
      <?php endwhile;?>
    </ul>
  </div>
  <?php endif; reset_rows();?>
  <div class="mod-banner">
    <?php
      $ctaHeading = get_field('cta_heading', 'option');
      $ctaTxt = get_field('cta_txt', 'option');
    ?>
    <?php if($ctaHeading):?>
    <div class="mod-banner__ttl"><span><?php echo $ctaHeading;?></span></div>
    <?php endif;?>
    <?php if($ctaTxt):?>
    <div class="mod-banner__txt">
    <?php echo $ctaTxt;?>
    </div>
    <?php endif;?>
    <?php if(have_rows('cta_btn', 'option')):?>
    <div class="mod-banner__btn">
      <?php
      while(have_rows('cta_btn', 'option')): the_row();
      $ctaBtn = get_sub_field('cta_btn_item','option');
      ?>
      <a href="<?php echo $ctaBtn['url'];?>" target="<?php echo $ctaBtn['target'];?>" class="mod-btn b"><?php echo $ctaBtn['title'];?></a>
      <?php endwhile;?>
    </div>
    <?php endif;?>
  </div>
</div>