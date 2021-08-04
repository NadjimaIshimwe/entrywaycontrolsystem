<body class="theme-carmine">

    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="index.php" style="display: flex; align-items: center;"><img
                        src="../images/entry_logo_only.png"
                        style="width: 30px; height: 30px; border-radius: 50%; object-fit: contain;"><strong>EntryWay
                        Control</strong></a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                    <?php if ($_SESSION['role'] != 6) { ?>
                    <li><a href="javascript:void(0);" class="js-search" data-close="true"><i
                                class="material-icons">search</i></a></li>
                    <!-- #END# Call Search -->
                    <?php } ?>
                    <?php if ($_SESSION['role'] == 6) { ?>
                    <li><a href="../logout.php"> <i class="fa fa-sign-out"></i> Logout</a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->