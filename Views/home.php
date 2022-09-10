<button class="btn btn-secondary my-2 mx-2 my-sm-0" data-bs-toggle="modal" data-bs-target="#profile">Profile</button>
<div class="container mt-3">
    <form autocomplete="off">
        <div class="finder">
            <div class="finder__outer">
                <div class="finder__inner">
                    <div class="finder__icon" ref="icon"></div>
                    <input class="finder__input" type="text" onkeyup="getUsers(this.value)" name="q" />
                </div>
            </div>
        </div>
    </form>
</div>
<section id="testimonials" class="testimonials">
    <div class="container-fluid">
        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
            <div class="swiper-wrapper">
                <div class="row ajaxInject">
              <?php foreach ($users as $user) { ?>
                        <div class="swiper-slide col-3">
                        <div class="testimonial-wrap">
                            <div class="testimonial-item">

                                <img src="./<?=$user->profile?>" class="testimonial-img" alt="">
                                <h3><a href="photos_personne?personne=<?=$user->login?>"><?=$user->login?></a></h3>
                                <h4><?=$user->metier?></h4>
                                <p>
                                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                    <?=$user->desc_user?>
                                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                </p>
                            </div>
                        </div>
                    </div>
                    
           <?php } ?>

                </div>
            </div>
        </div>

    </div>
</section>

<!-- floating + -->
<button type="button" class="float" data-bs-toggle="modal" data-bs-target="#exampleModal">
    <img src="./vendor/img/plus.svg" class="w-50" alt="">
</button>


<div class="modal fade" id="profile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="modifier_profile" method="POST" enctype="multipart/form-data" name="add_photo">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ajouter une photo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Fichier de la photo: <input type="file" name="phphto"  size=30></p>

                    <p>Metier :
                     <input type="text" name="metier" value="<?=$me->metier;?>" class="form-control">
                    
                     <p>Description:
                     <input type="text" class="form-control" value="<?=$me->desc_user;?>" maxlength="50" name="description">
                    
                    </p>
                    <input type="hidden" name="proprietaire" value="<?=$me->login?>">
                    <input type="hidden" name="idphoto" value="<?= $me->idPhoto ?>">

                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Ajouter la photo</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="ajoute_photo" method="POST" enctype="multipart/form-data" name="add_photo">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ajouter une photo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Fichier de la photo: <input required type="file" name="photo" size=30></p>
                    <p>Description de la photo:</p>
                    <p><textarea name="description" placeholder="Entrez la description de la photo ici" rows="10"
                            cols="55"></textarea></p>
                    <p>Date de la photo:
                        <input type="date" name="date">
                    </p>
                    <input type="hidden" name="proprietaire" value="<?=$me->login?>">
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Ajouter la photo</button>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
function getUsers(str) {

   var xmlhttp = new XMLHttpRequest();
   xmlhttp.onreadystatechange = function() {
    console.log(xmlhttp.response)

    document.querySelector(".ajaxInject").innerHTML = xmlhttp.response;
   }
  

  
    xmlhttp.open("GET", "http://localhost:8000/ajax?user="+str, true);
    xmlhttp.send();
  }

</script>







<script>
const input = document.querySelector(".finder__input");
const finder = document.querySelector(".finder");
const form = document.querySelector("form");

input.addEventListener("focus", () => {
    finder.classList.add("active");
});

input.addEventListener("blur", () => {
    if (input.value.length === 0) {
        finder.classList.remove("active");
    }
});

form.addEventListener("submit", (ev) => {
    ev.preventDefault();
    finder.classList.add("processing");
    finder.classList.remove("active");
    input.disabled = true;
    setTimeout(() => {
        finder.classList.remove("processing");
        input.disabled = false;
        if (input.value.length > 0) {
            finder.classList.add("active");
        }
    }, 1000);
});
</script>

