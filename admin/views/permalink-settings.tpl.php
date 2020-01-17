<?php
use TMC_MiniCatalog\PostTypeEnum;
?>

<p><?php echo wp_kses_post( __( 'Here you may change the TMC product URLs. This setting affects product URLs only.', PostTypeEnum::CUSTOM_TEXT_DOMAIN))?></p>

<table class="form-table tmc-permalink-structure">
    <tbody>
        <tr>
            <th>
                <label>
                    <input name="product_permalink" type="radio" value="<?php echo esc_attr( $this->structures[0] ); ?>" class="wctog" <?php checked( $this->structures[0], $this->permalinks['product_base'] ); ?> /> <?php esc_html_e( 'Default', PostTypeEnum::CUSTOM_TEXT_DOMAIN ); ?>
                </label>
            </th>
            <td><code class="default-example"><?php echo esc_html( home_url() ); ?>/?product=sample-product</code> | with friendly SLUG: <code class="non-default-example"><?php echo esc_html( home_url() ); ?>/<?php echo esc_html( $this->product_base ); ?>/sample-product/</code></td>
        </tr>

        <tr>
            <th>
                <label>
                    <input name="product_permalink" id="tmc_custom_selection" type="radio" value="custom" class="tog" <?php checked( in_array($this->permalinks['product_base'], $this->structures, true), false); ?> />
                    <?php esc_html_e('Custom base', PostTypeEnum::CUSTOM_TEXT_DOMAIN ); ?>
                </label>
            </th>
            <td>
                <input name="product_permalink_structure" id="tmc_permalink_structure" type="text" value="<?php echo esc_attr( $this->permalinks['product_base'] ? trailingslashit( $this->permalinks['product_base'] ) : '' ); ?>" class="regular-text code">
                <span class="description">
                    <?php esc_html_e('Enter a custom base to use. A base must be set or WordPress will use default instead.', PostTypeEnum::CUSTOM_TEXT_DOMAIN )?>
                </span>
            </td>
        </tr>
    </tbody>
</table>
<?php wp_nonce_field( 'tmc-permalinks', 'tmc-permalinks-nonce' ); ?>
