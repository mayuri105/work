<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2017-12-21 20:42:44 --> Query error: Column 'warehouse_id' in where clause is ambiguous - Invalid query: SELECT DATE_FORMAT(date, '%Y-%m-%d %T') as date, reference, sma_expense_categories.name as category, amount, note, CONCAT(sma_users.first_name, ' ', sma_users.last_name) as user, attachment, sma_expenses.id as id
FROM `sma_expenses`
LEFT JOIN `sma_users` ON `sma_users`.`id`=`sma_expenses`.`created_by`
LEFT JOIN `sma_expense_categories` ON `sma_expense_categories`.`id`=`sma_expenses`.`category_id`
WHERE `warehouse_id` = '1'
GROUP BY `sma_expenses`.`id`
ORDER BY `date` DESC
 LIMIT 10
ERROR - 2017-12-21 20:42:56 --> Query error: Column 'warehouse_id' in where clause is ambiguous - Invalid query: SELECT DATE_FORMAT(date, '%Y-%m-%d %T') as date, reference, sma_expense_categories.name as category, amount, note, CONCAT(sma_users.first_name, ' ', sma_users.last_name) as user, attachment, sma_expenses.id as id
FROM `sma_expenses`
LEFT JOIN `sma_users` ON `sma_users`.`id`=`sma_expenses`.`created_by`
LEFT JOIN `sma_expense_categories` ON `sma_expense_categories`.`id`=`sma_expenses`.`category_id`
WHERE `warehouse_id` = '1'
GROUP BY `sma_expenses`.`id`
ORDER BY `date` DESC
 LIMIT 10
