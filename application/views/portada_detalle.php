
<script type="text/javascript"> 
    $(document).ready(function () {
        $('#like').click(function () {
            var id = $("#idNoticia").val();
            var valor = $(this).attr("data");
            $(this).html(++valor);
            $.ajax({
                type: "POST",
                data: {idNoticia:id},
                url: "<?= base_url() ?>index.php/portada/like"
            });
            $('#unlike').unbind();
            $(this).unbind();
        });
         $('#unlike').click(function () {
            var id = $("#idNoticia").val();
            var valor = $(this).attr("data");
            $(this).html(++valor);
            $.ajax({
                type: "POST",
                data: {idNoticia:id},
                url: "<?= base_url() ?>index.php/portada/unlike"
            });
            $('#like').unbind();
            $(this).unbind();
        });
    });
</script>

<!-- SECTION -->
<div class="section">
    <!-- CONTAINER -->
    <div class="container">
        <!-- ROW -->
        <div class="row">
            <!-- Main Column -->
            <div class="col-md-8">

                <!-- breadcrumb -->
                <ul class="article-breadcrumb">
                    <li style="color: rgb(0, 31, 128);"><?php print_r($noticia[0]->resumen); ?></li>
                </ul>
                <!-- /breadcrumb -->

                <!-- ARTICLE POST -->
                <article class="article article-post">
                    <div class="article-share">
                        <a style="padding: 15px;" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?= $ogurl; ?>" class="facebook"><i class="fa fa-facebook"></i></a>
                        <a style="padding: 15px;" target="_blank" href="https://twitter.com/intent/tweet?text=<?php print_r($noticia[0]->titulo);?>" class="twitter"><i class="fa fa-twitter"></i></a>
                    </div>
                    <div class="article-main-img">
                        <img src="<?php print_r($noticia[0]->urlImage); ?>" alt=""/>
                    </div>
                    <div class="article-body">
                        <h1 class="article-title"><?php print_r($noticia[0]->titulo); ?></h1>
                        <ul class="article-meta">
                            <li><i class="fa fa-clock-o"></i> <?php print_r(date_format(date_create($noticia[0]->Fecha),'d-m-Y')); ?></li>
                            <li> ¿Que te parecio la noticia?</li>
                            <li><i class="fa fa-fire"></i> <?php print_r($noticia[0]->visitas); ?> </li>
                            
                            <li><i id="like" class="fa fa-thumbs-up icon" data="<?php print_r($noticia[0]->likes); ?>"> <?php print_r($noticia[0]->likes); ?></i></li>
                            <li><i id="unlike" class="fa fa-thumbs-down icon" data="<?php print_r($noticia[0]->unLikes); ?>"><?php print_r($noticia[0]->unLikes); ?></i></li>
                        </ul>
                        <?php print_r($noticia[0]->Contenido); ?>

                    </div>
                </article>
                <!-- /ARTICLE POST -->

                <!-- article comments -->
                <div class="article-comments">
                    <div class="section-title">
                        <h2 class="title"  style="background:<?php print_r($menuColor[0]->valor); ?>">Comentarios</h2>
                    </div>

                    <!-- comment -->
                    <?php foreach ($comentarios as $comentario) { ?>
                        <div class="media">
                            <div class="media-body">
                                <div class="media-heading">
                                    <h5><?php print_r($comentario->Nombre) ?> <span class="reply-time"><?php print_r($comentario->Fecha) ?></span></h5>
                                </div>
                                <p><?php print_r($comentario->Comentario) ?></p>				
                            </div>
                        </div>
                    <?php } ?>
                    <!-- /comment -->

                </div>
                <!-- /article comments -->

                <!-- reply form -->
                <div class="article-reply-form">
                    <div class="section-title">
                        <h2 class="title"  style="background:<?php print_r($menuColor[0]->valor); ?>">Dejar mi Comentario</h2>
                    </div>

                    <?php echo form_open('portada/addComentario'); ?>
                    <input class="input" name="nombre" placeholder="Nombre" type="text">
                    <input class="input" name="email" placeholder="Email" type="email">
                    <input class="hidden" name="idNoticia"  id="idNoticia" value="<?php print_r($idNoticia); ?>">
                    <textarea class="input" name="comentario" placeholder="Mensaje"></textarea>
                    <p>
                        <?php echo $this->recaptcha->render(); ?>
                    </p>
                    
                    <button type="submit" class="input-btn">Enviar</button>
                    </form>
                </div>
                <!-- /reply form -->
            </div>
            <!-- /Main Column -->

            <!-- Aside Column -->
            <div class="col-md-4">
                <!-- Ad widget -->
                <div class="widget center-block hidden-xs">
                    <img style="width: 100%; height: 50%" class="center-block" src="<?php print_r($leftBanner[0]->valor);?>" alt="">
                </div>
                <!-- /Ad widget -->

                <!-- social widget -->
                <div class="widget social-widget">
                    <div class="widget-title">
                        <h2 class="title">Seguinos en</h2>
                    </div>
                    <ul>
                        <li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?= base_url() ?>" class="facebook"><i class="fa fa-facebook"></i><br><span>Facebook</span></a></li>
                        <li><a target="_blank" href="https://twitter.com/intent/tweet?text=<?php print_r($twitterUser[0]->valor);?>" class="twitter"><i class="fa fa-twitter"></i><br><span>Twitter</span></a></li>
                        <li><a target="_blank" href="http://instagram.com/<?php print_r($instagramUser[0]->valor);?>?ref=badge" class="instagram"><i class="fa fa-instagram"></i><br><span>Instagram</span></a></li>
                    </ul>
                </div>
                <!-- /social widget -->

                <!-- article widget -->
                <div class="widget">
                    <div class="widget-title">
                        <h2 class="title">Mas Leidos</h2>
                    </div>


                    <!-- /owl carousel 3 -->

                    <!-- ARTICLE -->

                    <?php $cont = 0;
                    while ($cont < count($noticiasMasLeidas) && $cont < 4) { ?>          
                        <article class="article widget-article">
                            <div class="article-img">
                                <a href="#">
                                    <img src="<?php print_r($noticiasMasLeidas[$cont]->urlImage); ?>" alt="">
                                </a>
                            </div>
                            <div class="article-body">
                                <h4 class="article-title"><a href="post.html"><?php print_r($noticiasMasLeidas[$cont]->titulo); ?></a></h4>
                                <ul class="article-meta">
                                    <li><i class="fa fa-clock-o"></i> <?php print_r(date_format(date_create($noticiasMasLeidas[$cont]->fecha),'d-m-Y')); ?> </li>
                                    <li><i class="fa fa-fire"></i> <?php print_r($noticiasMasLeidas[$cont]->visitas); ?></li>
                                    <li><i class="fa fa-thumbs-up icon"></i><?php print_r($noticiasMasLeidas[$cont]->likes); ?></li>
                                    <li><i class="fa fa-thumbs-down icon"></i><?php print_r($noticiasMasLeidas[$cont]->unLikes); ?></li>

                                </ul>
                            </div>
                        </article>
    <?php $cont++;
} ?>
                    <!-- /ARTICLE -->
                </div>
                <!-- /article widget -->


            </div>
            <!-- /Aside Column -->
        </div>
        <!-- /ROW -->
    </div>
    <!-- /CONTAINER -->
</div>
<!-- /SECTION -->


