<?php

$configuration = array(

	// Enter the SHA-256 hashed password here
	'password_sha256' => 'bd9fb8612fc72fc7cae045a168b8294f2de2572755823354b82991910657c764',

	// Enter records returned per request here
	// (use SinceId parameter to retrieve more)
	'records_per_request' => 2147483647,

	// Override the umask here
	'umask' => 0,

	// Increase execution time to 4 hrs
	// See http://php.net/manual/en/info.configuration.php
	'max_execution_time' => 14400,

	// Uncomment these lines to enable debugging
	// See http://php.net/manual/en/errorfunc.configuration.php
	// 'display_errors' => "1",
	// 'error_reporting' => E_ALL,

	// Uncomment this line to increase the memory limit (not usually needed)
	// See http://php.net/manual/en/ini.core.php#ini.memory-limit
	// 'memory_limit' => '1024M',

	// Configure tables names that can be exported by the ExportTable command
	// Specify the table names WITHOUT any Magento table prefix.
	'table_export_allowed_table_names' => array(
		'shipping_premiumrate',
		'directory_currency_rate',
		'warehouse_store',
		'warehouse',
		'cataloginventory_stock_item',
		'catalogrule_product_price',
	),

);