<style>
    .nav-item.active {
        background-color: white;
    }
</style>

<nav id="sidebar" class='mx-lt-5 bg-light'>
    <div class="container-fluid">
        <div class="sidebar-list">
            <a href="index.php?page=movielist" class="nav-item nav-movielist"><span class='icon-field'><i class="fa fa-list"></i></span> Event List</a>
            <a href="index.php?page=status" class="nav-item nav-status"><span class='icon-field'><i class="fa fa-book"></i></span> Sale Status</a>
            <a href="index.php?page=book" class="nav-item nav-book"><span class='icon-field'><i class="fa fa-book"></i></span> Purchases</a>
        </div>
    </div>
</nav>

<script>
    $(document).ready(function() {
		$('.nav-item').removeClass('active');
        $('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active');
    });
</script>
