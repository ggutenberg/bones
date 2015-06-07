<?php get_header(); ?>

<div id="content">

	<div id="inner-content" class="wrap cf">

		<main id="main" class="m-all t-all d-all cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

			<h2>Menu</h2>
			<?php
			$args = array(
				'post_type' => 'menu_item'
			);
			query_posts( $args );
			?>
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

					<header class="article-header">

						<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>

					</header> <?php // end article header ?>

					<section class="entry-content cf" itemprop="articleBody">
						<?php
						// the content (pretty self explanatory huh)
						the_content();

						global $post;
						$picture = get_post_meta( $post->ID, '_cmb_menu_item_picture', true );
						$description_en = get_post_meta( $post->ID, '_cmb_menu_item_description_en', true );
						$description_es = get_post_meta( $post->ID, '_cmb_menu_item_description_es', true );
						$price = get_post_meta( $post->ID, '_cmb_menu_item_price', true );

						?>
						<img src="<?php echo $picture; ?>" />
						<p><?php echo $description_en; ?></p>
						<p><?php echo $description_es; ?></p>
						<p><?php echo $price; ?></p>
					</section> <?php // end article section ?>

					<footer class="article-footer cf">

					</footer>

				</article>

			<?php endwhile; endif; ?>

			<h2>Specials</h2>
			<?php
			$args = array(
				'post_type' => 'special'
			);
			query_posts( $args );
			?>
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

					<header class="article-header">

						<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>

					</header> <?php // end article header ?>

					<section class="entry-content cf" itemprop="articleBody">
						<?php
						// the content (pretty self explanatory huh)
						the_content();

						global $post;
						$picture = get_post_meta( $post->ID, '_cmb_special_picture', true );
						$description_en = get_post_meta( $post->ID, '_cmb_special_description_en', true );
						$description_es = get_post_meta( $post->ID, '_cmb_special_description_es', true );
						$price = get_post_meta( $post->ID, '_cmb_special_price', true );

						?>
						<img src="<?php echo $picture; ?>" />
						<p><?php echo $description_en; ?></p>
						<p><?php echo $description_es; ?></p>
						<p><?php echo $price; ?></p>
					</section> <?php // end article section ?>

					<footer class="article-footer cf">

					</footer>

				</article>

			<?php endwhile; endif; ?>

			<?php
			$page = get_page_by_path( 'contact' );
			?>

			<article id="post-<?php echo $page->ID; ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

				<header class="article-header">

					<h1 class="page-title" itemprop="headline"><?php echo $page->post_title; ?></h1>

				</header> <?php // end article header ?>

				<section class="entry-content cf" itemprop="articleBody">
					<?php
					// the content (pretty self explanatory huh)
					echo apply_filters( 'the_content', $page->post_content );

					?>
				</section> <?php // end article section ?>

				<footer class="article-footer cf">

				</footer>

			</article>

		</main>

		<?php //get_sidebar(); ?>

	</div>

</div>

<?php get_footer(); ?>
