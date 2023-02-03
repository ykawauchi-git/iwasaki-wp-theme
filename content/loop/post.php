<li class="module__post--item">
  <a href="<?php the_permalink(); ?>" class="module__post--link" id="post-<?php the_ID(); ?>">
    <time class="module__post--date"><?php the_time('Y年n月j日(D)'); ?></time>
    <h2 class="module__post--ttl"><?php the_title(); ?></h2>
  </a>
</li>