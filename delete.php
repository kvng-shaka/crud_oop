<?php

include_once("class/EmployeeClass.php");


if(isset($_GET['id'])){
    $id  =  $_GET['id']   !=   ""   ?    $_GET['id']    :   "";
//
    $employee =  new Employee();
    $employee_rec = $employee->delete_recs($id);
}    

?>

