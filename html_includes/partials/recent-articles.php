<?php
namespace Yoast\YoastCom\Theme;

if ( ! isset( $template_args['class1'] ) ) {
	$template_args['class1'] = '';
}

if ( ! isset( $template_args['class2'] ) ) {
	$template_args['class2'] = '';
}

$must_read = isset( $template_args['must_read'] ) && $template_args['must_read'];
$args      = array( 'posts_per_page' => 3, 'post__not_in' => array( get_the_ID() ) );

if ( $must_read ) {
	if ( is_category() ) {
		$args['category__in'] = get_queried_object_id();
	}
	$posts_query = query_must_read_articles( $args );
}
else {
	$posts_query = new \WP_Query( $args );
}
?>
<div class="grid">
	<?php
		theme_object()->excerpt->length( 8 );
		theme_object()->excerpt->more( ' &hellip; &raquo;' );
	?>
	<?php while ( $posts_query->have_posts() ) : $posts_query->the_post(); ?>
		<div class="one-third">
			<div class="promoblock <?php echo esc_attr( $template_args['class1'] ); ?>">
				<a href="<?php the_permalink(); ?>" class="hide-on-tablet">
					<?php the_post_thumbnail( 'thumbnail-recent-articles' ); ?>
				</a>
				<h3 class="h4"><a href="<?php the_permalink(); ?>" class="<?php echo esc_attr( $template_args['class2'] ); ?>"><?php the_title(); ?></a></h3>
				<?php the_excerpt(); ?>
			</div>
		</div>
	<?php endwhile; wp_reset_postdata(); theme_object()->excerpt->clear(); ?>
</div>
