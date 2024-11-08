<div class="page-contact">
  <div class="page-contact__inner">
    <h1 class="page-contact__heading page-heading"><span>お問い合わせ</span></h1>
    <?php if(have_rows('contact_group')):?>
      <section class="page-contact__anchor">
        <?php
        while(have_rows('contact_group')): the_row();
        $contactHeading = get_sub_field('contact_heading');
        $contactID = get_sub_field('contact_id');
        ?>
        <a href="#<?php echo $contactID;?>"  class="btn__anchor <?php echo $contactID;?>"><?php echo $contactHeading;?></a>
        <?php endwhile;?>
      </section>
    <?php endif;?>

    <?php
    if(have_rows('contact_group')): while(have_rows('contact_group')): the_row();
    $contactHeading = get_sub_field('contact_heading');
    $contactID = get_sub_field('contact_id');
    ?>
    <section id="<?php echo $contactID;?>" class="page-contact__cont <?php if(get_sub_field('contact_select')){ echo 'wide';};?>">
      <?php if($contactID):?>
      <h2 class="page-contact__contTtl page-ttl"><span><?php echo $contactHeading;?></span></h2>
      <?php endif;?>
      <?php if(have_rows('contact_list')):?>
      <ul class="page-contact__list">
        <?php
        while(have_rows('contact_list')): the_row();
        $contactTtl = get_sub_field('contact_ttl');
        $contactTxt = get_sub_field('contact_txt');
        $contactUrl = get_sub_field('contact_url');
        ?>
        <li class="page-contact__item">
          <div class="page-contact__col">
            <?php if($contactTtl):?>
            <h3 class="page-contact__ttl"><?php echo $contactTtl;?></h3>
            <?php endif;?>
            <?php if($contactTxt):?>
            <div class="page-contact__info"><span><?php echo $contactTxt;?></span></div>
            <?php endif;?>
          </div>
          <?php if($contactUrl):?>
          <a href="<?php echo $contactUrl;?>" class="mod-btn w">詳しく見る</a>
          <?php endif;?>
        </li>
        <?php endwhile;?>
      </ul>
      <?php endif;?>
    </section>
    <?php endwhile; endif;?>

  </div>
</div>
