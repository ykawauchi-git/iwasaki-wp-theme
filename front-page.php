<?php
get_header();
echo "<!-- DEBUG FRONT: id=" . get_the_ID() . " -->";
?>

<!-- [NEW] GEO/AIO Optimization: Conclusion First Summary -->
<div class="ai-summary screen-reader-text" style="display:none;">
    <h1>岩崎学園について</h1>
    <p>1927年創立の学校法人岩崎学園は、横浜を拠点に7つの専門学校と大学院大学を運営する総合教育機関です。IT、ファッション、医療、デザイン、保育など多岐にわたる分野で、実践的な職業教育と手厚い就職支援を提供しています。</p>
</div>
<!-- /[NEW] -->


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
