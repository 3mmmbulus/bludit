<footer class="footer p-3 p-md-5 mt-5 text-center">
	<div class="container">
		<ul class="footer-links ps-0 mb-1">
			<?php foreach (HTML::socialNetworks() as $key => $name) {
				echo '<a class="color-violet" href="'.$site->{$key}().'"><li class="d-inline-block pe-4">' . $name . '</li></a>';
			}
			?>
		</ul>	
		<p class="m-0 mt-2">It's Polina - Created by <a class="color-violet" href="https://www.bludit.ir">Pourdaryaei</a></p>
	</div>
</footer>
