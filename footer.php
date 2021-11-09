<?php
/**
 * The template for displaying the footer.
 *
 * @package Go
 */

?>

		</main>

		<footer class="wp-block-template-part">
			<?php
			echo do_blocks( file_get_contents( get_stylesheet_directory() . '/go-block-template-parts/footer-01.html' ) );
			?>
		</footer>

	</div>

	<?php wp_footer(); ?>

	</body>
</html>
