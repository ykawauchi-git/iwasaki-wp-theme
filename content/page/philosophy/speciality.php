<?php $pageName="page-speciality";?>
<section class="<?php echo $pageName;?>">
  <!-- 岩崎学園の専門教育 -->
  <div class="<?php echo $pageName;?>__education">
    <h2 class="<?php echo $pageName;?>__education-heading page-heading"><span>岩崎学園の専門教育</span></h2>
    <div class="<?php echo $pageName;?>__intro">
      文章が入ります、文章が入ります。文章が入ります、文章が入ります。文章が入ります、文章が入ります。文章が入ります。文章が入ります、文章が入ります。文章が入ります、文章が入ります。文章が入ります、文章が入ります。文章が入ります、文章が入ります。文章が入ります、文章が入ります。文章が入ります、文章が入ります。
    </div>
  </div>
  <!-- 専門教育3つの特徴 -->
  <div class="<?php echo $pageName;?>__feature">
    <h3 class="page-bracketsTtl"><span>専門教育3つの特徴</span></h3>
    <ul class="<?php echo $pageName;?>__feature-list">
      <!-- 01 -->
      <li class="<?php echo $pageName;?>__feature-item">
        <div class="<?php echo $pageName;?>__feature-inner">
          <div class="<?php echo $pageName;?>__feature-num">1</div>
          <div class="<?php echo $pageName;?>__feature-ttl">質の高い授業と<br>効果的な資格取得</div>
          <a href="#speciality01" class="page-group__contBtn">詳しく見る</a>
        </div>
      </li>
      <!-- 02 -->
      <li class="<?php echo $pageName;?>__feature-item">
        <div class="<?php echo $pageName;?>__feature-inner">
          <div class="<?php echo $pageName;?>__feature-num">2</div>
          <div class="<?php echo $pageName;?>__feature-ttl">実践的な技術・<br>スキルが身につく</div>
          <a href="#speciality02" class="page-group__contBtn">詳しく見る</a>
        </div>
      </li>
      <!-- 03 -->
      <li class="<?php echo $pageName;?>__feature-item">
        <div class="<?php echo $pageName;?>__feature-inner">
          <div class="<?php echo $pageName;?>__feature-num">3</div>
          <div class="<?php echo $pageName;?>__feature-ttl">基礎学力が身につく</div>
          <a href="#speciality03" class="page-group__contBtn">詳しく見る</a>
        </div>
      </li>
    </ul>
  </div>
  <!-- 3STEP -->
  <div class="<?php echo $pageName;?>__step">
    <ul class="<?php echo $pageName;?>__step-list">
      <!-- 01 -->
      <li id="speciality01" class="<?php echo $pageName;?>__step-item">
        <div class="<?php echo $pageName;?>__step-bg"></div>
        <div class="<?php echo $pageName;?>__step-inner">
          <div class="<?php echo $pageName;?>__step-heading">
            <div class="<?php echo $pageName;?>__step-heading-num">1</div>
            <div class="<?php echo $pageName;?>__step-heading-ttl">質の高い授業と<br>効果的な資格取得</div>
          </div>
          <?php if(have_rows('acf_speciality01_group')):?>
          <ul class="<?php echo $pageName;?>__step-subList">
          <!-- 001 -->
            <?php while(have_rows('acf_speciality01_group')): the_row(); ?>
            <li class="<?php echo $pageName;?>__step-subItem">
              <div class="<?php echo $pageName;?>__step-ttl"><?php the_sub_field('acf_speciality01_ttl');?></div>
              <div class="<?php echo $pageName;?>__step-container">
                <?php if(get_sub_field('acf_speciality01_img')):?>
                <div class="<?php echo $pageName;?>__step-left">
                  <img class="object_fit" src="<?php the_sub_field('acf_speciality01_img');?>">
                </div>
                <?php endif;?>
                <div class="<?php echo $pageName;?>__step-right"><?php the_sub_field('acf_speciality01_txt');?></div>
              </div>
            </li>
            <?php endwhile;?>
          </ul>
          <?php endif;?>
        </div>
      </li>
      <!-- 02 -->
      <li id="speciality02" class="<?php echo $pageName;?>__step-item">
        <div class="<?php echo $pageName;?>__step-bg"></div>
        <div class="<?php echo $pageName;?>__step-inner">
          <div class="<?php echo $pageName;?>__step-heading">
            <div class="<?php echo $pageName;?>__step-heading-num">2</div>
            <div class="<?php echo $pageName;?>__step-heading-ttl">実践的な技術・<br>スキルが身につく</div>
          </div>
          <?php if(have_rows('acf_speciality02_group')):?>
          <ul class="<?php echo $pageName;?>__step-subList">
            <?php while(have_rows('acf_speciality02_group')): the_row(); ?>
          <!-- 001 -->
            <li class="<?php echo $pageName;?>__step-subItem">
              <div class="<?php echo $pageName;?>__step-ttl"><?php the_sub_field('acf_speciality02_ttl');?></div>
              <div class="<?php echo $pageName;?>__step-container">
                <?php if(get_sub_field('acf_speciality02_img')):?>
                <div class="<?php echo $pageName;?>__step-left">
                  <img class="object_fit" src="<?php the_sub_field('acf_speciality02_img');?>">
                </div>
                <?php endif;?>
                <div class="<?php echo $pageName;?>__step-right"><?php the_sub_field('acf_speciality02_txt');?></div>
              </div>
            </li>
            <?php endwhile;?>
          </ul>
          <?php endif;?>
        </div>
      </li>
      <!-- 03 -->
      <li id="speciality03" class="<?php echo $pageName;?>__step-item">
        <div class="<?php echo $pageName;?>__step-bg"></div>
        <div class="<?php echo $pageName;?>__step-inner">
          <div class="<?php echo $pageName;?>__step-heading">
            <div class="<?php echo $pageName;?>__step-heading-num">3</div>
            <div class="<?php echo $pageName;?>__step-heading-ttl">基礎学力が<br>身につく</div>
          </div>
          <?php if(have_rows('acf_speciality03_group')):?>
          <ul class="<?php echo $pageName;?>__step-subList">
            <?php while(have_rows('acf_speciality03_group')): the_row(); ?>
            <!-- 001 -->
            <li class="<?php echo $pageName;?>__step-subItem">
              <div class="<?php echo $pageName;?>__step-ttl"><?php the_sub_field('acf_speciality03_ttl');?></div>
              <div class="<?php echo $pageName;?>__step-container">
                <?php if(get_sub_field('acf_speciality03_img')):?>
                <div class="<?php echo $pageName;?>__step-left">
                  <img class="object_fit" src="<?php the_sub_field('acf_speciality03_img');?>">
                </div>
                <?php endif;?>
                <div class="<?php echo $pageName;?>__step-right"><?php the_sub_field('acf_speciality03_txt');?></div>
              </div>
            </li>
            <?php endwhile;?>
          </ul>
          <?php endif;?>
        </div>
      </li>
    </ul>
  </div>
  <div class="mod-banner">
    <div class="mod-banner__ttl"><span>未来を生き抜く力を育む<br>開拓力を磨く</span></div>
    <a href="<?php echo home_url('/philosophy/pioneer'); ?>" class="page-group__contBtn">詳しく見る</a>
  </div>
</section>