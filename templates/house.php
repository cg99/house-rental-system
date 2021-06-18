<div class="col-md-4 col-sm-6 my-4">
	<div class="card m-auto house" style="width: 20rem;">
		<img class="card-img-top" src="<?= $server; ?>img/house/<?php echo $r['image']; ?>" alt="Card Image Caption">
		<div class="card-body">
			<h4 class="card-title"><?php echo $r['location']; ?></h4>
			<p class="card-text"><?php echo $r['description']; ?></p>

			<div style="display: flex; justify-content: space-between; align-items: center;">
				<div style="font-weight: 600;">$<span class="price"><?php echo $r['price']; ?>/month</span></div>

				<!-- Button add to cart -->
				<button data-houseid="<?php echo $r['id']; ?>" type="button" class="btn btn-success rent-btn">
					<span class="text-white">
						<i class="fa fa-shopping-cart text-white"></i>
						Rent
					</span>
				</button>
			</div>
		</div>
	</div>
</div>