<!-- <div class="fixed-list">
	<ul class="nav" id="init-scrollspy">
		<li>

			<a class="nav-link" href="#electronic-01" data-click-scroll="#electronic-01"><i class="fas fa-tv"></i></a></li>
		<li>

			<a class="nav-link" href="#female-02" data-click-scroll="#female-02"><i class="fas fa-female"></i></a></li>
		<li>

			<a class="nav-link" href="#male-03" data-click-scroll="#male-03"><i class="fas fa-male"></i></a></li>
		<li>

			<a class="nav-link"><i class="fas fa-fighter-jet"></i></a></li>
		<li>

			<a class="nav-link"><i class="fas fa-cookie-bite"></i></a></li>
		<li>

			<a class="nav-link"><i class="fas fa-futbol"></i></a></li>
		<li>

			<a class="nav-link"><i class="fas fa-book-open"></i></a></li>
		<li>

			<a class="nav-link"><i class="fas fa-briefcase-medical"></i></a></li>
	</ul>
</div> -->

<!--====== Main Header ======-->
<header class="header--style-2">

	<!--====== Nav 1 ======-->
	<nav class="primary-nav-wrapper">
		<div class="container">

			<!--====== Primary Nav ======-->
			<div class="primary-nav">

				<!--====== Main Logo ======-->

				<a class="main-logo" href="index-2.html">
					<img src="images/logo/logo-2.png" alt=""></a>
				<!--====== End - Main Logo ======-->


				<!--====== Search Form ======-->
				<?php 
					include 'buscador.php'
				?>
				<!--====== End - Search Form ======-->


				<!--====== Dropdown Main plugin ======-->
				<div class="menu-init" id="navigation">

					<button class="btn btn--icon toggle-button toggle-button--white fas fa-cogs" type="button"></button>

					<!--====== Menu ======-->
					<div class="ah-lg-mode">

						<span class="ah-close">✕ Close</span>

						<!--====== List ======-->
						<ul class="ah-list ah-list--design1 ah-list--link-color-white">
							<li class="has-dropdown" data-tooltip="tooltip" data-placement="left" title="Cuenta">

								<a><i class="far fa-user-circle"></i></a>

								<!--====== Dropdown ======-->

								<span class="js-menu-toggle"></span>
								<ul style="width:180px" id="loginUser">
									<!-- LOGUEARSEEEE -->
								</ul>
								<!--====== End - Dropdown ======-->
							</li>
							
							<li data-tooltip="tooltip" data-placement="left" title="991509111">
								<!-- <a href="tel:+51991509111"><i class="fas fa-phone-volume"></i></a> -->
								<a href="https://api.whatsapp.com/send/?phone=%2B51991509111&text=hola%20tengo%20una%20pregunta%20...&app_absent=0" target="_bank"><i class="fas fa-phone-volume"></i></a>
							</li>
							<!-- <li data-tooltip="tooltip" data-placement="left" title="Mail">

								<a href="mailto:contact@domain.com"><i class="far fa-envelope"></i></a>
							</li> -->
						</ul>
						<!--====== End - List ======-->
					</div>
					<!--====== End - Menu ======-->
				</div>
				<!--====== End - Dropdown Main plugin ======-->
			</div>
			<!--====== End - Primary Nav ======-->
		</div>
	</nav>
	<!--====== End - Nav 1 ======-->


	<!--====== Nav 2 ======-->
	<nav class="secondary-nav-wrapper">
		<div class="container">

			<!--====== Secondary Nav ======-->
			<div class="secondary-nav">

				<!--====== Dropdown Main plugin ======-->
				<div class="menu-init" id="navigation1">
					<?php 
						// include 'view/inc/nav1.php' 
					?>
				</div>
				<!--====== End - Dropdown Main plugin ======-->


				<!--====== Dropdown Main plugin ======-->
				<div class="menu-init" id="navigation2">

					<button class="btn btn--icon toggle-button toggle-button--white fas fa-cog" type="button"></button>

					<!--====== Menu ======-->
					<div class="ah-lg-mode" id="listaMenu">

						<span class="ah-close">✕ Close</span>

						<!--====== List ======-->
						<ul class="ah-list ah-list--design2 ah-list--link-color-white">
							<li>
								<a href="<?php echo SERVERURL ?>">INICIO</a>
							</li>
							<li>
								<a href="<?php echo SERVERURL ?>categoria/">PRODUCTOS</a>
							</li>							
							<!-- <li>
								<a href="<?php echo SERVERURL ?>oferta/">OFERTAS</a>
							</li> -->
							<li>
								<a href="<?php echo SERVERURL ?>nosotros/">NOSOTROS</a>
							</li>							
						</ul>
						<!--====== End - List ======-->
					</div>
					<!--====== End - Menu ======-->
				</div>
				<!--====== End - Dropdown Main plugin ======-->


				<!--====== Dropdown Main plugin ======-->
				<div class="menu-init" id="navigation3">

					<button class="btn btn--icon toggle-button toggle-button--white fas fa-shopping-bag toggle-button-shop" type="button"></button>

					<span class="total-item-round" id="cantPed3"></span>

					<!--====== Menu ======-->
					<div class="ah-lg-mode">

						<span class="ah-close">✕ Close</span>

						<!--====== List ======-->
						<ul class="ah-list ah-list--design1 ah-list--link-color-white">
							<!-- <li>
								<a href="index-2.html"><i class="fas fa-home u-c-brand"></i></a></li>
							<li>
								<a href="wishlist.html"><i class="far fa-heart"></i></a></li> -->
							<li class="has-dropdown">
								<?php include 'carrito.php' ?>								
							</li>
						</ul>
						<!--====== End - List ======-->
					</div>
					<!--====== End - Menu ======-->
				</div>
				<!--====== End - Dropdown Main plugin ======-->
			</div>
			<!--====== End - Secondary Nav ======-->
		</div>
	</nav>
	<!--====== End - Nav 2 ======-->
</header>
<!--====== End - Main Header ======-->