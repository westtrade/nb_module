<?php

/**
 * @file
 * Page callbacks for the taxonomy module.
 */

/**
 * Menu callback; displays all nodes associated with a term.
 *
 * @param $term
 *   The taxonomy term.
 * @return
 *   The page content.
 */

function nbmod_term_page($term) {

	$term = i18n_taxonomy_localize_terms($term);

	// Assign the term name as the page title.

	// Build breadcrumb based on the hierarchy of the term.
	$current = (object) array(
		'tid' => $term->tid,
	);

	// dpm($term);

	$voc = taxonomy_vocabulary_load($term->vid);



	if($voc->machine_name === 'cases') {

		$wrapper = entity_metadata_wrapper('taxonomy_term', $term);

		// dpm();

		$title = $wrapper->field_full_title->value();
		drupal_set_title( !empty( $title ) ? $title : $term->name );

		$breadcrumbs = drupal_get_breadcrumb();
		$breadcrumbs[] = drupal_get_title();
		drupal_set_breadcrumb($breadcrumbs);





	} else {

		// @todo This overrides any other possible breadcrumb and is a pure hard-coded
		//   presumption. Make this behavior configurable per vocabulary or term.

	drupal_set_title($term->name);

		$breadcrumb = array();


		while ($parents = taxonomy_get_parents($current->tid)) {
			$parents = i18n_taxonomy_localize_terms($parents);
			$current = array_shift($parents);
			$breadcrumb[] = l($current->name, 'taxonomy/term/' . $current->tid);
		}

		$breadcrumb[] = l(t('Home'), NULL);
		$breadcrumb = array_reverse($breadcrumb);
		drupal_set_breadcrumb($breadcrumb);
		drupal_add_feed('taxonomy/term/' . $term->tid . '/feed', 'RSS - ' . $term->name);		
	}




	return taxonomy_term_view($term, 'full');


	// $build = array();

	// $build['term_heading'] = array(
	//   '#prefix' => '<div class="term-listing-heading">',
	//   '#suffix' => '</div>',
	//   'term' => taxonomy_term_view($term, 'full'),
	// );

	
	/*

	$build['term_heading'] = array(
		'#prefix' => '<div class="term-listing-heading">',
		'#suffix' => '</div>',
		'term' => taxonomy_term_view($term, 'full'),
	);

	
	
	
		if ($nids = taxonomy_select_nodes($term->tid, TRUE, variable_get('default_nodes_main', 10))) {
			$nodes = node_load_multiple($nids);
			$build += node_view_multiple($nodes);
			$build['pager'] = array(    
				'#theme' => 'pager',
				'#weight' => 5,
			);
		}
		else {
			$build['no_content'] = array(
				'#prefix' => '<p>',
				'#markup' => t('There is currently no content classified with this term.'),
				'#suffix' => '</p>',
			);
		}

	*/



	// return $build;
}