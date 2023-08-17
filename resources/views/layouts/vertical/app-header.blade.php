						<!--app header-->
						<div class="app-header header main-header1">
							<div class="container-fluid">
								<div class="d-flex">
									<a class="header-brand" href="{{url('index')}}">
										<img src="{{asset('assets/images/brand/logoCEMIN.png')}}" class="header-brand-img desktop-lgo" alt="CEMIN logo">
										<img src="{{asset('assets/images/brand/logo1.png')}}" class="header-brand-img dark-logo" alt="CEMIN logo">
										<img src="{{asset('assets/images/brand/faviconCEMIN.png')}}" class="header-brand-img mobile-logo" alt="CEMIN logo">
										<img src="{{asset('assets/images/brand/favicon1.png')}}" class="header-brand-img darkmobile-logo" alt="CEMIN logo">
									</a>
									<div class="app-sidebar__toggle d-flex" data-bs-toggle="sidebar">
										<a class="open-toggle" href="javascript:void(0);">
											<svg xmlns="http://www.w3.org/2000/svg" class="feather feather-align-left header-icon" width="24" height="24" viewBox="0 0 24 24"><path d="M4 6h16v2H4zm0 5h16v2H4zm0 5h16v2H4z"/></svg>
										</a>
									</div>
									
									<div class="d-flex order-lg-2 ms-auto main-header-end" >
										<button  class="navbar-toggler navresponsive-toggler d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="true" aria-label="Toggle navigation">
											<i class="fe fe-more-vertical header-icons navbar-toggler-icon"></i>
										</button>
										<div class="navbar navbar-expand-lg navbar-collapse responsive-navbar p-0">
											<div class="collapse navbar-collapse" id="navbarSupportedContent-4">
												<div class="d-flex order-lg-2">
													<!--
													<div class="dropdown d-flex">
														<a class="nav-link icon theme-layout nav-link-bg layout-setting">
															<span class="light-layout">
																<svg xmlns="http://www.w3.org/2000/svg" class="header-icon" width="24" height="24" viewBox="0 0 24 24">
																	<path d="M20.742 13.045a8.088 8.088 0 0 1-2.077.271c-2.135 0-4.14-.83-5.646-2.336a8.025 8.025 0 0 1-2.064-7.723A1 1 0 0 0 9.73 2.034a10.014 10.014 0 0 0-4.489 2.582c-3.898 3.898-3.898 10.243 0 14.143a9.937 9.937 0 0 0 7.072 2.93 9.93 9.93 0 0 0 7.07-2.929 10.007 10.007 0 0 0 2.583-4.491 1.001 1.001 0 0 0-1.224-1.224zm-2.772 4.301a7.947 7.947 0 0 1-5.656 2.343 7.953 7.953 0 0 1-5.658-2.344c-3.118-3.119-3.118-8.195 0-11.314a7.923 7.923 0 0 1 2.06-1.483 10.027 10.027 0 0 0 2.89 7.848 9.972 9.972 0 0 0 7.848 2.891 8.036 8.036 0 0 1-1.484 2.059z"/>
																</svg>
															</span>
															<span class="dark-layout"><svg xmlns="http://www.w3.org/2000/svg" class="header-icon" width="24" height="24" viewBox="0 0 24 24">
																<path d="M6.993 12c0 2.761 2.246 5.007 5.007 5.007s5.007-2.246 5.007-5.007S14.761 6.993 12 6.993 6.993 9.239 6.993 12zM12 8.993c1.658 0 3.007 1.349 3.007 3.007S13.658 15.007 12 15.007 8.993 13.658 8.993 12 10.342 8.993 12 8.993zM10.998 19h2v3h-2zm0-17h2v3h-2zm-9 9h3v2h-3zm17 0h3v2h-3zM4.219 18.363l2.12-2.122 1.415 1.414-2.12 2.122zM16.24 6.344l2.122-2.122 1.414 1.414-2.122 2.122zM6.342 7.759 4.22 5.637l1.415-1.414 2.12 2.122zm13.434 10.605-1.414 1.414-2.122-2.122 1.414-1.414z"/></svg>
															</span>
														</a>
													</div>
													 -->
													<!-- Theme-Layout -->
													<div class="dropdown  header-fullscreen d-flex" >
														<a  class="nav-link icon full-screen-link p-0"  id="fullscreen-button">
															<svg xmlns="http://www.w3.org/2000/svg" class="header-icon" width="24" height="24" viewBox="0 0 24 24"><path d="M5 5h5V3H3v7h2zm5 14H5v-5H3v7h7zm11-5h-2v5h-5v2h7zm-2-4h2V3h-7v2h5z"/></svg>
														</a>
													</div>
													
													<!--
													<div class="dropdown header-notify d-flex">
														<a class="nav-link icon" data-bs-toggle="dropdown">
															<svg xmlns="http://www.w3.org/2000/svg" class="header-icon" width="24" height="24" viewBox="0 0 24 24"><path d="M19 13.586V10c0-3.217-2.185-5.927-5.145-6.742C13.562 2.52 12.846 2 12 2s-1.562.52-1.855 1.258C7.185 4.074 5 6.783 5 10v3.586l-1.707 1.707A.996.996 0 0 0 3 16v2a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1v-2a.996.996 0 0 0-.293-.707L19 13.586zM19 17H5v-.586l1.707-1.707A.996.996 0 0 0 7 14v-4c0-2.757 2.243-5 5-5s5 2.243 5 5v4c0 .266.105.52.293.707L19 16.414V17zm-7 5a2.98 2.98 0 0 0 2.818-2H9.182A2.98 2.98 0 0 0 12 22z"/></svg><span class="pulse "></span>
														</a>
														<div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow  animated">
															<div class="dropdown-header">
																<h6 class="mb-0">Notifications</h6>
																<span class="badge fs-10 bg-secondary br-7 ms-auto">New</span>
															</div>
															<div class="notify-menu">
																<a href="{{url('email-inbox')}}" class="dropdown-item border-bottom d-flex ps-4">
																	<div class="notifyimg  text-primary bg-primary-transparent border-primary"> <i class="fa fa-envelope"></i> </div>
																	<div>
																		<span class="fs-13">Message Sent.</span>
																		<div class="small text-muted">3 hours ago</div>
																	</div>
																</a>
																<a href="{{url('email-inbox')}}" class="dropdown-item border-bottom d-flex ps-4">
																	<div class="notifyimg  text-secondary bg-secondary-transparent border-secondary"> <i class="fa fa-shopping-cart"></i></div>
																	<div>
																		<span class="fs-13">Order Placed</span>
																		<div class="small text-muted">5  hour ago</div>
																	</div>
																</a>
																<a href="{{url('email-inbox')}}" class="dropdown-item border-bottom d-flex ps-4">
																	<div class="notifyimg  text-danger bg-danger-transparent border-danger"> <i class="fa fa-gift"></i> </div>
																	<div>
																		<span class="fs-13">Event Started</span>
																		<div class="small text-muted">45 mintues ago</div>
																	</div>
																</a>
																<a href="{{url('email-inbox')}}" class="dropdown-item border-bottom d-flex ps-4 mb-2">
																	<div class="notifyimg  text-success  bg-success-transparent border-success"> <i class="fa fa-windows"></i> </div>
																	<div>
																		<span class="fs-13">Your Admin lanuched</span>
																		<div class="small text-muted">1 daya ago</div>
																	</div>
																</a>
															</div>
															<div class=" text-center p-2">
																<a href="{{url('email-inbox')}}" class="btn btn-primary btn-md fs-13 btn-block">View All</a>
															</div>
														</div>
													</div>
													-->
													<div class="dropdown ">
														<a class="nav-link icon" data-bs-toggle="dropdown">
															<svg xmlns="http://www.w3.org/2000/svg" class="header-icon" width="24" height="24" viewBox="796 796 200 200">
																<path d="M896.003 827.425c-20.538 0-37.187 19.66-37.187 43.921 0 24.258 16.648 43.924 37.187 43.924s37.188-19.667 37.188-43.924c0-24.261-16.65-43.921-37.188-43.921z"/><path d="M896 796c-55.141 0-100 44.859-100 99.999C796.001 951.14 840.86 996 896 996c55.139 0 99.999-44.86 99.999-100.001C995.999 840.859 951.14 796 896 796zm66.014 157.885c-.029-.111-.044-.223-.075-.333-4.735-16.523-15.472-30.494-29.687-39.455a7.483 7.483 0 0 0-8.931.71c-7.63 6.719-17.069 10.72-27.319 10.72-10.45 0-20.061-4.156-27.767-11.113a7.474 7.474 0 0 0-8.91-.829c-14.407 8.797-25.353 22.689-30.299 39.192-13.012-15.325-20.887-35.145-20.887-56.777 0-48.446 39.414-87.86 87.86-87.86 48.445 0 87.859 39.414 87.859 87.86.001 22.159-8.261 42.412-21.844 57.885z"/>
															</svg>
														</a>
													
														<div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow animated">
															<div class="text-center">
																<div class="text-center user pb-0 font-weight-bold">Has ingresado como</div>
																<span class="text-center user-semi-title">{{auth()->user()->email}}</span>
																<div class="dropdown-divider"></div>
															</div>

															<!--
															<a class="dropdown-item d-flex" href="{{url('profile1')}}">
																<svg class="header-icon me-2" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zM7.07 18.28c.43-.9 3.05-1.78 4.93-1.78s4.51.88 4.93 1.78C15.57 19.36 13.86 20 12 20s-3.57-.64-4.93-1.72zm11.29-1.45c-1.43-1.74-4.9-2.33-6.36-2.33s-4.93.59-6.36 2.33C4.62 15.49 4 13.82 4 12c0-4.41 3.59-8 8-8s8 3.59 8 8c0 1.82-.62 3.49-1.64 4.83zM12 6c-1.94 0-3.5 1.56-3.5 3.5S10.06 13 12 13s3.5-1.56 3.5-3.5S13.94 6 12 6zm0 5c-.83 0-1.5-.67-1.5-1.5S11.17 8 12 8s1.5.67 1.5 1.5S12.83 11 12 11z"/></svg>
																<div class="fs-13">Profile</div>
															</a>
															<a class="dropdown-item d-flex" href="{{url('search')}}">
																<svg class="header-icon me-2" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19.43 12.98c.04-.32.07-.64.07-.98 0-.34-.03-.66-.07-.98l2.11-1.65c.19-.15.24-.42.12-.64l-2-3.46c-.09-.16-.26-.25-.44-.25-.06 0-.12.01-.17.03l-2.49 1c-.52-.4-1.08-.73-1.69-.98l-.38-2.65C14.46 2.18 14.25 2 14 2h-4c-.25 0-.46.18-.49.42l-.38 2.65c-.61.25-1.17.59-1.69.98l-2.49-1c-.06-.02-.12-.03-.18-.03-.17 0-.34.09-.43.25l-2 3.46c-.13.22-.07.49.12.64l2.11 1.65c-.04.32-.07.65-.07.98 0 .33.03.66.07.98l-2.11 1.65c-.19.15-.24.42-.12.64l2 3.46c.09.16.26.25.44.25.06 0 .12-.01.17-.03l2.49-1c.52.4 1.08.73 1.69.98l.38 2.65c.03.24.24.42.49.42h4c.25 0 .46-.18.49-.42l.38-2.65c.61-.25 1.17-.59 1.69-.98l2.49 1c.06.02.12.03.18.03.17 0 .34-.09.43-.25l2-3.46c.12-.22.07-.49-.12-.64l-2.11-1.65zm-1.98-1.71c.04.31.05.52.05.73 0 .21-.02.43-.05.73l-.14 1.13.89.7 1.08.84-.7 1.21-1.27-.51-1.04-.42-.9.68c-.43.32-.84.56-1.25.73l-1.06.43-.16 1.13-.2 1.35h-1.4l-.19-1.35-.16-1.13-1.06-.43c-.43-.18-.83-.41-1.23-.71l-.91-.7-1.06.43-1.27.51-.7-1.21 1.08-.84.89-.7-.14-1.13c-.03-.31-.05-.54-.05-.74s.02-.43.05-.73l.14-1.13-.89-.7-1.08-.84.7-1.21 1.27.51 1.04.42.9-.68c.43-.32.84-.56 1.25-.73l1.06-.43.16-1.13.2-1.35h1.39l.19 1.35.16 1.13 1.06.43c.43.18.83.41 1.23.71l.91.7 1.06-.43 1.27-.51.7 1.21-1.07.85-.89.7.14 1.13zM12 8c-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4zm0 6c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z"/></svg>
																<div class="fs-13">Settings</div>
															</a>
															<a class="dropdown-item d-flex" href="{{url('chat')}}">
																<svg class="header-icon me-2" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M4 4h16v12H5.17L4 17.17V4m0-2c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2H4zm2 10h12v2H6v-2zm0-3h12v2H6V9zm0-3h12v2H6V6z"/></svg>
																<div class="fs-13">Messages</div>
															</a>

															
															<a class="dropdown-item d-flex">
															-->
															<div class="text-center">
																<form id="logout-form" action="{!! route('logout') !!}" method="post">
																	@csrf
																	<a class="side-menu__item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"  data-bs-toggle="slide" >
																		<svg class="header-icon me-2" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24"><g><rect fill="none" height="24" width="24"/></g><g><path d="M11,7L9.6,8.4l2.6,2.6H2v2h10.2l-2.6,2.6L11,17l5-5L11,7z M20,19h-8v2h8c1.1,0,2-0.9,2-2V5c0-1.1-0.9-2-2-2h-8v2h8V19z"/></g></svg>

																		<span class="material-icons-outlined">
																		</span>
																		&nbsp;
																	<span class="side-menu__label">Cerrar sesión</span></a>
																</form>
															</div>
															<!--
															</a>
															-->
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--/app header-->