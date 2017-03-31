<?php echo l(
	"<i class='fa fa-{$social_type}'></i>",
	empty($link) ? variable_get_value("nbmod_{$social_type}_url") : $link,
	array(
		'attributes' => array('class' => "color_{$social_type} social_link"),
		'html' => true
	)
); ?>
