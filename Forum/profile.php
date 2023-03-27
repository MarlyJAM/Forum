<?php 
    session_start(); 
    require('actions/users/showProfils.php');

?>
<!DOCTYPE html>
<html lang="en">


<?php include 'includes/head.php'; ?>

<body>
<?php include 'includes/navbar.php'; ?>

<?php 
    if (isset($errorMsg)) {
         
        echo $errorMsg;
    }

    if (isset($getThisQuestions)) {
       
        ?>
        <div class="myInfos">
            <div class="myname">
                <h3>  <?= $users_pseudo;?></h3> 
                <p>  <?= $users_name;?></p>

            </div>
        </div>
        <?php 
        while($question=$getThisQuestions->fetch()){

            ?>
            <div class="myquestions">
                <div class="thistitle"> <?= $question['title'] ;?></div> 
                <div class="thisdescrption"> <?= $question['description'] ;?></div> 
                <div class="thiscontent"> <?=  $question['content'] ;?>
                <div class="thisdate"> <?=  $question['publication_date'] ;?>
            </div>
            
            
            <?php 

        }

    }
   

?>


<p></p>




    
</body>
</html>
