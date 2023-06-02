<?php include('template/header.php'); ?>

<div class="box m-5">
    <h1 class="title">Inicio</h1>
    <p1>hola Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo id iure, quam fuga illum iusto optio neque deserunt tempora distinctio eum corrupti? Ratione fugiat maxime atque harum aliquam unde! Et. hola</p1>
    <!-- <div class="columns"> -->
        <!-- <div class="box">
        <section class="section">
			<div class="container">
				
				<div id="carousel-demo" class="carousel has-background-black" data-slide-to-scroll="1">
                    <div class="item-1">
                        <img src="https://www.tooltyp.com/wp-content/uploads/2014/10/1900x920-8-beneficios-de-usar-imagenes-en-nuestros-sitios-web.jpg" alt="" style="max-height: 300px; text-align: center; display: flex; margin:auto">
                        
                    </div>
                    <div class="item-2">
                        <img src="https://www.nationalgeographic.com.es/medio/2022/07/12/nebulosa-de-carina_00673698_2000x1158.jpg" alt="" style="max-height: 300px; text-align: center; display: flex; margin:auto">
                        
                    </div>
                    <div class="item-3">
                        <img src="https://cdn.shopify.com/s/files/1/0229/0839/files/bancos_de_imagenes_gratis.jpg?v=1630420628" alt="" style="max-height: 300px; text-align: center; display: flex; margin:auto">
                        
                    </div>
				</div>
				
			</div>
		</section> -->
        <!-- </div> -->
        
    <div class="box">

    </div>


		<!-- End Hero Carousel -->
    </div>
        
    </div>

    

</div>

<!-- Start Hero Carousel -->


		<script src="./src/bulma-carousel.min.js"></script>
		<script>
			// bulmaCarousel.attach('#carousel-demo', {
			// 	slidesToScroll: 1,
			// 	slidesToShow: 1
			// });

            // Initialize all div with carousel class
            var carousels = bulmaCarousel.attach('#carousel-demo', {autoplay:true, loop:true, infinite:true, slidesToShow:1, autoplaySpeed:1000, effect: fade});

            // Loop on each carousel initialized
            for(var i = 0; i < carousels.length; i++) {
                // Add listener to  event
                carousels[i].on('before:show', state => {
                    console.log(state);
                });
            }

            // Access to bulmaCarousel instance of an element
            var element = document.querySelector('#carousel-demo');
            if (element && element.bulmaCarousel) {
                // bulmaCarousel instance is available as element.bulmaCarousel
                element.bulmaCarousel.on('show', function(state) {
                    // element.bulmaCarousel.on('after-show', function(state) {
                    console.log(state);
                });
            }
		</script>

        

<?php include('template/footer.php'); ?>