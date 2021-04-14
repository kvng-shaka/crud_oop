<?php
include_once("class/EmployeeClass.php");

if(isset($_GET['id'])){
    $id  =  $_GET['id']   !=   ""   ?    $_GET['id']    :   "";
//
    if(isset($_FILES['imgUpload'])){
        $_POST['imgUpload'] = $_FILES['imgUpload'];
    }
    $employee =  new Employee();
    $employee_rec = $employee->read_one_rec($id);
    
     /*$employee =  new Employee();
     $delete_rec = $employee->delete_recs($id); 
    */
    
    $firstname      = $employee_rec['firstname']    !=   ""  ?  $employee_rec['firstname']  :   "";
    $lastname       = $employee_rec['lastname']     !=   ""  ?  $employee_rec['lastname']   :   "";
    $email          = $employee_rec['email']        !=   ""  ?  $employee_rec['email']      :   "";
    $pword          = $employee_rec['pword']        !=   ""  ?  $employee_rec['pword']      :   "";
    $phone          = $employee_rec['phone']        !=   ""  ?  $employee_rec['phone']      :   "";
    $gender         = $employee_rec['gender']       !=   ""  ?  $employee_rec['gender']     :   "";
    $squestion      = $employee_rec['squestion']    !=   ""  ?  $employee_rec['squestion']  :   "";
    $sanswer        = $employee_rec['sanswer']      !=   ""  ?  $employee_rec['sanswer']    :   "";
    $image          = $employee_rec['image']        !=   ""  ?  $employee_rec['image']      :   "";
}   
    
    if(isset($_FILES['imgUpload'])){
        $_POST['imgUpload'] = $_FILES['imgUpload'];
    }
    
    if (isset($_POST['update'])){
        
       $new_emp =  new Employee();
       $update_rec = $new_emp->update_recs($_POST['id'], $_POST); 
    }
    

?>
<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.grid.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.grid.min.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.reboot.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.reboot.min.css">
	<link rel="stylesheet" id="font-awesome-css" href="bootstrap/css/font-awesome.min.css" type="text/css" media="all">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style>
.register{
    background: -webkit-linear-gradient(left, #3931af, #00c6ff);
    margin-top: 3%;
    padding: 3%;
}
.register-left{
    text-align: center;
    color: #fff;
    margin-top: 4%;
}
.register-left input{
    border: none;
    border-radius: 1.5rem;
    padding: 2%;
    width: 60%;
    background: #f8f9fa;
    font-weight: bold;
    color: #383d41;
    margin-top: 30%;
    margin-bottom: 3%;
    cursor: pointer;
}
.register-right{
    background: #f8f9fa;
    border-top-left-radius: 10% 50%;
    border-bottom-left-radius: 10% 50%;
}
.register-left img{
    margin-top: 15%;
    margin-bottom: 5%;
    width: 25%;
    -webkit-animation: mover 2s infinite  alternate;
    animation: mover 1s infinite  alternate;
}
@-webkit-keyframes mover {
    0% { transform: translateY(0); }
    100% { transform: translateY(-20px); }
}
@keyframes mover {
    0% { transform: translateY(0); }
    100% { transform: translateY(-20px); }
}
.register-left p{
    font-weight: lighter;
    padding: 12%;
    margin-top: -9%;
}
.register .register-form{
    padding: 10%;
    margin-top: 10%;
}
.btnRegister{
    float: right;
    margin-top: 10%;
    border: none;
    border-radius: 1.5rem;
    padding: 2%;
    background: #0062cc;
    color: #fff;
    font-weight: 600;
    width: 50%;
    cursor: pointer;
}
.register .nav-tabs{
    margin-top: 3%;
    border: none;
    background: #0062cc;
    border-radius: 1.5rem;
    width: 28%;
    float: right;
}
.register .nav-tabs .nav-link{
    padding: 2%;
    height: 34px;
    font-weight: 600;
    color: #fff;
    border-top-right-radius: 1.5rem;
    border-bottom-right-radius: 1.5rem;
}
.register .nav-tabs .nav-link:hover{
    border: none;
}
.register .nav-tabs .nav-link.active{
    width: 100px;
    color: #0062cc;
    border: 2px solid #0062cc;
    border-top-left-radius: 1.5rem;
    border-bottom-left-radius: 1.5rem;
}
.register-heading{
    text-align: center;
    margin-top: 8%;
    margin-bottom: -15%;
    color: #495057;
}

</style>
</head>
<body>

<!------ Include the above in your HEAD tag ---------->

<div class="container register">
                <div class="row">
                    <div class="col-md-3 register-left">
                        <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt=""/>
                        <h3>Welcome</h3>
                        <p>You are 30 seconds away from earning your own money!</p>
                        <input type="submit" name="" value="Login"/><br/>
                    </div>
                    <div class="col-md-9 register-right">
                        <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Employee</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Hirer</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <h3 class="register-heading">Apply as a Employee</h3>
                                <form name="empform" enctype="multipart/form-data"  action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
                                
                               
                                <div class="row register-form">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="hidden" class="form-control"  name="id" value="<?=$id?>" />
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="First Name *" value="<?=$firstname?>" name="fname" />
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Last Name *" value="<?=$lastname?>" name="lname"  />
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="pword" placeholder="Password  *" value="<?=$pword?>" />
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="cpword" onmouseout="passconfirm_verify()" value="<?=$pword?>"  placeholder="Confirm Password *" />
                                        </div>
                                        <div class="form-group">
                                            <div class="maxl">
                                                <label class="radio inline">
                                                <?php
                                                 if($gender == "male"){  ?> 
                                                    <span> Male </span>
                                                    <input type="radio" name="gender" value="male" checked>
                                                    <span>Female </span>
                                                    <input type="radio" name="gender" value="female">
                                                     
                                               
                                                <?php  }  ?>
                                                
                                                <?php 
                                                if ($gender == "female"){  ?>  
                                                    <span> Male </span>
                                                    <input type="radio" name="gender" value="male">
                                                    <span>Female </span>
                                                    <input type="radio" name="gender" value="female" checked>
                                                     
                                                
                                                <?php  }  ?>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="email" class="form-control" name="email" placeholder="Your Email *" value="<?=$email?>"/>
                                        </div>
                                        <div class="form-group">
                                            <input type="text"  name="phone" class="form-control" placeholder="Your Phone *" value="<?=$phone?>"/>
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control" name="squestion">
                                            <?php
                                                $desc = "";
                                                switch ($squestion){
                                                    case "qphone":
                                                        $desc = "What is Your old Phone Number";
                                                        break;
                                                    case "qbod":
                                                        $desc = "What is your Birthdate?";
                                                        break;
                                                    case "qname":
                                                        $desc = "What is your Pet Name?";
                                                        break;
                                                    default:
                                                        $desc = "Nothing To Show";  
                                                }
                                                
                                                if ($squestion != ""){
                                            
                                            ?>
                                                <option value="<?=$squestion?>" selected="selected"><?=$desc?>"</option>
                                            <?php } ?>
                                                <option value="">Please select your Sequrity Question</option>
                                                <option value="qbod">What is your Birthdate?</option>
                                                <option value="qphone">What is Your old Phone Number</option>
                                                <option value="qname">What is your Pet Name?</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Enter Your Answer *" value="<?=$sanswer?>" name="sanswer" value="" />
                                        </div>
                                        <div class="form-group">
                                        <img src="image/<?=$image?>" width="120px; height=120px"/>
                                            <p>
                                            Select File to upload:
                                                <input type="file" name="imgUpload" />
                                            </p>
                                        </div>
                                        <input type="submit" class="btnRegister" name="update" value="Update"/>
                                    </div>
                                </div>
                            </form>
                            </div>
                            
                        </div>
                    </div>
                </div>

            </div>
<script src="js/validateForm.js"></script>
</body>
</html>
