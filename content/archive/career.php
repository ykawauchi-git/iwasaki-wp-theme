<?php $pageName = "archive-career";?>

<div class="<?php echo $pageName;?> archive-wrap">
  <h1 class="<?php echo $pageName;?>__heading page-heading"><span>学園の卒業生・就職実績</span></h1>
  <div class="<?php echo $pageName;?>__intro">
  岩崎学園は90年以上にわたり、どのような未来にも自分らしく活躍できる、個性ある卒業生を社会に送り出しています。
  </div>
  <div class="<?php echo $pageName;?>__inner">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
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
  <?php endif;?>
  <div class="mod-banner">
    <div class="mod-banner__ttl"><span>求人申し込みはこちら</span></div>
    <div class="mod-banner__txt">
      岩崎学園では、共に変化を楽しみ<br class="pctab-only">教育サービスを提供しつづけることができる​方を募集しています。
    </div>
    <a href="<?php echo home_url('/facility'); ?>" class="mod-btn b">詳しく見る</a>
  </div>
</div>