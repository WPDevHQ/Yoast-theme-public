<?php
/**
 * @author        codeBOX
 * @package       lifterLMS/Templates
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $quiz;
$user_id = get_current_user_id();

$quiz_data    = get_user_meta( $user_id, 'llms_quiz_data', true );
$quiz_session = LLMS()->session->get( 'llms_quiz' );

if ( ! $quiz->get_total_attempts_by_user( $user_id ) ) {
	return;
}

$quiz->is_passing_score( $user_id );
$passing_percent = $quiz->get_passing_percent();

$grade      = $quiz->get_user_grade( $user_id );
$best_grade = $quiz->get_best_grade( $user_id );

$is_passing_score = $quiz->is_passing_score( $user_id );

?>

<div class="clear"></div>
<div class="llms-template-wrapper">
	<div class="llms-quiz-results">
		<h3>Quiz results</h3>

		<?php
		//determine if grade, best grade or none should be shown.
		if ( isset( $grade ) && isset( $best_grade ) ) :

			$graph_grade = empty( $grade ) ? $best_grade : $grade;

			?>
			<input type="hidden" id="llms-grade-value" name="llms_grade" value="<?php echo $graph_grade; ?>"/>
			<div class="llms-progress-circle">
				<svg>
					<g>
						<circle cx="-40" cy="40" r="68" class="llms-background-circle"
						        transform="translate(50,50) rotate(-90)"/>
					</g>
					<g>
						<circle cx="-40" cy="40" r="68" class="llms-animated-circle"
						        transform="translate(50,50) rotate(-90)"/>
					</g>
					<g>
						<circle cx="40" cy="40" r="63" transform="translate(50,50)"/>
					</g>
				</svg>

				<div class="llms-progress-circle-count"><?php printf( __( '%s%%' ), $graph_grade ); ?></div>
			</div>

		<?php endif; ?>
		
		<div class="llms-quiz-result-details">
			
			<ul>
				<li>
					<h5 class="llms-content-block">
						<?php
						if ( $is_passing_score ) {
							_e( apply_filters( 'lifterlms_quiz_passed', 'Passed' ), 'lifterlms' );
						}
						else {
							_e( apply_filters( 'lifterlms_quiz_failed', 'Failed' ), 'lifterlms' );
						}
						?>
					</h5>
					<h6><?php printf( __( '%d / %d correct answers', 'lifterlms' ), $quiz->get_correct_answers_count( $user_id ), $quiz->get_question_count() ); ?></h6>

					<a class="view-summary"><?php _e( 'View Summary', 'lifterlms' ); ?></a>

				</li>
			</ul>

		</div>

	</div>
</div>
