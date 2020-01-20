# # The Wak WP-MiniCart Plugin Project

- To showcase how I create a WordPress plugin

## Summary of Project

- Project has been hosted on a LIVE server, see here: [https://wpcart.7php.com/](https://wpcart.7php.com/)
- To create a simple mini catalog which caters for:
	- creating products with custom fields: price, quantity, promo price, Sales period
	- whether or not to display any or all of the fields
	- The custom Permalink should be dynamically set via **Permalinks > Settings**
	- No ACF or related CPT plugins should be used. Everything should be 100% custom coded
	- Programmatically create Pages: Store and Override its template from within the plugin itself
	- Programmatically override the custom post_type `product` via the plugin itself

NOTE:

The page Mass Promo has not been completed due to lack of time.

## The Main Logic Of The Project

## Installation of Project

1) **Manually** - Download and extract this repo inside your wp plugins' folder

2) **Using Composer**

- Add `"sevenphp/the-mini-catalog": "~1.0.0",` inside your composer's require
- Add the following as well:
```
"repositories": [
    {
      "type": "composer",
      "url": "https://wpackagist.org/"
    },
    {
      "type": "vcs",
      "url": "https://github.com/7php/the-mini-catalog.git"
    }
  ]
```

