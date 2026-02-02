<?php
get_header();
echo "<!-- DEBUG FRONT: id=" . get_the_ID() . " -->";
?>

<?php get_template_part('template-parts/top/kv'); ?>
<?php get_template_part('template-parts/top/banner'); ?>
<?php get_template_part('template-parts/top/info'); ?>
<?php get_template_part('template-parts/top/news'); ?>
<?php get_template_part('template-parts/top/pages'); ?>
<?php get_template_part('template-parts/top/movies'); ?>
<?php get_template_part('template-parts/top/others'); ?>
<?php get_template_part('template-parts/top/team'); ?>
<?php the_content(); ?>
<div style="text-align:center; padding: 20px; background: #eee; margin-top: 50px;">
    <a href="<?php echo home_url('/オープンキャンパスの練習/'); ?>" style="font-weight:bold; color: #d33;">[Dev Only] LP2025
        ページへ移動</a>
</div>

<?php get_footer();
