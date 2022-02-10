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

$table = 'hpshrc_customer hc';
// Table's primary key
$primaryKey = 'hc.customer_id';
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(      
    array('db' => 'hc.customer_id', 'dt' =>'customer_id'),
    array('db' => 'hc.user_unique_id', 'dt' =>'user_unique_id'),
    array('db' => 'hc.customer_first_name', 'dt' =>'customer_first_name'),
    array('db' => 'hc.customer_email_password', 'dt' =>'customer_email_password'),    
    array('db' => 'hc.customer_last_name', 'dt' =>'customer_last_name'),    
    array('db' => 'hc.customer_gender', 'dt' =>'customer_gender'),    
    array('db' => 'hc.customer_mobile_no', 'dt' =>'customer_mobile_no'),
    array('db' => 'hc.customer_email_id', 'dt' =>'customer_email_id'),
    array('db' => 'hc.customer_email_verified_status', 'dt' =>'customer_email_verified_status'),
    array('db' => 'hc.customer_locked_status', 'dt' =>'customer_locked_status'),
    array('db' => 'hc.customer_status', 'dt' =>'customer_status') 
   
);
include 'conn.php';
$customer_id=$_REQUEST['customer_id'];
$where=" refCustomer_id='$customer_id' ";

//if(!empty($_REQUEST['search']['value'])){
//    $value=$_REQUEST['search']['value'];
//    $where.=" (hc.category_title LIKE '%$value%' OR hc1.category_title LIKE '%$value%' OR huf.upload_file_title LIKE '%$value%' OR huf.upload_file_desc LIKE '%$value%' OR huf.upload_file_original_name LIKE '%$value%' OR huf.upload_file_status LIKE '%$value%') ";
//}

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
require('ssp.class.php');
echo json_encode(
       SSP::customers_view($_REQUEST, $sql_details, $table, $primaryKey, $columns,$where)
);


