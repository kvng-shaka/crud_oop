<?php

include_once("class/EmployeeClass.php");

$employees = new Employee();
$select_res = $employees->read_recs();



?>

<!DOCTYPE html>
<html>
<head>
<style>
.panel-table .panel-body{
  padding:0;
}

.panel-table .panel-body .table-bordered{
  border-style: none;
  margin:0;
}

.panel-table .panel-body .table-bordered > thead > tr > th:first-of-type {
    text-align:center;
    width: 100px;
}

.panel-table .panel-body .table-bordered > thead > tr > th:last-of-type,
.panel-table .panel-body .table-bordered > tbody > tr > td:last-of-type {
  border-right: 0px;
}

.panel-table .panel-body .table-bordered > thead > tr > th:first-of-type,
.panel-table .panel-body .table-bordered > tbody > tr > td:first-of-type {
  border-left: 0px;
}

.panel-table .panel-body .table-bordered > tbody > tr:first-of-type > td{
  border-bottom: 0px;
}

.panel-table .panel-body .table-bordered > thead > tr:first-of-type > th{
  border-top: 0px;
}

.panel-table .panel-footer .pagination{
  margin:0; 
}

/*
used to vertically center elements, may need modification if you're not using default sizes.
*/
.panel-table .panel-footer .col{
 line-height: 34px;
 height: 34px;
}

.panel-table .panel-heading .col h3{
 line-height: 30px;
 height: 30px;
}

.panel-table .panel-body .table-bordered > tbody > tr > td{
  line-height: 34px;
}


</style>

<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
</head>
<body>


<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>

<div class="container">
    <div class="row">
    
    <h1>RECORDS</h1>
    
    
        <div class="col-md-10 col-md-offset-1">

            <div class="panel panel-default panel-table">
              <div class="panel-heading">
                <div class="row">
                  <div class="col col-xs-6">
                    <h3 class="panel-title">&nbsp;</h3>
                  </div>
                  <div class="col col-xs-6 text-right">
                    <a href="index.php"><button type="button">Create New</button></a>
                  </div>
                </div>
              </div>
              <div class="panel-body"> 
              <?php
                 if(is_array($select_res) && !empty($select_res)){ ?>
                <table class="table table-striped table-bordered table-list" width="100%">
                  <thead>
                    <tr>
                        <th><em class="fa fa-cog"></em></th>
                        <th class="hidden-xs">ID</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Gender</th>
                        <th>password</th>
                        <th>photo</th>
                    </tr> 
                  </thead>
                  <?php
                    }  
                    ?>
                    <?php
                       $x = 1;
                       foreach($select_res as $row){
                            $id         = $row['id'];
                            $fullname   = $row['firstname'];
                       
                        ?>
                  <tbody>
                          <tr>
                            <td align="center">
                              <a href="edit.php?id=<?php echo $row['id']?>" class="btn btn-primary" title="Edit"><em class="fa fa-edit"></em></a>
                              <a href= "#" onclick='show_alert(<?php echo json_encode($id);?> , <?php echo json_encode($fullname);?>)' class="btn btn-danger" title="Delete"><em class="fa fa-trash"></em></a>
                              <!-- <a href="view.php?id=<?php echo $row['id']?>"class="btn btn-success" title="View"><em class="fa fa-eye"></em></a> -->
                            </td>
                            <td class="hidden-xs"><?=$x?></td>
                            <td><?=$row['firstname']?></td>
                            <td><?=$row['lastname']?></td>
                            <td><?=$row['email']?></td>
                            <td><?=$row['phone']?></td>
                            <td><?=$row['gender']?></td>
                            <td><?=$row['pword']?></td>
                            <td><img src="image/<?php if(isset($row['image']) && $row['image'] != "") echo $row['image']; else echo "noimage.jpg";?>" width="150px" height="150px" /></td>
                          </tr>
                        </tbody>
                    
                      <?php
                      $x++;
                      }
                      
                      ?>
                </table>
            
              </div>
              
            </div>

</div>
</div>
</div>
<script>
function show_alert(idno,fullname){
    
    var actn = confirm("Do you really want to delete ("+fullname+") from the list");
    if (actn == true){
        location.href = "delete.php?id="+idno;
    }
}
</script>


</body>


