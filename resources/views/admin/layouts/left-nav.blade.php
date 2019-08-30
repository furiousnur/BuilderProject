@if(Auth::user()->role==1)

<nav class="pcoded-navbar">
    <div class="nav-list">
        <div class="pcoded-inner-navbar main-menu">
            <div class="pcoded-navigation-label">Navigation</div>
            <ul class="pcoded-item pcoded-left-item">
                <li class=" active pcoded-trigger">
                    <a href="" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                        <span class="pcoded-mtext">Dashboard</span>
                    </a>
                </li>
                <li class="pcoded-hasmenu">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-layers"></i>
                        </span>
                        <span class="pcoded-mtext">Projects</span>
                        <span class="pcoded-badge label label-danger">100+</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="">
                            <a href="{{route('projects.index')}}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Lists</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="pcoded-hasmenu">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-layers"></i>
                        </span>
                        <span class="pcoded-mtext">Coustomers</span>
                    </a>
                    <ul class="pcoded-submenu">
                        
                        <li class="">
                            <a href="{{route('coustomer.create')}}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Create Coustomer</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="{{route('coustomer.index')}}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Lists</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="pcoded-hasmenu">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-inbox"></i>
                        </span>
                        <span class="pcoded-mtext">Vendors</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="">
                            <a href="{{route('vendor.create')}}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Add new</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="{{route('vendor.index')}}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Lists</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="pcoded-hasmenu">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-inbox"></i>
                        </span>
                        <span class="pcoded-mtext">Managers</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="">
                            <a href="{{route('manager.create')}}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Add new</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="{{route('manager.index')}}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Lists</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="pcoded-hasmenu">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="feather icon-users"></i></span>
                        <span class="pcoded-mtext">Man Power</span>
                        <span class="pcoded-badge label label-warning">NEW</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="">
                            <a href="{{route('labours.index')}}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Lists / Attendence</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="{{route('attendence.editSearch')}}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Edit Attendence</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="{{route('labours.create')}}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Add Labour</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="{{route('manpower-report.index')}}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Report</span>
                            </a>
                        </li>
                        <li class=" pcoded-hasmenu">
                            <a href="javascript:void(0)" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Vertical</span>
                            </a>

                            <ul class="pcoded-submenu">
                                <li class="">
                                    <a href="" class="waves-effect waves-dark">
                                        <span class="pcoded-mtext">Static Layout</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="" class="waves-effect waves-dark">
                                        <span class="pcoded-mtext">Header Fixed</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="" class="waves-effect waves-dark">
                                        <span class="pcoded-mtext">Compact</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="" class="waves-effect waves-dark">
                                        <span class="pcoded-mtext">Sidebar Fixed</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                    </ul>
                </li>

                <li class="pcoded-hasmenu">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="feather icon-codepen"></i></span>
                        <span class="pcoded-mtext">Inventory</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="">
                            <a href="{{route('item.create')}}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Add Item Name</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="{{route('inventory.create')}}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">New Item</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="{{route('inventory.index')}}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Item List</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="pcoded-hasmenu">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="feather icon-credit-card"></i></span>
                        <span class="pcoded-mtext">Accounting</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="">
                            <a href="{{route('bank.index')}}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Banks</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="{{route('bank.income')}}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Income</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="{{route('bank.expence')}}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Expence</span>
                            </a>
                        </li>
                        {{-- <li class="">
                            <a href="{{route('bank.index')}}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">All Transection</span>
                            </a>
                        </li> --}}
                    </ul>
                </li>
            </ul>   
        </div>
    </div>
</nav>

@else

<nav class="pcoded-navbar">
    <div class="nav-list">
        <div class="pcoded-inner-navbar main-menu">
            <div class="pcoded-navigation-label">Manager Dashboard</div>
            <ul class="pcoded-item pcoded-left-item">
                <li class=" active pcoded-trigger">
                    <a href="{{route('home')}}" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                        <span class="pcoded-mtext">Dashboard</span>
                    </a>
                </li>
                <li class="pcoded-hasmenu">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-inbox"></i>
                        </span>
                        <span class="pcoded-mtext">Manager</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="">
                            <a href="{{route('manager.show',Auth::user()->id)}}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Profile</span>
                            </a>
                        </li>
                        
                    </ul>
                </li>
                <li class="pcoded-hasmenu">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-layers"></i>
                        </span>
                        <span class="pcoded-mtext">Projects</span>
                        <span class="pcoded-badge label label-danger">100+</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="">
                            <a href="{{route('projects.index')}}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Lists</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="pcoded-hasmenu">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-inbox"></i>
                        </span>
                        <span class="pcoded-mtext">Vendors</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="">
                            <a href="{{route('vendor.create')}}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Add new</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="{{route('vendor.index')}}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Lists</span>
                            </a>
                        </li>
                    </ul>
                </li>

                
                <li class="pcoded-hasmenu">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="feather icon-users"></i></span>
                        <span class="pcoded-mtext">Man Power</span>
                        <span class="pcoded-badge label label-warning">NEW</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="">
                            <a href="{{route('labours.index')}}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Lists / Attendence</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="{{route('labours.create')}}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Add Labour</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="{{route('manpower-report.index')}}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Report</span>
                            </a>
                        </li>
                        <li class=" pcoded-hasmenu">
                            <a href="javascript:void(0)" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Vertical</span>
                            </a>

                            <ul class="pcoded-submenu">
                                <li class="">
                                    <a href="" class="waves-effect waves-dark">
                                        <span class="pcoded-mtext">Static Layout</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="" class="waves-effect waves-dark">
                                        <span class="pcoded-mtext">Header Fixed</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="" class="waves-effect waves-dark">
                                        <span class="pcoded-mtext">Compact</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="" class="waves-effect waves-dark">
                                        <span class="pcoded-mtext">Sidebar Fixed</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                    </ul>
                </li>

                <li class="pcoded-hasmenu">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="feather icon-codepen"></i></span>
                        <span class="pcoded-mtext">Inventory</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="">
                            <a href="{{route('item.create')}}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Add Item Name</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="{{route('inventory.create')}}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">New Item</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="{{route('inventory.index')}}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Item List</span>
                            </a>
                        </li>
                    </ul>
                </li>
                
            </ul>   
        </div>
    </div>
</nav>

@endif