    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
    <img src="../<?php echo $app_logo; ?>" alt="app Logo" class="brand-image img-circle elevation-3" style="opacity: .8; width: 100px; height: 200px;">
      <span class="brand-text font-weight-light"><?php echo $app_name; ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="index" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
            
          </li>
         
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Account Management
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="add_user" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>New User</p>
                </a>
              </li>
              
              
              <li class="nav-item">
                <a href="user_record" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User Record</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="change_password" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Change Password</p>
                </a>
              </li>
            </ul>
          </li>
     
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-chalkboard"></i> 
              <p>
                Class Management
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="add_class" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>New Class</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="class_record" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Class Record</p>
                </a>
              </li>
              
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-chalkboard"></i> 
              <p>
               Teacher Management
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
             
              <li class="nav-item">
                <a href="teacher_record" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Teacher Record</p>
                </a>
              </li>
              
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-calendar-alt"></i>
              <p>
                Session Management
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="add_session" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Session</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="session_record" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Session Record</p>
                </a>
              </li>
              
            </ul>
          </li>


          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-book"></i> 
              <p>
                Subject Management
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="add_subject" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>New Subject</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="subject_record" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Subject Record</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="add_subject_allocation" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Subject Allocation</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="subject_allocation_record" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Subject Allocation Record</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-file-alt"></i>
              <p>
                Result Management
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/tables/simple.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Simple Tables</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/tables/data.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>DataTables</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/tables/jsgrid.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>jsGrid</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-graduation-cap"></i> 
              <p>Student Management<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="student_record" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Student Record</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="asso" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Assign Student to class</p>
                </a>
              </li>
              </ul>
          </li>

          <li class="nav-item">
            <a href="pages/calendar.html" class="nav-link">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Calendar
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="update_school" class="nav-link">
            <i class="nav-icon fas fa-cogs"></i> 
              <p>
                School Settings
              </p>
            </a>
          </li>

    
          <li class="nav-item">
            <a href="logout" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"></i>

              <p>
                Logout
              </p>
            </a>
          </li>
  
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
