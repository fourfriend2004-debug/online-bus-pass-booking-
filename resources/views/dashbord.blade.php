@extends('layouts.master')
@section('title', 'Home Page')

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Dashboard | Bus Pass System</title>
  <style>
    /* ===== Basic Styles ===== */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Segoe UI", sans-serif;
    }
    .cardlink{
      text-decoration:none;
    }

    body {
      background: linear-gradient(to right, #e3f2fd, #f5faff);
      color: #333;
    }
    
    /* ===== Sidebar ===== */
    .sidebar {
      width: 250px;
      height: 100vh;
      background: #2563eb;
      color: #fff;
      position: fixed;
      top: 0;
      left: 0;
      display: flex;
      flex-direction: column;
      padding: 20px;
    }

    .sidebar h2 {
      text-align: center;
      margin-bottom: 40px;
      font-size: 22px;
      letter-spacing: 1px;
    }

    .sidebar a {
      text-decoration: none;
      color: #fff;
      display: flex;
      align-items: center;
      padding: 12px 15px;
      border-radius: 8px;
      margin: 5px 0;
      transition: 0.3s;
    }

    .sidebar a:hover {
      background: rgba(255, 255, 255, 0.2);
    }

    .sidebar a span {
      margin-left: 10px;
      font-size: 15px;
    }

    /* ===== Main Content ===== */
    .main-content {
      margin-left: 270px;
      padding: 30px;
      padding-top:100px ;
    }

    .main-content h1 {
      font-size: 28px;
      margin-bottom: 20px;
      color: #1d4ed8;
    }
   

    .cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
      gap: 20px;
    }

    .card {
      background: #fff;
      border-radius: 16px;
      padding: 25px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      transition: 0.3s;
      text-align: center;
      height:250px;
    }

    .card:hover {
      transform: translateY(-5px);
    }

    .card h3 {
      margin: 15px 0 10px;
      color: #2563eb;
    }

    .card p {
      color: #666;
      font-size: 14px;
    }

    /* ===== Icons ===== */
    .icon {
      font-size: 40px;
      color: #2563eb;
    }

    /* ===== Responsive ===== */
    @media (max-width: 768px) {
      .sidebar {
        width: 200px;
      }

      .main-content {
        margin-left: 220px;
      }
    }

    @media (max-width: 600px) {
      .sidebar {
        display: none;
      }

      .main-content {
        margin-left: calc(100%-250px);
      }
    }
    footer {
      background: #0f172a;
      color: #cbd5e1;
      text-align: center;
      padding: 15px;
      width: calc(100% - 250px);
      bottom: 0;
      margin-left:250px;
      left: 250px;
    }

  </style>
</head>
<body>

  <!-- ===== Sidebar ===== -->
  <div class="sidebar">
    <h2>🚌 BusPass</h2>
    <a href="bussearch"><span>🆕 Apply New Pass</span></a>
    <a href="renew"><span>🔁 Renew Pass</span></a>
    <a href="mypass"><span>📄 My Passes</span></a>
    <a href="pass"><span>⬇️ Download Pass</span></a>
    <a href="profile"><span>⚙️ Profile Settings</span></a>
    <a href="logout"><span>🚪 Logout</span></a>
  </div>

  <!-- ===== Main Content ===== -->
  <div class="main-content">
    <h1>Welcome, Meet 👋</h1>
    <a href="bussearch" class="cardlink"><div class="cards">
      <div class="card">
        <div class="icon">🆕</div>
        <h3>Apply New Pass</h3>
        <p>Naya bus pass apply karne ke liye form fill karein.</p>
      </div></a>
    <a href="renew" class="cardlink">

      <div class="card">
        <div class="icon">🔁</div>
        <h3>Renew Pass</h3>
        <p>Apne purane pass ko renew karein easily.</p>
      </div>
  </a>
  <a href="{{ route('my.passes') }}" class="cardlink">
      <div class="card">
        <div class="icon">📄</div>
        <h3>My Passes</h3>
        <p>Pending, Approved, aur Rejected passes dekhein.</p>
      </div>
    </a>

   {{-- ✅ Approved Pass Download --}}
@if(isset($passes) && count($passes) > 0)
    @php
        $pass = $passes->first();
    @endphp

    <a href="{{ route('pass.show', $pass->id) }}" class="cardlink">
        <div class="card">
            <div class="icon">⬇️</div>
            <h3>Download Pass</h3>
            <p>{{ ucfirst($pass->pass_type) }} Pass ka PDF download karein.</p>
        </div>
    </a>
@else
    <div class="card" style="text-align:center; color:#999;">
        <h3>No Approved Pass</h3>
        <p>Aapke paas abhi koi approved pass nahi hai.</p>
    </div>
@endif


       <a href="profile" class="cardlink"><div class="card">

        <div class="icon">⚙️</div>
        <h3>Profile Settings</h3>
        <p>Apni personal details update karein.</p>
      </div>
    </div>
    <a>
  </div>

</body>
