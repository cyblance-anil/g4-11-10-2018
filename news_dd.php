<?php
$values = array(''=>'All');
$categories = get_categories();
foreach ($categories as $category) {
	$values[$category->term_id] = $category->name;
}

$ABdevDND_shortcodes['news_dd'] = array(
	'attributes' => array(
		'type' => array(
			'type' => 'select',
			'values' => $values,
			'description' => __('Category', 'dnd-shortcodes'),
		),
	),
	'description' => __('News', 'dnd-shortcodes' )
);
function ABdevDND_news_dd_shortcode( $attributes, $content = null ) {	
	extract(shortcode_atts(ABdevDND_extract_attributes('news_dd'), $attributes));
	return do_shortcode('[g4h_news category_id='.esc_attr($type).']') ;
}
