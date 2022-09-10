
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