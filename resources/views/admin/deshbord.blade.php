<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>BusPass Admin Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    .status.pending { background:#f59e0b; }
.status.rejected { background:#dc2626; }

    :root{
      --bg: #f6f8fb;
      --card: #ffffff;
      --muted: #6b7280;
      --primary: #1e3a8a; /* deep blue */
      --accent: #ff6a00;  /* orange */
      --glass: rgba(255,255,255,0.6);
      --radius: 10px;
      --shadow: 0 6px 18px rgba(20,25,40,0.08);
      --glass-border: rgba(30,58,138,0.06);
    }
    *{box-sizing:border-box}
    html,body{height:100%;font-family:Inter, system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial; background:var(--bg); color:#0f172a}

    /* Layout */
    .app{display:flex;min-height:100vh;align-items:stretch}

    /* Sidebar */
    .sidebar{width:260px;background:linear-gradient(180deg,var(--primary),#0f3b6f);color:#fff;padding:22px;border-right:1px solid rgba(255,255,255,0.04);transition:all .35s ease;display:flex;flex-direction:column;gap:18px}
    .sidebar .brand{display:flex;align-items:center;gap:12px;font-weight:700;font-size:1.1rem}
    .brand .logo{width:40px;height:40px;border-radius:10px;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,#fff3 0,#ffffff11);border:1px solid rgba(255,255,255,0.06)}
    .menu{list-style:none;padding:0;margin:8px 0 0 0;display:flex;flex-direction:column;gap:6px}
    .menu li{display:flex;align-items:center;gap:12px;padding:10px;border-radius:8px;cursor:pointer;transition:background .2s,color .2s}
    .menu li i{width:28px;text-align:center}
    .menu li span{font-weight:600}
    .menu li:hover{background:rgba(255,255,255,0.06)}
    .menu li.active{background:rgba(255,255,255,0.10)}
    .sidebar .footer{margin-top:auto;font-size:12px;opacity:.9}

    /* Collapsed sidebar */
    .collapsed .sidebar{width:72px}
    .collapsed .sidebar .brand h1, .collapsed .sidebar .menu li span{display:none}

    /* Main area */
    .main{flex:1;padding:20px 28px;min-height:100vh}

    /* Top navbar */
    .topbar{display:flex;align-items:center;justify-content:space-between;gap:12px;margin-bottom:18px}
    .left-controls{display:flex;align-items:center;gap:12px}
    .hamburger{background:transparent;border:0;color:var(--primary);font-size:18px;padding:8px;border-radius:8px;cursor:pointer}

    .search{display:flex;align-items:center;background:var(--card);padding:8px 12px;border-radius:999px;box-shadow:var(--shadow);gap:10px;border:1px solid var(--glass-border)}
    .search input{border:0;outline:0;background:transparent;width:380px;font-weight:500}

    .actions{display:flex;align-items:center;gap:12px}
    .icon-btn{background:var(--card);padding:9px;border-radius:10px;box-shadow:var(--shadow);border:1px solid var(--glass-border);cursor:pointer}
    .profile{display:flex;align-items:center;gap:10px}
    .profile img{width:40px;height:40px;border-radius:50%;object-fit:cover}

    /* Quick actions slider (desktop) */
    .quick-actions{display:flex;align-items:center;gap:12px;margin-bottom:18px}
    .qa-wrapper{position:relative;flex:1}
    .qa-track{display:flex;gap:12px;padding:6px;overflow-x:auto;scroll-behavior:smooth}
    .qa-item{min-width:160px;background:linear-gradient(180deg,var(--card),#fcfcff);border-radius:10px;padding:12px;box-shadow:var(--shadow);display:flex;gap:12px;align-items:center;border:1px solid var(--glass-border)}
    .qa-item i{font-size:18px;color:var(--primary);width:36px;height:36px;border-radius:8px;display:flex;align-items:center;justify-content:center;background:linear-gradient(180deg,#eef4ff,#fff)}
    .qa-arrows{display:flex;gap:8px;margin-left:6px}
    .qa-arrow{background:var(--card);border-radius:8px;padding:8px;box-shadow:var(--shadow);border:1px solid var(--glass-border);cursor:pointer}

    /* Content grid */
    .grid{display:grid;grid-template-columns:repeat(12,1fr);gap:16px}
    .col-3{grid-column:span 3}
    .col-6{grid-column:span 6}
    .col-12{grid-column:span 12}

    .stat-card{background:var(--card);padding:18px;border-radius:12px;box-shadow:var(--shadow);display:flex;justify-content:space-between;align-items:center;border:1px solid var(--glass-border)}
    .stat-left{display:flex;gap:12px;align-items:center}
    .stat-left i{font-size:28px;background:linear-gradient(135deg,#eef4ff,#fff);padding:12px;border-radius:12px;color:var(--primary)}
    .stat-right h3{margin:0;font-size:1.4rem}
    .muted{color:var(--muted);font-size:0.9rem}

    /* Table */
    .table-card{background:var(--card);padding:16px;border-radius:12px;box-shadow:var(--shadow);border:1px solid var(--glass-border);overflow:auto}
    table{width:100%;border-collapse:collapse}
    th,td{padding:12px 10px;text-align:left;border-bottom:1px solid #f1f3f7}
    thead th{background:transparent;color:var(--muted);font-weight:700}
    td .avatar{display:inline-flex;align-items:center;gap:10px}
    .status{padding:6px 10px;border-radius:999px;color:#fff;font-weight:600;font-size:0.8rem}
    .status.active{background:#16a34a}
    .status.offline{background:#ef4444}

    /* Modal */
    .modal{position:fixed;inset:0;display:none;align-items:center;justify-content:center;background:rgba(2,6,23,0.5);z-index:60}
    .modal.show{display:flex}
    .modal-box{background:var(--card);padding:18px;border-radius:12px;min-width:320px;max-width:480px;box-shadow:0 24px 48px rgba(2,6,23,0.15);border:1px solid var(--glass-border)}

    /* Bottom mobile slider */
    .mobile-slider{display:none;position:fixed;left:12px;right:12px;bottom:14px;background:linear-gradient(180deg,var(--card),#fff);padding:8px;border-radius:14px;box-shadow:0 10px 30px rgba(2,6,23,0.12);z-index:80;border:1px solid var(--glass-border)}
    .mobile-slider .qa-track{display:flex;gap:8px;overflow-x:auto;padding:6px}
    .mobile-slider .qa-item{min-width:110px;padding:10px}

    /* Sections - use same class names you used earlier */
    .section { display: none; }
    .active-section { display: block; }

    /* Responsive rules */
    @media (max-width: 1024px){
      .search input{width:220px}
    }
    @media (max-width: 820px){
      .sidebar{position:fixed;left:-320px;top:0;bottom:0;z-index:70}
      .sidebar.open{left:0}
      .main{padding:18px}
      .collapsed .sidebar{width:260px}
      .quick-actions{display:none}
      .mobile-slider{display:block}
      .search input{width:140px}
      .qa-arrows{display:none}
    }

    /* small screens: grid stacks */
    @media (max-width:640px){
      .grid{grid-template-columns:repeat(6,1fr)}
      .col-3{grid-column:span 6}
      .col-6{grid-column:span 6}
    }

    /* little polish */
    a{color:var(--primary);text-decoration:none}
    button{font-family:inherit}
  </style>
</head>
<body>
  <div class="app" id="app">

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar" aria-label="Sidebar navigation">
      <div class="brand">
        <div class="logo"><i class="fa fa-chart-pie" style="color:#fff"></i></div>
        <div>
          <div style="font-weight:800">BusPass</div>
          <div style="font-size:12px;opacity:.85">Admin Panel</div>
        </div>
      </div>

      <ul class="menu" role="menu">
        <li class="active" data-section="dashboard" role="menuitem"><i class="fa fa-home"></i><span>Dashboard</span></li>
        <li data-section="bookings" role="menuitem"><i class="fa fa-ticket-alt"></i><span>Bookings</span></li>
        <li data-section="payments" role="menuitem"><i class="fa fa-id-card"></i><span>payment</span></li>
        <li data-section="routes" role="menuitem"><i class="fa fa-route"></i><span>Routes</span></li>
        <li data-section="users" role="menuitem"><i class="fa fa-users"></i><span>Users</span></li>
        <li data-section="analytics" role="menuitem"><i class="fa fa-chart-line"></i><span>Analytics</span></li>
        <li data-section="contacts" role="menuitem"><i class="fa fa-envelope"></i><span>Contact Messages</span></li>


        <li data-section="settings" role="menuitem"><i class="fa fa-cog"></i><span>Settings</span></li>
        
      </ul>

      <div class="footer">
        <div style="display:flex;align-items:center;gap:8px;margin-bottom:8px">
          <!-- <img src="https://via.placeholder.com/36" style="border-radius:50%" alt="user"> -->
          <div style="font-size:13px">Meet Sanchala<br><small style="opacity:.7">Administrator</small></div>
        </div>
        <div style="font-size:12px;opacity:.85">v1.2 • Last sync 2 mins</div>
      </div>
    </aside>

    <!-- Main content -->
    <main class="main">
      <!-- Topbar -->
      <div class="topbar">
        <div class="left-controls">
          <button class="hamburger icon-btn" id="toggleSidebar" aria-label="Toggle sidebar"><i class="fa fa-bars"></i></button>

          <div class="search" role="search">
            <i class="fa fa-search" style="color:var(--muted)"></i>
            <input type="search" placeholder="Search anything..." aria-label="Search" />
            <div style="margin-left:6px;font-size:13px;color:var(--muted)">/</div>
          </div>
        </div>

        <div class="actions">
          <div class="qa-summary muted" style="font-weight:600">Welcome back, <span style="color:var(--primary)">Meet</span></div>
          <!-- <button class="icon-btn" title="Notifications"><i class="fa fa-bell"></i></button>
          <button class="icon-btn" title="Settings" data-section="settings" role="menuitem"><i class="fa fa-gear"></i></button>
          <div class="profile" title="Profile">
            <img src="https://via.placeholder.com/40" alt="user profile">
          </div> -->
        </div>
      </div>

      <!-- Quick actions slider (desktop) -->
      <!-- <div class="quick-actions">
        <div class="qa-wrapper">
          <div class="qa-track" id="qaTrack" tabindex="0" aria-label="Quick actions">
            <div class="qa-item" role="button" tabindex="0"><i class="fa fa-ticket-alt"></i><div><div style="font-weight:700">New Booking</div><div class="muted">Create booking</div></div></div>
            <div class="qa-item" role="button" tabindex="0"><i class="fa fa-route"></i><div><div style="font-weight:700">Add Route</div><div class="muted">New bus route</div></div></div>
            <div class="qa-item" role="button" tabindex="0"><i class="fa fa-id-card"></i><div><div style="font-weight:700">Pass Types</div><div class="muted">Manage passes</div></div></div>
            <div class="qa-item" role="button" tabindex="0"><i class="fa fa-chart-bar"></i><div><div style="font-weight:700">Reports</div><div class="muted">View analytics</div></div></div>
            <div class="qa-item" role="button" tabindex="0"><i class="fa fa-bell"></i><div><div style="font-weight:700">Notifications</div><div class="muted">Send alerts</div></div></div>
          </div>
        </div>
        <div class="qa-arrows">
          <button class="qa-arrow" id="qaPrev" aria-label="Previous"><i class="fa fa-chevron-left"></i></button>
          <button class="qa-arrow" id="qaNext" aria-label="Next"><i class="fa fa-chevron-right"></i></button>
        </div>
      </div> -->

      <!-- Dashboard Section (visible by default) -->
      <section id="dashboard" class="section active-section">
        <h2>Dashboard Overview</h2>
        <div class="grid" style="margin-bottom:18px">
          <div class="col-3 stat-card">
            <div class="stat-left"><i class="fa fa-ticket-alt"></i><div><div class="muted">Total Bookings</div><h3>{{ $bookingCount }}</h3>
</div></div>
            <div class="stat-right muted">+12.4%</div>
          </div>

          <!-- <div class="col-3 stat-card">
            <div class="stat-left"><i class="fa fa-id-card"></i><div><div class="muted">Active Passes</div><h3>1,234</h3></div></div>
            <div class="stat-right muted">+8.1%</div>
          </div> -->

          <div class="col-3 stat-card">
            <div class="stat-left"><i class="fa fa-users"></i><div><div class="muted">Registered Users</div><h3>{{ $userCount }} </h3>
</div></div>
            <div class="stat-right muted">+3.4%</div>
          </div>

          <div class="col-3 stat-card">
            <div class="stat-left"><i class="fa fa-dollar-sign"></i><div><div class="muted">Revenue</div><h3>₹ {{ number_format($revenue, 2) }}</h3>
</div></div>
            <div class="stat-right muted">+15.3%</div>
          </div>
        </div>

        <div class="table-card">
          <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px">
            <div style="font-weight:700">Recent Bookings</div>
            <div style="display:flex;gap:8px">
              <button class="icon-btn" id="openModalBtn"><i class="fa fa-plus"></i> New Booking</button>
              <a href="#">Export</a>
            </div>
          </div>
          <table>
            <thead>
              <tr>
                <th>Booking ID</th>
                <th>Customer</th>
                <th>Route</th>
                <th>Pass Type</th>
                <th>Status</th>
                <th>Amount</th>
              </tr>
            </thead>
            <tbody>
@forelse($passes as $pass)
  <tr>
    {{-- Booking ID --}}
    <td>#BK-{{ $pass->id }}</td>

    {{-- Customer --}}
    <td>
      <div class="avatar">
        <img src="{{ asset('uploads/'.$pass->photo) }}" 
             onerror="this.src='https://via.placeholder.com/38'"
             alt="avatar"
             style="border-radius:50%;width:38px;height:38px">

        <div>
          {{ $pass->student_name ?? $pass->full_name }}
          <br>
          <small class="muted">{{ $pass->email }}</small>
        </div>
      </div>
    </td>

    {{-- Route --}}
    <td>
      {{ $pass->from_location }} → {{ $pass->to_location }}
      <br>
      <small class="muted">{{ $pass->route }}</small>
    </td>

    {{-- Pass Type --}}
    <td>{{ ucfirst($pass->pass_duration) }}</td>

    {{-- Status --}}
    <td>
      @if($pass->status == 'approved' && !$pass->is_expired)
        <span class="status active">Active</span>
      @elseif($pass->status == 'approved' && $pass->is_expired)
        <span class="status offline">Expired</span>
      @elseif($pass->status == 'rejected')
        <span class="status rejected">Rejected</span>
      @else
        <span class="status pending">Pending</span>
      @endif
    </td>

    {{-- Amount --}}
    <td>₹{{ number_format($pass->price, 2) }}</td>
  </tr>
@empty
  <tr>
    <td colspan="6" style="text-align:center" class="muted">
      No bookings found
    </td>
  </tr>
@endforelse
</tbody>

          </table>
        </div>
      </section>

      <section id="routes" class="section" style="margin-top:16px; display:none">
  <h2>Route Management</h2>

  

  <!-- Add New Route Form -->
  <form action="{{ route('admin.routes.store') }}" method="POST" style="background:white;padding:18px;border-radius:10px;margin-bottom:18px;box-shadow:0 4px 12px rgba(0,0,0,0.05)">
      @csrf
      <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:12px">
          <input type="text" name="from" placeholder="From" required>
          <input type="text" name="to" placeholder="To" required>

          <input type="number" step="0.01" name="local_student_price" placeholder="Local Student Price" required>
          <input type="number" step="0.01" name="local_passenger_price" placeholder="Local Passenger Price" required>

          <input type="number" step="0.01" name="express_student_price" placeholder="Express Student Price" required>
          <input type="number" step="0.01" name="express_passenger_price" placeholder="Express Passenger Price" required>
      </div>

      <button type="submit" 
              style="margin-top:14px;background:#1e3a8a;color:white;padding:10px 18px;border-radius:6px;font-weight:600">
          ➕ Add Route
      </button>
  </form>

  <!-- Route Table -->
  <div class="table-card">
  <div style="font-weight:700;margin-bottom:12px">Available Bus Routes</div>
  <table>
    
    <thead>
<tr>
  <th>From</th>
  <th>To</th>
  <th>Local (Student)</th>
  <th>Local (Passenger)</th>
  <th>Express (Student)</th>
  <th>Express (Passenger)</th>
  <th>Added</th>
  <th>Action</th>
</tr>
</thead>

<tbody>
@foreach($routes as $r)
<tr>
  <td>{{ $r->from }}</td>
  <td>{{ $r->to }}</td>
  <td>{{ $r->local_student_price }}</td>
  <td>{{ $r->local_passenger_price }}</td>
  <td>{{ $r->express_student_price }}</td>
  <td>{{ $r->express_passenger_price }}</td>
  <td>{{ $r->created_at ? $r->created_at->format('M d, Y') : '-' }}</td>

  <td>
    <button onclick="openEditForm({{ $r->id }}, '{{ $r->from }}', '{{ $r->to }}', '{{ $r->local_student_price }}', '{{ $r->local_passenger_price }}', '{{ $r->express_student_price }}', '{{ $r->express_passenger_price }}')"
      class="btn-small" style="background:#2563eb;color:white;padding:4px 8px;border-radius:4px">
      Edit
    </button>

    <a href="{{ route('admin.routes.delete', $r->id) }}"
       onclick="return confirm('Are you sure to delete this route?')"
       class="btn-small"
       style="background:#dc2626;color:white;padding:4px 8px;border-radius:4px;margin-left:6px">
       Delete
    </a>
  </td>
</tr>
@endforeach
</tbody>

  </table>
</div>

  
</section>
<script>
function openEditForm(id, from, to, lsp, lpp, esp, epp) {
    document.getElementById("edit_from").value = from;
    document.getElementById("edit_to").value = to;
    document.getElementById("edit_lsp").value = lsp;
    document.getElementById("edit_lpp").value = lpp;
    document.getElementById("edit_esp").value = esp;
    document.getElementById("edit_epp").value = epp;

    document.getElementById("editRouteForm").action = `/admin/routes/update/${id}`;
    document.getElementById("editForm").style.display = "flex";
}

function closeEditForm() {
    document.getElementById("editForm").style.display = "none";
}</script>

  <!-- Edit Form Modal -->
<div id="editForm" style="display:none; position:fixed; top:0; left:0; 
width:100%; height:100%; background:rgba(0,0,0,0.4); justify-content:center; align-items:center;">
  <div style="background:white; padding:25px; border-radius:8px; width:440px;">
    <h3>Edit Route</h3>
    
    <form id="editRouteForm" method="POST">
      @csrf

      <input type="text" name="from" id="edit_from" placeholder="From" class="form-input" required>
      <input type="text" name="to" id="edit_to" placeholder="To" class="form-input" required>

      <input type="number" step="0.01" name="local_student_price" id="edit_lsp" placeholder="Local Student Price" class="form-input" required>
      <input type="number" step="0.01" name="local_passenger_price" id="edit_lpp" placeholder="Local Passenger Price" class="form-input" required>

      <input type="number" step="0.01" name="express_student_price" id="edit_esp" placeholder="Express Student Price" class="form-input" required>
      <input type="number" step="0.01" name="express_passenger_price" id="edit_epp" placeholder="Express Passenger Price" class="form-input" required>

      <button type="submit" class="btn-primary" style="margin-top:12px">Update Route</button>
      <button type="button" onclick="closeEditForm()" style="margin-top:12px;background:#737373;color:white;padding:8px;border-radius:4px">Cancel</button>
    </form>
  </div>
</div>



</section>

<!-- Bookings Section -->
<section id="bookings" class="section" style="margin-top:16px;display:block">
    <h2>All Bookings</h2>
    <div class="table-card">
        <div style="font-weight:700;margin-bottom:12px">Booking Management</div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Customer</th>
                    <th>Route</th>
                    <th>Pass Type</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($passes as $pass)
                <tr>
                    <td>#BK-{{ $pass->id }}</td>
                    <td>{{ $pass->pass_type == 'student' ? $pass->student_name : $pass->full_name }}</td>
                    <td>{{ $pass->route ?? $pass->from_location.' → '.$pass->to_location }}</td>
                    <td>{{ ucfirst($pass->pass_type) }}</td>
                    <td>{{ $pass->created_at->format('M d, Y') }}</td>
                    <td>
                        @if($pass->status == 'approved')
                            <span class="status active">Approved</span>
                        @elseif($pass->status == 'rejected')
                            <span class="status offline">Rejected</span>
                        @else
                            <span class="status pending">Pending</span>
                        @endif
                    </td>
                    <td>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#passModal{{ $pass->id }}">View</button>
                       @if($pass->status == 'pending')

<form action="{{ route('admin.pass.status', $pass->id) }}" method="POST" style="display:inline-block">
    @csrf
    <input type="hidden" name="status" value="approved">
    <button type="submit" class="btn btn-success btn-sm">
        Approve
    </button>
</form>

<form action="{{ route('admin.pass.status', $pass->id) }}" method="POST" style="display:inline-block">
    @csrf
    <input type="hidden" name="status" value="rejected">
    <button type="submit" class="btn btn-danger btn-sm">
        Reject
    </button>
</form>

@endif

                    </td>
                </tr>

                <!-- Modal -->
                <div class="modal fade" id="passModal{{ $pass->id }}" tabindex="-1" aria-labelledby="passModalLabel{{ $pass->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content" style="border-radius: 24px; overflow: hidden; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.15);">

                            <!-- Modal Header -->
                            <div class="modal-header border-0 p-4" style="background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);">
                                <h5 class="modal-title text-white fw-bold" id="passModalLabel{{ $pass->id }}">
                                    <i class="bi bi-ticket-perforated me-2"></i>Pass Details #BK-{{ $pass->id }}
                                </h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <!-- Modal Body -->
                            <div class="modal-body p-4" style="background-color: #ffffff; border-radius: 0 0 24px 24px;">
                                <div class="container-fluid">
                                    <!-- User Info -->
                                    <div class="row g-4 mb-4">
                                        <div class="col-md-12">
                                            <div class="card border-0 shadow-sm p-3" style="border-radius: 16px;">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-circle">
                                                            <i class="bi bi-person-fill fs-3"></i>
                                                        </div>
                                                    </div>
                                                    <div class="ms-4">
                                                        <h4 class="mb-0 fw-bold text-dark">{{ $pass->pass_type == 'student' ? $pass->student_name : $pass->full_name }}</h4>
                                                        <span class="badge rounded-pill {{ $pass->status == 'approved' ? 'bg-success' : ($pass->status == 'pending' ? 'bg-warning' : 'bg-danger') }}">
                                                            {{ ucfirst($pass->status) }}
                                                        </span>
                                                        <span class="ms-2 text-muted small"><i class="bi bi-hash"></i> {{ $pass->icard_no }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Contact & Journey Info -->
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <h6 class="text-uppercase text-muted fw-bold mb-3 small">Contact Information</h6>
                                            <div class="bg-white p-3 rounded-4 shadow-sm h-100">
                                                <div class="mb-2"><small class="text-muted d-block">Email Address</small><strong>{{ $pass->email }}</strong></div>
                                                <div class="mb-2"><small class="text-muted d-block">Mobile Number</small><strong>{{ $pass->mobile }}</strong></div>
                                                <div><small class="text-muted d-block">Pass Type</small><span class="badge bg-light text-dark border">{{ ucfirst($pass->pass_type) }}</span></div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <h6 class="text-uppercase text-muted fw-bold mb-3 small">Journey Details</h6>
                                            <div class="bg-white p-3 rounded-4 shadow-sm h-100">
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <div class="text-center">
                                                        <small class="text-muted d-block">From</small>
                                                        <span class="fw-bold">{{ $pass->from_location }}</span>
                                                    </div>
                                                    <i class="bi bi-arrow-right text-primary"></i>
                                                    <div class="text-center">
                                                        <small class="text-muted d-block">To</small>
                                                        <span class="fw-bold">{{ $pass->to_location }}</span>
                                                    </div>
                                                </div>
                                                <div class="mb-2 small"><i class="bi bi-bus-front me-2 text-primary"></i>{{ $pass->bus_type }} ({{ $pass->route }})</div>
                                                <div class="small"><i class="bi bi-calendar3 me-2 text-primary"></i>{{ $pass->pass_duration }} | {{ $pass->academic_year }}</div>
                                            </div>
                                        </div>

                                        <!-- Documents -->
                                        <div class="col-md-12">
                                            <h6 class="text-uppercase text-muted fw-bold mb-3 small">Verification Documents</h6>
                                            <div class="d-flex flex-wrap gap-2">
                                                @foreach(['aadhaar','bonafide','photo','signature','ration'] as $file)
                                                    @if($pass->$file)
                                                        <a href="{{ asset('uploads/docs/'.$pass->$file) }}" target="_blank" class="btn btn-outline-primary btn-sm px-3" style="border-radius: 10px;">
                                                            <i class="bi bi-file-earmark-check me-1"></i> {{ ucfirst($file) }}
                                                        </a>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>

                                        <!-- Payment Info -->
                                        <div class="col-md-12">
                                            <div class="bg-dark text-white p-4 rounded-4 d-flex justify-content-between align-items-center shadow-lg">
                                                <div>
                                                    <p class="mb-0 text-secondary small text-uppercase">Total Amount Paid</p>
                                                    <h3 class="mb-0 fw-bold">₹{{ $pass->price }}</h3>
                                                </div>
                                                <div class="text-end">
                                                    <p class="mb-0 text-secondary small text-uppercase">Payment Method</p>
                                                    <span class="badge bg-primary">{{ $pass->payment ? ucfirst($pass->payment->method) : 'N/A' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- Modal Footer -->
                            <div class="modal-footer border-0 p-4 bg-light">
                                <button type="button" class="btn btn-light px-4 py-2 fw-bold shadow-sm" data-bs-dismiss="modal" style="border-radius:12px;">Close</button>
                                <button type="button" class="btn btn-primary px-4 py-2 fw-bold shadow-sm" onclick="window.print()" style="border-radius:12px; background: #4f46e5;">
                                    <i class="bi bi-printer me-2"></i>Print Details
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- End Modal -->

                @endforeach
            </tbody>
        </table>
    </div>
</section>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Bootstrap JS (for modal) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Edit Form Modal -->
<div id="editForm" style="display:none; position:fixed; top:0; left:0; 
width:100%; height:100%; background:rgba(0,0,0,0.4); justify-content:center; align-items:center;">
  <div style="background:white; padding:25px; border-radius:8px; width:380px;">
    <h3>Edit Route</h3>
    
    <form id="editRouteForm" method="POST">
      @csrf
      <input type="text" name="from" id="edit_from" class="form-input" placeholder="From" required>
      <input type="text" name="to" id="edit_to" class="form-input" placeholder="To" required>

      <input type="number" step="0.01" name="student_price" id="edit_student_price" class="form-input" placeholder="Student Price" required>
      <input type="number" step="0.01" name="passenger_price" id="edit_passenger_price" class="form-input" placeholder="Passenger Price" required>

      <button type="submit" class="btn-primary" style="margin-top:12px">Update Route</button>
      <button type="button" onclick="closeEditForm()" style="margin-top:12px;background:#737373;color:white;padding:8px;border-radius:4px">Cancel</button>
    </form>
  </div>
</div>
<script>
function openEditForm(id, from, to, lsp, lpp, esp, epp) {
  document.getElementById("editForm").style.display = "flex";

  document.getElementById("edit_from").value = from;
  document.getElementById("edit_to").value = to;

  document.getElementById("edit_lsp").value = lsp;
  document.getElementById("edit_lpp").value = lpp;
  document.getElementById("edit_esp").value = esp;
  document.getElementById("edit_epp").value = epp;

  document.getElementById("editRouteForm").action = "/admin/routes/update/" + id;
}

function closeEditForm() {
    document.getElementById('editForm').style.display = 'none';
}
</script>



      <!-- Bus Passes Section -->
      <section id="#" class="section" style="margin-top:16px;display:none">
        <h2>Bus Pass Types</h2>
        <div class="grid" style="margin-top:12px">
          <div class="col-4 stat-card">
            <div class="stat-left"><i class="fa fa-id-card"></i><div><div class="muted">Monthly Pass</div><h3>$89</h3><small class="muted">30 days validity</small></div></div>
            <div class="stat-right"><a href="#">Edit</a></div>
          </div>
          <div class="col-4 stat-card">
            <div class="stat-left"><i class="fa fa-id-card"></i><div><div class="muted">Weekly Pass</div><h3>$45</h3><small class="muted">7 days validity</small></div></div>
            <div class="stat-right"><a href="#">Edit</a></div>
          </div>
          <div class="col-4 stat-card">
            <div class="stat-left"><i class="fa fa-id-card"></i><div><div class="muted">Daily Pass</div><h3>$12</h3><small class="muted">24 hours validity</small></div></div>
            <div class="stat-right"><a href="#">Edit</a></div>
          </div>
        </div>
      </section>

      <!-- Routes Section -->
      <section id="routes" class="section" style="margin-top:16px;display:none">
        <h2>Bus Routes</h2>
        <div class="table-card">
          <div style="font-weight:700;margin-bottom:12px">Active Routes</div>
          <table>
            <thead><tr><th>Route ID</th><th>Route Name</th><th>From - To</th><th>Buses</th><th>Status</th><th>Actions</th></tr></thead>
            <tbody>
              <tr><td>R-42</td><td>Downtown Express</td><td>Central Station → Business District</td><td>12</td><td><span class="status active">Active</span></td><td><a href="#">Edit</a></td></tr>
              <tr><td>R-15</td><td>Campus Shuttle</td><td>University → Metro Station</td><td>8</td><td><span class="status active">Active</span></td><td><a href="#">Edit</a></td></tr>
              <tr><td>R-28</td><td>Suburban Connect</td><td>Riverside → City Center</td><td>15</td><td><span class="status active">Active</span></td><td><a href="#">Edit</a></td></tr>
              <tr><td>R-09</td><td>Airport Link</td><td>Airport → Downtown</td><td>6</td><td><span class="status offline">Inactive</span></td><td><a href="#">Edit</a></td></tr>
            </tbody>
          </table>
        </div>
      </section>
<!-- Payments Section -->
<section id="payments" class="section" style="margin-top:16px;display:none">

<h2>Payment Details</h2>

<div class="table-card">
<table>
<thead>
<tr>
    <th>Payment ID</th>
    <th>User Name</th>
    <th>Pass Type</th>
    <th>Route</th>
    <th>Amount Paid</th>
    <th>Method</th>
    <th>Status</th>
    <th>Date</th>
</tr>
</thead>

<tbody>
@foreach($payments as $payment)
<tr>
    <td>#PAY-{{ $payment->id }}</td>

    <td>
        {{ $payment->user->name ?? 'N/A' }}
    </td>

    <td>
        {{ ucfirst($payment->pass->pass_type ?? 'N/A') }}
    </td>

    <td>
        {{ ($payment->pass->from_location ?? '') }}
        →
        {{ ($payment->pass->to_location ?? '') }}
    </td>

    <td>
        ₹ {{ number_format($payment->pass->price ?? 0, 2) }}
    </td>

    <td>
        {{ strtoupper($payment->method ?? 'NA') }}
    </td>

    <td>
        @if($payment->status == 'success')
            <span class="status active">Success</span>
        @else
            <span class="status pending">Pending</span>
        @endif
    </td>

    <td>
        {{ $payment->created_at->format('d M Y') }}
    </td>
</tr>
@endforeach
</tbody>
</table>
</div>
</section>

  <!-- Users Section -->
<section id="users" class="section" style="margin-top:16px;display:block">
    <h2>User Management</h2>
    <div class="table-card">
        <div style="font-weight:700;margin-bottom:12px">Registered Users</div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Joined</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $u)
                <tr>
                    <td>{{ $u->name }}</td>
                    <td>{{ $u->email }}</td>
                    <td>{{ $u->no }}</td>
                    <td>{{ $u->created_at ? $u->created_at->format('M d, Y') : '-' }}</td>
                    <td>
                        <form action="{{ route('admin.user.delete', $u->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user? This will remove all related passes and payments.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
   <!-- Analytics Section -->
   <section id="analytics" class="section" style="margin-top:16px;display:none">
  <h2>Analytics & Reports</h2>

  <div class="grid" style="margin-bottom:18px">

    <!-- Daily Bookings -->
    <div class="col-3 stat-card">
      <div class="stat-left">
        <i class="fa fa-chart-line"></i>
        <div>
          <div class="muted">Daily Bookings</div>
          <h3>{{ $todayBookings }}</h3>
        </div>
      </div>
      <div class="stat-right muted">Today</div>
    </div>

    <!-- Monthly Rides -->
    <div class="col-3 stat-card">
      <div class="stat-left">
        <i class="fa fa-bus"></i>
        <div>
          <div class="muted">Total Rides</div>
          <h3>{{ $totalRidesMonth }}</h3>
        </div>
      </div>
      <div class="stat-right muted">This Month</div>
    </div>

    <!-- Average Revenue -->
    <div class="col-3 stat-card">
      <div class="stat-left">
        <i class="fa fa-rupee-sign"></i>
        <div>
          <div class="muted">Avg Revenue</div>
          <h3>₹{{ number_format($avgRevenuePerDay ?? 0, 2) }}</h3>
        </div>
      </div>
      <div class="stat-right muted">Per Day</div>
    </div>

    <!-- Satisfaction
    <div class="col-3 stat-card">
      <div class="stat-left">
        <i class="fa fa-star"></i>
        <div>
          <div class="muted">Satisfaction</div>
          <h3>{{ $satisfaction }}/5</h3>
        </div>
      </div>
      <div class="stat-right muted">Rating</div>
    </div> -->

  </div>
</section> 
<!-- contact us  -->
 <section id="contacts" class="section" style="margin-top:16px; display:none">
  <h2>Contact Messages</h2>
  <div class="table-card">
    <div style="font-weight:700;margin-bottom:12px">Contact Submissions</div>

    <table>
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Mobile</th>
          <th>Subject</th>
          <th>Message</th>
          <th>Received</th>
        </tr>
      </thead>
      <tbody>
        @foreach($messages as $m)
        <tr>
          <td>{{ $m->name }}</td>
          <td>{{ $m->email }}</td>
          <td>{{ $m->phone }}</td>
          <td>{{ $m->subject }}</td>
          <td>{{$m->message }}</td>
          <td>{{ $m->created_at ? $m->created_at->format('M d, Y') : '-' }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</section>

      <!-- Settings Section -->
    <section id="settings" class="section" style="margin-top:16px;display:none">
  <h2>System Settings</h2>

  @if(session('success'))
    <div style="color:green;font-weight:600;margin-bottom:10px">
      {{ session('success') }}
    </div>
  @endif

  <div class="table-card">
    <div style="font-weight:700;margin-bottom:12px">Configuration</div>

   <form method="POST" action="{{ route('admin.dashboard') }}">

      @csrf

      <label style="font-weight:600;display:block;margin-bottom:8px">
        System Name
      </label>
      <input
        type="text"
        name="system_name"
        value="{{ $admin->system_name ?? '' }}"
        style="width:100%;padding:10px;border-radius:8px;border:1px solid #eef2ff;margin-bottom:16px"
        required
      >

      <label style="font-weight:600;display:block;margin-bottom:8px">
        Support Email
      </label>
      <input
        type="email"
        name="support_email"
        value="{{ $admin->support_email ?? '' }}"
        style="width:100%;padding:10px;border-radius:8px;border:1px solid #eef2ff;margin-bottom:16px"
        required
      >

      <button
        type="submit"
        name="update_settings"
        style="background:var(--primary);color:#fff;padding:12px 24px;border-radius:10px;border:0;font-weight:600">
        Save Changes
      </button>
    </form>
  </div>
</section>


    </main>
  </div>

  <!-- Mobile slider (appears on small screens) -->
  <div class="mobile-slider" role="navigation" aria-label="Mobile quick actions">
    <div class="qa-track" id="mobileQa">
      <div class="qa-item"><i class="fa fa-ticket-alt"></i> <div style="font-weight:700">Bookings</div></div>
      
      <div class="qa-item"><i class="fa fa-route"></i> <div style="font-weight:700">Routes</div></div>
      <div class="qa-item"><i class="fa fa-chart-bar"></i> <div style="font-weight:700">Analytics</div></div>
      <div class="qa-item"><i class="fa fa-users"></i> <div style="font-weight:700">Users</div></div>
    </div>
  </div>

  <script>
    // Sidebar toggle for small screens
    const sidebar = document.getElementById('sidebar');
    const app = document.getElementById('app');
    const toggle = document.getElementById('toggleSidebar');

    toggle.addEventListener('click', ()=>{
      if(window.innerWidth <= 820){
        // mobile drawer open/close
        sidebar.classList.toggle('open');
      } else {
        // collapse on large screens
        app.classList.toggle('collapsed');
      }
    });

    // Section switching
    // Use the .menu li data-section attribute to open respective section.
    document.querySelectorAll('.menu li').forEach(item=>{
      item.addEventListener('click', ()=>{
        // active class on menu
        document.querySelectorAll('.menu li').forEach(i=>i.classList.remove('active'));
        item.classList.add('active');

        // hide all sections and show the target
        document.querySelectorAll('main .section').forEach(s=>{
          s.classList.remove('active-section');
          s.style.display = 'none';
        });

        const sectionId = item.getAttribute('data-section');
        const target = document.getElementById(sectionId);
        if(target){
          target.style.display = 'block';
          // also toggle class for legacy styles if used
          target.classList.add('active-section');
        }

        // close sidebar on mobile after navigation
        if(window.innerWidth <= 820){ sidebar.classList.remove('open'); }
      })
    });

    // Quick actions slider arrows (if present)
    const qaTrack = document.getElementById('qaTrack');
    const qaPrev = document.getElementById('qaPrev');
    const qaNext = document.getElementById('qaNext');
    if(qaPrev && qaNext && qaTrack){
      qaPrev.addEventListener('click', ()=>{ qaTrack.scrollBy({left:-qaTrack.clientWidth * 0.7, behavior:'smooth'}) });
      qaNext.addEventListener('click', ()=>{ qaTrack.scrollBy({left: qaTrack.clientWidth * 0.7, behavior:'smooth'}) });
    }

    // Swipe support for slider (desktop and mobile track)
    function addSwipe(track){
      if(!track) return;
      let pointerDown = false; let startX=0; let scrollLeft=0;
      track.addEventListener('pointerdown', e=>{ pointerDown=true; startX = e.pageX - track.offsetLeft; scrollLeft = track.scrollLeft; track.setPointerCapture(e.pointerId); });
      track.addEventListener('pointermove', e=>{ if(!pointerDown) return; const x = e.pageX - track.offsetLeft; const walk = (x - startX) * 1; track.scrollLeft = scrollLeft - walk; });
      track.addEventListener('pointerup', ()=>{ pointerDown=false });
      track.addEventListener('pointerleave', ()=>{ pointerDown=false });
    }
    addSwipe(qaTrack);
    addSwipe(document.getElementById('mobileQa'));

    // Modal logic (dashboard invite button)
    const modal = document.getElementById('myModal');
    const openModalBtn = document.getElementById('openModalBtn');
    const openModalSectionBtn = document.getElementById('openModal'); // button inside modal section
    const closeButtons = document.querySelectorAll('.modal .close, .modal-box .close');

    if(openModalBtn){ openModalBtn.addEventListener('click', ()=>{ modal.classList.add('show'); modal.setAttribute('aria-hidden','false'); }) }
    if(openModalSectionBtn){ openModalSectionBtn.addEventListener('click', ()=>{ modal.classList.add('show'); modal.setAttribute('aria-hidden','false'); }) }

    closeButtons.forEach(btn=>{
      btn.addEventListener('click', ()=>{ modal.classList.remove('show'); modal.setAttribute('aria-hidden','true'); });
    });

    window.addEventListener('click', (e)=>{ if(e.target === modal) { modal.classList.remove('show'); modal.setAttribute('aria-hidden','true'); }});

    // small enhancement: keyboard navigation for quick actions
    if(qaTrack){
      qaTrack.addEventListener('keydown', e=>{
        if(e.key === 'ArrowRight') qaTrack.scrollBy({left:200, behavior:'smooth'});
        if(e.key === 'ArrowLeft') qaTrack.scrollBy({left:-200, behavior:'smooth'});
      });
    }

    // Close sidebar when resizing to desktop
    window.addEventListener('resize', ()=>{ if(window.innerWidth > 820){ sidebar.classList.remove('open') } });

    // Ensure dashboard is visible on load (in case of initial hiding)
    window.addEventListener('DOMContentLoaded', ()=>{
      const initial = document.querySelector('.menu li.active');
      if(initial){
        const id = initial.getAttribute('data-section');
        const t = document.getElementById(id);
        if(t){ t.style.display = 'block'; t.classList.add('active-section'); }
      }
    });
  </script>
</body>
</html>
