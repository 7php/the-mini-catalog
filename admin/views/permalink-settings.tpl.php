<table class="form-table wc-permalink-structure">
    <tbody>
    <tr>
        <td>
            <code class="default-example">
                <?php echo esc_html( home_url() ); ?>/?product=sample-product</code> <code class="non-default-example"><?php echo esc_html( home_url() ); ?>/<?php echo esc_html( $this->product_base ); ?>/sample-product/
            </code>
        </td>
    </tr>

    <tr>
        <th><label><input name="product_permalink" type="radio" value="<?php echo esc_attr( $this->structures[0] ); ?>" class="wctog" <?php checked( $this->structures[0], $this->permalinks['product_base'] ); ?> /> <?php esc_html_e( 'Default', 'woocommerce' ); ?></label></th>
        <td><code class="default-example"><?php echo esc_html( home_url() ); ?>/?product=sample-product</code> <code class="non-default-example"><?php echo esc_html( home_url() ); ?>/<?php echo esc_html( $this->product_base ); ?>/sample-product/</code></td>
    </tr>

    <tr>
        <th>
            <label>
                <input name="product_permalink" id="woocommerce_custom_selection" type="radio" value="custom" class="tog" <?php checked( in_array( $this->permalinks['product_base'], $this->structures, true ), false ); ?> />
                <?php esc_html_e( 'Custom base', 'woocommerce' ); ?>
            </label>
        </th>
        <td>
            <input name="product_permalink_structure" id="tmc_permalink_structure" type="text" value="<?php echo esc_attr( $this->permalinks['product_base'] ? trailingslashit( $this->permalinks['product_base'] ) : '' ); ?>" class="regular-text code">
            <span class="description">
                <?php echo $this->description?>
            </span>
        </td>
    </tr>
    </tbody>
</table>
