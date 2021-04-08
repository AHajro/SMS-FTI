<div class="wrapper">
    <div class="sidebar" data-background-color="black" data-active-color="danger">
    <div class="sidebar-wrapper" id="sideLinks">
            <div class="logo">
                <a href="a_index.php" class="simple-text">
                   FTI
                </a>
            </div>
            <ul class="nav">
                <li class="" id="p_dashboard">
                    <a href="p_dashboard.php" class="menu-link">
                        <i class="ti-dashboard"></i>
                        <p>KREU</p>
                    </a>
                </li>
				<li id="p_leksion">
                    <a href="p_leksion.php" class="menu-link">
                        <i class="ti-folder"></i>
                        <p>Leksion</p>
                    </a>
                </li>
				<li id="p_seminar">
                    <a href="p_seminar.php" class="menu-link">
                        <i class="ti-bar-chart-alt"></i>
                        <p>Seminar</p>
                    </a>
                </li>
				<li id="p_lab">
                    <a href="p_lab.php" class="menu-link">
                        <i class="ti-vector"></i>
                        <p>Laborator</p>
                    </a>
                </li>
				<li id="p_detyra">
                    <a href="p_detyra.php" class="menu-link">
                        <i class="ti-write"></i>
                        <p>Detyra</p>
                    </a>
                </li>
				<li id="p_provim">
                    <a href="p_provim.php" class="menu-link">
                        <i class="ti-files"></i>
                        <p>Provim</p>
                    </a>
                </li>
				
                <li id="p_vleresim_perfundimtar">
                    <a href="p_vleresim_perfundimtar.php" class="menu-link">
                        <i class="ti-stats-up"></i>
                        <p>Vleresime perfundimtare</p>
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
						<p><strong><?php echo $_SESSION["pedagog"]; ?></strong></p>
						<b class="caret"></b>
						</a>
						</a>
						<ul class="dropdown-menu"> 
                            <li>            
						<a href="p_modifiko.php"><i class="fa fa-cog"></i> <strong>Modifiko</strong></a>
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