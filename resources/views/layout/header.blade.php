<!-- Navbar -->
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Absence & Signature</a>
    <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    
    <!-- Navbar-->    
    <div class="pull-right navbar-nav ml-auto mr-0 mr-md-3 my-2 my-md-0" role="navigation">
        <ul class="nav ace-nav">
            <li class="light-orange dropdown-modal">
                <a data-toggle="dropdown" href="#" class="dropdown">
                    <span class="user-info text-light"><i class="fas fa-user fa-fw"></i>
                        {{ Auth::user()->name }} <i class="ace-icon fa fa-caret-down"></i>  
                    </span>             
                </a>
                <ul class="bg-dark user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close" style="margin-top:-5px;margin-right:5px">
                    <li>
                        <a class="dropdown-item text-light" href="/usersettings">Settings</a>
                    </li>
                        <a class="dropdown-item text-light" href="#">Activity Log</a>
                    </li>
                    <li>
                        <a class="dropdown-item text-light" href="{{ route('logout') }}" onclick="event.preventDefault();                                                 document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    
    <!-- 
    <form class=" ml-auto ml-md-0 ">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
            <div class="input-group-append">
                <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
            </div>
        </div>
    </form>
    -->
</nav>
<!-- /.navbar -->
