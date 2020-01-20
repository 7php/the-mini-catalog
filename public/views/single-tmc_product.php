<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 */
use TMC_MiniCatalog\PostTypeEnum;

get_header()?>
<?php
/** @var WP_Query $wp_query */
global $wp_query;
$postmeta_values = get_post_meta(get_the_ID());
?>
<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <?php if ($postmeta_values !== false):?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
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
    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer()?>
