<?php
/**
 *
 * The template used for displaying articles & search results
 *
 * @package settimi
 */
$settimi_options = get_theme_mods();

?>
					<article  id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<div class="post-inner-content">

							<div class="post-image">
								<?php if ( has_post_thumbnail() ) : 

										$settimi_thumb_size = array_key_exists('settimi_sidebar_position', $settimi_options) ? $settimi_options['settimi_sidebar_position'] : '';
										$settimi_thumbs_layout = array_key_exists('settimi_thumbs_layout', $settimi_options) ? $settimi_options['settimi_thumbs_layout'] : '';

										if ($settimi_thumbs_layout == "portrait") $settimi_thumbnail = 'settimi-portrait-thumbnail';
										else $settimi_thumbnail = 'settimi-landscape-thumbnail';
										if ($settimi_thumb_size == 'mz-full-width') $settimi_thumbnail = 'settimi-large-thumbnail';

									?>
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
									<?php echo get_the_post_thumbnail( get_the_ID(), $settimi_thumbnail ); ?>
									</a>
								<?php endif; ?>
							</div>
							<div class="post-header">
								<span class="cat"><?php the_category( ' | ' ); ?></span>
								<h2><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
							</div>
							<div class="post-entry">

								<?php the_excerpt(); ?>
								
								<p class="read-more"><a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Continue Reading', 'settimi' ); ?></a></p>
							</div>

						</div><!-- end: post-inner-content -->

					</article>
