<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" target="_blank" href="{{asset('')}}"> >> {{asset('')}}</a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a ><i class="fa fa-user fa-fw"></i> {{Auth::User()->name}} </a>
                </li>
                <li><a href="admin/profile/list"><i class="fa fa-gear fa-fw"></i> Profile</a>
                </li>
                <li class="divider"></li>
                <li><a href="admin/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" id="scroll" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li><a href="admin/dashboard"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a></li>
                <!-- <li><a href="admin/home/list"><i class="fa fa-table fa-fw"></i> Homes</a></li> -->
                <li><a href="admin/category/list"><i class="fa fa-table fa-fw"></i> Category</a></li>
                <li><a href="admin/product/list"><i class="fa fa-table fa-fw"></i> Products</a></li>
                <!-- <li>
                    <a href="#"><i class="fa fa-table fa-fw"></i> Product<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="admin/product/list/"><i class="fa fa-table fa-fw"></i> </a>
                        </li>
                    </ul>
                </li> -->
                <li><a href="admin/news/list"><i class="fa fa-table fa-fw"></i> News</a></li>
                <li><a href="admin/location/list"><i class="fa fa-table fa-fw"></i> Location</a></li>
                <li><a href="admin/themes/list"><i class="fa fa-table fa-fw"></i> Themes</a></li>
                <li><a href="admin/setting/list"><i class="fa fa-table fa-fw"></i> Settings</a></li>
                <li><a href="admin/user/list"><i class="fa fa-table fa-fw"></i> User</a></li>
                <li onclick="BrowseServer();"><a ><i class="fa fa-table fa-fw"></i> Media</a></li>
                
            </ul>
        </div>
    </div>
</nav>