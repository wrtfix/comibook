	<!-- SECTION -->
		<div class="section">
				<div class="visible-lg visible-md">
					<img class="center-block" src="<?=base_url()?>estilo/login/img/ad-3.jpg" alt="">
				</div>
				<br>
			<!-- CONTAINER -->
			<div class="container">


				<!-- ROW -->
				<div class="row">
					<!-- Main Column -->
					<div class="col-md-12">
						<!-- section title -->
						<div class="section-title">
							<h2 class="title">Noticias recientes</h2>
							<!-- tab nav -->
							<ul class="tab-nav pull-right">
							</ul>
							<!-- /tab nav -->
						</div>
						<!-- /section title -->
						
						<!-- Tab content -->
						<div class="tab-content">
							<!-- tab1 -->
							<div id="tab1" class="tab-pane fade in active">
								<!-- row -->
								<div class="row">
									<? for($cont = 0; $cont < 4; ++$cont) { ?>                  
										<div class="col-md-3 col-sm-6">
											<!-- ARTICLE -->
											<article class="article">
												<div class="article-img">
													<a href="#">
														<img src="<?php print_r($noticiasPrincipales[$cont]->Observaciones);?>" alt="">
													</a>
													<ul class="article-info">
														<li class="article-type"><i class="fa fa-camera"></i></li>
													</ul>
												</div>
												<div class="article-body">
													<h4 class="article-title"><a href="post.html"><?php print_r($noticiasPrincipales[$cont]->ClienteOrignen);?></a></h4>
													<ul class="article-meta">
														<li><i class="fa fa-clock-o"></i> <?php print_r($noticiasPrincipales[$cont]->Fecha);?> </li>
														<li><i class="fa fa-comments"></i> <?php print_r($noticiasPrincipales[$cont]->Bultos);?></li>
														<li><i class="fa fa-thumbs-up icon"></i><?php print_r($noticiasPrincipales[$cont]->valorDeclarado);?></li>
														<li><i class="fa fa-thumbs-down icon"></i><?php print_r($noticiasPrincipales[$cont]->CostoFlete);?></li>

													</ul>
												</div>
											</article>
											<!-- /ARTICLE -->
										</div>
									<? } ?>
								</div>
								<!-- /row -->
								
								<!-- row -->
								<div class="row">
									<!-- Column 1 -->
									<div class="col-md-4 col-sm-6">
										<!-- ARTICLE -->
										<article class="article widget-article">
											<div class="article-img">
												<a href="#">
													<img src="<?php print_r($noticiasPrincipales[0]->Observaciones);?>" alt="">
												</a>
											</div>
											<div class="article-body">
												<h4 class="article-title"><a href="post.html"><?php print_r($noticiasPrincipales[0]->ClienteOrignen);?></a></h4>
												<ul class="article-meta">
													<li><i class="fa fa-clock-o"></i> <?php print_r($noticiasPrincipales[0]->Fecha);?> </li>
													<li><i class="fa fa-comments"></i> <?php print_r($noticiasPrincipales[0]->Bultos);?></li>
													<li><i class="fa fa-thumbs-up icon"></i><?php print_r($noticiasPrincipales[0]->valorDeclarado);?></li>
													<li><i class="fa fa-thumbs-down icon"></i><?php print_r($noticiasPrincipales[0]->CostoFlete);?></li>

												</ul>
											</div>
										</article>
										<!-- /ARTICLE -->
										
										<!-- ARTICLE -->
										<article class="article widget-article">
											<div class="article-img">
												<a href="#">
													<img src="<?php print_r($noticiasPrincipales[1]->Observaciones);?>" alt="">
												</a>
											</div>
											<div class="article-body">
												<h4 class="article-title"><a href="post.html"><?php print_r($noticiasPrincipales[1]->ClienteOrignen);?></a></h4>
												<ul class="article-meta">
													<li><i class="fa fa-clock-o"></i> <?php print_r($noticiasPrincipales[1]->Fecha);?> </li>
													<li><i class="fa fa-comments"></i> <?php print_r($noticiasPrincipales[1]->Bultos);?></li>
													<li><i class="fa fa-thumbs-up icon"></i><?php print_r($noticiasPrincipales[1]->valorDeclarado);?></li>
													<li><i class="fa fa-thumbs-down icon"></i><?php print_r($noticiasPrincipales[1]->CostoFlete);?></li>

												</ul>
											</div>
										</article>
										<!-- /ARTICLE -->
									</div>
									<!-- /Column 1 -->
									
									<!-- Column 2 -->
									<div class="col-md-4 col-sm-6">
										<!-- ARTICLE -->
										<article class="article widget-article">
											<div class="article-img">
												<a href="#">
													<img src="<?php print_r($noticiasPrincipales[2]->Observaciones);?>" alt="">
												</a>
											</div>
											<div class="article-body">
												<h4 class="article-title"><a href="post.html"><?php print_r($noticiasPrincipales[2]->ClienteOrignen);?></a></h4>
												<ul class="article-meta">
													<li><i class="fa fa-clock-o"></i> <?php print_r($noticiasPrincipales[2]->Fecha);?> </li>
													<li><i class="fa fa-comments"></i> <?php print_r($noticiasPrincipales[2]->Bultos);?></li>
													<li><i class="fa fa-thumbs-up icon"></i><?php print_r($noticiasPrincipales[2]->valorDeclarado);?></li>
													<li><i class="fa fa-thumbs-down icon"></i><?php print_r($noticiasPrincipales[2]->CostoFlete);?></li>

												</ul>
											</div>
										</article>
										<!-- /ARTICLE -->
										
										<!-- ARTICLE -->
										<article class="article widget-article">
											<div class="article-img">
												<a href="#">
													<img src="<?php print_r($noticiasPrincipales[3]->Observaciones);?>" alt="">
												</a>
											</div>
											<div class="article-body">
												<h4 class="article-title"><a href="post.html"><?php print_r($noticiasPrincipales[3]->ClienteOrignen);?></a></h4>
												<ul class="article-meta">
													<li><i class="fa fa-clock-o"></i> <?php print_r($noticiasPrincipales[3]->Fecha);?> </li>
													<li><i class="fa fa-comments"></i> <?php print_r($noticiasPrincipales[3]->Bultos);?></li>
													<li><i class="fa fa-thumbs-up icon"></i><?php print_r($noticiasPrincipales[3]->valorDeclarado);?></li>
													<li><i class="fa fa-thumbs-down icon"></i><?php print_r($noticiasPrincipales[3]->CostoFlete);?></li>

												</ul>
											</div>
										</article>
										<!-- /ARTICLE -->
									</div>
									<!-- /Column 2 -->
									
									<!-- /Column 3 -->
									<div class="col-md-4 hidden-sm">
										<!-- ARTICLE -->
										<article class="article widget-article">
											<div class="article-img">
												<a href="#">
													<img src="<?php print_r($noticiasPrincipales[4]->Observaciones);?>" alt="">
												</a>
											</div>
											<div class="article-body">
												<h4 class="article-title"><a href="post.html"><?php print_r($noticiasPrincipales[4]->ClienteOrignen);?></a></h4>
												<ul class="article-meta">
													<li><i class="fa fa-clock-o"></i> <?php print_r($noticiasPrincipales[4]->Fecha);?> </li>
													<li><i class="fa fa-comments"></i> <?php print_r($noticiasPrincipales[4]->Bultos);?></li>
													<li><i class="fa fa-thumbs-up icon"></i><?php print_r($noticiasPrincipales[4]->valorDeclarado);?></li>
													<li><i class="fa fa-thumbs-down icon"></i><?php print_r($noticiasPrincipales[4]->CostoFlete);?></li>

												</ul>
											</div>
										</article>
										<!-- /ARTICLE -->
										
										<!-- ARTICLE -->
										<article class="article widget-article">
											<div class="article-img">
												<a href="#">
													<img src="<?php print_r($noticiasPrincipales[5]->Observaciones);?>" alt="">
												</a>
											</div>
											<div class="article-body">
												<h4 class="article-title"><a href="post.html"><?php print_r($noticiasPrincipales[5]->ClienteOrignen);?></a></h4>
												<ul class="article-meta">
													<li><i class="fa fa-clock-o"></i> <?php print_r($noticiasPrincipales[5]->Fecha);?> </li>
													<li><i class="fa fa-comments"></i> <?php print_r($noticiasPrincipales[5]->Bultos);?></li>
													<li><i class="fa fa-thumbs-up icon"></i><?php print_r($noticiasPrincipales[5]->valorDeclarado);?></li>
													<li><i class="fa fa-thumbs-down icon"></i><?php print_r($noticiasPrincipales[5]->CostoFlete);?></li>

												</ul>
											</div>
										</article>
										<!-- /ARTICLE -->
									</div>
									<!-- /Column 3 -->
								</div>
								<!-- /row -->
							</div>
							<!-- /tab1 -->
						</div>
						<!-- /tab content -->
					</div>
					<!-- /Main Column -->
				</div>
				<!-- /ROW -->
			</div>
			<!-- /CONTAINER -->
		</div>
		<!-- /SECTION -->
		<!-- SECTION -->
		<div class="section">
			<!-- CONTAINER -->
			<div class="container">
				<!-- ROW -->
				<div class="row">
					<!-- Main Column -->
					<div class="col-md-8">
						
						<!-- row -->
						<div class="row">
							<!-- section title -->
							<div class="col-md-12">
								<div class="section-title">
									<h2 class="title">Policiales</h2>
								</div>
							</div>
							<!-- /section title -->
							
							<!-- Column 1 -->
							<div class="col-md-6 col-sm-6">
								<!-- ARTICLE -->
								<article class="article">
									<div class="article-img">
										<a href="#">
											<img src="http://www.quepasasalta.com.ar/files/image/53/53108/5adddc4d64aa6.png" alt="">
										</a>
										<ul class="article-info">
											<li class="article-type"><i class="fa fa-camera"></i></li>
										</ul>
									</div>
									<div class="article-body">
										<h3 class="article-title"><a href="#">La Policía y AFIP allanan los boliches La Roka, Salón y otros 6 domicilios: ¿Qué buscan?</a></h3>
										<ul class="article-meta">
											<li><i class="fa fa-clock-o"></i> Abril 24, 2018</li>
											<li><i class="fa fa-comments"></i> 33</li>
																						<li><i class="fa fa-thumbs-up icon"></i> 2</li>
											<li><i class="fa fa-thumbs-down icon"></i> 4</li>

										</ul>
										<p>Populo tritani laboramus ex mei, no eum iuvaret ceteros euripidis, ne alia sadipscing mei. Te inciderint cotidieque pro, ei iisque docendi qui, ne accommodare theophrastus reprehendunt vel. Et commodo menandri eam.</p>
									</div>
								</article>
								<!-- /ARTICLE -->
							</div>
							<!-- /Column 1 -->
							
							<!-- /Column 2 -->
							<div class="col-md-6 col-sm-6">
								<!-- ARTICLE -->
								<article class="article">
									<div class="article-img">
										<a href="#">
											<img src="http://www.quepasasalta.com.ar/files/image/53/53176/5ade6a04e2e33.jpg" alt="">
										</a>
										<ul class="article-info">
											<li class="article-type"><i class="fa fa-camera"></i></li>
										</ul>
									</div>
									<div class="article-body">
										<h3 class="article-title"><a href="#">Condenaron al hijo de 'Chirete' por amenazar a su ex con una pistola y disparar</a></h3>
										<ul class="article-meta">
											<li><i class="fa fa-clock-o"></i> Abril 24, 2018</li>
											<li><i class="fa fa-comments"></i> 33</li>
																						<li><i class="fa fa-thumbs-up icon"></i> 2</li>
											<li><i class="fa fa-thumbs-down icon"></i> 4</li>

										</ul>
										<p>Populo tritani laboramus ex mei, no eum iuvaret ceteros euripidis, ne alia sadipscing mei. Te inciderint cotidieque pro, ei iisque docendi qui, ne accommodare theophrastus reprehendunt vel. Et commodo menandri eam.</p>
									</div>
								</article>
								<!-- /ARTICLE -->
							</div>
							<!-- /Column 2 -->
						</div>
						<!-- /row -->
						
						<!-- row -->
						<div class="row">
							<!-- Column 1 -->
							<div class="col-md-4 col-sm-4">
								<!-- ARTICLE -->
								<article class="article">
									<div class="article-img">
										<a href="#">
											<img src="http://www.quepasasalta.com.ar/files/image/53/53108/5adddc4d64aa6.png" alt="">
										</a>
										<ul class="article-info">
											<li class="article-type"><i class="fa fa-file-text"></i></li>
										</ul>
									</div>
									<div class="article-body">
										<h4 class="article-title"><a href="#">La Policía y AFIP allanan los boliches La Roka, Salón y otros 6 domicilios: ¿Qué buscan?</a></h4>
										<ul class="article-meta">
											<li><i class="fa fa-clock-o"></i> Abril 24, 2018</li>
											<li><i class="fa fa-comments"></i> 33</li>
																						<li><i class="fa fa-thumbs-up icon"></i> 2</li>
											<li><i class="fa fa-thumbs-down icon"></i> 4</li>

										</ul>
									</div>
								</article>
								<!-- /ARTICLE -->
							</div>
							<!-- /Column 1 -->
							
							<!-- Column 2 -->
							<div class="col-md-4 col-sm-4">
								<!-- ARTICLE -->
								<article class="article">
									<div class="article-img">
										<a href="#">
											<img src="http://www.quepasasalta.com.ar/files/image/53/53187/5ade8c577b5eb.jpg" alt="">
										</a>
										<ul class="article-info">
											<li class="article-type"><i class="fa fa-file-text"></i></li>
										</ul>
									</div>
									<div class="article-body">
										<h4 class="article-title"><a href="#">La lluvia se convirtió en diluvio y provocó un desastre en El Galpón y Metán</a></h4>
										<ul class="article-meta">
											<li><i class="fa fa-clock-o"></i> Abril 24, 2018</li>
											<li><i class="fa fa-comments"></i> 33</li>
																						<li><i class="fa fa-thumbs-up icon"></i> 2</li>
											<li><i class="fa fa-thumbs-down icon"></i> 4</li>

										</ul>
									</div>
								</article>
								<!-- /ARTICLE -->
							</div>
							<!-- /Column 2 -->
							
							<!-- Column 3 -->
							<div class="col-md-4 col-sm-4">
								<!-- ARTICLE -->
								<article class="article">
									<div class="article-img">
										<a href="#">
											<img src="http://www.quepasasalta.com.ar/files/image/53/53176/5ade6a04e2e33.jpg" alt="">
										</a>
										<ul class="article-info">
											<li class="article-type"><i class="fa fa-file-text"></i></li>
										</ul>
									</div>
									<div class="article-body">
										<h4 class="article-title"><a href="#">Condenaron al hijo de 'Chirete' por amenazar a su ex con una pistola y disparar</a></h4>
										<ul class="article-meta">
											<li><i class="fa fa-clock-o"></i> Abril 24, 2018</li>
											<li><i class="fa fa-comments"></i> 33</li>
																						<li><i class="fa fa-thumbs-up icon"></i> 2</li>
											<li><i class="fa fa-thumbs-down icon"></i> 4</li>

										</ul>
									</div>
								</article>
								<!-- /ARTICLE -->
							</div>
							<!-- /Column 3 -->
						</div>
						<!-- /row -->
					</div>
					<!-- /Main Column -->
					
					<!-- Aside Column -->
					<div class="col-md-4">
						
						
						<!-- social widget -->
						<div class="widget social-widget">
							<div class="widget-title">
								<h2 class="title">Seguinos en:</h2>
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
							
							<? for($cont = 0; $cont < 4; ++$cont) { ?>
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
												<li><i class="fa fa-comments"></i> <?php print_r($noticiasMasLeidas[$cont]->Bultos);?></li>
												<li><i class="fa fa-thumbs-up icon"></i><?php print_r($noticiasMasLeidas[$cont]->valorDeclarado);?></li>
												<li><i class="fa fa-thumbs-down icon"></i><?php print_r($noticiasMasLeidas[$cont]->CostoFlete);?></li>

											</ul>
										</div>
									</article>
							<? } ?>
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
			<img class="center-block" src="<?=base_url()?>estilo/login/img/ad-3.jpg" alt="">
		</div>
		<!-- /AD SECTION -->
