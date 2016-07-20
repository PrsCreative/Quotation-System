<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- search form (Optional) -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
      </div>
    </form>
    <!-- /.search form -->

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
      <!-- Optionally, you can add icons to the links -->
      <li class="header">General</li>
      <li><a href="{{URL::to('/')}}"><i class="fa fa-link"></i> <span>Dashboard</span></a></li>
      <li><a href="{{URL::to('/settings')}}"><i class="fa fa-link"></i> <span>Settings</span></a></li>
      <li class="header">Quotations</li>
      <li><a href="{{URL::to('/quotations')}}"><i class="fa fa-link"></i> <span>VIEW ALL QUOTATIONS</span></a></li>
      <li><a href="{{URL::to('/quotations/create')}}"><i class="fa fa-link"></i> <span>ADD NEW QUOTE</span></a></li>
      <li class="header">Customers</li>
      <li><a href="{{URL::to('/customers')}}"><i class="fa fa-link"></i> <span>VIEW ALL CUSTOMERS</span></a></li>
      <li><a href="{{URL::to('/customers/create')}}"><i class="fa fa-link"></i> <span>ADD NEW CUSTOMER</span></a></li>
      <li class="header">Products</li>
      <li><a href="{{URL::to('/products')}}"><i class="fa fa-link"></i> <span>View All Products</span></a></li>
      <li><a href="{{URL::to('/products/create')}}"><i class="fa fa-link"></i> <span>Add New Product</span></a></li>
      <li><a href="{{URL::to('/inventory/create')}}"><i class="fa fa-link"></i> <span>Add To Inventory</span></a></li>
      
    </ul>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
  <div class="mfooter">
    <?php echo date('Y'); ?> &copy; <a href="http://themohammeda.github.io/" target="_blank">theMohammedA</a>
  </div>
</aside>