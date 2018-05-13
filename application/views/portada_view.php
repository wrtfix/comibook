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
									</div>
									<!-- /Column 1 -->
									
									<!-- Column 2 -->
									<div class="col-md-4 col-sm-6">
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
										
										<!-- ARTICLE -->
										<article class="article widget-article">
											<div class="article-img">
												<a href="#">
													<img src="<?php print_r($noticiasPrincipales[6]->Observaciones);?>" alt="">
												</a>
											</div>
											<div class="article-body">
												<h4 class="article-title"><a href="post.html"><?php print_r($noticiasPrincipales[6]->ClienteOrignen);?></a></h4>
												<ul class="article-meta">
													<li><i class="fa fa-clock-o"></i> <?php print_r($noticiasPrincipales[6]->Fecha);?> </li>
													<li><i class="fa fa-comments"></i> <?php print_r($noticiasPrincipales[6]->Bultos);?></li>
													<li><i class="fa fa-thumbs-up icon"></i><?php print_r($noticiasPrincipales[6]->valorDeclarado);?></li>
													<li><i class="fa fa-thumbs-down icon"></i><?php print_r($noticiasPrincipales[6]->CostoFlete);?></li>

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
													<img src="<?php print_r($noticiasPrincipales[7]->Observaciones);?>" alt="">
												</a>
											</div>
											<div class="article-body">
												<h4 class="article-title"><a href="post.html"><?php print_r($noticiasPrincipales[7]->ClienteOrignen);?></a></h4>
												<ul class="article-meta">
													<li><i class="fa fa-clock-o"></i> <?php print_r($noticiasPrincipales[7]->Fecha);?> </li>
													<li><i class="fa fa-comments"></i> <?php print_r($noticiasPrincipales[7]->Bultos);?></li>
													<li><i class="fa fa-thumbs-up icon"></i><?php print_r($noticiasPrincipales[7]->valorDeclarado);?></li>
													<li><i class="fa fa-thumbs-down icon"></i><?php print_r($noticiasPrincipales[7]->CostoFlete);?></li>

												</ul>
											</div>
										</article>
										<!-- /ARTICLE -->
										
										<!-- ARTICLE -->
										<article class="article widget-article">
											<div class="article-img">
												<a href="#">
													<img src="<?php print_r($noticiasPrincipales[8]->Observaciones);?>" alt="">
												</a>
											</div>
											<div class="article-body">
												<h4 class="article-title"><a href="post.html"><?php print_r($noticiasPrincipales[8]->ClienteOrignen);?></a></h4>
												<ul class="article-meta">
													<li><i class="fa fa-clock-o"></i> <?php print_r($noticiasPrincipales[8]->Fecha);?> </li>
													<li><i class="fa fa-comments"></i> <?php print_r($noticiasPrincipales[8]->Bultos);?></li>
													<li><i class="fa fa-thumbs-up icon"></i><?php print_r($noticiasPrincipales[8]->valorDeclarado);?></li>
													<li><i class="fa fa-thumbs-down icon"></i><?php print_r($noticiasPrincipales[8]->CostoFlete);?></li>

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
									<h2 class="title">Mas Populares</h2>
								</div>
							</div>
							<!-- /section title -->
								<div class="col-md-6 col-sm-6">
								<!-- ARTICLE -->
								<article class="article">
									<div class="article-img">
										<a href="#">
											<img src="<?php print_r($resumenNoticias[0]->Observaciones);?>" alt="">
										</a>
										<ul class="article-info">
											<li class="article-type"><i class="fa fa-camera"></i></li>
										</ul>
									</div>
									<div class="article-body">
										<h3 class="article-title"><a href="#"><?php print_r($resumenNoticias[0]->ClienteOrignen);?></a></h3>
										<ul class="article-meta">
											<li><i class="fa fa-clock-o"></i><?php print_r($resumenNoticias[8]->Fecha);?></li>
											<li><i class="fa fa-comments"></i> <?php print_r($resumenNoticias[0]->Bultos);?></li>
											<li><i class="fa fa-thumbs-up icon"></i><?php print_r($resumenNoticias[0]->valorDeclarado);?></li>
											<li><i class="fa fa-thumbs-down icon"></i><?php print_r($resumenNoticias[0]->CostoFlete);?></li>

										</ul>
										<p><?php print_r($resumenNoticias[0]->ClienteDestino);?></p>
									</div>
								</article>
								<!-- /ARTICLE -->
							</div>
							<!-- /Column 2 -->
							<div class="col-md-6 col-sm-6">
								<!-- ARTICLE -->
								<article class="article">
									<div class="article-img">
										<a href="#">
											<img src="<?php print_r($resumenNoticias[1]->Observaciones);?>" alt="">
										</a>
										<ul class="article-info">
											<li class="article-type"><i class="fa fa-camera"></i></li>
										</ul>
									</div>
									<div class="article-body">
										<h3 class="article-title"><a href="#"><?php print_r($resumenNoticias[1]->ClienteOrignen);?></a></h3>
										<ul class="article-meta">
											<li><i class="fa fa-clock-o"></i><?php print_r($resumenNoticias[8]->Fecha);?></li>
											<li><i class="fa fa-comments"></i> <?php print_r($resumenNoticias[1]->Bultos);?></li>
											<li><i class="fa fa-thumbs-up icon"></i><?php print_r($resumenNoticias[1]->valorDeclarado);?></li>
											<li><i class="fa fa-thumbs-down icon"></i><?php print_r($resumenNoticias[1]->CostoFlete);?></li>

										</ul>
										<p><?php print_r($resumenNoticias[1]->ClienteDestino);?></p>
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
											<img src="<?php print_r($resumenNoticias[2]->Observaciones);?>" alt="">
										</a>
										<ul class="article-info">
											<li class="article-type"><i class="fa fa-camera"></i></li>
										</ul>
									</div>
									<div class="article-body">
										<h3 class="article-title"><a href="#"><?php print_r($resumenNoticias[2]->ClienteOrignen);?></a></h3>
										<ul class="article-meta">
											<li><i class="fa fa-clock-o"></i><?php print_r($resumenNoticias[8]->Fecha);?></li>
											<li><i class="fa fa-comments"></i> <?php print_r($resumenNoticias[2]->Bultos);?></li>
											<li><i class="fa fa-thumbs-up icon"></i><?php print_r($resumenNoticias[2]->valorDeclarado);?></li>
											<li><i class="fa fa-thumbs-down icon"></i><?php print_r($resumenNoticias[2]->CostoFlete);?></li>

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
											<img src="<?php print_r($resumenNoticias[3]->Observaciones);?>" alt="">
										</a>
										<ul class="article-info">
											<li class="article-type"><i class="fa fa-camera"></i></li>
										</ul>
									</div>
									<div class="article-body">
										<h3 class="article-title"><a href="#"><?php print_r($resumenNoticias[3]->ClienteOrignen);?></a></h3>
										<ul class="article-meta">
											<li><i class="fa fa-clock-o"></i><?php print_r($resumenNoticias[3]->Fecha);?></li>
											<li><i class="fa fa-comments"></i> <?php print_r($resumenNoticias[3]->Bultos);?></li>
											<li><i class="fa fa-thumbs-up icon"></i><?php print_r($resumenNoticias[3]->valorDeclarado);?></li>
											<li><i class="fa fa-thumbs-down icon"></i><?php print_r($resumenNoticias[3]->CostoFlete);?></li>

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
											<img src="<?php print_r($resumenNoticias[4]->Observaciones);?>" alt="">
										</a>
										<ul class="article-info">
											<li class="article-type"><i class="fa fa-camera"></i></li>
										</ul>
									</div>
									<div class="article-body">
										<h3 class="article-title"><a href="#"><?php print_r($resumenNoticias[4]->ClienteOrignen);?></a></h3>
										<ul class="article-meta">
											<li><i class="fa fa-clock-o"></i><?php print_r($resumenNoticias[4]->Fecha);?></li>
											<li><i class="fa fa-comments"></i> <?php print_r($resumenNoticias[4]->Bultos);?></li>
											<li><i class="fa fa-thumbs-up icon"></i><?php print_r($resumenNoticias[4]->valorDeclarado);?></li>
											<li><i class="fa fa-thumbs-down icon"></i><?php print_r($resumenNoticias[4]->CostoFlete);?></li>

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
