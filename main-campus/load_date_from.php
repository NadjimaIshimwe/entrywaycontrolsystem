<?php include('../includes/header.php'); ?>
<!--<script type="text/javascript" src="../js/jquery.min.js"></script>!-->
<script type="text/javascript">
// $(document).ready(function () {
$("#date_from_data").change(function() {
    var gateID = $('#gate_id').val();
    $("#loader_cont").after(
        '<div id="loader"><img src="images/ajax_loader.gif" alt="loading...." width="10" height="10" /></div>'
    );
    $.get('load_date_to.php?date_fromID=' + $(this).val() + '&gateID=' + gateID, function(data) {
        $("#date_to").html(data);
        $('#loader').slideUp(910, function() {
            $(this).remove();
        });
    });
});

// });
</script>

<?php
$gate_id = $_REQUEST['gate_id'];
?>

<div class="col-md-4">
    <div class="row clearfix">
        <div class="col-lg-4 col-md-3 col-sm-4 col-xs-4 form-control-label">
            <label for="email_address_2">Date From</label>
        </div>
        <div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">
            <div class="form-group">
                <div class="form-line" id="loader_cont">
                    <input type="date" id="date_from_data" class="form-control" max="<?php echo date("Y-m-d"); ?>"
                        name="from" />
                </div>
            </div>
        </div>
    </div>
</div>

<div name='date_to' id='date_to'></div>
<input type="hidden" name="gateID" id="gateID" value="<?php echo $gate_id; ?>" />