<?php
/**
 * The template for displaying page STORE
 */

use TMC_MiniCatalog\PostTypeEnum;

get_header();
?>
<?php
global $wp_query;
$temp       = $wp_query;
$wp_query   = null;

$post_status = 'publish';
$post_type = PostTypeEnum::CUSTOM_POST_TYPE;

$wp_query = new WP_Query(
    'post_type='        . $post_type        . '&' .
    'post_status='      . $post_status      . '&' .
    'posts_per_page=10'                     . '&' .
    'no_found_rows=true'                    . '&' .
    'order=DESC'
);
?>
<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <article>
            <header class="entry-header">
                <h3 style="padding-left: 40px;">Below is a list of product(s)</h3>
            </header>
        </article>
        <?php
        while ( have_posts() ) :
            the_post();
            $postmeta_values = get_post_meta(get_the_ID());
        ?>
            <?php if ($postmeta_values !== false):?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                <?php
                    $title      = get_the_title(get_the_ID());
                    $title_url  = get_permalink(get_the_ID())
                ?>
                    <h4><a href="<?php echo $title_url?>"><?php echo $title?></a></h4>
                </header>

                <div class="entry-content">
                    <?php if (esc_html($postmeta_values[PostTypeEnum::FIELD_DISPLAY_PRICE][0]) === 'YES'):?>
                        <?php if (esc_html($postmeta_values[PostTypeEnum::FIELD_DISPLAY_PROMO][0]) === 'YES'):?>
                            <div id="price">
                                Product price (USD): <span style="text-decoration:line-through;color:#0a6aa1;font-size: medium;"><?php echo esc_html($postmeta_values[PostTypeEnum::FIELD_PRICE][0])?></span> <span style="color: #0f834d; font-weight: bold;font-size: large;"><?php echo esc_html($postmeta_values[PostTypeEnum::FIELD_PROMO_PRICE][0])?></span>
                            </div>
                        <?php else:?>
                            <div id="price">
                                Product price (USD): <?php echo esc_html($postmeta_values[PostTypeEnum::FIELD_PRICE][0])?>
                            </div>
                        <?php endif?>
                    <?php endif?>

                    <?php if (esc_html($postmeta_values[PostTypeEnum::FIELD_DISPLAY_QUANTITY][0]) === 'YES'):?>
                        <div id="quantity">
                            Product quantity: <?php echo esc_html($postmeta_values[PostTypeEnum::FIELD_QUANTITY][0])?>
                        </div>
                    <?php endif?>

                    <?php if (esc_html($postmeta_values[PostTypeEnum::FIELD_DISPLAY_DATE][0]) === 'YES'):?>
                        <div id="quantity">
                            Sales period:
                            <p>
                                from <?php echo esc_html($postmeta_values[PostTypeEnum::FIELD_START_DATE][0])?> to <?php echo esc_html($postmeta_values[PostTypeEnum::FIELD_END_DATE][0])?>
                            </p>
                        </div>
                    <?php endif?>
                </div><!-- .entry-content -->

            </article><!-- #post-<?php the_ID(); ?> -->
        <?php endif?>

        <?php endwhile; // End of the loop.
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
$wp_query   = $temp;
$temp       = null;
