 <!--====== App Content ======-->
 <div class="app-content">

	<!--====== Anti Flash White Background ======-->
	<div class="bg-anti-flash-white">

		<!--====== White Container ======-->
		<div class="white-container">
			<div class="container">

				<!--====== Primary Slider ======-->
				<div class="s-skeleton s-skeleton--h-600 s-skeleton--bg-black">
					<div class="owl-carousel primary-style-2" id="hero-slider">

 						<?php 					
						 
							include 'controller/productosControlador.php'; 
							$producto = new productosControlador();
							$producto->listaBanner();
						?>
						
					</div>
				</div> 
				
				<!--====== End - Primary Slider ======-->
			</div>

			<!--====== Section 1 ======-->

			<!--====== Electronic Category ======-->
			<div class="u-s-p-y-60" id="electronic-01">

				<!--====== Section Intro ======-->
				<div class="section__intro u-s-m-b-46">
					<div class="container">
						<div class="row">
							<div class="col-lg-12">
								<div class="block">

									<span class="block__title">TOP CATEGORIAS</span></div>
							</div>
						</div>
					</div>
				</div>
				<!--====== End - Section Intro ======-->


				<!--====== Section Content ======-->
				<div class="section__content">
					<div class="container">
						<div class="row">
							<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 u-s-m-b-30">
								<div class="category-o">
									<div class="aspect aspect--bg-grey aspect--square category-o__img-wrap">

										<img class="aspect__img category-o__img" src="<?php echo SERVERURL ?>view/images/product/hombre.png" alt=""></div>
									<div class="category-o__info">

										<a class="category-o__shop-now btn--e-white-brand" href="<?php echo SERVERURL ?>categoria/hombre">HOMBRES</a></div>
								</div>
							</div>
							<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 u-s-m-b-30">
								<div class="category-o">
									<div class="aspect aspect--bg-grey aspect--square category-o__img-wrap">

										<img class="aspect__img category-o__img"src="<?php echo SERVERURL ?>view/images/product/mujer.png" alt=""></div>
									<div class="category-o__info">

										<a class="category-o__shop-now btn--e-white-brand" href="<?php echo SERVERURL ?>categoria/mujer">MUJERES</a></div>
								</div>
							</div>
							<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 u-s-m-b-30">
								<div class="category-o">
									<div class="aspect aspect--bg-grey aspect--square category-o__img-wrap">

										<img class="aspect__img category-o__img" src="<?php echo SERVERURL ?>view/images/product/chico.png" alt=""></div>
									<div class="category-o__info">

										<a class="category-o__shop-now btn--e-white-brand" href="<?php echo SERVERURL ?>categoria/nino">NIÑOS</a></div>
								</div>
							</div>
							<!-- <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 u-s-m-b-30">
								<div class="category-o">
									<div class="aspect aspect--bg-grey aspect--square category-o__img-wrap">

										<img class="aspect__img category-o__img" src="<?php echo SERVERURL ?>view/images/product/television.png" alt=""></div>
									<div class="category-o__info">

										<a class="category-o__shop-now btn--e-white-brand" href="<?php echo SERVERURL ?>categoria/bebes">BEBES</a></div>
								</div>
							</div> -->
							<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 u-s-m-b-30">
								<div class="category-o">
									<div class="aspect aspect--bg-grey aspect--square category-o__img-wrap">

										<img class="aspect__img category-o__img" src="<?php echo SERVERURL ?>view/images/product/aparato.png" alt=""></div>
									<div class="category-o__info">

										<a class="category-o__shop-now btn--e-white-brand" href="<?php echo SERVERURL ?>categoria/electronico">ELECTRONICOS</a></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--====== End - Section Content ======-->
			</div>

			<!--====== Electronic Category ======-->
			<!--====== End - Section 1 ======-->

			<!--====== Section 2 ======-->

			<!--====== Electronics Tab ======-->
			<div class="u-s-p-b-60">

				<!--====== Section Intro ======-->
				<div class="section__intro u-s-m-b-46">
					<div class="container">
						<div class="row">
							<div class="col-lg-12">
								<div class="block">

									<span class="block__title">CATEGORIAS</span>
									<ul class="nav tab-list">
										<li class="nav-item">

											<a class="nav-link btn--e-white-brand-shadow" data-toggle="tab" href="#e-l-p">HOMBRE </a></li>
										<li class="nav-item">

											<a class="nav-link btn--e-white-brand-shadow active" data-toggle="tab" href="#e-b-s">MUJERES</a></li>
										<!-- <li class="nav-item">

											<a class="nav-link btn--e-white-brand-shadow" data-toggle="tab" href="#e-t-r">TOP RATING</a></li> -->
										<!-- <li class="nav-item">

											<a class="nav-link btn--e-white-brand-shadow" data-toggle="tab" href="#e-f-p">FEATURED PRODUCTS</a></li> -->
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--====== End - Section Intro ======-->

				<!--====== Section Content ======-->
				<div class="section__content">
					<div class="container">

 						<?php
						 	// include 'controller/productosControlador.php'; 
							//  $producto3 = new productosControlador();
							$producto->listaEletronicos();
						 ?>

						
					</div>
				</div>
				<!--====== End - Section Content ======-->
			</div>
			<!--====== End - Electronics Tab ======-->
			<!--====== End - Section 2 ======-->


			<!--====== Section 3 ======-->


			<!--====== Women Category ======-->
			

			

			<!--====== Section 10 ======-->
			
			<!--====== End - Section 10 ======-->
		</div>
		<!--====== End - White Container ======-->
	</div>
	<!--====== End - Anti Flash White Background ======-->
</div>
<!--====== End - App Content ======-->