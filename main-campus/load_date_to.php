<?php include('../includes/header.php'); ?>

<!--<script type="text/javascript" src="../js/jquery.min.js"></script>!-->
<script type="text/javascript">
$("#date_to_data").change(function() {
    var gateID = $('#gateID').val();
    var date_fromID = $('#date_fromID').val();
    $("#loader_cont").after(
        '<div id="loader"><img src="images/ajax_loader.gif" alt="loading...." width="10" height="10" /></div>'
    );
    $.get('load_gate_contents.php?date_toID=' + $(this).val() + '&gateID=' + gateID + '&date_fromID=' +
        date_fromID,
        function(data) {
            $("#display_contents").html(data);
            $('#loader').slideUp(910, function() {
                $(this).remove();
            });
        });
});
</script>

<?php
$date_fromID = $_REQUEST['date_fromID'];
$gateID = $_REQUEST['gateID'];
?>

<div class="col-md-4">
    <div class="row clearfix">
        <div class="col-lg-4 col-md-3 col-sm-4 col-xs-4 form-control-label">
            <label for="email_address_2">Date To</label>
        </div>
        <div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">
            <div class="form-group">
                <div class="form-line" id="loader_cont">
                    <input type="date" id="date_to_data" class="form-control" name="to"
                        min="<?php echo $date_fromID; ?>" max="<?php echo date("Y-m-d"); ?>">
                </div>
            </div>
        </div>
    </div>
</div>

<section id='display_contents' class="content" style="margin: 0;">

</section>
<input type="hidden" name="gateID" id="gateID" value="<?php echo $gateID; ?>" />
<input type="hidden" name="date_fromID" id="date_fromID" value="<?php echo $date_fromID; ?>" />