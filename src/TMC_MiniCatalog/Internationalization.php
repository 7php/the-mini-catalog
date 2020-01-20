<?php
/**
 * To be used when we are coping for more than one languages
 *
 * @author Khayrattee Wasseem <wasseem@khayrattee.com>
 * @copyright Copyright (c) 2020 Wasseem Khayrattee
 * @license GPL-3.0
 * @link https://7php.com (website)
 */

namespace TMC_MiniCatalog;


class Internationalization
{
    public function __construct()
    {
        load_plugin_textdomain(
            TMC_TEXT_DOMAIN,
            false,
            TMC_PLUGIN_ROOT . 'languages/'
        );
    }
}
