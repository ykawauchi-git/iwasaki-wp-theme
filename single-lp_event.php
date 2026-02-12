<?php get_header(); ?>

<main class="lp-event-single">
  <h1><?php the_title(); ?></h1>

  <p>開催日：<?php the_field('event_date'); ?></p>
  <p>場所：<?php the_field('event_place'); ?></p>
  <p>説明：</p>
  <div><?php the_field('event_desc'); ?></div>

  <?php if(get_field('event_image')): ?>
    <img src="<?php the_field('event_image'); ?>" alt="">
  <?php endif; ?>

  <?php if(get_field('event_link')): ?>
    <p><a href="<?php the_field('event_link'); ?>" target="_blank">詳細を見る</a></p>
  <?php endif; ?>
</main>

<?php get_footer(); ?>
