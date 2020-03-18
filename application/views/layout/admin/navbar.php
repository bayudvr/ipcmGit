					<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

					<ul class="navbar-nav ml-auto">
						
						<li class="nav-item dropdown no-arrow">
							<a href="#" class="nav-link dropdown-toggle" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php foreach($user as $u){echo $u->email;} ?></span>
								<i class="fa fa-user"></i>
							</a>

							<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
				                <div class="dropdown-divider"></div>
				                <a class="dropdown-item" href="#" onclick="logout()">
				                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
				                  Logout
				                </a>
							</div>
						</li>
					</ul>
				</nav>