<div class="p-3">
  <div class="row">

    <div class="col-6">

      <section class="">
        <header class="d-flex justify-content-between align-items-center py-2">
          <strong>포스트 현황</strong>
        </header>

        <ul class="list-group list-group-horizontal text-center text-muted shadow-sm">
          <li class="list-group-item flex-fill">
            <small>포스트</small>
            <span class="d-block display-4">
              <?php echo number_format($my['num_post']) ?>
            </span>
          </li>
          <li class="list-group-item flex-fill">
            <small>리스트</small>
            <span class="d-block display-4">
              <?php echo number_format($my['num_list']) ?>
            </span>
          </li>
          <li class="list-group-item flex-fill">
            <small>총 조회</small>
            <span class="d-block display-4">
              <?php echo number_format($my['hit_post']) ?>
            </span>
          </li>
          <li class="list-group-item flex-fill">
            <small>총 좋아요</small>
            <span class="d-block display-4">
              <?php echo number_format($my['likes_post']) ?>
            </span>
          </li>
        </ul>
      </section>

      <section class="mt-4">
        <?php include $g['dir_module_skin'].'_recentPost.php';?>
      </section>

      <section class="mt-4">
        <?php include $g['dir_module_skin'].'_recentList.php';?>
      </section>

    </div>
    <div class="col-6">

      <section>
        <?php include $g['dir_module_skin'].'_analytics.php';?>
      </section>



    </div>

  </div><!-- /.row -->

</div>
