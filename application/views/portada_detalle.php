
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
                    <li><?php print_r($noticia[0]->ClienteOrignen); ?></li>
                </ul>
                <!-- /breadcrumb -->

                <!-- ARTICLE POST -->
                <article class="article article-post">
                    <div class="article-share">
                        <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                        <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                    </div>
                    <div class="article-main-img">
                        <img src="<?php print_r($noticia[0]->Observaciones); ?>" alt="">
                    </div>
                    <div class="article-body">
                        <h1 class="article-title"><?php print_r($noticia[0]->ClienteOrignen); ?></h1>
                        <ul class="article-meta">
                            <li><i class="fa fa-clock-o"></i> <?php print_r($noticia[0]->Fecha); ?></li>
                            <li><i class="fa fa-comments"></i> <?php print_r($noticia[0]->Bultos); ?> </li>
                            <li><i id="like" class="fa fa-thumbs-up icon" data="<?php print_r($noticia[0]->valorDeclarado); ?>"> <?php print_r($noticia[0]->valorDeclarado); ?></i></li>
                            <li><i id="unlike" class="fa fa-thumbs-down icon" data="<?php print_r($noticia[0]->CostoFlete); ?>"><?php print_r($noticia[0]->CostoFlete); ?></i></li>
                        </ul>
                        <?php print_r($noticia[0]->Contenido); ?>

                    </div>
                </article>
                <!-- /ARTICLE POST -->

                <!-- article comments -->
                <div class="article-comments">
                    <div class="section-title">
                        <h2 class="title">Comentarios</h2>
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
                        <h2 class="title">Dejar mi Comentario</h2>
                    </div>

                    <?php echo form_open('portada/addComentario'); ?>
                    <input class="input" name="nombre" placeholder="Nombre" type="text">
                    <input class="input" name="email" placeholder="Email" type="email">
                    <input class="hidden" name="idNoticia"  id="idNoticia" value="<?php print_r($idNoticia); ?>">
                    <textarea class="input" name="comentario" placeholder="Mensaje"></textarea>
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
                    <img class="center-block" src="<?php print_r($leftBanner[0]->proviene);?>" alt="">
                </div>
                <!-- /Ad widget -->

                <!-- social widget -->
                <div class="widget social-widget">
                    <div class="widget-title">
                        <h2 class="title">Seguinos en</h2>
                    </div>
                    <ul>
                        <li><a href="#" class="facebook"><i class="fa fa-facebook"></i><br><span>Facebook</span></a></li>
                        <li><a href="#" class="twitter"><i class="fa fa-twitter"></i><br><span>Twitter</span></a></li>
                        <li><a href="#" class="instagram"><i class="fa fa-instagram"></i><br><span>Instagram</span></a></li>
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
                                    <img src="<?php print_r($noticiasMasLeidas[$cont]->Observaciones); ?>" alt="">
                                </a>
                            </div>
                            <div class="article-body">
                                <h4 class="article-title"><a href="post.html"><?php print_r($noticiasMasLeidas[$cont]->ClienteOrignen); ?></a></h4>
                                <ul class="article-meta">
                                    <li><i class="fa fa-clock-o"></i> <?php print_r($noticiasMasLeidas[$cont]->Fecha); ?> </li>
                                    <li><i class="fa fa-fire"></i> <?php print_r($noticiasMasLeidas[$cont]->Bultos); ?></li>
                                    <li><i class="fa fa-thumbs-up icon"></i><?php print_r($noticiasMasLeidas[$cont]->valorDeclarado); ?></li>
                                    <li><i class="fa fa-thumbs-down icon"></i><?php print_r($noticiasMasLeidas[$cont]->CostoFlete); ?></li>

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


