<?php
$secName = "top-team";
$teamHeading = get_field('top_team_heading');
?>
<section class="<?php echo $secName;?>">
  <div class="<?php echo $secName;?>__inner">
    <?php if($teamHeading):?>
    <h2><?php echo $teamHeading;?></h2>
    <?php endif;?>
    <?php if(have_rows('top_team_list')):?>
    <ul class="<?php echo $secName;?>__list">
      <?php
      while(have_rows('top_team_list')): the_row();
      $teamLogo = get_sub_field('top_team_logo');
      $teamUrl = get_sub_field('top_team_url');
      $teamName = get_sub_field('top_team_name');
      ?>
      <li>
        <a href="<?php echo $teamUrl?>" target="_blank">
          <figure><img class="object_fit" src=<?php echo $teamLogo;?>" alt=""></figure>
          <span><?php echo $teamName;?></span>
        </a>
      </li>
      <?php endwhile;?>
    </ul>
    <?php endif;?>
  </div>
</section>