
<div class="margin:10px 10px;">
    <?php wp_nonce_field('tmc_custom_box_action', 'tmc_custom_box_nonce'); ?>

    <div data-name="<?php echo esc_attr($this->field_list['tmc_price']['name']) ?>" data-type="number" data-key="<?php echo esc_attr($this->field_list['tmc_price']['name']) ?>">
        <div class="label">
            <label for="<?php echo esc_attr($this->field_list['tmc_price']['name']) ?>"><?php echo esc_attr($this->field_list['tmc_price']['label']) ?>:</label></div>
        <div class="input">
            <div class="input-wrap">
                <input type="number" id="<?php echo esc_attr($this->field_list['tmc_price']['name']) ?>" name="<?php echo esc_attr($this->field_list['tmc_price']['name']) ?>" value="<?php echo esc_attr($this->field_list['tmc_price']['value']) ?>">
            </div>
        </div>
    </div>
    <div data-name="<?php echo esc_attr($this->field_list['tmc_display_price']['name']) ?>" data-type="true_false" data-key="field_5e201f46223c6">
        <div class="acf-label">
            <label for="<?php echo esc_attr($this->field_list['tmc_display_price']['name']) ?>"><?php echo esc_attr($this->field_list['tmc_display_price']['label']) ?>:</label></div>
        <div class="acf-input">
            <div class="acf-true-false">
                    <input type="checkbox" id="<?php echo esc_attr($this->field_list['tmc_display_price']['name']) ?>" name="<?php echo esc_attr($this->field_list['tmc_display_price']['name']) ?>" value="<?php echo esc_attr($this->field_list['tmc_display_price']['value']) ?>">
                </label>
            </div>
        </div>
    </div>

    <div data-name="<?php echo esc_attr($this->field_list['tmc_quantity']['name']) ?>" data-type="number" data-key="<?php echo esc_attr($this->field_list['tmc_quantity']['name']) ?>">
        <div class="label">
            <label for="<?php echo esc_attr($this->field_list['tmc_quantity']['name']) ?>"><?php echo esc_attr($this->field_list['tmc_quantity']['label']) ?>:</label></div>
        <div class="input">
            <div class="input-wrap">
                <input type="number" id="<?php echo esc_attr($this->field_list['tmc_quantity']['name']) ?>" name="<?php echo esc_attr($this->field_list['tmc_quantity']['name']) ?>" value="<?php echo esc_attr($this->field_list['tmc_quantity']['value']) ?>">
            </div>
        </div>
    </div>
    <div data-name="<?php echo esc_attr($this->field_list['tmc_display_quantity']['name']) ?>" data-type="true_false" data-key="<?php echo esc_attr($this->field_list['tmc_display_quantity']['name']) ?>">
        <div class="label">
            <label for="<?php echo esc_attr($this->field_list['tmc_display_quantity']['name']) ?>"><?php echo esc_attr($this->field_list['tmc_display_quantity']['label']) ?>:</label></div>
        <div class="input">
            <div class="true-false">
                    <input type="checkbox" id="<?php echo esc_attr($this->field_list['tmc_display_quantity']['name']) ?>" name="<?php echo esc_attr($this->field_list['tmc_display_quantity']['name']) ?>" value="<?php echo esc_attr($this->field_list['tmc_display_quantity']['value']) ?>">
                </label>
            </div>
        </div>
    </div>

    <div data-name="<?php echo esc_attr($this->field_list['tmc_stock']['name']) ?>" data-type="number" data-key="<?php echo esc_attr($this->field_list['tmc_stock']['name']) ?>">
        <div class="label">
            <label for="<?php echo esc_attr($this->field_list['tmc_stock']['name']) ?>"><?php echo esc_attr($this->field_list['tmc_stock']['label']) ?>:</label></div>
        <div class="input">
            <div class="input-wrap">
                <input type="number" id="<?php echo esc_attr($this->field_list['tmc_stock']['name']) ?>" name="<?php echo esc_attr($this->field_list['tmc_stock']['name']) ?>" value="<?php echo esc_attr($this->field_list['tmc_stock']['value']) ?>"></div></div>
    </div>

    <div data-name="<?php echo esc_attr($this->field_list['tmc_promotional_price']['name']) ?>" data-type="number" data-key="<?php echo esc_attr($this->field_list['tmc_promotional_price']['name']) ?>a">
        <div class="label">
            <label for="<?php echo esc_attr($this->field_list['tmc_promotional_price']['name']) ?>"><?php echo esc_attr($this->field_list['tmc_promotional_price']['label']) ?>:</label></div>
        <div class="acf-input">
            <div class="input-wrap">
                <input type="number" id="<?php echo esc_attr($this->field_list['tmc_promotional_price']['name']) ?>" name="<?php echo esc_attr($this->field_list['tmc_promotional_price']['name']) ?>" value="<?php echo esc_attr($this->field_list['tmc_promotional_price']['value']) ?>"></div></div>
    </div>
    <div data-name="<?php echo esc_attr($this->field_list['tmc_display_promo']['name']) ?>" data-type="true_false" data-key="<?php echo esc_attr($this->field_list['tmc_display_promo']['name']) ?>">
        <div class="label">
            <label for="<?php echo esc_attr($this->field_list['tmc_display_promo']['name']) ?>"><?php echo esc_attr($this->field_list['tmc_display_promo']['label']) ?>:</label></div>
        <div class="input">
            <div class="true-false">
                    <input type="checkbox" id="acf-<?php echo esc_attr($this->field_list['tmc_display_promo']['name']) ?>" name="<?php echo esc_attr($this->field_list['tmc_display_promo']['name']) ?>" value="<?php echo esc_attr($this->field_list['tmc_display_promo']['value']) ?>">
                </label>
            </div>
        </div>
    </div>

    <div data-name="<?php echo esc_attr($this->field_list['tmc_sales_start_date']['name']) ?>" data-type="date_time_picker" data-key="<?php echo esc_attr($this->field_list['tmc_sales_start_date']['name']) ?>">
        <div class="label">
            <label for="<?php echo esc_attr($this->field_list['tmc_sales_start_date']['name']) ?>"><?php echo esc_attr($this->field_list['tmc_sales_start_date']['label']) ?>:</label></div>
        <div class="input">
            <div class="date-time-picker input-wrap" data-date_format="dd/mm/yy" data-time_format="h:mm tt" data-first_day="1">
                <input type="text" class="input hasDatepicker" value="<?php echo esc_attr($this->field_list['tmc_sales_start_date']['value']) ?>" id="<?php echo esc_attr($this->field_list['tmc_sales_start_date']['name']) ?>" name="<?php echo esc_attr($this->field_list['tmc_sales_start_date']['name']) ?>">
            </div>
        </div>
    </div>
    <div data-name="<?php echo esc_attr($this->field_list['tmc_sales_end_date']['name']) ?>" data-type="date_time_picker" data-key="<?php echo esc_attr($this->field_list['tmc_sales_end_date']['name']) ?>">
        <div class="label">
            <label for="<?php echo esc_attr($this->field_list['tmc_sales_end_date']['name']) ?>"><?php echo esc_attr($this->field_list['tmc_sales_end_date']['label']) ?>:</label></div>
        <div class="input">
            <div class="date-time-picker input-wrap" data-date_format="dd/mm/yy" data-time_format="h:mm tt" data-first_day="1">
                <input type="text" class="input hasDatepicker" value="<?php echo esc_attr($this->field_list['tmc_sales_end_date']['value']) ?>" id="<?php echo esc_attr($this->field_list['tmc_sales_end_date']['name']) ?>" name="<?php echo esc_attr($this->field_list['tmc_sales_end_date']['name']) ?>">
            </div>
        </div>
    </div>

    <div data-name="<?php echo esc_attr($this->field_list['tmc_display_date']['name']) ?>" data-type="true_false" data-key="<?php echo esc_attr($this->field_list['tmc_display_date']['name']) ?>">
        <div class="label">
            <label for="<?php echo esc_attr($this->field_list['tmc_display_date']['name']) ?>"><?php echo esc_attr($this->field_list['tmc_display_date']['label']) ?>:</label></div>
        <div class="input">
            <div class="true-false">
                    <input type="checkbox" id="<?php echo esc_attr($this->field_list['tmc_display_date']['name']) ?>" name="<?php echo esc_attr($this->field_list['tmc_display_date']['name']) ?>" value="<?php echo esc_attr($this->field_list['tmc_display_date']['value']) ?>">
            </div>
        </div>
    </div>
</div>
