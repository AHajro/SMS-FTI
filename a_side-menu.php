<div class="wrapper">
    <div class="sidebar" data-background-color="black" data-active-color="danger">
    <div class="sidebar-wrapper" id="sideLinks">
            <div class="logo">
                <a href="a_index.php" class="simple-text">
                    FTI
                </a>
            </div>
            <ul class="nav">
                <li class="" id="dashboard">
                    <a href="a_dashboard.php" class="menu-link">
                        <i class="ti-dashboard"></i>
                        <p>KREU</p>
                    </a>
                </li>
                <li  id="a_students">
                    <a href="a_students.php" class="menu-link">
                        <i class="ti-user"></i>
                        <p>Studentet</p>
                    </a>
                </li>
                <li id="a_pedagog">
                    <a href="a_pedagog.php" class="menu-link">
                        <i class="ti-id-badge"></i>
                        <p>Pedagoget</p>
                    </a>
                </li>
				<li id="a_lendet">
                    <a href="a_lendet.php" class="menu-link">
                        <i class="ti-book"></i>
                        <p>Lendet</p>
                    </a>
                </li>
                         				
            </ul>
    	</div>
    </div>

<div class="main-panel">
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar bar1"></span>
					<span class="icon-bar bar2"></span>
					<span class="icon-bar bar3"></span>
				</button>
				<a class="navbar-brand" href="#">Fakulteti i Teknologjise se Informacionit</a>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="ti-user"></i>
						<p class="notification"></p>
						<p><strong><?php echo $_SESSION["admin"]; ?></strong></p>
						<b class="caret"></b>
						</a>
						<ul class="dropdown-menu"> 
                            <li>            
						<a href="a_modifiko.php"><i class="fa fa-cog"></i> <strong>Modifiko</strong></a>
						</li>
						<li>
						<a href="logout.php"><i class="fa fa-power-off"></i> <strong>Dil</strong></a>
						</li>
						</ul>
					</li>
				</ul>
				</li>
				</ul>
			</div>
		</div>
	</nav>