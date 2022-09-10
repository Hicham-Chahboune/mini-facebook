

                    <?php foreach($photos as $key=>$photo){ ?>
                    <div class="col">
                        <a href=<?="photo?id=".$photo->id."&personne=".$personne?>><img class="gallery-item"
                                src=<?="./".$photo->fichier?> alt=""></a>
                    </div>
                    <?php } ?>

   