@extends('layouts.master')
@section('title', 'Home Page')

<head>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to bottom, #eaf3ff, #f9fbff);
      margin: 0;
      padding: 0;
    }

    /* Hero Section */
    .hero-section {
      padding-top: 150px;
      position: relative;
      overflow: hidden;
    }

    .hero-section::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      opacity: 0.3;
    }

    .hero-content {
      position: relative;
      z-index: 2;
    }

    .hero-title {
      font-size: 3rem;
      font-weight: 800;
      color: rgb(0, 0, 0);
      line-height: 1.2;
      text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      animation: fadeInUp 0.8s ease-out;
    }

    .hero-subtitle {
      font-size: 1.1rem;
      color: rgb(28, 28, 28);
      max-width: 700px;
      margin: 0 auto;
      line-height: 1.6;
      animation: fadeInUp 1s ease-out;
    }

    /* Hero Buttons */
    .btn-hero {
      font-weight: 600;
      border-radius: 50px;
      padding: 12px 32px;
      transition: all 0.3s ease;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      font-size: 0.9rem;
    }

    .btn-hero:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    .btn-outline-primary {
      background: rgba(255, 255, 255, 0.1);
      border: 2px solid #ffffff;
      color: #ffffff;
      backdrop-filter: blur(10px);
    }

    .btn-outline-primary:hover {
      background: #ffffff;
      color: #667eea;
      border-color: #ffffff;
    }

    /* Animations */
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Process Section */
    .process-section {
      padding: 60px 20px;
      text-align: center;
    }

    .process-section h2 {
      font-weight: 700;
      margin-bottom: 8px;
    }

    .process-section p {
      color: #555;
      margin-bottom: 40px;
    }

    .process-step {
      text-align: center;
      padding: 20px;
    }

    .process-icon {
      width: 70px;
      height: 70px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 20px;
      font-size: 28px;
      color: #fff;
    }

    .step-title {
      font-weight: 600;
      margin-bottom: 8px;
    }

    .step-text {
      font-size: 0.95rem;
      color: #444;
    }

    .step-1 .process-icon {
      background: #2563eb;
    }

    .step-2 .process-icon {
      background: #16a34a;
    }

    .step-3 .process-icon {
      background: #f59e0b;
    }

    /* Features Section */
    .features-section {
      background: linear-gradient(to bottom, #eaf3ff, #f9fbff);
    }

    .feature-card {
      transition: all 0.3s ease;
      border-radius: 12px;
    }

    .feature-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 12px 24px rgba(0, 0, 0, 0.12) !important;
    }

    .icon-circle {
      width: 70px;
      height: 70px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .bg-purple-light {
      background-color: #f3e8ff;
    }

    .bg-success-light {
      background-color: #dcfce7;
    }

    .bg-warning-light {
      background-color: #fef3c7;
    }

    @media(max-width:768px) {
      .hero h1 {
        font-size: 2rem;
      }
    }
  </style>
</head>

<body>
  <!-- Hero Section -->
  <section class="hero-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <div class="hero-content text-center">
            <h1 class="hero-title mb-4">
              Your Journey, <span class="text-primary">Simplified</span>
            </h1>
            <p class="hero-subtitle mb-5">
              Book bus passes online instantly. Travel daily, weekly, or monthly with ease.<br class="d-none d-md-block">
              Say goodbye to ticket counters and hello to seamless commuting.
            </p>

            <!-- ✅ Button Logic -->
          <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center mb-5">
    @if(Session::has('username'))
        <a href="{{ url('/dashbord') }}" class="btn btn-primary btn-lg btn-hero px-5">
            My Dashboard
            <i class="fas fa-tachometer-alt ms-2"></i>
        </a>
    @else
        <a href="{{ url('/login') }}" class="btn btn-primary btn-lg btn-hero px-5">
            Get Started
            <i class="fas fa-arrow-right ms-2"></i>
        </a>
    @endif
</div>  

          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Process Section -->
  <section class="process-section">
    <div class="container">
      <h2>Simple 3-Step Booking Process</h2>
      <p>Get your monthly pass in just a few clicks</p>
      <div class="row justify-content-center">
        <div class="col-md-4 col-sm-6 step-1">
          <div class="process-step">
            <div class="process-icon"><i class="fas fa-search"></i></div>
            <div class="step-title">1. Select Pass</div>
            <div class="step-text">Search and choose the perfect pass</div>
          </div>
        </div>
        <div class="col-md-4 col-sm-6 step-2">
          <div class="process-step">
            <div class="process-icon"><i class="fas fa-user"></i></div>
            <div class="step-title">2. Fill Details</div>
            <div class="step-text">Enter your info and contact details</div>
          </div>
        </div>
        <div class="col-md-4 col-sm-6 step-3">
          <div class="process-step">
            <div class="process-icon"><i class="fas fa-credit-card"></i></div>
            <div class="step-title">3. Payment</div>
            <div class="step-text">Complete payment and get your pass</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Features Section -->
  <section class="features-section bg-white py-5">
    <div class="container">
      <div class="text-center mb-5">
        <h2 class="font-weight-bold mb-3">Why Choose BusPass?</h2>
        <p class="text-muted">Experience hassle-free travel with our modern bus pass booking platform</p>
      </div>

      <div class="row g-4">
        <!-- Feature 1 -->
        <div class="col-lg-3 col-md-6">
          <div class="card h-100 border-0 shadow-sm feature-card">
            <div class="card-body text-center p-4">
              <div class="icon-circle bg-primary bg-opacity-10 mx-auto mb-3">
                <i class="fas fa-ticket-alt fa-2x text-primary"></i>
              </div>
              <h5 class="card-title font-weight-bold mb-2">Instant Booking</h5>
              <p class="card-text text-muted small">Book your pass in seconds and start traveling immediately</p>
            </div>
          </div>
        </div>

        <!-- Feature 2 -->
        <div class="col-lg-3 col-md-6">
          <div class="card h-100 border-0 shadow-sm feature-card">
            <div class="card-body text-center p-4">
              <div class="icon-circle bg-purple-light mx-auto mb-3">
                <i class="fas fa-calendar-check fa-2x text-purple"></i>
              </div>
              <h5 class="card-title font-weight-bold mb-2">Flexible Plans</h5>
              <p class="card-text text-muted small">Choose from daily, weekly, or monthly passes that suit you</p>
            </div>
          </div>
        </div>

        <!-- Feature 3 -->
        <div class="col-lg-3 col-md-6">
          <div class="card h-100 border-0 shadow-sm feature-card">
            <div class="card-body text-center p-4">
              <div class="icon-circle bg-success-light mx-auto mb-3">
                <i class="fas fa-lock fa-2x text-success"></i>
              </div>
              <h5 class="card-title font-weight-bold mb-2">Secure Payments</h5>
              <p class="card-text text-muted small">Safe and encrypted payment processing for your peace of mind</p>
            </div>
          </div>
        </div>

        <!-- Feature 4 -->
        <div class="col-lg-3 col-md-6">
          <div class="card h-100 border-0 shadow-sm feature-card">
            <div class="card-body text-center p-4">
              <div class="icon-circle bg-warning-light mx-auto mb-3">
                <i class="fas fa-route fa-2x text-warning"></i>
              </div>
              <h5 class="card-title font-weight-bold mb-2">Multiple Routes</h5>
              <p class="card-text text-muted small">Access to hundreds of routes across major cities</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>
