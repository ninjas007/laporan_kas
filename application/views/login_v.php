<div class="row row-content-value">
  <?php if ($this->session->flashdata('error') == TRUE): ?>
      <div role="alert" class="alert alert-danger alert-dismissable fade in" >
          <button aria-label="Close" data-dismiss="alert" class="close btn-xs" type="button"><span aria-hidden="true" class="fa fa-times"></span></button>
          <strong><?php echo $this->session->flashdata('error'); ?></strong>
      </div>
  <?php endif ?>
  <div class="box" style="background: #ff2c31; padding: 50px; height: 50%;">
    <form action="<?php echo base_url('login/redirect') ?>" method="POST" role="form">
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="Email...">
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" name="password" class="form-control" id="password" placeholder="Password...">
      </div>
      <button type="submit" name="login" class="btn btn-success form-control">Login</button>
    </form>

  </div>
</div>
<script src="<?php echo base_url() ?>/assets/js/jQuery-2.1.4.min.js"></script>
<script>
$(document).ready(function($) {
       $('.alert').fadeOut(5000);
});
</script>