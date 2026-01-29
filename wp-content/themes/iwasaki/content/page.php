<?php
/**
 * default template.
 */
?>

<!-- <div class="editor-content"> -->
	<?php
		remove_filter('the_content', 'wpautop'); // 自動<p>タグ挿入を無効化
		the_content();
		add_filter('the_content', 'wpautop');
	?>
<!-- </div> -->