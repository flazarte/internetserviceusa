<?php if ( post_password_required() ) { return; } ?>
<?php if ( have_comments() ) { ?>
	<h3 class="cz_cm_ttl">
		<i class="fa fa-comments mr8"></i>
		<?php comments_number( Codevz_Theme::option( 'no_comment', 'No comment' ), '1 ' . Codevz_Theme::option( 'comment', 'Comment' ), '% ' . Codevz_Theme::option( 'comments', 'Comments' ) ); ?>
	</h3>
	<div id="commentlist-container">
		<ul class="commentlist"><?php wp_list_comments(array('avatar_size' => 40)); ?></ul>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
			<ul class="page-numbers">
				<li><?php previous_comments_link(); ?></li>
				<li><?php next_comments_link(); ?></li>
			</ul>
		<?php } ?>
	</div>
<?php } if ( comments_open() ) {comment_form();} ?>