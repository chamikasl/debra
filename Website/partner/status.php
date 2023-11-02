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
                            <th class="text-center">Event Name</th>
                            <th class="text-center">Event ID</th>
                            <th class="text-center">Tickets Sold</th>
                            <th class="text-center">Revenue</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $partner_id = $_SESSION['login_id'];

                        $events = $conn->query("SELECT m.id as event_id, m.title as event_name, SUM(b.qty) as tickets_sold, SUM(b.qty * m.price) as revenue
                                               FROM events m
                                               LEFT JOIN orders b ON m.id = b.event_id
                                               WHERE m.partner_id = $partner_id
                                               GROUP BY m.id, m.title");

                        while ($row = $events->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?php echo $i++ ?></td>
                                <td><?php echo $row['event_name'] ?></td>
                                <td><?php echo $row['event_id'] ?></td>
                                <td><?php echo $row['tickets_sold'] ?></td>
                                <td><?php echo $row['revenue'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
