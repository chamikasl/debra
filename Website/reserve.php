<?php
include 'db_connect.php';

$mov = $conn->query("SELECT * FROM events where id =" . $_GET['id'])->fetch_array();
$duration = explode('.', $mov['duration']);
$hr = sprintf("%'.02d\n", $duration[0]);
$min = isset($duration[1]) ? (60 * ('.' . $duration[1])) : '0';
$min = sprintf("%'.02d\n", $min);
$duration = $hr . ' : ' . $min;

// Fetch partner name using partner_id
$partner_id = $mov['partner_id'];
$partner_result = $conn->query("SELECT name FROM users WHERE id = $partner_id");
$partner_name = ($partner_result->num_rows > 0) ? $partner_result->fetch_assoc()['name'] : 'Unknown Partner';
?>

<header class="masthead">
	<div class="container pt-5">
		<div class="col-lg-12">
			<div class="row">
				<div class="col-md-4">
					<img src="assets/img/<?php echo $mov['cover_img'] ?>" alt="" class="reserve-img">
				</div>
				<div class="col-md-8">
					<div class="card bg-primary">
						<div class="card-body text-white">
							<h3><b><?php echo $mov['title'] ?></b></h3>
							<p class=""><small><b> Event By: </b><i><?php echo $partner_name; ?></i></small></p>
							<hr>
							<p class=""><small><b></b><i><?php echo $mov['description'] ?></i></small></p>
							<p class=""><small><b>Location: </b><i><?php echo $mov['location'] ?></i></small></p>
							<p class=""><small><b>Start: </b><i><?php echo $mov['date_showing'] ?></i></small></p>
							<p class=""><small><b>End: </b><i><?php echo $mov['end_date'] ?></i></small></p>
							<p class=""><small><b>Time: </b><i><?php echo $duration ?></i></small></p>
							<p class=""><small><b>Ticket Price: </b><i><?php echo $mov['price'] ?></i></small></p>
						</div>
					</div>
					<div class="card bg-light mt-2">
						<div class="card-body">
							<h4>Reserve your Ticket Here</h4>
							<form action="" id="save-reserve">
								<input type="hidden" name="event_id" value="<?php echo $_GET['id'] ?>">
								<div class="row">
									<div class="form-group col-md-4">
										<label for="" class="control-label">Name</label>
										<input type="text" name="name" required="" class="form-control">
									</div>
									<div class="form-group col-md-4">
										<label for="" class="control-label">Email</label>
										<input type="text" name="email" required="" class="form-control">
									</div>
									<div class="form-group col-md-4">
										<label for="" class="control-label">Phone</label>
										<input type="text" name="phone" required="" class="form-control">
									</div>
								</div>

								<div class="row">
									<div class="form-group col-md-4">
										<label for="" class="control-label">Quantity</label>
										<input type="number" name="qty" required="" class="form-control">
									</div>
								</div>
								<div class="row">
									<button type="button" class="col-md-2 btn btn-block btn-primary" id="buy-btn">Buy Ticket</button>
								</div>

							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        $('#buy-btn').click(function () {

            // Validate all fields are filled out
            if (!$('[name="name"]').val() || !$('[name="email"]').val() || !$('[name="phone"]').val() || !$('[name="qty"]').val()) {
                alert('All fields are required!');
                return;
            }

            // Disable the button and show loading text
            $('#buy-btn').attr('disabled', true).html("Processing...");

            // Function to generate unique ID
            function generateUniqueId() {
                var randomNum = Math.floor(Math.random() * 1000);
                var randomNumPadded = ('00' + randomNum).slice(-7);
                return randomNumPadded;
            }

            // Generate UID
            var uniqueOrderId = generateUniqueId();

            // Make an API request
            $.ajax({
                url: 'https://localhost:7100/order/create',
                method: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({
                    name: $('[name="name"]').val(),
                    email: $('[name="email"]').val(),
                    phone: $('[name="phone"]').val(),
                    qty: $('[name="qty"]').val(),
                    event_id: $('[name="event_id"]').val(),
                    id: uniqueOrderId, // Use uniqueOrderId instead of id
                }),
                error: function (err) {
                    console.log(err);
                    $('#buy-btn').removeAttr('disabled').html('Buy');
                },
                success: function (resp) {
                    console.log(resp);
                    if (resp.success) {
                        alert('Reservation successfully saved. ' +'(Invoice ID: ' + uniqueOrderId + ')');
                        location.replace('index.php');
                    } else {
                        alert(resp.message || 'Failed to save reservation. Please try again.');
                        $('#buy-btn').removeAttr('disabled').html('Buy');
                    }
                }
            });
        });
    });
</script>