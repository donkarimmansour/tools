<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
	<a class="navbar-brand" href="home.php">MobiLive</a>
	<button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>

	<ul class="navbar-nav ml-auto">
		<li class="nav-item dropdown">

			<a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

				<img class="user-avatar rounded-circle" style="width: 35px;height: 35px;" src="<?php echo $cssImg; ?>avatar/empty.png">

				

			</a>
			<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
				<a class="dropdown-item" href="profile.php"><i class="fas fa-id-badge"></i> My Profile</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
			</div>
		</li>
	</ul>
</nav>
<div id="layoutSidenav">
	<div id="layoutSidenav_nav">
		<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
			<div class="sb-sidenav-menu">
				<div class="nav">

					<div class="sb-sidenav-menu-heading">By Karim Mansour</div>
					<a class="nav-link" href="home.php">
						<div class="sb-nav-link-icon"><i class="fas fa-chart-line"></i></div>
						Dashboard
					</a>
					<div class="sb-sidenav-menu-heading">App</div>
					<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayoutsEmail" aria-expanded="false" aria-controls="collapseLayouts">
						<div class="sb-nav-link-icon"><i class="fas fa-envelope-square"></i></div>
						Email

					</a>
					<div class="collapse" id="collapseLayoutsEmail" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
						<nav class="sb-sidenav-menu-nested nav">
							<a class="nav-link" href="./email/views/sender.php"><i class="fas fa-at"></i>&nbsp; Sender</a>
							<a class="nav-link" href="./email/views/extractor.php"><i class="fas fa-redo-alt"></i>&nbsp; Extractor</a>
							<a class="nav-link" href="./email/views/scraper.php"><i class="fas fa-redo-alt"></i>&nbsp; Scraper</a>
							<a class="nav-link" href="./email/views/links.php"><i class="fas fa-redo-alt"></i>&nbsp; Url Extractor</a>
							<a class="nav-link" href="./email/views/checker.php"><i class="fas fa-check"></i>&nbsp; Checker</a>
						</nav>
					</div>
					<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayoutsIban" aria-expanded="false" aria-controls="collapseLayouts">
						<div class="sb-nav-link-icon"><i class="fas fa-university"></i></div>
						Iban

					</a>
					<div class="collapse" id="collapseLayoutsIban" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
						<nav class="sb-sidenav-menu-nested nav">
							<a class="nav-link" href="./iban/views/generator.php"><i class="fas fa-redo-alt"></i>&nbsp; Generator </a>
							<a class="nav-link" href="./iban/views/checker.php"><i class="fas fa-check"></i>&nbsp; Checker</a>
						</nav>
					</div>
					<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayoutsSsn" aria-expanded="false" aria-controls="collapseLayouts">
						<div class="sb-nav-link-icon"><i class="fas fa-shield-alt"></i></div>
						Ssn

					</a>
					<div class="collapse" id="collapseLayoutsSsn" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
						<nav class="sb-sidenav-menu-nested nav">
							<a class="nav-link" href="/ssn/views/generator.php"><i class="fas fa-redo-alt"></i>&nbsp; Generator </a>
							<a class="nav-link" href="/ssn/views/checker.php"><i class="fas fa-check"></i>&nbsp; Checker</a>
						</nav>
					</div>
					<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayoutsInfo" aria-expanded="false" aria-controls="collapseLayouts">
						<div class="sb-nav-link-icon"><i class="fas fa-info"></i></div>
						Info

					</a>
					<div class="collapse" id="collapseLayoutsInfo" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
						<nav class="sb-sidenav-menu-nested nav">
							<a class="nav-link" href="./info/generator.php"><i class="fas fa-redo-alt"></i>&nbsp; Generator </a>
						</nav>
					</div>
					<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayoutsBin" aria-expanded="false" aria-controls="collapseLayouts">
						<div class="sb-nav-link-icon"><i class="far fa-credit-card"></i></div>
						Bin

					</a>
					<div class="collapse" id="collapseLayoutsBin" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
						<nav class="sb-sidenav-menu-nested nav">
							<a class="nav-link" href="./bin/generator.php"><i class="fas fa-redo-alt"></i>&nbsp; Generator </a>
							<a class="nav-link" href="./bin/checker.php"><i class="fas fa-check"></i>&nbsp; Checker </a>
						</nav>
					</div>
					<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayoutsProxy" aria-expanded="false" aria-controls="collapseLayouts">
						<div class="sb-nav-link-icon"><i class="fab fa-internet-explorer"></i></div>
						Proxy

					</a>
					<div class="collapse" id="collapseLayoutsProxy" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
						<nav class="sb-sidenav-menu-nested nav">
							<a class="nav-link" href="./proxy/checker.php"><i class="fas fa-check"></i>&nbsp; Checker </a>
						</nav>
					</div>
					<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayoutsCc" aria-expanded="false" aria-controls="collapseLayouts">
						<div class="sb-nav-link-icon"><i class="fas fa-cart-plus"></i></div>
						Cc

					</a>
					<div class="collapse" id="collapseLayoutsCc" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
						<nav class="sb-sidenav-menu-nested nav">
					     	<a class="nav-link" href="./cc/views/generator.php"><i class="fas fa-redo-alt"></i>&nbsp; Generator </a>
							<a class="nav-link" href="./cc/views/checker.php"><i class="fas fa-check"></i>&nbsp; Checker</a>
						</nav>
					</div>

				</div>
			</div>
			<div class="sb-sidenav-footer">
				<div class="small">Logged in as:</div>
				<?php
				echo "karim";
				?> <i class="fas fa-meh-rolling-eyes"></i>
			</div>
		</nav>
	</div>

	<div id="layoutSidenav_content">
		<main>