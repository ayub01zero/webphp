<?php
require_once('dashhead.php');
$allfeedback = countData("SELECT * FROM feedback");
?>

 <div class="container mt-5 d-flex justify-content-center mb-4">
    <div class="row d-flex justify-content-center">
        <div class="col-md-10">
            <div class="text-left">
                <h6>All Feedback(<?php echo $allfeedback; ?>)</h6>
            </div>
            <?php

          $fetchdata = allData("SELECT * FROM feedback");
          foreach($fetchdata as $allmydatadeed){
            $useremail = $allmydatadeed['user_email'];    
            $usersubject = $allmydatadeed['fed_subject'];  
            $usermesssage = $allmydatadeed['fed_message'];  
            $usernameacc = $allmydatadeed['full_name'];
            $userdate = $allmydatadeed['datetime'];  
        
            ?>
            
            <div class="card p-3 mb-2">
                
                <div class="d-flex flex-row">
                    <div class="d-flex flex-column ms-2">
                        <h5 class="mb-1 text-primary"><?php echo $usernameacc; ?></h5>
                        <h6> <?php echo $usersubject;  ?></h6>
                        <p class="comment-text"><?php echo $usermesssage; ?></p>
                    </div>
                </div>
                
                <div class="d-flex justify-content-between">
                    <div class="d-flex flex-row gap-3 align-items-center">
                        <div class="d-flex align-items-center">
                            <span class="ms-1 fs-10"><?php  echo $useremail; ?></span>
                        </div>
                        
                
                    </div>
                    
                    <div class="d-flex flex-row">
                        <span class="text-muted fw-normal fs-10"><?php  echo $userdate;  ?></span>
                    </div>

                </div>
            </div>           
<?php
          }
          ?>
       </div> 
    </div>
</div>

<?php
require_once('dashfoot.php');
?>



