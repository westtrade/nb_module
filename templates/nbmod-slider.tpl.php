<div class="clearfix"></div>

<div id="<?php echo $slider_id ?>" class="carousel slide carousel-fade " data-ride="carousel">

	<?php if( count( $slides ) > 1 ) : ?>

		<ol class="carousel-indicators">
			<?php for($i = 0; $i < count($slides); $i++) : ?>
				<li data-target="#<?php echo $slider_id; ?>" data-slide-to="<?php echo $i ?>"  <?php if(!$i): echo 'class="active"'; endif; ?>></li>
			<?php endfor; ?>
		</ol>

	<?php endif; ?>
	


	<?php if(!empty($video)) : ?>
	
		<div class="video ">
			<div class="container">
				<div class="row">
					<div class="col-md-5 col-md-offset-7">	
						<?php echo $video; ?>
					</div>
				</div>
			</div>
		</div>

	<?php endif; ?>


	
	<?php if(!empty($slides) ) : ?>

		<?php $first_item = true ?>

		<div class="carousel-inner">	
			<?php foreach($slides as $i => $slide) : ?>
				<div class="item <?php if($first_item): echo ' active'; $first_item = false; endif; ?>">	

			
				<?php  if( is_object($slide) ) : ?>

						<?php 
							$href = field_get_items('node', $slide, 'field_href');
							// $output = field_view_value('node', $slide, 'field_href', $field_href[0]);

							/* Render responsive image */
							$image = field_get_items('node', $slide, 'field_slide_photo');

							if(!empty($image)) {

								$view =  field_view_value(
									'node', $slide, 'field_slide_photo', $image[0], 
									array(
										'type' => 'image',
										'settings' => array(
											'image_style' => 'slider_image',
										),
									)
								);	

								$image = render($view);


								echo !empty($href) ? l( $image, $href[0]['safe_value'], array( 'html' => TRUE, 'attributes' => array( 'class' => 'slider_image' ) ) ) : $image;

							}	

						?>

						<div class="carousel-caption">
							

							<div class="container">

								<div class="col-md-10 col-md-offset-1<?php if( user_access('access contextual links') ): ?> contextual-links-region <?php endif; ?>">

									<?php

				    					$links = _clinks_get_renderable_array(
				    						array(
					    						'node' => array('node', array($slide->nid))
					    					)
				    					);

										echo  render($links);

									?>


									<div class="title">

										<?php 

											$title = mb_strtoupper($slide->title);

											echo !empty($href) ? 
												l( mb_strtoupper($title) , $href[0]['safe_value'], array( 'html' => TRUE ) ) 
												: mb_strtoupper($title);

										?>										
									</div>
									<div class="caption">

										<?php
											$caption = field_view_field('node', $slide, 'body', array( 'label' => 'hidden'));
											$caption = render($caption);

											echo !empty($href) ? l( $caption , $href[0]['safe_value'], array( 'html' => TRUE ) ) : $caption;
										?>

									</div>	

								</div>

							</div>
						</div> 

					
				<?php endif; ?>


				</div>
			<?php endforeach; ?>
		</div>

	<?php endif; ?>
	

	<?php if(count($slides) > 1 ) : ?>
	
		<div class="controls">
			<div class="container">
				<div class="row">
					<div class="col-md-1 col-xs-2">


						<a class="left carousel-control" href="#<?php echo $slider_id ?>" role="button" data-slide="prev">
							<i class="icon-leftarrow"></i>
						</a>

					</div>
					<div class="col-md-1 col-xs-2 col-xs-offset-10">	

						<a class="right carousel-control" href="#<?php echo $slider_id ?>" role="button" data-slide="next">
							<i class="icon-rightarrow"></i>
						</a>

					</div>
				</div>
			</div>
		</div>

	<?php endif; ?>


</div>
