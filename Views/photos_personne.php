<div class="container mt-3">
    <div class="col-4 profile_pr d-flex justify-content-start mb-3 align-items-center mx-2">
        <img src="<?="./".$profile->fichier?>" class="mx-2" alt="">
        <h2><?=$personne?></h2>
    </div>

    <div class="mt-5 mb-5">
        <input type="text" class="form-control mb-2" id="kyw" onkeyup="getPhotos(this.value,'<?=$personne?>')" placeholder="Search by keyword">
        <div class="d-flex align-items-center">
            <label for="">debut: </label>
            <input type="date" class="form-control" id="date1" onchange="getByDateIn(this.value,'<?=$personne?>')">
            <label for="">fin: </label>
            <input type="date" class="form-control" id="date2"onchange="getByDateIn(this.value,'<?=$personne?>')">
        </div>
        </div>
        <div>
        <section class="gallery min-vh-100">
            <div class="container-lg">
                <div class="row gy-4 row-cols-1 row-cols-sm-2 row-cols-md-3 injection">

                    <?php foreach($photos as $key=>$photo){ ?>
                    <div class="col">
                        <a href=<?="photo?id=".$photo->id."&personne=".$personne?>><img class="gallery-item"
                                src=<?="./".$photo->fichier?> alt=""></a>
                    </div>
                    <?php } ?>

                </div>
            </div>
        </section>
        </div>

    </div>



    <script>
        function getPhotos(str,personne) {
            console.log(str);
            var xmlhttp = new XMLHttpRequest();
            const date1 = document.querySelector("#date1").value;
            const date2 = document.querySelector("#date2").value
            if(date1 != "" && date2!=""){
                xmlhttp.open("GET", "http://localhost:8000/getPhotosAjax?kw="+str+"&date1="+date1+"&date2="+date2+"&login="+personne, true);
                
            }else{
                xmlhttp.open("GET", "http://localhost:8000/getPhotosAjax?kw="+str+"&login="+personne, true);
            }
            xmlhttp.send();
             xmlhttp.onreadystatechange = function() {
                document.querySelector(".injection").innerHTML = xmlhttp.response;
              }
            }
        function getByDateIn(date,personne){
            const kw = document.querySelector("#kyw").value;
             getPhotos(kw,personne)
            }

    </script>
    <style>
    img {
        max-width: 100%;
    }

    .gallery {
        background-color: #dbddf1;
        padding: 80px 0;
    }

    .gallery img {
        background-color: #ffffff;
        padding: 15px;
        width: 100%;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
        cursor: pointer;
    }

    #gallery-modal .modal-img {
        width: 100%;
    }
    </style>