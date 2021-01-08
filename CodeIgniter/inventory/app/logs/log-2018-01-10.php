<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2018-01-10 18:14:03 --> Severity: error --> Exception: Call to undefined method Shop_model::getShopWarehouse() /Users/Saleem/Desktop/Projects/ci/sma/app/models/shop/Shop_model.php 132
ERROR - 2018-01-10 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$warehouse_id /Users/Saleem/Desktop/Projects/ci/sma/app/models/shop/Shop_model.php 464
ERROR - 2018-01-10 18:15:26 --> Query error: Unknown column 'sma_products.id' in 'field list' - Invalid query: SELECT `sma_products`.`id` as `id`, `sma_products`.`name` as `name`, `sma_products`.`code` as `code`, `sma_products`.`image` as `image`, `sma_products`.`slug` as `slug`, `price`, `quantity`, `type`, `promotion`, `promo_price`, `product_details` as `details`
FROM `sma_warehouses`
WHERE `id` IS NULL
ERROR - 2018-01-10 18:16:22 --> Query error: Unknown column 'sma_products.id' in 'field list' - Invalid query: SELECT `sma_products`.`id` as `id`, `sma_products`.`name` as `name`, `sma_products`.`code` as `code`, `sma_products`.`image` as `image`, `sma_products`.`slug` as `slug`, `price`, `quantity`, `type`, `promotion`, `promo_price`, `product_details` as `details`
FROM `sma_warehouses`
WHERE `id` = '2'
ERROR - 2018-01-10 18:21:56 --> Query error: Unknown column 'sma_products.id' in 'field list' - Invalid query: SELECT `sma_products`.`id` as `id`, `sma_products`.`name` as `name`, `sma_products`.`code` as `code`, `sma_products`.`image` as `image`, `sma_products`.`slug` as `slug`, `price`, `quantity`, `type`, `promotion`, `promo_price`, `product_details` as `details`
FROM `sma_warehouses`
WHERE `id` = '2'
ERROR - 2018-01-10 18:24:38 --> Query error: Unknown column 'sma_products.id' in 'field list' - Invalid query: SELECT `sma_products`.`id` as `id`, `sma_products`.`name` as `name`, `sma_products`.`code` as `code`, `sma_products`.`image` as `image`, `sma_products`.`slug` as `slug`, `price`, `quantity`, `type`, `promotion`, `promo_price`, `product_details` as `details`
FROM `sma_warehouses`
WHERE `id` = '2'
ERROR - 2018-01-10 18:25:16 --> Query error: Column 'id' in where clause is ambiguous - Invalid query: SELECT `sma_products`.`id` as `id`, `sma_products`.`name` as `name`, `sma_products`.`code` as `code`, `sma_products`.`image` as `image`, `sma_products`.`slug` as `slug`, `price`, `quantity`, `type`, `promotion`, `promo_price`, `product_details` as `details`
FROM `sma_products`, `sma_warehouses`
WHERE `id` = '2'
ERROR - 2018-01-10 18:26:06 --> Query error: Column 'id' in where clause is ambiguous - Invalid query: SELECT `sma_products`.`id` as `id`, `sma_products`.`name` as `name`, `sma_products`.`code` as `code`, `sma_products`.`image` as `image`, `sma_products`.`slug` as `slug`, `price`, `quantity`, `type`, `promotion`, `promo_price`, `product_details` as `details`
FROM `sma_products`, `sma_warehouses`
WHERE `id` = '2'
ERROR - 2018-01-10 18:26:26 --> Query error: Not unique table/alias: 'sma_products' - Invalid query: SELECT `sma_products`.`id` as `id`, `sma_products`.`name` as `name`, `sma_products`.`code` as `code`, `sma_products`.`image` as `image`, `sma_products`.`slug` as `slug`, `price`, `quantity`, `type`, `promotion`, `promo_price`, `product_details` as `details`
FROM `sma_products`, `sma_products`
WHERE `hide` != 1
ORDER BY `name` ASC
 LIMIT 12
ERROR - 2018-01-10 18:27:01 --> Query error: Column 'id' in where clause is ambiguous - Invalid query: SELECT `sma_products`.`id` as `id`, `sma_products`.`name` as `name`, `sma_products`.`code` as `code`, `sma_products`.`image` as `image`, `sma_products`.`slug` as `slug`, `price`, `quantity`, `type`, `promotion`, `promo_price`, `product_details` as `details`
FROM `sma_products`, `sma_warehouses`
WHERE `id` = '2'
ERROR - 2018-01-10 18:31:56 --> Query error: Column 'id' in where clause is ambiguous - Invalid query: SELECT `sma_products`.`id` as `id`, `sma_products`.`name` as `name`, `sma_products`.`code` as `code`, `sma_products`.`image` as `image`, `sma_products`.`slug` as `slug`, `price`, `quantity`, `type`, `promotion`, `promo_price`, `product_details` as `details`
FROM `sma_products`, `sma_warehouses`
WHERE `id` = '2'
ERROR - 2018-01-10 18:32:28 --> Query error: Column 'id' in where clause is ambiguous - Invalid query: SELECT `sma_products`.`id` as `id`, `sma_products`.`name` as `name`, `sma_products`.`code` as `code`, `sma_products`.`image` as `image`, `sma_products`.`slug` as `slug`, `price`, `quantity`, `type`, `promotion`, `promo_price`, `product_details` as `details`
FROM `sma_products`, `sma_warehouses`
WHERE `id` = '2'
ERROR - 2018-01-10 18:34:02 --> Query error: Column 'id' in where clause is ambiguous - Invalid query: SELECT `sma_products`.`id` as `id`, `sma_products`.`name` as `name`, `sma_products`.`code` as `code`, `sma_products`.`image` as `image`, `sma_products`.`slug` as `slug`, `price`, `quantity`, `type`, `promotion`, `promo_price`, `product_details` as `details`
FROM `sma_products`, `sma_warehouses`
WHERE `id` = '2'
 LIMIT 1
ERROR - 2018-01-10 18:34:42 --> Severity: error --> Exception: syntax error, unexpected 'var_dump' (T_STRING) /Users/Saleem/Desktop/Projects/ci/sma/app/models/shop/Shop_model.php 135
ERROR - 2018-01-10 18:34:43 --> Severity: error --> Exception: syntax error, unexpected 'var_dump' (T_STRING) /Users/Saleem/Desktop/Projects/ci/sma/app/models/shop/Shop_model.php 135
ERROR - 2018-01-10 18:34:58 --> Query error: Column 'id' in where clause is ambiguous - Invalid query: SELECT `sma_products`.`id` as `id`, `sma_products`.`name` as `name`, `sma_products`.`code` as `code`, `sma_products`.`image` as `image`, `sma_products`.`slug` as `slug`, `price`, `quantity`, `type`, `promotion`, `promo_price`, `product_details` as `details`
FROM `sma_products`, `sma_warehouses`
WHERE `id` = '2'
 LIMIT 1
ERROR - 2018-01-10 18:35:21 --> Query error: Column 'id' in where clause is ambiguous - Invalid query: SELECT `sma_products`.`id` as `id`, `sma_products`.`name` as `name`, `sma_products`.`code` as `code`, `sma_products`.`image` as `image`, `sma_products`.`slug` as `slug`, `price`, `quantity`, `type`, `promotion`, `promo_price`, `product_details` as `details`
FROM `sma_products`, `sma_warehouses`
WHERE `id` = '2'
 LIMIT 1
ERROR - 2018-01-10 18:35:53 --> Query error: Column 'id' in where clause is ambiguous - Invalid query: SELECT `sma_products`.`id` as `id`, `sma_products`.`name` as `name`, `sma_products`.`code` as `code`, `sma_products`.`image` as `image`, `sma_products`.`slug` as `slug`, `price`, `quantity`, `type`, `promotion`, `promo_price`, `product_details` as `details`
FROM `sma_products`, `sma_warehouses`
WHERE `id` = '2'
 LIMIT 1
ERROR - 2018-01-10 18:36:30 --> Query error: Column 'price' in field list is ambiguous - Invalid query: SELECT `sma_products`.`id` as `id`, `sma_products`.`name` as `name`, `sma_products`.`code` as `code`, `sma_products`.`image` as `image`, `sma_products`.`slug` as `slug`, `price`, `quantity`, `type`, `promotion`, `promo_price`, `product_details` as `details`, `sma_product_prices`.`price` as `special_price`
FROM `sma_products`
LEFT JOIN `sma_product_prices` ON `sma_products`.`id`=`sma_product_prices`.`product_id`
WHERE `price_group_id` = '2'
AND `hide` != 1
ORDER BY `name` ASC
 LIMIT 12
ERROR - 2018-01-10 18:36:57 --> Query error: Unknown column 'sma_products.sma_.id' in 'field list' - Invalid query: SELECT `sma_products`.`sma_`.`id` as `id`, `sma_products`.`name` as `name`, `sma_products`.`code` as `code`, `sma_products`.`image` as `image`, `sma_products`.`slug` as `slug`, `sma_products`.`price`, `quantity`, `type`, `promotion`, `promo_price`, `product_details` as `details`, `sma_product_prices`.`price` as `special_price`
FROM `sma_products`
LEFT JOIN `sma_product_prices` ON `sma_products`.`id`=`sma_product_prices`.`product_id`
WHERE `price_group_id` = '2'
AND `hide` != 1
ORDER BY `name` ASC
 LIMIT 12
ERROR - 2018-01-10 19:01:03 --> Severity: Notice --> Undefined variable: customer /Users/Saleem/Desktop/Projects/ci/sma/app/models/shop/Shop_model.php 135
ERROR - 2018-01-10 19:09:57 --> Query error: Column 'price' in field list is ambiguous - Invalid query: SELECT `sma_products`.`id` as `id`, `sma_products`.`name` as `name`, `sma_products`.`code` as `code`, `sma_products`.`image` as `image`, `sma_products`.`slug` as `slug`, `price`, `quantity`, `type`, `promotion`, `promo_price`, `b`.`name` as `brand_name`, `b`.`slug` as `brand_slug`, `c`.`name` as `category_name`, `c`.`slug` as `category_slug`, `sma_product_prices`.`price` as `special_price`
FROM `sma_products`
LEFT JOIN `sma_brands` `b` ON `sma_products`.`brand`=`b`.`id`
LEFT JOIN `sma_categories` `c` ON `sma_products`.`category_id`=`c`.`id`
LEFT JOIN `sma_product_prices` ON `sma_products`.`id`=`sma_product_prices`.`product_id`
WHERE `sma_products`.`featured` = 1
AND `hide` != 1
AND `price_group_id` = '2'
ORDER BY RAND()
 LIMIT 4
ERROR - 2018-01-10 19:09:57 --> Query error: Column 'price' in field list is ambiguous - Invalid query: SELECT `sma_products`.`id` as `id`, `sma_products`.`name` as `name`, `sma_products`.`code` as `code`, `sma_products`.`image` as `image`, `sma_products`.`slug` as `slug`, `price`, `quantity`, `type`, `promotion`, `promo_price`, `b`.`name` as `brand_name`, `b`.`slug` as `brand_slug`, `c`.`name` as `category_name`, `c`.`slug` as `category_slug`, `sma_product_prices`.`price` as `special_price`
FROM `sma_products`
LEFT JOIN `sma_brands` `b` ON `sma_products`.`brand`=`b`.`id`
LEFT JOIN `sma_categories` `c` ON `sma_products`.`category_id`=`c`.`id`
LEFT JOIN `sma_product_prices` ON `sma_products`.`id`=`sma_product_prices`.`product_id`
WHERE `sma_products`.`featured` = 1
AND `hide` != 1
AND `price_group_id` = '2'
ORDER BY `promotion` desc, RAND()
 LIMIT 16
ERROR - 2018-01-10 19:34:02 --> Severity: Notice --> Undefined index: special_price /Users/Saleem/Desktop/Projects/ci/sma/app/controllers/shop/Shop.php 89
ERROR - 2018-01-10 19:34:02 --> Severity: Notice --> Undefined index: special_price /Users/Saleem/Desktop/Projects/ci/sma/app/controllers/shop/Shop.php 89
ERROR - 2018-01-10 19:34:02 --> Severity: Notice --> Undefined index: special_price /Users/Saleem/Desktop/Projects/ci/sma/app/controllers/shop/Shop.php 89
ERROR - 2018-01-10 19:34:02 --> Severity: Notice --> Undefined index: special_price /Users/Saleem/Desktop/Projects/ci/sma/app/controllers/shop/Shop.php 89
ERROR - 2018-01-10 19:34:02 --> Severity: Notice --> Undefined index: special_price /Users/Saleem/Desktop/Projects/ci/sma/app/controllers/shop/Shop.php 89
ERROR - 2018-01-10 19:34:02 --> Severity: Notice --> Undefined index: special_price /Users/Saleem/Desktop/Projects/ci/sma/app/controllers/shop/Shop.php 89
ERROR - 2018-01-10 19:34:02 --> Severity: Notice --> Undefined index: special_price /Users/Saleem/Desktop/Projects/ci/sma/app/controllers/shop/Shop.php 89
ERROR - 2018-01-10 19:34:02 --> Severity: Notice --> Undefined index: special_price /Users/Saleem/Desktop/Projects/ci/sma/app/controllers/shop/Shop.php 89
ERROR - 2018-01-10 19:34:02 --> Severity: Notice --> Undefined index: special_price /Users/Saleem/Desktop/Projects/ci/sma/app/controllers/shop/Shop.php 89
ERROR - 2018-01-10 19:34:02 --> Severity: Notice --> Undefined index: special_price /Users/Saleem/Desktop/Projects/ci/sma/app/controllers/shop/Shop.php 89
ERROR - 2018-01-10 19:34:02 --> Severity: Notice --> Undefined index: special_price /Users/Saleem/Desktop/Projects/ci/sma/app/controllers/shop/Shop.php 89
ERROR - 2018-01-10 19:34:02 --> Severity: Notice --> Undefined index: special_price /Users/Saleem/Desktop/Projects/ci/sma/app/controllers/shop/Shop.php 89
ERROR - 2018-01-10 19:34:02 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /Users/Saleem/Desktop/Projects/ci/sma/system/core/Exceptions.php:271) /Users/Saleem/Desktop/Projects/ci/sma/app/libraries/Sma.php 514
ERROR - 2018-01-10 21:21:03 --> Severity: Compile Error --> Cannot redeclare Shop_model::getProductByID() /Users/Saleem/Desktop/Projects/ci/sma/app/models/shop/Shop_model.php 471
ERROR - 2018-01-10 21:21:04 --> Severity: Compile Error --> Cannot redeclare Shop_model::getProductByID() /Users/Saleem/Desktop/Projects/ci/sma/app/models/shop/Shop_model.php 471
ERROR - 2018-01-10 21:21:38 --> Severity: Compile Error --> Cannot redeclare Shop_model::getProductByID() /Users/Saleem/Desktop/Projects/ci/sma/app/models/shop/Shop_model.php 471
ERROR - 2018-01-10 21:21:38 --> Severity: Compile Error --> Cannot redeclare Shop_model::getProductByID() /Users/Saleem/Desktop/Projects/ci/sma/app/models/shop/Shop_model.php 471
ERROR - 2018-01-10 21:24:37 --> Query error: Column 'id' in where clause is ambiguous - Invalid query: SELECT `sma_product_prices`.`price` as `special_price`
FROM `sma_products`
LEFT JOIN `sma_product_prices` ON `sma_products`.`id`=`sma_product_prices`.`product_id`
WHERE `id` = '10'
AND `price_group_id` = '2'
 LIMIT 1
ERROR - 2018-01-10 21:24:52 --> Query error: Column 'id' in where clause is ambiguous - Invalid query: SELECT `sma_product_prices`.`price` as `special_price`
FROM `sma_products`
LEFT JOIN `sma_product_prices` ON `sma_products`.`id`=`sma_product_prices`.`product_id`
WHERE `id` = '10'
AND `price_group_id` = '2'
 LIMIT 1
ERROR - 2018-01-10 21:25:49 --> Severity: Notice --> Undefined property: stdClass::$promotion /Users/Saleem/Desktop/Projects/ci/sma/app/controllers/shop/Cart_ajax.php 36
ERROR - 2018-01-10 21:25:49 --> Severity: Notice --> Undefined property: stdClass::$tax_rate /Users/Saleem/Desktop/Projects/ci/sma/app/controllers/shop/Cart_ajax.php 51
ERROR - 2018-01-10 21:25:49 --> Severity: Notice --> Trying to get property of non-object /Users/Saleem/Desktop/Projects/ci/sma/app/models/Site.php 1142
ERROR - 2018-01-10 21:25:49 --> Severity: Notice --> Undefined property: stdClass::$tax_method /Users/Saleem/Desktop/Projects/ci/sma/app/controllers/shop/Cart_ajax.php 55
ERROR - 2018-01-10 21:25:49 --> Severity: Notice --> Undefined property: stdClass::$id /Users/Saleem/Desktop/Projects/ci/sma/app/controllers/shop/Cart_ajax.php 60
ERROR - 2018-01-10 21:25:49 --> Severity: Notice --> Undefined property: stdClass::$name /Users/Saleem/Desktop/Projects/ci/sma/app/controllers/shop/Cart_ajax.php 62
ERROR - 2018-01-10 21:25:49 --> Severity: Notice --> Undefined property: stdClass::$code /Users/Saleem/Desktop/Projects/ci/sma/app/controllers/shop/Cart_ajax.php 63
ERROR - 2018-01-10 21:25:49 --> Severity: Notice --> Undefined property: stdClass::$image /Users/Saleem/Desktop/Projects/ci/sma/app/controllers/shop/Cart_ajax.php 66
ERROR - 2018-01-10 21:25:49 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /Users/Saleem/Desktop/Projects/ci/sma/system/core/Exceptions.php:271) /Users/Saleem/Desktop/Projects/ci/sma/system/helpers/url_helper.php 564
ERROR - 2018-01-10 21:27:38 --> Severity: Notice --> Undefined property: stdClass::$promotion /Users/Saleem/Desktop/Projects/ci/sma/app/controllers/shop/Cart_ajax.php 36
ERROR - 2018-01-10 21:27:38 --> Severity: Notice --> Undefined property: stdClass::$tax_rate /Users/Saleem/Desktop/Projects/ci/sma/app/controllers/shop/Cart_ajax.php 51
ERROR - 2018-01-10 21:27:38 --> Severity: Notice --> Trying to get property of non-object /Users/Saleem/Desktop/Projects/ci/sma/app/models/Site.php 1142
ERROR - 2018-01-10 21:27:38 --> Severity: Notice --> Undefined property: stdClass::$tax_method /Users/Saleem/Desktop/Projects/ci/sma/app/controllers/shop/Cart_ajax.php 55
ERROR - 2018-01-10 21:27:38 --> Severity: Notice --> Undefined property: stdClass::$id /Users/Saleem/Desktop/Projects/ci/sma/app/controllers/shop/Cart_ajax.php 60
ERROR - 2018-01-10 21:27:38 --> Severity: Notice --> Undefined property: stdClass::$name /Users/Saleem/Desktop/Projects/ci/sma/app/controllers/shop/Cart_ajax.php 62
ERROR - 2018-01-10 21:27:38 --> Severity: Notice --> Undefined property: stdClass::$code /Users/Saleem/Desktop/Projects/ci/sma/app/controllers/shop/Cart_ajax.php 63
ERROR - 2018-01-10 21:27:38 --> Severity: Notice --> Undefined property: stdClass::$image /Users/Saleem/Desktop/Projects/ci/sma/app/controllers/shop/Cart_ajax.php 66
ERROR - 2018-01-10 21:27:38 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /Users/Saleem/Desktop/Projects/ci/sma/system/core/Exceptions.php:271) /Users/Saleem/Desktop/Projects/ci/sma/system/helpers/url_helper.php 564
ERROR - 2018-01-10 22:25:08 --> Could not find the language line "downloads"
ERROR - 2018-01-10 22:25:08 --> Could not find the language line "send_email_title"
ERROR - 2018-01-10 22:25:08 --> Could not find the language line "message_sent"
ERROR - 2018-01-10 22:25:37 --> Could not find the language line "downloads"
ERROR - 2018-01-10 22:25:37 --> Could not find the language line "send_email_title"
ERROR - 2018-01-10 22:25:37 --> Could not find the language line "message_sent"
ERROR - 2018-01-10 22:25:42 --> Could not find the language line "downloads"
ERROR - 2018-01-10 22:25:42 --> Could not find the language line "send_email_title"
ERROR - 2018-01-10 22:25:42 --> Could not find the language line "message_sent"
ERROR - 2018-01-10 22:25:43 --> Could not find the language line "downloads"
ERROR - 2018-01-10 22:25:43 --> Could not find the language line "send_email_title"
ERROR - 2018-01-10 22:25:43 --> Could not find the language line "message_sent"
ERROR - 2018-01-10 22:26:44 --> Could not find the language line "downloads"
ERROR - 2018-01-10 22:26:44 --> Could not find the language line "send_email_title"
ERROR - 2018-01-10 22:26:44 --> Could not find the language line "message_sent"
ERROR - 2018-01-10 22:26:47 --> Could not find the language line "downloads"
ERROR - 2018-01-10 22:26:47 --> Could not find the language line "send_email_title"
ERROR - 2018-01-10 22:26:47 --> Could not find the language line "message_sent"
ERROR - 2018-01-10 22:26:50 --> Could not find the language line "downloads"
ERROR - 2018-01-10 22:26:50 --> Could not find the language line "send_email_title"
ERROR - 2018-01-10 22:26:50 --> Could not find the language line "message_sent"
ERROR - 2018-01-10 22:26:53 --> Could not find the language line "downloads"
ERROR - 2018-01-10 22:26:53 --> Could not find the language line "send_email_title"
ERROR - 2018-01-10 22:26:53 --> Could not find the language line "message_sent"
ERROR - 2018-01-10 22:27:01 --> Could not find the language line "downloads"
ERROR - 2018-01-10 22:27:01 --> Could not find the language line "send_email_title"
ERROR - 2018-01-10 22:27:01 --> Could not find the language line "message_sent"
