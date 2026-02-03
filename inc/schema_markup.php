<?php
/**
 * Schema.org Structured Data Output
 *
 * Adds JSON-LD structured data to the <head> for:
 * - EducationalOrganization (Global, Front Page)
 * - FAQPage (Conditional, placeholders)
 * - Event (Conditional, placeholders)
 */

function iwasaki_output_schema_json()
{
    $schema = [];

    // 1. Organization Schema (Applied to Front Page or Global)
    // Using EducationalOrganization as it is more specific than Organization
    if (is_front_page()) {
        $schema[] = [
            '@context' => 'https://schema.org',
            '@type' => 'EducationalOrganization',
            'name' => '学校法人 岩崎学園',
            'alternateName' => 'Iwasaki Gakuen',
            'url' => home_url('/'),
            'logo' => get_stylesheet_directory_uri() . '/img/common/logo_header.svg', // Assuming this path exists
            'foundingDate' => '1927',
            'address' => [
                '@type' => 'PostalAddress',
                'addressRegion' => '神奈川県',
                'addressLocality' => '横浜市',
                'addressCountry' => 'JP'
            ],
            'sameAs' => [
                'https://www.iwasaki.ac.jp/', // Main portal
                // Add social profiles here if available
            ],
            'description' => '1927年創立の岩崎学園は、横浜を拠点とする総合教育機関です。7つの専門学校、大学院大学を運営し、幼児教育や文化振興など多岐にわたる事業を展開しています。'
        ];
    }

    // 2. FAQPage Schema (Applied to About Page)
    if (is_page('about') || is_page('page-about')) {
        $schema[] = [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => [
                [
                    '@type' => 'Question',
                    'name' => '岩崎学園の特徴は何ですか？',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => 'IT、ファッション、医療、デザイン、保育など7つの専門分野を持つ専門学校と、情報セキュリティ大学院大学を運営する総合教育機関です。横浜を拠点に、実践的な教育と強力な産学連携を行っています。'
                    ]
                ],
                [
                    '@type' => 'Question',
                    'name' => 'どのような学生支援がありますか？',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => '独自の奨学金制度、PC無償貸与、学生寮（東白楽寮）、キャリアカウンセラーによる就職サポートなど、手厚い支援体制を整えています。'
                    ]
                ],
                [
                    '@type' => 'Question',
                    'name' => 'オープンキャンパスは開催されていますか？',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => 'はい、各校で定期的にオープンキャンパスや学校説明会を開催しています。詳細は公式サイトのイベント情報をご確認ください。'
                    ]
                ]
            ]
        ];
    }

    // Output JSON-LD
    if (!empty($schema)) {
        foreach ($schema as $s) {
            echo '<script type="application/ld+json">' . json_encode($s, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";
        }
    }
}
add_action('wp_head', 'iwasaki_output_schema_json');
