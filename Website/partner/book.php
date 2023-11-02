<style>
	td img {
		width: 50px;
		height: 75px;
		margin: auto;
	}

	td p {
		margin: 0;
	}
</style>

<?php include('db_connect.php') ?>

<div class="container-fluid">
	<div class="row">
		<div class="card col-md-12 mt-3">
			<div class="card-body">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th class="text-center">Name</th>
							<th class="text-center">Phone & Email</th>
							<th class="text-center">Event</th>
							<th class="text-center">Ticket Info</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i = 1;
						$partner_id = $_SESSION['login_id'];

						$movie = $conn->query(" SELECT b.*, m.title, m.price
												FROM orders b 
												INNER JOIN events m ON b.event_id = m.id 
                                                WHERE m.partner_id = $partner_id");

						while ($row = $movie->fetch_assoc()) {
						?>
							<tr>
								<td><?php echo $i++ ?></td>
								<td><?php echo $row['name'] ?></td>
								<td><?php echo ucwords($row['phone'] . '<br>' . $row['email']) ?></td>
								<td><?php echo $row['title'] ?></td>
								<td>
									<p><small><b>Qty:</b> <?php echo $row['qty'] ?></small></p>
									<p><small><b>Ticket Price:</b> <?php echo $row['price'] ?></small></p>
                                    <p><small><b>Total:</b> <?php echo $row['qty'] * $row['price'] ?></small></p>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>