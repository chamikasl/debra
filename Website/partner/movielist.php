<style>
    td img {
        width: 50px;
        height: 75px;
        margin: auto;
    }
</style>
<?php include('db_connect.php') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-block btn-sm btn-primary col-sm-2" type="button" id="new_movie"><i class="fa fa-plus"></i> New Event</button>
        </div>
    </div>
    <div class="row">
        <div class="card col-md-12 mt-3">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Cover</th>
                            <th class="text-center">Title</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        // Retrieve partner ID from the session
                        $partner_id = isset($_SESSION['login_id']) ? $_SESSION['login_id'] : 0;

                        // Modify the SQL query to filter events by partner_id
                        $movie = $conn->query("SELECT * FROM events WHERE partner_id = $partner_id");
                        while ($row = $movie->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?php echo $i++ ?></td>
                                <td>
                                    <center><img src="../assets/img/<?php echo $row['cover_img'] ?>" alt=""></center>
                                </td>
                                <td><?php echo ucwords($row['title']) ?></td>
                                <?php if (strtotime(date('Y-m-d')) < strtotime($row['date_showing'])) : ?>
                                    <td>Pending</td>
                                <?php elseif (strtotime(date('Y-m-d')) > strtotime($row['date_showing']) && strtotime(date('Y-m-d')) < strtotime($row['end_date'])) : ?>
                                    <td>Running</td>
                                <?php else : ?>
                                    <td>Ended</td>

                                <?php endif; ?>
                                <td>
                                    <center>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary">Manage</button>
                                            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item edit_movie" href="javascript:void(0)" data-id='<?php echo $row['id'] ?>'>Edit</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item delete_movie" href="javascript:void(0)" data-id='<?php echo $row['id'] ?>'>Delete</a>
                                            </div>
                                        </div>
                                    </center>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<script>
	$('#new_movie').click(function() {
		uni_modal('New Event', 'manage_movie.php');
	})
	$('.edit_movie').click(function() {
		uni_modal('Edit Event', 'manage_movie.php?id=' + $(this).attr('data-id'));
	})
	$('.delete_movie').click(function() {
		_conf('Are you sure to delete this data?', 'delete_movie', [$(this).attr('data-id')])
	})

	function delete_movie($id = '') {
		start_load()
		$.ajax({
			url: 'ajax.php?action=delete_movie',
			method: 'POST',
			data: {
				id: $id
			},
			success: function(resp) {
				if (resp == 1) {
					alert_toast("Data successfully deleted", 'success');
					setTimeout(function() {
						location.reload()
					}, 1500)
				}
			}
		})
	}
</script>