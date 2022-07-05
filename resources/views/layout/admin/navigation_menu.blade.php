<!-- BEGIN: Left Aside -->
<style type="text/css">
    .m-aside-left.m-aside-left--skin-dark{
        background-color: #1f4e78!important;

    }
    .m-menu__link-icon{
        color: #c4c5d6!important;
    }
    .m-menu__link-text{
        color: #ffffff!important;
    }
    .m-menu__ver-arrow{
        color: #c4c5d6!important;
    }
    .m-brand.m-brand--skin-dark{
        background-color: #1f4e78!important;
        color: #c4c5d6!important;
    }

</style>

        <button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn"><i class="la la-close"></i></button>
    
        <div id="m_aside_left" class="m-grid__item  m-aside-left  m-aside-left--skin-dark ">
        <img src="{{url('/image/gspe3.png')}}" style="width: 90%;">
          <!-- BEGIN: Aside Menu -->
          <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " m-menu-vertical="1" m-menu-scrollable="1" m-menu-dropdown-timeout="500" style="position: relative;">
            <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
            <!-- @if(Auth::user() != null) -->

            <li class="m-menu__item  m-menu__item--active" aria-haspopup="true"><a href="{{url('/dashboard')}}" class="m-menu__link "><i class="m-menu__link-icon flaticon-line-graph"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Dashboard</span>
                </span></span></a></li>


            @if(Auth::user()->hasRole('admin') == true)

            <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                  
                <i class="m-menu__link-icon flaticon-edit"></i>
                    <span class="m-menu__link-text">Setup</span>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                <ul class="m-menu__subnav"> 
                    <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span class="m-menu__link"><span class="m-menu__link-text">Setup</span></span></li>

                    <li class="m-menu__item" aria-haspopup="true"><a href="{{url('/user-list')}}" class="m-menu__link "><i class="m-menu__link-icon flaticon-users"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">User List</span>
                    </span></span></a></li>

                    <li class="m-menu__item" aria-haspopup="true"><a href="{{url('/warehouse-list')}}" class="m-menu__link "><i class="m-menu__link-icon flaticon-home"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Warehouse List</span>
                    </span></span></a></li>
                    <li class="m-menu__item" aria-haspopup="true"><a href="{{url('/new-warehouse-location')}}" class="m-menu__link "><i class="m-menu__link-icon flaticon-home"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Warehouse Location</span>
                    </span></span></a></li>
                    <li class="m-menu__item" aria-haspopup="true"><a href="{{url('/product-list')}}" class="m-menu__link "><i class="m-menu__link-icon flaticon-home"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Product</span>
                    </span></span></a></li>
                    <!-- <li class="m-menu__item" aria-haspopup="true"><a href="{{url('/warehouse-location-list')}}" class="m-menu__link"><i class="m-menu__link-icon flaticon-placeholder-1"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Warehouse Zoning</span>
                    </span></span></a></li>

                    <li class="m-menu__item" aria-haspopup="true"><a href="{{url('/warehouse-racking-list')}}" class="m-menu__link"><i class="m-menu__link-icon flaticon-placeholder-1"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Warehouse Racking</span>
                    </span></span></a></li> -->

                    <li class="m-menu__item" aria-haspopup="true"><a href="{{url('/mover-list')}}" class="m-menu__link "><i class="m-menu__link-icon flaticon-truck"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Mover</span>
                    </span></span></a></li>
                    <li class="m-menu__item" aria-haspopup="true"><a href="{{url('/supplier-list')}}" class="m-menu__link "><i class="m-menu__link-icon flaticon-shopping-basket"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Supplier</span>
                    </span></span></a></li>
                    <li class="m-menu__item" aria-haspopup="true"><a href="{{url('/customer-list')}}" class="m-menu__link "><i class="m-menu__link-icon flaticon-shopping-basket"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Customer</span>
                    </span></span></a></li>
                </ul>
            </div>
        </li>

            @endif

            @if(Auth::user()->hasRole('admin') == true || Auth::user()->hasRole('loading_department') == true)

            <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
              
            <a href="javascript:;" class="m-menu__link m-menu__toggle">
                  
                  <i class="m-menu__link-icon flaticon-cart"></i>
                      <span class="m-menu__link-text">Receive</span>
                      <i class="m-menu__ver-arrow la la-angle-right"></i>
                  </a>
            <!-- <li class="m-menu__item  m-menu__item--active" aria-haspopup="true"><a href="{{url('/receive')}}" class="m-menu__link "><i class="m-menu__link-icon flaticon-cart"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Receive</span>
                </span></span></a></li> -->
                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                <ul class="m-menu__subnav">

                
                    <li class="m-menu__item" aria-haspopup="true"><a href="{{url('/receive')}}" class="m-menu__link"><i class="m-menu__link-icon flaticon-web"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Dashboard</span></span></span></a></li>
                   
                  
                    <li class="m-menu__item" aria-haspopup="true"><a href="{{url('/receive-document')}}" class="m-menu__link"><i class="m-menu__link-icon flaticon-folder"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Queue Document</span>
                    </span></span></a></li>

                    <li class="m-menu__item" aria-haspopup="true"><a href="{{url('/inspection-document')}}" class="m-menu__link"><i class="m-menu__link-icon flaticon-clipboard"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Inspection</span>
                    </span></span></a></li>

                    <li class="m-menu__item" aria-haspopup="true"><a href="{{url('/qc-request-list')}}" class="m-menu__link"><i class="m-menu__link-icon flaticon-list-3"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Quality Check</span>
                    </span></span></a></li>


                    <li class="m-menu__item" aria-haspopup="true"><a href="{{url('/report-list')}}" class="m-menu__link"><i class="m-menu__link-icon flaticon-warning-sign"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Receiving Report</span></span></span></a></li>

                    <li class="m-menu__item" aria-haspopup="true"><a href="{{url('senditems-towh-list')}}" class="m-menu__link"><i class="m-menu__link-icon flaticon-folder"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Send Item To Warehouse</span>
                    </span></span></a></li>

                    <li class="m-menu__item" aria-haspopup="true"><a href="{{url('/add-new-do-po')}}" class="m-menu__link"><i class="m-menu__link-icon flaticon-folder"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Create DO(Titipan)</span>
                    </span></span></a></li>
                    <!-- <li class="m-menu__item" aria-haspopup="true"><a href="{{url('/senditems-towh-list')}}" class="m-menu__link"><i class="m-menu__link-icon flaticon-file"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Send Items To Warehouse</span></span></span></a></li>
                    <li class="m-menu__item" aria-haspopup="true"><a href="{{url('/qc-request-list')}}" class="m-menu__link"><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text"><img src="{{url('/image/qc.png')}}" width="15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;QC</span>
                    </span></span></a></li>

                    <li class="m-menu__item" aria-haspopup="true"><a href="{{url('/qc-request-serial-no')}}" class="m-menu__link"><i class="m-menu__link-icon flaticon-list-3"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">QC Request Serial No</span>
                    </span></span></a></li>

                    <li class="m-menu__item" aria-haspopup="true"><a href="{{url('/qcReturn-list')}}" class="m-menu__link"><i class="m-menu__link-icon flaticon-interface-7"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Return List</span>
                    </span></span></a></li>

                   

                    <li class="m-menu__item" aria-haspopup="true"><a href="{{url('/report-list')}}" class="m-menu__link"><i class="m-menu__link-icon flaticon-graphic-2"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Receive Report List</span></span></span></a></li>
  </span></span></a></li>
    <li class="m-menu__item" aria-haspopup="true"><a href="{{url('/report-serial-no')}}" class="m-menu__link"><i class="m-menu__link-icon flaticon-warning-sign"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Receive Report Serial No</span>
                    <li class="m-menu__item" aria-haspopup="true"><a href="{{url('/report-return-list')}}" class="m-menu__link"><i class="m-menu__link-icon flaticon-graphic-2"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Return Report List</span></span></span></a></li>

                    <li class="m-menu__item" aria-haspopup="true"><a href="{{url('/item-list')}}" class="m-menu__link"><i class="m-menu__link-icon flaticon-web"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Item List</span></span></span></a></li>

           

                    <li class="m-menu__item" aria-haspopup="true"><a href="{{url('/packing-items-list')}}" class="m-menu__link"><i class="m-menu__link-icon flaticon-business"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Packing Items</span>
                    </span></span></a></li>

                    <li class="m-menu__item" aria-haspopup="true"><a href="{{url('/sendingDo-list')}}" class="m-menu__link"><i class="m-menu__link-icon flaticon-paper-plane"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Send DO Items</span>
                    </span></span></a></li> -->
                </ul>
            </div>
        </li>
            @endif

            @if(Auth::user()->hasRole('admin') == true || Auth::user()->hasRole('warehouse') == true || Auth::user()->hasRole('internal_department') == true)

            <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
            <a href="javascript:;" class="m-menu__link m-menu__toggle">
                  
                  <i class="m-menu__link-icon flaticon-squares-2"></i>
                      <span class="m-menu__link-text">Storing</span>
                      <i class="m-menu__ver-arrow la la-angle-right"></i>
                  </a>
            <!-- <li class="m-menu__item  m-menu__item--active" aria-haspopup="true"><a href="{{url('/storing')}}" class="m-menu__link "><i class="m-menu__link-icon flaticon-squares-2"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Storing</span>
                </span></span></a></li> -->

                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                <ul class="m-menu__subnav">

                   
                <li class="m-menu__item" aria-haspopup="true"><a href="{{url('/storing')}}" class="m-menu__link"><i class="m-menu__link-icon flaticon-web"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Dashboard</span></span></span></a></li>
                    <li class="m-menu__item" aria-haspopup="true"><a href="{{url('/receive-itemwh-list')}}" class="m-menu__link"><i class="m-menu__link-icon flaticon-folder"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Receive Item</span></span></span></a></li>

                    <li class="m-menu__item" aria-haspopup="true"><a href="{{url('/store-item')}}" class="m-menu__link"><i class="m-menu__link-icon flaticon-pie-chart"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Store Item</span></span></span></a></li>
                    <li class="m-menu__item" aria-haspopup="true"><a href="{{url('/transfer-item-list')}}" class="m-menu__link"><i class="m-menu__link-icon flaticon-pie-chart"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Transfer Item</span></span></span></a></li>
                    <li class="m-menu__item" aria-haspopup="true"><a href="{{url('/transfer-item-list')}}" class="m-menu__link"><i class="m-menu__link-icon flaticon-pie-chart"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">PO/DO Report</span></span></span></a></li>
                    <!-- <li class="m-menu__item" aria-haspopup="true"><a href="{{url('/receiveitem-fromwh-list')}}" class="m-menu__link"><i class="m-menu__link-icon flaticon-interface-6"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Receive Items From Warehouse</span></span></span></a></li> -->

                </ul>
            </div>
        </li>

            @endif
            @if(Auth::user()->hasRole('admin') == true || Auth::user()->hasRole('warehouse') == true || Auth::user()->hasRole('internal_department') == true)

<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">

<li class="m-menu__item  m-menu__item--active" aria-haspopup="true"><a href="{{url('/internal-storing')}}" class="m-menu__link "><i class="m-menu__link-icon flaticon-squares-2"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Internal Storing</span>
    </span></span></a></li>

    <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
    <ul class="m-menu__subnav">

        <!-- <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span class="m-menu__link"><span class="m-menu__link-text">Storing</span></span></li>

        <li class="m-menu__item" aria-haspopup="true"><a href="{{url('/material-request')}}" class="m-menu__link"><i class="m-menu__link-icon flaticon-pie-chart"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Material Request List</span></span></span></a></li>


        <li class="m-menu__item" aria-haspopup="true"><a href="{{url('/receiveitem-fromwh-list')}}" class="m-menu__link"><i class="m-menu__link-icon flaticon-interface-6"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Receive Items From Warehouse</span></span></span></a></li> -->

    </ul>
</div>
</li>

@endif

            @if(Auth::user()->hasRole('admin') == true || Auth::user()->hasRole('warehouse') == true || Auth::user()->hasRole('internal_department') == true)

            <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
          
            <li class="m-menu__item  m-menu__item--active" aria-haspopup="true"><a href="{{url('/picking-dashboard')}}" class="m-menu__link "><i class="m-menu__link-icon flaticon-interface-8"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Picking</span>
                </span></span></a></li>
                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                <ul class="m-menu__subnav">

                    <!-- <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span class="m-menu__link"><span class="m-menu__link-text">Picking</span></span></li>

                    <li class="m-menu__item" aria-haspopup="true"><a href="{{url('/storeitem-request')}}" class="m-menu__link"><i class="m-menu__link-icon flaticon-signs-2"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Store Item Request</span>
                    </span></span></a></li>

                    <li class="m-menu__item" aria-haspopup="true"><a href="{{url('/send-store-items-list')}}" class="m-menu__link"><i class="m-menu__link-icon flaticon-suitcase"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Send Store Items</span>
                    </span></span></a></li> -->

                </ul>
            </div>
        </li>

            @endif

            @if(Auth::user()->hasRole('admin') == true || Auth::user()->hasRole('internal_department') == true)
            <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
            <li class="m-menu__item  m-menu__item--active" aria-haspopup="true"><a href="{{url('/packing-dashboard')}}" class="m-menu__link "><i class="m-menu__link-icon flaticon-folder"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Packing</span>
                </span></span></a></li>
                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                <ul class="m-menu__subnav">

                    <!-- <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span class="m-menu__link"><span class="m-menu__link-text">Picking</span></span></li>

                    <li class="m-menu__item" aria-haspopup="true"><a href="{{url('/storeitem-request')}}" class="m-menu__link"><i class="m-menu__link-icon flaticon-signs-2"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Store Item Request</span>
                    </span></span></a></li>

                    <li class="m-menu__item" aria-haspopup="true"><a href="{{url('/send-store-items-list')}}" class="m-menu__link"><i class="m-menu__link-icon flaticon-suitcase"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Send Store Items</span>
                    </span></span></a></li> -->

                </ul>
            </div>
        </li>
        @endif

        @if(Auth::user()->hasRole('admin') == true || Auth::user()->hasRole('logistic') == true)
            <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
            <li class="m-menu__item  m-menu__item--active" aria-haspopup="true"><a href="{{url('/request-doc-list')}}" class="m-menu__link "><i class="m-menu__link-icon flaticon-folder"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Create Document Request</span>
                </span></span></a></li>
                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                <ul class="m-menu__subnav">

                </ul>
            </div>
        </li>
        @endif
        @if(Auth::user()->hasRole('admin') == true || Auth::user()->hasRole('logistic') == true)
            <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
            <li class="m-menu__item  m-menu__item--active" aria-haspopup="true"><a href="{{url('/stock-opname-list')}}" class="m-menu__link "><i class="m-menu__link-icon flaticon-folder"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Stock Opname</span>
                </span></span></a></li>
                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                <ul class="m-menu__subnav">

                </ul>
            </div>
        </li>
        @endif
        @if(Auth::user()->hasRole('admin') == true || Auth::user()->hasRole('warehouse') == true)
        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                <i class="m-menu__link-icon flaticon-warning"></i>
                    <span class="m-menu__link-text">Report</span>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                <ul class="m-menu__subnav">

                <li class="m-menu__item" aria-haspopup="true"><a href="{{url('/new-official-report')}}" class="m-menu__link"><i class="m-menu__link-icon flaticon-truck"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Official Report</span>
                    </span></span></a></li>

                <li class="m-menu__item" aria-haspopup="true"><a href="{{url('/inventory-list')}}" class="m-menu__link"><i class="m-menu__link-icon flaticon-truck"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Inventory List</span>
                    </span></span></a></li>

                    <li class="m-menu__item" aria-haspopup="true"><a href="{{url('/inventory-tr-list')}}" class="m-menu__link"><i class="m-menu__link-icon flaticon-truck"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Inventory In Transit List</span>
                    </span></span></a></li>

                    <li class="m-menu__item" aria-haspopup="true"><a href="{{url('/inventory-wip-list')}}" class="m-menu__link"><i class="m-menu__link-icon flaticon-truck"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Inventory WIP List</span>
                    </span></span></a></li>

                    <li class="m-menu__item" aria-haspopup="true"><a href="{{url('/reserve-stock-list')}}" class="m-menu__link"><i class="m-menu__link-icon flaticon-truck"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Reserve Stock</span>
                    </span></span></a></li>

                    <li class="m-menu__item" aria-haspopup="true"><a href="{{url('/transaction-inventory-list')}}" class="m-menu__link"><i class="m-menu__link-icon flaticon-truck"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Transaction Inventory</span>
                    </span></span></a></li>

                    <li class="m-menu__item" aria-haspopup="true"><a href="{{url('/po-do-report')}}" class="m-menu__link"><i class="m-menu__link-icon flaticon-pie-chart"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">PO/DO Report</span></span></span></a></li>
                </ul>
            </div>
        </li>
        @endif
            @if(Auth::user()->hasRole('admin') == true || Auth::user()->hasRole('warehouse') == true)

            <!-- <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-home"></i>
                    <span class="m-menu__link-text">Warehouse</span>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                <ul class="m-menu__subnav">

                    <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span class="m-menu__link"><span class="m-menu__link-text">Warehouse</span></span></li>


                    <li class="m-menu__item" aria-haspopup="true"><a href="{{url('/receive-itemwh-list')}}" class="m-menu__link"><i class="m-menu__link-icon flaticon-interface-1"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Receive Items</span>
                    </span></span></a></li>

                    <li class="m-menu__item" aria-haspopup="true"><a href="{{url('/store-items-list')}}" class="m-menu__link"><i class="m-menu__link-icon flaticon-lifebuoy"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Store Items</span>
                    </span></span></a></li>

                    <li class="m-menu__item" aria-haspopup="true"><a href="{{url('/pick-items-list')}}" class="m-menu__link"><i class="m-menu__link-icon flaticon-share"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Pick Item</span>
                    </span></span></a></li>

                    <li class="m-menu__item" aria-haspopup="true"><a href="{{url('/senditems-fromwh-list')}}" class="m-menu__link"><i class="m-menu__link-icon flaticon-interface-9"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Send Items From Warehouse</span>
                    </span></span></a></li>

                    <li class="m-menu__item" aria-haspopup="true"><a href="{{url('/transfer-item-list')}}" class="m-menu__link"><i class="m-menu__link-icon flaticon-truck"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Transfer Item</span>
                    </span></span></a></li>

                 

                </ul>
            </div>
            
        </li> -->

            @endif
        @endif

            </ul>

          </div>

          <!-- END: Aside Menu -->
        </div>

        <!-- END: Left Aside -->
