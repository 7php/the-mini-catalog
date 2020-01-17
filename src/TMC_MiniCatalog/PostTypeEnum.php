<?php
/**
 * Contains a list of all the Attributes for our Custom Post Type
 */

namespace TMC_MiniCatalog;

/**
 * Class PostTypeEnum
 * @package TMC_MiniCatalog
 */
class PostTypeEnum
{
    //Permalinks
    const CUSTOM_TEXT_DOMAIN    = "the-mini-catalog";
    const TMC_PERMALINKS_KEY    = "tmc_permalinks";
    const TMC_REWRITE_SLUG      = "product_rewrite_slug";

    //Basic Settings
    const CUSTOM_POST_TYPE      = "tmc_product"; //to prevent collision
    const CUSTOM_PLURAL_LABEL   = "TMC Products"; //to prevent collision
    const CUSTOM_SINGULAR_LABEL = "TMC Product"; //to prevent collision

    //Additional Settings
    const POST_TYPE_DESCRIPTION = "This post type used to create products"; //description of this custom post type
    const MENU_NAME             = "TMC Products"; //Custom admin menu name for your custom post type
    const ALL_ITEMS             = "All TMC Products"; //Used in the post type admin submenu
    const ADD_NEW               = "Add New"; //Used in the post type admin submenu
    const ADD_NEW_ITEM          = "Add new tmc_product"; //Used at the top of the post editor screen for a new post type post
    const EDIT_NEW_ITEM         = "Edit tmc_product"; //Used at the top of the post editor screen for an existing post type post
    const NEW_ITEM              = "New tmc_product"; //Post type label. Used in the admin menu for displaying post types
    const VIEW_ITEM             = "View tmc_product"; //Used in the admin bar when viewing editor screen for a published post in the post type
    const VIEW_ITEMS            = "View TMC Products"; //Used in the admin bar when viewing editor screen for a published post in the post type
    const SEARCH_ITEM           = "Search TMC Products"; //Used as the text for the search button on post type list screen
    const NOT_FOUND             = "No TMC Products Found"; //Used when there are no posts to display on the post type list screen
    const PARENT                = "Parent tmc_product:"; //Used for hierarchical types that need a colon
    const FEATURED_IMAGE        = "Featured image for this tmc_product"; //Used as the "Featured Image" phrase for the post type.
    const SET_FEATURED_IMAGE    = "Set Featured image for this tmc_product"; //Used as the "Set featured image" phrase for the post type.
    const REMOVE_FEATURED_IMAGE = "Remove featured image for this tmc_product"; //Used as the "Remove featured image" phrase for the post type
    const USE_FEATURED_IMAGE    = "Use as featured image for this tmc_product"; //Used as the "Use as featured image" phrase for the post type.
    const ARCHIVES              = "tmc_product archives"; //Post type archive label used in nav menus
    const INSERT_INTO_ITEM      = "Insert into tmc_product"; //Used as the "Insert into post" or "Insert into page" phrase for the post type.
    const UPLOADED_TO_THIS_ITEM = "Upload to this tmc_product"; //Used as the "Uploaded to this post" or "Uploaded to this page" phrase for the post type.
    const FILTER_ITEM_LIST      = "Filter TMC Products list"; //Screen reader text for the filter links heading on the post type listing screen.
    const ITEMS_LIST_NAVIGATION = "Products list navigation"; //Screen reader text for the pagination heading on the post type listing screen.
    const ITEMS_LIST            = "Product List"; //Screen reader text for the items list heading on the post type listing screen
    const ATTRIBUTES            = "Products attributes"; //Used for the title of the post attributes meta box.
    const NEW_MENU_IN_ADMIN_BAR = "tmc_product"; // Used in New in Admin menu bar. Default "singular name" label.
    const ITEM_PUBLISHED        = "tmc_product published"; //Used in the editor notice after publishing a post. Default "Post published." / "Page published."
    const ITEM_PUBLISHED_PRIVATELY  = "tmc_product published privately."; //Used in the editor notice after publishing a private post. Default "Post published privately." / "Page published privately."
    const ITEM_REVERTED_TO_DRAFT    = "tmc_product reverted to draft."; //	Used in the editor notice after reverting a post to draft. Default "Post reverted to draft." / "Page reverted to draft."
    const ITEM_SCHEDULED            = "tmc_product scheduled"; //Used in the editor notice after scheduling a post to be published at a later date. Default "Post scheduled." / "Page scheduled."
    const ITEM_UPDATED              = "tmc_product updated."; //Used in the editor notice after updating a post. Default "Post updated." / "Page updated."

    //Admin Settings
    const IS_PUBLIC             = true; //Whether or not posts of this type should be shown in the admin UI and is publicly queryable.
    const PUBLICLY_QUERYABLE    = true; //Whether or not queries can be performed on the front end as part of parse_request()
    const SHOW_UI               = true; //Whether or not to generate a default UI for managing this post type.
    const SHOW_IN_NAV_MENUS     = true; //Whether or not this post type is available for selection in navigation menus.
    const SHOW_IN_MENU          = true; //Whether or not to show the post type in the admin menu and where to show that menu.
    const DELETE_WITH_USER      = false; //Whether to delete posts of this type when deleting a user.
    const HAS_ARCHIVE           = false; //Whether or not the post type will have a post type archive URL
    const EXCLUDE_FROM_SEARCH   = false; // Whether or not to exclude posts with this post type from front end search results.
    const CAPABILITY_TYPE       = "post"; //The post type to use for checking read, edit, and delete capabilities. A comma-separated second value can be used for plural version.
    const HIERARCHICAL          = false; //Whether or not the post type can have parent-child relationships
    const REWRITE               = ""; //Whether or not WordPress should use rewrites for this post type.
    const REWRITE_SLUG          = "product"; //Custom post type slug to use instead of the default
    const WITH_FRONT            = true; //Should the permalink structure be prepended with the front base. (example: if your permalink structure is /blog/, then your links will be: false->/news/, true->/blog/news/).
    const QUERY_VAR             = true; //Sets the query_var key for this post type
    const CUSTOM_QUERY_VAR_SLUG = ""; //Custom query var slug to use instead of the default.
    const MENU_POSITION         = 7; //The position in the menu order the post type should appear. show_in_menu must be true (5-100)
    const MENU_ICON             = "dashicons-products"; //https://developer.wordpress.org/resource/dashicons/

    const SHOW_IN_REST_API          = true; //Whether or not to show this post type data in the WP REST API.
    const REST_API_BASE_SLUG        = "tmc_product"; //Slug to use in REST API URLs.
    const RES_API_CONTROLLER_CLASS  = "WP_REST_Posts_Controller"; //Custom controller to use instead of WP_REST_Posts_Controller
}
