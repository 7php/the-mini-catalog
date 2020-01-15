<?php
/**
 * To be used when we are coping for more than one languages
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
