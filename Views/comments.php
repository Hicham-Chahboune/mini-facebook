                <div class="comment">
                    <img src="<?php echo $commentaire->profile?>" />
                    <div class="d-flex justify-content-between">
                        <div class="text">
                            <strong><?php echo $commentaire->auteur?></strong>  <br/><?php echo $commentaire->contenu?>
                            <br />
                        </div>
                        <?php if( $prop==$commentaire->auteur){?>
                            <div class="text" style="cursor:pointer;"><i class="fa-solid fa-ban fa-2x" onclick="deleteComment(this,<?php echo $commentaire->id?>)"></i></div>
                       <?php } ?>
                   </div>
                   
                </div>
               
