
@extends('layouts.master')
@section('title', 'Login - BusPass')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us - BusPass</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    /* Global Styles */
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to bottom, #eaf3ff, #f9fbff);
      margin: 0;
      padding: 0;
      scroll-behavior: smooth;
    }
    h1, h2, h3, h4, h5, h6 {
      margin: 0;
    }
    a {
      text-decoration: none;
    }
    /* Hero Section */
    .hero-section {
      padding: 120px 20px 80px;
      text-align: center;
    }
    .hero-title {
      font-size: 3rem;
      font-weight: 800;
      color: #1e3a8a;
      margin-bottom: 20px;
      animation: fadeInUp 0.8s ease-out;
    }
    .hero-subtitle {
      font-size: 1.1rem;
      color: #4b5563;
      max-width: 800px;
      margin: 0 auto 40px;
      line-height: 1.6;
      animation: fadeInUp 1s ease-out;
    }
    /* Animations */
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* About Section */
    .about-section {
      padding: 60px 20px;
      max-width: 1200px;
      margin: 0 auto;
      text-align: center;
    }
    .about-section h2 {
      font-size: 2.5rem;
      color: #1e3a8a;
      margin-bottom: 20px;
      animation: fadeInUp 0.8s ease-out;
    }
    .about-section p {
      font-size: 1rem;
      line-height: 1.8;
      color: #4b5563;
      max-width: 800px;
      margin: 0 auto 50px;
      animation: fadeInUp 1s ease-out;
    }

    /* Cards */
    .about-cards {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
    }
    .about-card {
      background: #fff;
      border-radius: 16px;
      padding: 30px 20px;
      flex: 1 1 250px;
      max-width: 300px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.08);
      transition: all 0.3s ease;
    }
    .about-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 12px 25px rgba(0,0,0,0.15);
    }
    .about-card .icon-circle {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 15px;
      font-size: 32px;
      color: #fff;
    }
    .about-card .card-title {
      font-size: 1.25rem;
      color: #1e3a8a;
      font-weight: 700;
      margin-bottom: 10px;
    }
    .about-card .card-text {
      font-size: 0.95rem;
      color: #4b5563;
      line-height: 1.5;
    }

    /* Card Colors */
    .bg-primary { background-color: #2563eb; }
    .bg-success { background-color: #16a34a; }
    .bg-warning { background-color: #f59e0b; }
    .bg-purple { background-color: #9333ea; }

    /* Responsive */
    @media(max-width:768px){
      .hero-title { font-size: 2rem; }
      .about-card { max-width: 90%; }
      .about-section p { font-size: 0.95rem; }
    }
  </style>
</head>
<body>

  <!-- Hero Section -->
  <section class="hero-section">
    <h1 class="hero-title">About BusPass</h1>
    <p class="hero-subtitle">We are committed to making daily commuting simple, fast, and convenient. Learn more about our mission, vision, and values.</p>
  </section>

  <!-- About Cards Section -->
  <section class="about-section">
    <div class="about-cards">
      <div class="about-card">
        <div class="icon-circle bg-primary"><i class="fas fa-bullseye"></i></div>
        <h3 class="card-title">Our Mission</h3>
        <p class="card-text">To provide seamless bus pass booking solutions that save time and enhance commuting experience across cities.</p>
      </div>
      <div class="about-card">
        <div class="icon-circle bg-success"><i class="fas fa-eye"></i></div>
        <h3 class="card-title">Our Vision</h3>
        <p class="card-text">To be the most trusted and convenient platform for commuters, ensuring accessibility and efficiency for all users.</p>
      </div>
      <div class="about-card">
        <div class="icon-circle bg-warning"><i class="fas fa-heart"></i></div>
        <h3 class="card-title">Our Values</h3>
        <p class="card-text">Integrity, reliability, and customer-first approach drive everything we do to create better urban mobility.</p>
      </div>
      <div class="about-card">
        <div class="icon-circle bg-purple"><i class="fas fa-users"></i></div>
        <h3 class="card-title">Our Team</h3>
        <p class="card-text">A passionate group of designers, developers, and transportation experts committed to building a smarter travel experience.</p>
      </div>
    </div>
  </section>

</body>
</html>
