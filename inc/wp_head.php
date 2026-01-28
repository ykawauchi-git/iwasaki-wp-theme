<?php
function my_output_head_code() {
	if ( function_exists( 'get_field' ) ) {
			// オプションページから生のコードを取得
			$head_code = get_field( 'head_tag', 'option' );
			if ( ! empty( $head_code ) ) {
					// サニタイズやエスケープ処理を行わずそのまま出力
					echo $head_code;
			}
	}
}
add_action( 'wp_head', 'my_output_head_code' );