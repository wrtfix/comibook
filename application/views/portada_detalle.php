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
							<li><a href="#">Portada</a></li>
							<li><a href="#">Policiales</a></li>
							<li>La Policía y AFIP allanan los boliches La Roka, Salón y otros 6 domicilios: ¿Qué buscan?</li>
						</ul>
						<!-- /breadcrumb -->
					
						<!-- ARTICLE POST -->
						<article class="article article-post">
							<div class="article-share">
								<a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
								<a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
							</div>
							<div class="article-main-img">
								<img src="<?php print_r($noticia[0]->Observaciones);?>" alt="">
							</div>
							<div class="article-body">
								<h1 class="article-title"><?php print_r($noticia[0]->Contenido);?></h1>
								<ul class="article-meta">
									<li><i class="fa fa-clock-o"></i> <?php print_r($noticia[0]->Fecha);?></li>
									<li><i class="fa fa-comments"></i> <?php print_r($noticia[0]->Bultos);?> </li>
								</ul>
                                                                <?php print_r($noticia[0]->Contenido);?>
								
							</div>
						</article>
						<!-- /ARTICLE POST -->
						
						<!-- widget tags -->
						<div class="widget-tags">
							<ul>
								<li><a href="#">Noticia</a></li>
								<li><a href="#">Policiales</a></li>
							</ul>
						</div>
						<!-- /widget tags -->
						
						<!-- article comments -->
						<div class="article-comments">
							<div class="section-title">
								<h2 class="title">Comentarios</h2>
							</div>
								
							<!-- comment -->
							<div class="media">
								<div class="media-left">
									<img src="img/av-1.jpg" alt="">
								</div>
								<div class="media-body">
									<div class="media-heading">
										<h5>Roberto <span class="reply-time">Agosto 25, 2018 At 9:30 AM</span></h5>
									</div>
									<p>Espero que sea verdad lo que dice.</p>				
									<a href="#" class="reply-btn">Reply</a>
								</div>
								
							
							</div>
							<!-- /comment -->
							
							<!-- comment -->
							<div class="media">
								<div class="media-left">
									<img src="img/av-2.jpg" alt="">
								</div>
								<div class="media-body">
									<div class="media-heading">
										<h5>Estefania <span class="reply-time">Agosto 25, 2018 At 9:31 AM</span></h5>
									</div>
									<p>Algo pasaba ahi adentro.</p>				
									<a href="#" class="reply-btn">Reply</a>
								</div>
							</div>
							<!-- /comment -->
						</div>
						<!-- /article comments -->
						
						<!-- reply form -->
						<div class="article-reply-form">
							<div class="section-title">
								<h2 class="title">Dejar mi Comentario</h2>
							</div>
								
							<form>
								<input class="input" placeholder="Nombre" type="text">
								<input class="input" placeholder="Email" type="email">
								<textarea class="input" placeholder="Mensaje"></textarea>
								<button class="input-btn">Enviar</button>
							</form>
						</div>
						<!-- /reply form -->
					</div>
					<!-- /Main Column -->
					
					<!-- Aside Column -->
					<div class="col-md-4">
						<!-- Ad widget -->
						<div class="widget center-block hidden-xs">
							<img class="center-block" src="./img/ad-1.jpg" alt=""> 
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
							
							<?php $cont = 0; while($cont < count($noticiasMasLeidas) && $cont < 4) { ?>          
							<article class="article widget-article">
										<div class="article-img">
											<a href="#">
												<img src="<?php print_r($noticiasMasLeidas[$cont]->Observaciones);?>" alt="">
											</a>
										</div>
										<div class="article-body">
											<h4 class="article-title"><a href="post.html"><?php print_r($noticiasMasLeidas[$cont]->ClienteOrignen);?></a></h4>
											<ul class="article-meta">
												<li><i class="fa fa-clock-o"></i> <?php print_r($noticiasMasLeidas[$cont]->Fecha);?> </li>
												<li><i class="fa fa-fire"></i> <?php print_r($noticiasMasLeidas[$cont]->Bultos);?></li>
												<li><i class="fa fa-thumbs-up icon"></i><?php print_r($noticiasMasLeidas[$cont]->valorDeclarado);?></li>
												<li><i class="fa fa-thumbs-down icon"></i><?php print_r($noticiasMasLeidas[$cont]->CostoFlete);?></li>

											</ul>
										</div>
									</article>
							<?php $cont++; } ?>
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
		
		<!-- AD SECTION -->
		<div class="visible-lg visible-md">
			<img class="center-block" src="./img/ad-3.jpg" alt="">
		</div>
		<!-- /AD SECTION -->
		
		<!-- SECTION -->
		<div class="section">
			<!-- CONTAINER -->
			<div class="container">
				<!-- ROW -->
				<div class="row">
					<!-- Main Column -->
					<div class="col-md-12">
						<!-- section title -->
						<div class="section-title">
							<h2 class="title">Relacionados</h2>
						</div>
						<!-- /section title -->
						
						<!-- row -->
						<div class="row">
							<!-- Column 1 -->
							<div class="col-md-3 col-sm-6">
								<!-- ARTICLE -->
								<article class="article">
									<div class="article-img">
										<a href="#">
											<img src="./img/img-md-1.jpg" alt="">
										</a>
										<ul class="article-info">
											<li class="article-type"><i class="fa fa-camera"></i></li>
										</ul>
									</div>
									<div class="article-body">
										<h4 class="article-title"><a href="#">Gran robo en oficinas del estado.</a></h4>
										<ul class="article-meta">
											<li><i class="fa fa-clock-o"></i> Abril 3, 2018</li>
											<li><i class="fa fa-comments"></i> 33</li>
										</ul>
									</div>
								</article>
								<!-- /ARTICLE -->
							</div>
							<!-- /Column 1 -->
							
							<!-- Column 2 -->
							<div class="col-md-3 col-sm-6">
								<!-- ARTICLE -->
								<article class="article">
									<div class="article-img">
										<a href="#">
											<img src="./img/img-md-2.jpg" alt="">
										</a>
									</div>
									<div class="article-body">
										<h4 class="article-title"><a href="#">La peatonal mas segura.</a></h4>
										<ul class="article-meta">
											<li><i class="fa fa-clock-o"></i> Abril 1, 2018</li>
											<li><i class="fa fa-comments"></i> 33</li>
										</ul>
									</div>
								</article>
								<!-- /ARTICLE -->
							</div>
							<!-- /Column 2 -->
							
							<!-- Column 3 -->
							<div class="col-md-3 col-sm-6">
								<!-- ARTICLE -->
								<article class="article">
									<div class="article-img">
										<a href="#">
											<img src="./img/img-md-3.jpg" alt="">
										</a>
										<ul class="article-info">
											<li class="article-type"><i class="fa fa-file-text"></i></li>
										</ul>
									</div>
									<div class="article-body">
										<h4 class="article-title"><a href="#">Desapaerecio joven en cafayate.</a></h4>
										<ul class="article-meta">
											<li><i class="fa fa-clock-o"></i> Abril 5, 2018</li>
											<li><i class="fa fa-comments"></i> 33</li>
										</ul>
									</div>
								</article>
								<!-- /ARTICLE -->
							</div>
							<!-- /Column 3 -->
							
							<!-- Column 4 -->
							<div class="col-md-3 col-sm-6">
								<!-- ARTICLE -->
								<article class="article">
									<div class="article-img">
										<a href="#">
											<img src="./img/img-md-4.jpg" alt="">
										</a>
										<ul class="article-info">
											<li class="article-type"><i class="fa fa-file-text"></i></li>
										</ul>
									</div>
									<div class="article-body">
										<h4 class="article-title"><a href="#">Reclaman mayor seguridad en dakart.</a></h4>
										<ul class="article-meta">
											<li><i class="fa fa-clock-o"></i> January 31, 2017</li>
											<li><i class="fa fa-comments"></i> 33</li>
										</ul>
									</div>
								</article>
								<!-- /ARTICLE -->
							</div>
							<!-- Column 4 -->
						</div>
						<!-- /row -->
					</div>
					<!-- /Main Column -->
				</div>
				<!-- /ROW -->
			</div>
			<!-- /CONTAINER -->
		</div>
		<!-- /SECTION -->