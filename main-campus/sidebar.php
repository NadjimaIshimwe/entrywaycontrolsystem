<div class="menu">
    <ul class="list">
        <li class="header">ADMIN MAIN NAVIGATION </li>
        <li class="active">
            <a href="index.php">
                <i class="material-icons">home</i>
                <span>Dashboard</span>
            </a>
        </li>

        <li>
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">settings</i>
                <span>Manage</span>
            </a>

            <ul class="ml-menu">
                <li>
                    <a href="check_point.php">Check Point</a>
                </li>

            </ul>
        </li>

        <li>
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">linear_scale</i>
                <span>Check Points</span>
            </a>

            <ul class="ml-menu">
                <?php
                $sql = " SELECT * FROM tbl_place ";
                $query = $conn->prepare($sql);
                $query->execute();

                while ($fetch = $query->fetch()) {
                    $place_id = $fetch['place_id'];
                    $today = date("Y-m-d");
                ?>
                <li>
                    <a
                        href="cp_data.php?place=<?php echo $place_id; ?>&today=<?php echo $today; ?>"><?php echo $fetch['place_name'] ?></a>
                </li>
                <?php
                }
                ?>
            </ul>
        </li>

        <li>
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">add</i>
                <span>Report</span>
            </a>

            <ul class="ml-menu">
                <!--<li>-->
                <!--    <a href="quick_report">Quick Report</a>-->
                <!--</li>-->

                <li>
                    <a href="general_report.php">General Entrance rpt</a>
                </li>
            </ul>
        </li>
</div>