<?php
ini_set("display_errors",1);
error_reporting(E_ALL);
include_once("config/configClass.php");

class Employee extends connect_db {
    
    public $data = array();
    public $value;
    public $error;
    public $saveFlag;
    public $query;
    public $recs;
    public $row;
    public $id;
    public $ress_arr = array();
    
    //file upload properties
    
    public $currentDir;
    public $uploadDirectory;
    public $allowed_fileExtensions;
    public $fileName;
    public $fileSize;
    public $fileTmpName;
    public $fileType;
    public $ext;
    public $fileExtension;
    public $uploadPath;
    public $img_path;
    
    
    public function __construct(){
        parent::__construct();
    }
    
    
    
    
    public function create_recs($data){
        //
       if($this->validate_recs($data)){// this checks if the valifation has been done on all inputs and return true
        $this->data  = $this->validate_recs($data);
        
         $this->query = "INSERT INTO employee_table (firstname,lastname,email,phone,gender,pword,squestion,sanswer,image) 
                        
                        VALUES ('{$this->data['fname']}',
                                '{$this->data['lname']}',
                                '{$this->data['email']}',
                                '{$this->data['phone']}',
                                '{$this->data['gender']}',
                                '{$this->                                                 data['pword']}',
                                '{$this->data['squestion']}',
                                '{$this->data['sanswer']}',
                                '{$this->data['imgUpload']['name']}')";
                   
        //echo $this->query;die();
    $this->recs  = mysqli_query($this->db_connect,$this->query);
        if(mysqli_affected_rows($this->db_connect)){
            
            move_uploaded_file($this->fileTmpName, $this->uploadPath);
            
            echo "<script>alert('Record saved succesfully..Redirecting in 5 seconds')</script>";
            //header("location:index.html");
            header("refresh:2; url=http://localhost/crud_oop/show.php");
        }else{
            echo "Ooops! Record Could not be saved ".mysqli_error($this->db_connect);
        }
        
       }
        
    }
    
   
    
    
    public function read_recs(){
        
        $this->query = "SELECT * FROM employee_table WHERE 1 = 1 ORDER BY 'id' DESC";
        
        $this->recs = mysqli_query($this->db_connect,$this->query);
        
        if (mysqli_num_rows($this->recs) > 0 ){
            while ($this->row = mysqli_fetch_assoc($this->recs)){
                $this->ress_arr[] = $this->row;
            }
            return $this->ress_arr;
        }
        else{
            return "Ooops! Record Not Found";
        }
    }
    
    
     
    public function read_one_rec($id){
        
        $this->id = $id;
        $this->query = "SELECT * FROM employee_table WHERE id = '$this->id' ";
        
        $this->recs = mysqli_query($this->db_connect,$this->query);
        
        if (mysqli_num_rows($this->recs) > 0 ){
           $this->row = mysqli_fetch_assoc($this->recs);
              return $this->row;
        }
        else {
            return "Ooops No Records Found";
        }
            
    }
    
    
    
    public function update_recs($id, $data){
        
        
        
        $this->id = $id;
        
        if($this->validate_recs($data)){// this checks if the valifation has been done on all inputs and return true
         //trying to remove the associated image uploaded earlier with the record 
          $this->query = "SELECT image FROM employee_table WHERE id = '$this->id' ";
        
            $this->recs = mysqli_query($this->db_connect,$this->query);
            
            if (mysqli_num_rows($this->recs) > 0 ){
               $this->row = mysqli_fetch_assoc($this->recs);
                  if($this->row['image'] != ""){
                    $this->currentDir = getcwd();
                    $this->img_path = $this->currentDir."\\image\\".$this->row['image'];
                    unlink($this->img_path);
                  }
            }
            
             $this->data  = $this->validate_recs($data);
             $this->query = "UPDATE employee_table 
             
                            SET 
                                    firstname       =  '{$this->data['fname']}',
                                    lastname        =  '{$this->data['lname']}',
                                    email           =  '{$this->data['email']}',
                                    phone           =  '{$this->data['phone']}',
                                    gender          =  '{$this->data['gender']}',
                                    pword           =  '{$this->data['pword']}',
                                    squestion       =  '{$this->data['squestion']}',
                                    sanswer         =  '{$this->data['sanswer']}',
                                    image           =  '{$this->data['imgUpload']['name']}' 
                            
                            WHERE 
                                    id              =   '$this->id'  ";
                       
      //echo "qry =  $this->query";die();
      //print_r($this->db_connect);
        $this->recs  = mysqli_query($this->db_connect,$this->query);
            if(mysqli_affected_rows($this->db_connect)){
                move_uploaded_file($this->fileTmpName, $this->uploadPath);
                echo "<script>alert('Record updated succesfully..Redirecting in 5 seconds')</script>";
                //header("location:index.html");
                header("refresh:1; url=http://localhost/crud_oop/show.php");die();
            }else{
                echo "Ooops! Record Could not be updated ".mysqli_error($this->db_connect);
            }
            
           }
    }
    
    
    
    public function delete_recs($id){
        
        $this->id = $id;
        
        $this->query = "SELECT image FROM employee_table WHERE id = '$this->id' ";
        
            $this->recs = mysqli_query($this->db_connect,$this->query);
            
            if (mysqli_num_rows($this->recs) > 0 ){
               $this->row = mysqli_fetch_assoc($this->recs);
                  if($this->row['image'] != ""){
                    $this->currentDir = getcwd();
                    $this->img_path = $this->currentDir."\\image\\".$this->row['image'];
                    unlink($this->img_path);
                  }
            }
        
        $this->query = "DELETE FROM employee_table WHERE id = '$this->id'";
        
        //echo $this->query;die;

        $this->recs = mysqli_query($this->db_connect,$this->query);
        
        if ( mysqli_affected_rows($this->db_connect) ){
            header("location:show.php");
        }
    }
    
    public function validate_recs($arr){
        
               $this->data = $arr;
     //Assiging form input values to variables
   
               $this->data['fname']          = $this->data['fname']       != ""   ?   $this->test_input($this->data['fname'])    : "";
               $this->data['lname']          = $this->data['lname']       != ""   ?   $this->test_input($this->data['lname'])    : "";
               $this->data['phone']          = $this->data['phone']       != ""   ?   $this->test_input($this->data['phone'])       : ""; 
               $this->data['email']          = $this->data['email']       != ""   ?   $this->test_input($this->data['email'])       : ""; 
               $this->data['pword']          = $this->data['pword']       != ""   ?   $this->test_input($this->data['pword'])    : ""; 
               $this->data['cpword']         = $this->data['cpword']      != ""   ?   $this->test_input($this->data['cpword'] )  : ""; 
               $this->data['gender']         = $this->data['gender']      != ""   ?   $this->test_input($this->data['gender'])  : ""; 
               $this->data['squestion']      = $this->data['squestion']   != ""   ?   $this->test_input($this->data['squestion'])  : "";
               $this->data['sanswer']        = $this->data['sanswer']     != ""   ?   $this->test_input($this->data['sanswer'])  : "";
               
               //Start Validation
               $this->saveFlag    = true; //iniatialise save flag to true 
               $this->error       = "";
               
               if($this->data['fname']  == ""){
                    $this->error  .= "Firstname cannot be empty <br>";
                    $this->saveFlag = false;
               }
               
                if($this->data['lname']  == ""){
                    $this->error  .= "Lastname cannot be empty <br>";
                    $this->saveFlag = false;
               }
               
               if(!filter_var($this->data['email'],FILTER_VALIDATE_EMAIL)){
                    $this->error  .= "Invalid Email<br>";
                    $this->saveFlag = false;
               }
               
               
               if($this->data['phone'] == ""){
                    $this->error .= "Phone number cannot be empty <br>";
                    $this->saveFlag = false;
               }
               
                //echo "phone xter length = ".strlen($phone);die("wait...");
               if ($this->data['phone'] != "" && !preg_match("/[0-9]/",$this->data['phone'])){
                    $this->error  .= "Phone number can only contain numbers <br>";
                    $this->saveFlag = false;
               }
                
               if(strlen($this->data['phone']) != 11){
                $this->error  .= "Invalid Phone number length<br>";
                $this->saveFlag = false;
               }
               
                if($this->data['pword'] == ""){
                    $this->error .= "Phone number cannot be empty <br>";
                    $this->saveFlag = false;
               }
               
               if($this->data['pword'] != "" && strlen($this->data['pword']) < 8){
                    $this->error  .= "Password xter length too short<br>";
                    $this->saveFlag = false;
               }
             
               if($this->data['gender'] == ""){
                    $this->error  .= "Pls Select your gender<br>";
                    $this->saveFlag = false;
               }
               
               
               //File Upload Validation
               $this->currentDir = getcwd();
               $this->uploadDirectory = "/image/";
               $this->allowed_fileExtensions = ['jpeg','jpg','png','gif']; // get all the file extensions
               $this->fileName = $this->data['imgUpload']['name'];
               $this->fileSize = $this->data['imgUpload']['size'];
               $this->fileTmpName = $this->data['imgUpload']['tmp_name'];
               $this->fileType = $this->data['imgUpload']['type'];
               
               $this->ext = explode('.',$this->fileName);
               $this->fileExtension = strtolower(end($this->ext));
               //echo "file ext = ". $this->fileExtension;die;
               $this->uploadPath = $this->currentDir . $this->uploadDirectory . basename($this->fileName);
               
               if(!in_array($this->fileExtension,$this->allowed_fileExtensions)){
                    $this->error.="This file Extension is not allowed. Please upload a JPEG or PNG or GIF file<br>";
                    $this->saveFlag = false;
               }
               
               if ($this->fileSize > 2000000){
                    $this->error.= "This file is more than 2MB. Sorry, it has to be less than or equal to 2MB<br>";
                    $this->saveFlag = false;
               }
               
               
               
              
               if($this->saveFlag){
                return $this->data;
               }
               else{
                    echo "<h2>There are some errors in your inputs: Check below for details</h2><br>";
                    echo "<div style='background:#ffcccc;padding:15px;border-radius:10px;'>".$this->error."</div>";
                    return false;
               }
        
    }
    
    
    public function test_input($value){
        $this->value = $value;
        $this->value = trim($this->value);
        $this->value = stripslashes($this->value);
        $this->value = htmlspecialchars($this->value);
        return $this->value;
        
    }
}
?>