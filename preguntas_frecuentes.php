<?php include('template/header.php'); ?>

<div class="box m-5">
    <h1 class="title">Preguntas frecuentes</h1>
    <p1>hola Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo id iure, quam fuga illum iusto optio neque deserunt tempora distinctio eum corrupti? Ratione fugiat maxime atque harum aliquam unde! Et. hola</p1>

    <div id="accordion_second">
	<article class="message">
		<div class="message-header has-background-danger">
			<p><a href="#collapsible-message-accordion-second-1" data-action="collapse">Question 1 <i class="fa fa-angle-double-down"></i></a></p>
		</div>
		<div id="collapsible-message-accordion-second-1" class="message-body is-collapsible" data-parent="accordion_second" data-allow-multiple="true">
			<div class="message-body-content">
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. <strong>Pellentesque risus mi</strong>, tempus quis
				placerat ut, porta nec nulla. Vestibulum rhoncus ac ex sit amet fringilla. Nullam gravida purus diam, et dictum
				<a>felis venenatis</a> efficitur. Aenean ac <em>eleifend lacus</em>, in mollis lectus. Donec sodales, arcu et
				sollicitudin porttitor, tortor urna tempor ligula, id porttitor mi magna a neque. Donec dui urna, vehicula et
				sem eget, facilisis sodales sem.
			</div>
		</div>
	</article>
	<article class="message">
		<div class="message-header has-background-danger">
			<p>Question 2 <a href="#collapsible-message-accordion-second-2" data-action="collapse">Collapse/Expand</a></p>
		</div>
		<div id="collapsible-message-accordion-second-2" class="message-body is-collapsible" data-parent="accordion_second" data-allow-multiple="true">
			<div class="message-body-content">
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. <strong>Pellentesque risus mi</strong>, tempus quis
				placerat ut, porta nec nulla. Vestibulum rhoncus ac ex sit amet fringilla. Nullam gravida purus diam, et dictum
				<a>felis venenatis</a> efficitur. Aenean ac <em>eleifend lacus</em>, in mollis lectus. Donec sodales, arcu et
				sollicitudin porttitor, tortor urna tempor ligula, id porttitor mi magna a neque. Donec dui urna, vehicula et
				sem eget, facilisis sodales sem.
			</div>
		</div>
	</article>
	<article class="message">
		<div class="message-header has-background-danger">
			<p>Question 3 <a href="#collapsible-message-accordion-second-3" data-action="collapse">Collapse/Expand</a></p>
		</div>
		<div id="collapsible-message-accordion-second-3" class="message-body is-collapsible" data-parent="accordion_second" data-allow-multiple="true">
			<div class="message-body-content">
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. <strong>Pellentesque risus mi</strong>, tempus quis
				placerat ut, porta nec nulla. Vestibulum rhoncus ac ex sit amet fringilla. Nullam gravida purus diam, et dictum
				<a>felis venenatis</a> efficitur. Aenean ac <em>eleifend lacus</em>, in mollis lectus. Donec sodales, arcu et
				sollicitudin porttitor, tortor urna tempor ligula, id porttitor mi magna a neque. Donec dui urna, vehicula et
				sem eget, facilisis sodales sem.
			</div>
		</div>
	</article>
</div>
<script src="./src/bulma-collapsible.min.js"></script>
<script>
    const bulmaCollapsibleElement = bulmaCollapsible.attach('.is-collapsible')
</script>


</div>

<?php include('template/footer.php'); ?>


<!-- <div class = "dropdown">
            <div class = "dropdown-trigger">
                  <button class = "button" aria-haspopup = "true" aria-controls = "dropdown-menu">
                     <span>Countries</span>
                     <span class = "icon is-small">
                        <i class = "fa fa-angle-down" aria-hidden="true"></i>
                     </span>
                  </button>
            </div>
               
            <div class = "dropdown-menu" id = "dropdown-menu" role = "menu">
                    <div class = "dropdown-content">
                        <a href = "#" class = "dropdown-item">India</a>
                        <a class = "dropdown-item">England</a>
                        <a href = "#" class = "dropdown-item is-active">Australia</a>
                        <a href = "#" class = "dropdown-item">Srilanka</a>
                        <hr class = "dropdown-divider">
                        <a href = "#" class = "dropdown-item">South Africa</a>
                    </div>
            </div>
    </div> -->

    <!-- <script>
               //DOMContentLoaded - it fires when initial HTML document has been completely loaded
               document.addEventListener('DOMContentLoaded', function () {
                  // querySelector - it returns the element within the document that matches the specified selector
                  var dropdown = document.querySelector('.dropdown');
                    
                  //addEventListener - attaches an event handler to the specified element.
                  dropdown.addEventListener('click', function(event) {
                    
                     //event.stopPropagation() - it stops the bubbling of an event to parent elements, by preventing parent event handlers from being executed
                     event.stopPropagation();
                      
                     //classList.toggle - it toggles between adding and removing a class name from an element
                     dropdown.classList.toggle('is-active');
                  });
               });
            </script> -->