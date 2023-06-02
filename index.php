<?php include('template/header.php'); ?>

<div class="box m-5">
    <h1 class="title">Inicio</h1>
    <p1>hola Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo id iure, quam fuga illum iusto optio neque deserunt tempora distinctio eum corrupti? Ratione fugiat maxime atque harum aliquam unde! Et. hola</p1>

    <section class="hero is-medium has-carousel">
			<div id="carousel-demo" class="hero-carousel">
				<div class="item-1">
                    <img src="https://www.tooltyp.com/wp-content/uploads/2014/10/1900x920-8-beneficios-de-usar-imagenes-en-nuestros-sitios-web.jpg" alt="">
					<!-- Slide Content -->
				</div>
				<div class="item-2">
                    <img src="https://www.nationalgeographic.com.es/medio/2022/07/12/nebulosa-de-carina_00673698_2000x1158.jpg" alt="">
					<!-- Slide Content -->
				</div>
				<div class="item-3">
                    <img src="https://cdn.shopify.com/s/files/1/0229/0839/files/bancos_de_imagenes_gratis.jpg?v=1630420628" alt="">
					<!-- Slide Content -->
				</div>
			</div>
			<div class="hero-head"></div>
			<div class="hero-body"></div>
			<div class="hero-foot"></div>
		</section>
		<!-- End Hero Carousel -->

</div>

<!-- Start Hero Carousel -->


		<script src="./src/bulma-carousel.min.js"></script>
		<script>
			bulmaCarousel.attach('#carousel-demo', {
				slidesToScroll: 1,
				slidesToShow: 1
			});
		</script>

<?php include('template/footer.php'); ?>