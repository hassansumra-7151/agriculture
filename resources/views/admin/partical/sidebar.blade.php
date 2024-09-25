<div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>DarkPan</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="{{url('')}}/admin/img/testimonial-1.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">Noor Hassan</h6>
                        @if(Auth::check())
                            <span>{{ Auth::user()->name }}</span>
                        @else
                            <span>You are not logged in</span>
                        @endif
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="{{ route('admin.home') }}" class="nav-item nav-link active">
                        <i class="fa fa-tachometer-alt me-2"></i>Dashboard
                    </a>
                    <a href="{{ route('user.index') }}" class="nav-item nav-link">
                        <i class="fa fa-globe me-2"></i>Website
                    </a>

                    @can('manage banner')
                    <div class="nav-item dropdown">
                         <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-flag me-2"></i> Manage Banner
                        </a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{ route('banner.create')}}" class="dropdown-item">
                                <i class="fa fa-plus me-2"></i> Add Banner
                            </a>
                            <a href="{{ route('banner.list')}}" class="dropdown-item">
                                <i class="fa fa-list me-2"></i> List Banner
                            </a>
                        </div>
                    </div>
                    @endcan
                    @can('manage product')
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-boxes me-2"></i>Manage Products
                        </a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{ route('product.create') }}" class="dropdown-item"><i class="fa fa-plus me-2"></i> Add Product</a>
                            <a href="{{ route('product.index') }}" class="dropdown-item"><i class="fa fa-list me-2"></i> List Product</a>
                        </div>
                    </div>
                    @endcan
                    @can('manage category')
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-tags me-2"></i>Manage Category
                        </a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{ route('category.create') }}" class="dropdown-item"><i class="fa fa-plus me-2"></i> Add Category</a>
                            <a href="typography.html" class="dropdown-item"><i class="fa fa-list me-2"></i> List Category</a>
                        </div>
                    </div>
                    @endcan
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-user-shield me-6"></i>Role&Permissions
                        </a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{ route('role.list') }}" class="dropdown-item">Role</a>
                            <a href="{{ route('permission.list') }}" class="dropdown-item">Permission</a>
                            <a href="{{ route('user.list') }}" class="dropdown-item">User</a>
                        </div>
                    </div>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-leaf me-2"></i>Agriculture
                        </a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{ route('agriculture.create') }}" class="dropdown-item">
                                <i class="fa fa-plus me-2"></i> Add
                            </a>
                            <a href="{{ route('agriculture.list') }}" class="dropdown-item">
                                <i class="fa fa-list me-2"></i> List
                            </a>
                        </div>
                    </div>


                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-seedling me-2"></i>Fertilizer(کھاد)
                        </a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{ route('fertilizer.create') }}" class="dropdown-item">
                                <i class="fa fa-plus me-2"></i> Add
                            </a>
                            <a href="{{ route('fertilizer.list') }}" class="dropdown-item">
                                <i class="fa fa-list me-2"></i> List
                            </a>
                        </div>
                    </div>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-tractor me-2"></i>Tractor Plow(ہل)
                        </a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{ route('plow.create') }}" class="dropdown-item">
                                <i class="fa fa-plus me-2"></i> Add
                            </a>
                            <a href="{{ route('plow.list') }}" class="dropdown-item">
                                <i class="fa fa-list me-2"></i> List
                            </a>
                        </div>
                    </div>

                </div>
            </nav>
        </div>