<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/all.min.css">
  <style>
    /* Navbar */
    .navbar {
      background: #fff;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
      padding: 12px 30px;
    }
    .navbar-brand {
      font-weight: 700;
      font-size: 1.5rem;
      color: #2563eb;
    }
    .navbar-nav .nav-link {
      margin: 0 12px;
      color: #333;
      font-weight: 500;
    }
    .navbar-nav .nav-link:hover {
      color: #2563eb;
    }
    .btn-login {
      margin-right: 10px;
      color: #2563eb;
      font-weight: 500;
    }
    .btn-signup {
      background: #2563eb;
      color: #fff;
      font-weight: 500;
      border-radius: 6px;
      padding: 6px 14px;
    }

    /* Footer */
    .footer {
      background: #0f172a;
      color: #cbd5e1;
      padding: 60px 20px 20px;
    }
    .footer h5 {
      font-weight: 600;
      margin-bottom: 20px;
      color: #fff;
    }
    .footer a {
      color: #cbd5e1;
      text-decoration: none;
      display: block;
      margin-bottom: 8px;
      transition: color 0.3s ease;
    }
    .footer a:hover {
      color: #38bdf8;
    }
    .footer .logo {
      font-size: 24px;
      font-weight: 700;
      color: #3b82f6;
      margin-bottom: 10px;
      display: inline-block;
    }
    .footer .social-icons{
      display: flex;
    }
    .footer .social-icons a {
      margin-right: 12px;
      font-size: 18px;
      color: #cbd5e1;
      transition: color 0.3s;
    }
    .footer .social-icons a:hover {
      color: #38bdf8;
    }
    .footer .payment-icons i {
      font-size: 22px;
      margin-right: 12px;
    }
    .footer-bottom {
      border-top: 1px solid #1e293b;
      margin-top: 30px;
      padding-top: 15px;
      text-align: center;
      color: #94a3b8;
      font-size: 14px;
    }
  </style>
</head>
<body>

@php
use App\Admin;
$admin = Admin::first();
@endphp

<nav class="navbar navbar-expand-lg navbar-light fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">
        {{ $admin->system_name ?? 'BusPass' }}
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="/contact">Contact</a></li>
        <li class="nav-item"><a class="nav-link" href="/about">About</a></li>
      </ul>

      {{--  User Login Name Show Logic --}}
      @if(Session::has('username'))
        <div class="dropdown">
          <button class="btn btn-login dropdown-toggle" type="button" data-bs-toggle="dropdown">
            {{ Session::get('username') }}
          </button>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="/dashbord">Dashboard</a></li>
            <li><a class="dropdown-item" href="/profile">Profile</a></li>
            <li><a class="dropdown-item" href="/logout">Logout</a></li>
          </ul>
        </div>
      @else
        <a href="/login" class="btn btn-login">Login</a>
        <a href="/reg" class="btn btn-signup">Sign Up</a>
      @endif

    </div>
  </div>
</nav>

  @yield('content')

  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <div class="row">
        
        <div class="col-md-3 col-sm-6 mb-4">
          <div class="logo">
            {{ $admin->system_name ?? 'Online BusPass' }}
          </div>
          <p>Making public transportation accessible, affordable, and convenient for everyone.</p>
          <div class="social-icons mt-3">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 mb-4">
          <h5>Quick Links</h5>
          <a href="/about">About Us</a>
        </div>

        <div class="col-md-3 col-sm-6 mb-4">
          <h5>Support</h5>
          <a href="/help">Help Center</a>
          <a href="/contact">Contact Us</a>
          <a href="/terms">Terms & Conditions</a>
          <a href="/privacy">Privacy Policy</a>
        </div>

        <div class="col-md-3 col-sm-6 mb-4">
          <h5>Payment Methods</h5>
          <div class="payment-icons mb-2">
            <i class="fas fa-credit-card"></i>
            <i class="fab fa-cc-visa"></i>
            <i class="fab fa-cc-paypal"></i>
          </div>
          <!-- <small>Customer Support: {{ $admin->support_phone ?? '8849000260' }}</small><br> -->
          <small>Customer Support: {{ $admin->support_email ?? '8849000260' }}</small>

        </div>

      </div>
    </div>
    <div class="footer-bottom">
      © 2025 {{ $admin->system_name ?? 'BusPass' }}. All rights reserved.
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
