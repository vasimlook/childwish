<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:index.html');
    exit;
}
/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simple to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */
// DB table to use

$table = 'withdrawl_req wr';
// Table's primary key
$primaryKey = 'wr.withdrawl_req_id';
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(      
    array('db' => 'wr.withdrawl_req_id', 'dt' =>'withdrawl_req_id'),
    array('db' => 'wr.amount', 'dt' =>'amount'),
    array('db' => 'wr.refCustomer_id', 'dt' =>'refCustomer_id'),    
    array('db' => 'hc.customer_first_name', 'dt' =>'customer_first_name'),        
    array('db' => 'hc.customer_last_name', 'dt' =>'customer_last_name'),
    array('db' => 'hc.customer_id', 'dt' =>'customer_id'),
    array('db' => 'hc.user_unique_id', 'dt' =>'user_unique_id')
   
);
include 'conn.php';

$where=" wr.status=0 ";

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
require('ssp.class.php');
echo json_encode(
       SSP::withdrawal_req_list($_REQUEST, $sql_details, $table, $primaryKey, $columns,$where)
);


