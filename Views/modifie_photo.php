<h1>Modifier</h1>

<div class="row w-100 d-flex justify-content-center">
    <div class="col-6">
        <div class="thumbnail">
            <div class="profile">
                <div class="d-flex justify-content-between ">


                </div>


            </div>
            <img src=<?php echo "./" . $photo->fichier ?>>
            
            <div class=" mb-3 mt-2 mx-2">
                <form action=<?="photo?id=".$photo->id?> method="post" >
                    <div class="mb-2">
                        <label class="form-label">Description de la photo:</label>
                        <textarea name="description" class="form-control" 
                           rows="7" cols="80"><?php echo $photo->description;?></textarea>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Date de la photo:</label>
                        <input type="date" name="date" value=<?= $photo->date_photo ;?> class="form-control">
                        <input  type="hidden" name="id" value=<?= $photo->id ;?> class="form-control">
                        <input  type="hidden" name="personne" value="<?=$personne?>" class="form-control">

                    </div>
                    <div class="mb-2">

                            <input type="submit"  name="modifier_photo" class="btn btn-primary" value="save changes">
                    </div>
                </form>

            </div>


        </div>