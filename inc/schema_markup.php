<?php
/**
 * Schema.org Structured Data Output
 *
 * Adds JSON-LD structured data to the <head> for:
 * - EducationalOrganization (Global, Front Page)
 * - FAQPage (Conditional, placeholders)
 * - Event (Conditional, placeholders)
 */

function iwasaki_output_schema_json() {
    $schema = [];

    // 1. Organization Schema (Applied to Front Page or Global)
    // Using EducationalOrganization as it is more specific than Organization
    if (is_front_page()) {
        $schema[] = [
            '@context'  => 'https://schema.org',
            '@type'     => 'EducationalOrganization',
            'name'      => '学校法人 岩崎学園',
            'alternateName' => 'Iwasaki Gakuen',
            'url'       => home_url('/'),
            'logo'      => get_stylesheet_directory_uri() . '/img/common/logo_header.svg', // Assuming this path exists
            'foundingDate' => '1927',
            'address'   => [
                '@type' => 'PostalAddress',
                'addressRegion' => '神奈川県',
                'addressLocality' => '横浜市',
                'addressCountry' => 'JP'
            ],
            'sameAs'    => [
                'https://www.iwasaki.ac.jp/', // Main portal
                // Add social profiles here if available
            ],
             'description' => '1927年創立の岩崎学園は、横浜を拠点とする総合教育機関です。7つの専門学校、大学院大学を運営し、幼児教育や文化振興など多岐にわたる事業を展開しています。'
        ];
    }

    // 2. FAQPage Schema (Applied to FAQ pages)
    // Placeholder: Need to identify the specific FAQ page or standard (e.g., is_page('faq'))
    if (is_page('faq') || is_page('qa')) {
        // Example structure. In a real scenario, this would loop through ACF Repeater fields.
        /*
        $schema[] = [
            '@context' => 'https://schema.org',
            '@type'    => 'FAQPage',
            'mainEntity' => [
                [
                    '@type' => 'Question',
                    'name'  => '学費の分割納入は可能ですか？',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text'  => 'はい、可能です。岩崎学園では学費サポートプランをご用意しており、分割納入のご相談も承っております。詳細は学生支援課までお問い合わせください。'
                    ]
                ]
            ]
        ];
        */
    }

    // Output JSON-LD
    if (!empty($schema)) {
        foreach ($schema as $s) {
            echo '<script type="application/ld+json">' . json_encode($s, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";
        }
    }
}
add_action('wp_head', 'iwasaki_output_schema_json');
