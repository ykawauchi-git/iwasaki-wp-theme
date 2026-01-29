<?php
/**
 * Diagnostic tool to check ACF fields in the database.
 */

// Try to find wp-load.php
$wp_load_path = __DIR__ . '/../../../../wp-load.php';
if (!file_exists($wp_load_path)) {
    // Try another common location if theme is in a subdirectory
    $wp_load_path = __DIR__ . '/../../../wp-load.php';
}

if (file_exists($wp_load_path)) {
    require_once($wp_load_path);
} else {
    die("Could not find wp-load.php at: " . $wp_load_path);
}

header('Content-Type: text/plain');

global $wpdb;

echo "--- DB Connection Test ---\n";
echo "DB Name: " . DB_NAME . "\n";
echo "Prefix: " . $wpdb->prefix . "\n";

echo "\n--- Checking Page 203 Meta ---\n";
$meta = $wpdb->get_results("SELECT meta_key, meta_value FROM {$wpdb->postmeta} WHERE post_id = 203 AND (meta_key LIKE 'top_%' OR meta_key LIKE '_top_%')");
if ($meta) {
    foreach ($meta as $row) {
        echo "{$row->meta_key}: " . substr($row->meta_value, 0, 50) . (strlen($row->meta_value) > 50 ? '...' : '') . "\n";
    }
} else {
    echo "No relevant meta found for ID 203.\n";
}

echo "\n--- Checking Options for top_ ---\n";
$options = $wpdb->get_results("SELECT option_name, option_value FROM {$wpdb->options} WHERE option_name LIKE 'options_top_%' OR option_name LIKE '_options_top_%' LIMIT 20");
if ($options) {
    foreach ($options as $row) {
        echo "{$row->option_name}: " . substr($row->option_value, 0, 50) . (strlen($row->option_value) > 50 ? '...' : '') . "\n";
    }
} else {
    echo "No relevant ACF options found.\n";
}

echo "\n--- Checking ACF Field Groups ---\n";
$groups = $wpdb->get_results("SELECT post_title, post_name FROM {$wpdb->posts} WHERE post_type = 'acf-field-group'");
foreach ($groups as $g) {
    echo "Group: {$g->post_title} ({$g->post_name})\n";
}
