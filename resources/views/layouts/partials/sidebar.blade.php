<!--start sidebar -->
<aside class="sidebar-wrapper" data-simplebar="true" style="background: linear-gradient(332.9deg, #00A6EC 16.93%, #0000BA 77.18%);">
    <div class="sidebar-header" style="background: #0000ba;">
        <div>
            {{-- <img src="{{ asset('assets/images/main-logo.png') }}" class="logo-icon" alt="logo icon"> --}}
        </div>
        <div>
            <img src="{{ asset('assets/images/main-logo.png') }}" class="logo-text" style="width: 86px;" alt="logo text">
        </div>
        <div class="toggle-icon ms-auto"><i class="bi bi-list"></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('dashboard') }}" class="">
                <div class="parent-icon">
                    <i class="fa-solid fa-gauge"></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>

        <li style="color: white; margin-top: 20px;">Main</li>
        <li>
            <a href="{{ route('categoryIndex') }}" class="">
                <div class="parent-icon">
                    <i class="fa-solid fa-box"></i>
                </div>
                <div class="menu-title">Categories</div>
            </a>
        </li>
        <li>
            <a href="{{ route('serviceIndex') }}" class="">
                <div class="parent-icon">
                    <i class="fa-solid fa-gears"></i>
                </div>
                <div class="menu-title">Services</div>
            </a>
        </li>
        <li>
            <a href="{{ route('zoneIndex') }}" class="">
                <div class="parent-icon">
                    <i class="fa-solid fa-map-pin"></i>
                </div>
                <div class="menu-title">Zones</div>
            </a>
        </li>

        <li>
            <a href="{{ route('bookingList') }}" class="">
                <div class="parent-icon">
                    <i class="fa-solid fa-box"></i>
                </div>
                <div class="menu-title">Booking</div>
            </a>
        </li>
        <li style="color: white; margin-top: 20px;">Customers</li>
        <li>
            <a href="{{ route('userList') }}" class="">
                <div class="parent-icon">
                    <i class="fa-solid fa-user"></i>
                </div>
                <div class="menu-title">Users</div>
            </a>
        </li>
        <li>
            <a href="{{ route('cleanerIndex') }}" class="">
                <div class="parent-icon">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div class="menu-title">Cleaners</div>
            </a>
        </li>

        {{-- <li>
            <a href="auditReportsList.php" class="">
                <div class="parent-icon">
                    <i class="fa-solid fa-box"></i>
                </div>
                <div class="menu-title">Audit Reports</div>
            </a>
        </li>
        <li>
            <a href="inventoryList.php" class="">
                <div class="parent-icon">
                    <i class="fa-solid fa-box"></i>
                </div>
                <div class="menu-title">Inventory</div>
            </a>
        </li>
        <li>
            <a href="teamMembers.php" class="">
                <div class="parent-icon">
                    <i class="fa-solid fa-box"></i>
                </div>
                <div class="menu-title">Team Members</div>
            </a>
        </li> --}}
        {{-- <li>
            <a href="javascript:;" class="">
                <div class="parent-icon">
                    <i class="fa-solid fa-box"></i>
                </div>
                <div class="menu-title">Manage Clients</div>
            </a>
            <ul>
                <li>
                    <a href="clientsList.php"><i class="bi bi-circle"></i>All Clients</a>
                </li>
                <li>
                    <a href="clientsList.php"><i class="bi bi-circle"></i>Active Clients</a>
                </li>
                <li>
                    <a href="clientsList.php"><i class="bi bi-circle"></i>Banned Clients</a>
                </li>
            </ul>
        </li> --}}
        <li style="color: white; margin-top: 20px;">Marketing & Advertising</li>
        <li>
            <a href="{{ route('promoCodeIndex') }}" class="">
                <div class="parent-icon">
                    <i class="fa-solid fa-tag"></i>
                </div>
                <div class="menu-title">Coupens</div>
            </a>
        </li>
        <li>
            <a href="{{ route('createBanner') }}" class="">
                <div class="parent-icon">
                   <i class="fa-solid fa-flag"></i>
                </div>
                <div class="menu-title">Banners</div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="">
                <div class="parent-icon">
                    <i class="fa-solid fa-box"></i>
                </div>
                <div class="menu-title">Manage Payments</div>
            </a>
            <ul>
                <li>
                    <a href="AllPaymentsList.php"><i class="bi bi-circle"></i>All Payments</a>
                </li>
                <li>
                    <a href="PendingPaymentsList.php"><i class="bi bi-circle"></i>Pending Payments</a>
                </li>
                <li>
                    <a href="ApprovedPaymentsList.php"><i class="bi bi-circle"></i>Approved Payments</a>
                </li>
                <li>
                    <a href="SuccessfulPaymentsList.php"><i class="bi bi-circle"></i>Successful Payments</a>
                </li>
                <li>
                    <a href="RejectedPaymentsList.php"><i class="bi bi-circle"></i>Rejected Payments</a>
                </li>
                <li>
                    <a href="InitiatedPaymentsList.php"><i class="bi bi-circle"></i>Initiated Payments</a>
                </li>
            </ul>
        </li>
        {{-- <li>
            <a href="calendar.php" class="">
                <div class="parent-icon">
                    <i class="fa-solid fa-box"></i>
                </div>
                <div class="menu-title">Calendar</div>
            </a>
        </li>
        <li>
            <a href="hygieneCertificatesList.php" class="">
                <div class="parent-icon">
                    <i class="fa-solid fa-box"></i>
                </div>
                <div class="menu-title">Hygiene Certificates</div>
            </a>
        </li>
        <li>
            <a href="Messages.php" class="">
                <div class="parent-icon">
                    <i class="fa-solid fa-box"></i>
                </div>
                <div class="menu-title">Messages</div>
            </a>
        </li> --}}

    </ul>
</aside>
