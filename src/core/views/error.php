<div class="alert alert-danger">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong><?php echo $lang['ERROR']; ?> : : </strong>
  <p><?php echo $msg; ?></p>
</div>

<script>

$(function () {
    var $alert = $('#alert');
    if($alert.length)
    {
        var alerttimer = window.setTimeout(function () {
            $alert.trigger('click');
        }, 3000);
        $alert.animate({height: $alert.css('line-height') || '50px'}, 200)
        .click(function () {
            window.clearTimeout(alerttimer);
            $alert.animate({height: '0'}, 200);
            $alert.hide();
        });
    }
});

</script>