<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fab fa-btc"></i>
        </div>
        <div class="sidebar-brand-text mx-3">VRU My-wallet </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">

        <a class="nav-link" href="{{ url('/transaction') }}">
            <i class="fas fa-circle"></i>
            <span style="color:black ; font-weight:bold">หน้าธุรกรรม</span></a>
        <a class="nav-link" href="{{ url('/report_user') }}">
            <i class="fas fa-circle"></i>
            <span style="color:black ; font-weight:bold">หน้าสรุปรวม</span></a>
        <a class="nav-link" href="{{ url('/user_personal') }}">
            <i class="fas fa-circle"></i>
            <span style="color:black ; font-weight:bold">หน้าประวัติส่วนตัว</span></a>
    </li>
    {{-- <li class="nav-item">
            <a class="nav-link" href="{{ url('/volunteer_question') }}">
                <i class="fas fa-circle"></i>
                <span>แบบสอบถาม</span></a>
        </li>
  <li class="nav-item">
            <a class="nav-link" href="{{ url('/volunteer_con') }}">
                <i class="fas fa-circle"></i>
                <span>ผลการรักษา</span></a>
  </li> --}}

</ul>
<!-- End of Sidebar -->
