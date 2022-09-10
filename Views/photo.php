<div class="row w-100 d-flex justify-content-center">
    <div class="col-6">
        <div class="thumbnail">
            <div class="profile">
                <div class="d-flex justify-content-between ">
                    <div class="d-flex align-items-center">
                        <img src="<?="./".$profile->fichier?>" sclass="mx-3 mt-2" />
                        <div class="">
                            <bold><?php echo $photo->proprietaire ;?> <small><?php echo $photo->date_photo ;?></small>
                            </bold>
                        </div>
                    </div>
                    <?php if($user->login==$photo->proprietaire){?>
                    <div class="dropdown m-1 btn-sm">
                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Options
                        </a>
                        
                             <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                             <li><a class="dropdown-item" href= "<?="modifie_photo?id=".$photo->id."&personne=".$photo->proprietaire?>">Modifier</a></li>
                             <li><a class="dropdown-item" href= "<?="supprimerphoto?id=".$photo->id?>">Supprimer</a></li>
                         </ul>

                         
                       
                    </div>
                    <?php } ?>
                </div>



                <div class="mx-2 mt-2">
                    <small><?php echo $photo->description;?></small>

                </div>

            </div>
            <img src=<?php echo"./".$photo->fichier?>>
            <div class="hero">
                <div class="count"></div>
                <div class="fade"></div>
            </div>
            <div class="m-3">
                <form action=<?="photo?id=".$_GET['id']."&personne=".$_GET['personne']?> method="post" >
                    <input name="comment" type="text" id="commentvalue"class="form-control" placeholder="Add a comment" aria-label="Recipient's username"
                        aria-describedby="basic-addon2">
                    <input type="hidden" name="id_photo" value=<?php echo $photo->id ;?>>
                    <input type="hidden" name="auteur" value=<?php echo $user->login;?>>
                    
                    <input name="add_comment"  class="btn btn-dark btn-sm m-1"  onclick="getUsers('<?php echo $photo->id ;?>','<?= $user->login;?>','<?= $photo->proprietaire ?>')" value="comment">
                </form>
            </div>


            <!--photo Comments  -->

            <!-- end photo Comments -->
            <div class="comments">
                <?php
                      foreach($commentaires as $key=>$commentaire){
                        ?>
                <button>Comment</button>
                <div class="comment">
                    <img src="<?php echo $commentaire->profile?>" />
                    <div class="d-flex justify-content-between">
                        <div class="text">
                            <strong><?php echo $commentaire->auteur?></strong>  <br/><?php echo $commentaire->contenu?>
                            <br />
                        </div>
                        <?php if($user->login==$photo->proprietaire){?>
                        <div class="text" style="cursor:pointer;"><i class="fa-solid fa-ban fa-2x" onclick="deleteComment(this,<?php echo $commentaire->id?>)"></i></div>
                        <?php } ?>
                    </div>
                   
                </div>
                <?php 
                      }
                    ?>

            </div>

            <script>
function getUsers(a,b,c) {
    var xmlhttp = new XMLHttpRequest();
     xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200)
    document.querySelector(".comments").insertAdjacentHTML('afterbegin',xmlhttp.response);
     
     }
    const comment = document.querySelector("#commentvalue").value
    xmlhttp.open("POST", "http://localhost:8000/photo?comment="+comment+"&id_photo="+a+"&auteur="+b+"&prop="+c , true);
     xmlhttp.send();
  }

function deleteComment(target,id){
    var xmlhttp = new XMLHttpRequest();
     xmlhttp.onreadystatechange = function() {
        target.parentElement.parentElement.parentElement.style.display = "none";  
    }
    xmlhttp.open("POST", "http://localhost:8000/deletecomment?id="+id , true);
     xmlhttp.send();
}

</script>
