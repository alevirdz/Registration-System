
<nav id="sidebar" class="sidebar-black">
			<div class="sidebar-content-black js-simplebar">
				<a class="sidebar-brand" href="Dashboard-panel.php" id="panel">
					<img class="img-fluid rounded-circle" src="https://picsum.photos/30/30" alt="">
          			<span class="align-middle">Empresa</span>
        		</a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Pages
					</li>

					<li class="sidebar-item active" id="item-desktop">
						<a class="sidebar-link" href="Dashboard-panel.php" id="panel">
              			<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Escritorio</span>
            			</a>
					</li>

					<li class="sidebar-item" id="item-donation">
						<a class="sidebar-link" onclick=actionMenu((this.id)) id="donations">
              			<i class="align-middle" data-feather="heart"></i> <span class="align-middle">Donaciones</span>
            			</a>
					</li>

					<li class="sidebar-item" id="item-inscriptions">
						<a class="sidebar-link" onclick=actionMenu((this.id)) id="inscriptions">
              			<i class="align-middle" data-feather="calendar"></i> <span class="align-middle">Inscripciones</span>
            			</a>
					</li>

					<li class="sidebar-item" id="item-profile">
						<a class="sidebar-link-black" onclick=actionMenu((this.id)) id="profile">
              			<i class="align-middle" data-feather="user"></i> <span class="align-middle">Perfil</span>
            			</a>
					</li>

					<li class="sidebar-item" id="item-configurations">
						<a class="sidebar-link-black" onclick=actionMenu((this.id)) id="configurations">
              			<i class="align-middle" data-feather="settings"></i> <span class="align-middle">Configuración</span>
            			</a>
					</li>


					<li class="sidebar-item" id="item-user-management">
						<a href="#auth" data-bs-toggle="collapse" class="sidebar-link-black collapsed">
              			<i class="align-middle" data-feather="users"></i> <span class="align-middle">Gestion de usuarios</span>
            			</a>
						<ul id="auth" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
							<li class="sidebar-item"><a class="sidebar-link" href="pages-sign-in.html">Crear usuario</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="pages-sign-up.html">Ver registros de usuario</a></li>
						</ul>
					</li>

					

					<li class="sidebar-header">
						Ubicaciones
					</li>

					<li class="sidebar-item" id="item-direction">
						<a class="sidebar-link-black" onclick=actionMenu((this.id)) id="direction">
              			<i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Dirección</span>
            			</a>
					</li>

					<li class="sidebar-item" id="item-maps">
						<a class="sidebar-link-black" onclick=actionMenu((this.id)) id="maps">
              			<i class="align-middle" data-feather="map"></i> <span class="align-middle">Mapas</span>
            			</a>
					</li>
				</ul>

				<!-- <div class="sidebar-cta">
					<div class="sidebar-cta-content">
						<strong class="d-inline-block mb-2">Upgrade to Pro</strong>
						<div class="mb-3 text-sm">
							Are you looking for more components? Check out our premium version.
						</div>
						<div class="d-grid">
							<a href="https://adminkit.io/pricing" target="_blank" class="btn btn-primary">Upgrade to Pro</a>
						</div>
					</div>
				</div> -->
			</div>
		</nav>