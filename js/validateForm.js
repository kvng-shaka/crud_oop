function passconfirm_verify(){
      //password validation  
       var password =  document.forms['empform']['pword'].value; 
       var cpassword =  document.forms['empform']['cpword'].value; 
       
         if( password != ""  && password != cpassword){
            alert("The two passwords do not match: Pls! Re enter password");
            document.forms['empform']['pword'].value  = ""; 
            document.forms['empform']['cpword'].value = ""; 
            document.forms['empform']['pword'].focus();
            return false;
         }  
  }