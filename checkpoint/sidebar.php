<!-- Place Menu-->
<div class="menu">
    <ul class="list">
        <li class="header"><?php echo $place_name; ?> MAIN NAVIGATION</li>

        <li class="active">
            <a href="index.php">
                <i class="material-icons">
                    business
                </i>
                <span>Dashboard</span>
            </a>
        </li>

        <li>
            <a href="record.php">
                <i class="material-icons">home</i>
                <span>Make Record</span>
            </a>
        </li>

        <li>
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">view_list</i>
                <span>Report</span>
            </a>

            <ul class="ml-menu">
                <!--<li>-->
                <!--    <a href="rpt_place_people_history.php">View All History</a>-->
                <!--</li>-->
                <li>
                    <a href="report_filter.php">View Report</a>
                </li>
                <!--<li>-->
                <!--    <a href="rpt_place_no_exit_history.php">No Exit History</a>-->
                <!--</li>-->
            </ul>
        </li>

    </ul>
</div>
<!-- end of Place Menu -->