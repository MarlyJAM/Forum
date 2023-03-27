<?php 
    session_start();
    require('actions/questions/showArticleContentAction.php'); 
    require('actions/questions/postAnswerAction.php'); 
    require('actions/questions/allAnswersOfAQuestion.php'); 

?>
<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php'; ?>
<body>
    
    <?php include 'includes/navbar.php'; ?>
    <br><br>

    <div class="container">


        <?php 
            if(isset($errorMsg)){ echo $errorMsg; }


            if(isset($question_publication_date)){
                ?>

                   <section class="show-content"><h3><?= $question_title; ?></h3>
                    <hr>
                    <p><?= $question_content; ?></p>
                    <hr>
                    <small><?= $question_pseudo_author , $question_publication_date; ?></small>
                    </section>
                    
                    <section class="show-answers">
                        
                        <?php
                        
                        if (isset($_SESSION['auth'])) {
                            
                        ?>
                            <form class="form-group" method="POST">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Réponse :</label>
                                <textarea name="answer" class="form-control"></textarea>
                                <button class="button-answer" type="submit" name='validate'> Répondre </button>

                            </div>
                            </form> 
                        <?php
                        
                        }
                        ?> 
                  
                        <?php 
                        
                        
                        # code...
                            while ($answers = $getAllAnswersOfAQuestion->fetch() ) {
                                ?>
                                
                                
                                <div class="ans-g">

                                <div class="asn-pseudo">
                                
                                      <?= $answers['pseudo_author']  ?>

                                </div>
                                <div class="ans-rps">

                                 <?= $answers['contents'] ?>

                                </div>
                                </div>

                                
                                
                                
                                <?php
                                
                            }
   
                            
                            ?>
                    </section>


                <?php
            }
        ?>


    </div>

</body>
</html>