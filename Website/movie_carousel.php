<?php
include 'db_connect.php';
$events = $conn->query("SELECT * FROM events WHERE CURDATE() <= date(end_date) ORDER BY RAND() LIMIT 10");
?>

<div id="movie-carousel-field">

  <div class="list-prev list-nav">
    <a href="javascript:void(0)" class="text" style="color: white;" ><i class="fa fa-angle-left"></i></a>
  </div>

  <div class="list">
    <?php while ($row = $events->fetch_assoc()) : ?>
      <div class="movie-item">
        <img class="" src="assets/img/<?php echo $row['cover_img']  ?>" alt="<?php echo $row['title'] ?>">
        <div class="mov-det">
          <button type="button" class="btn btn-primary" data-id="<?php echo $row['id'] ?>">Explore</button>
        </div>
      </div>
    <?php endwhile; ?>
  </div>

  <div class="list-next list-nav">
    <a href="javascript:void(0)" class="text" style="color: white;"><i class="fa fa-angle-right"></i></a>
  </div>

</div>

<script>

  $('#movie-carousel-field .list-next').click(function() {
    $('#movie-carousel-field .list').animate({
      scrollLeft: $('#movie-carousel-field .list').scrollLeft() + ($('#movie-carousel-field .list').find('img').width() * 3)
    }, 'slow');
  })

  $('#movie-carousel-field .list-prev').click(function() {
    $('#movie-carousel-field .list').animate({
      scrollLeft: $('#movie-carousel-field .list').scrollLeft() - ($('#movie-carousel-field .list').find('img').width() * 3)
    }, 'slow');
  })

  $('.mov-det button').click(function() {
    location.replace('index.php?page=reserve&id=' + $(this).attr('data-id'))
  })
</script>
