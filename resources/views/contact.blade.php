@extends('layouts.master')
@section('title', 'Contact Us - BusPass')

@if(session('success'))
<div style="background:#d1fae5; color:#065f46; padding:12px; border-radius:6px; margin-bottom:20px;">
  {{ session('success') }}
</div>
@endif

<head>
  <style>
    :root {
      --primary: #2563eb;
      --primary-dark: #1d4ed8;
      --success: #16a34a;
      --gray-50: #f9fafb;
      --gray-100: #f3f4f6;
      --gray-200: #e5e7eb;
      --gray-600: #4b5563;
      --gray-700: #374151;
      --gray-900: #111827;
    }

    * {
      box-sizing: border-box;
    }

    body {
      background: linear-gradient(180deg, #eaf3ff, #f9fbff);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 0;
    }

    .contact-container {
      max-width: 1200px;
      margin: 60px auto;
      padding: 20px;
    }

    /* Hero Section */
    .contact-hero {
      text-align: center;
      padding: 60px 20px;
      margin-bottom: 40px;
    }

    .contact-hero h1 {
      font-size: 2.5rem;
      font-weight: 800;
      color: var(--gray-900);
      margin-bottom: 16px;
    }

    .contact-hero p {
      font-size: 1.1rem;
      color: var(--gray-600);
      max-width: 600px;
      margin: 0 auto;
    }

    /* Contact Grid */
    .contact-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 30px;
      margin-bottom: 40px;
    }

    .card {
      background: #fff;
      border-radius: 16px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
      padding: 40px;
    }

    .card-title {
      font-size: 1.5rem;
      font-weight: 700;
      color: var(--gray-900);
      margin-bottom: 24px;
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .card-title i {
      color: var(--primary);
      font-size: 1.75rem;
    }

    /* Form Styles */
    .form-group {
      margin-bottom: 20px;
    }

    .form-label {
      display: block;
      margin-bottom: 8px;
      font-weight: 600;
      color: var(--gray-700);
      font-size: 0.9rem;
    }

    .form-control {
      width: 100%;
      padding: 12px 16px;
      border: 2px solid var(--gray-200);
      border-radius: 8px;
      font-size: 0.95rem;
      transition: all 0.3s;
      font-family: inherit;
    }

    .form-control:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    textarea.form-control {
      resize: vertical;
      min-height: 120px;
    }

    .btn {
      padding: 12px 32px;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s;
      border: none;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      font-size: 1rem;
    }

    .btn-primary {
      background: var(--primary);
      color: #fff;
      width: 100%;
      justify-content: center;
    }

    .btn-primary:hover {
      background: var(--primary-dark);
      transform: translateY(-2px);
      box-shadow: 0 8px 16px rgba(37, 99, 235, 0.3);
    }

    /* Contact Info */
    .contact-info-list {
      display: flex;
      flex-direction: column;
      gap: 24px;
    }

    .contact-info-item {
      display: flex;
      gap: 16px;
      align-items: flex-start;
    }

    .contact-icon {
      width: 56px;
      height: 56px;
      border-radius: 12px;
      background: #dbeafe;
      color: var(--primary);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 24px;
      flex-shrink: 0;
    }

    .contact-details h3 {
      font-size: 1.1rem;
      font-weight: 700;
      color: var(--gray-900);
      margin: 0 0 6px 0;
    }

    .contact-details p {
      margin: 0;
      color: var(--gray-600);
      font-size: 0.95rem;
      line-height: 1.6;
    }

    .contact-details a {
      color: var(--primary);
      text-decoration: none;
      font-weight: 600;
    }

    .contact-details a:hover {
      text-decoration: underline;
    }

    /* Map Section */
    .map-section {
      background: #fff;
      border-radius: 16px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
      overflow: hidden;
      margin-top: 40px;
    }

    .map-container {
      width: 100%;
      height: 400px;
      background: var(--gray-100);
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--gray-600);
      font-size: 1.1rem;
    }

    /* FAQ Quick Links */
    .faq-quick {
      background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
      border-radius: 16px;
      padding: 40px;
      color: #fff;
      text-align: center;
      margin-top: 40px;
    }

    .faq-quick h2 {
      font-size: 1.75rem;
      margin-bottom: 12px;
    }

    .faq-quick p {
      margin-bottom: 24px;
      opacity: 0.95;
    }

    .btn-outline-white {
      background: transparent;
      border: 2px solid #fff;
      color: #fff;
      padding: 12px 32px;
    }

    .btn-outline-white:hover {
      background: #fff;
      color: var(--primary);
    }

    /* Responsive */
    @media (max-width: 968px) {
      .contact-grid {
        grid-template-columns: 1fr;
      }

      .contact-hero h1 {
        font-size: 2rem;
      }

      .card {
        padding: 28px;
      }
    }

    @media (max-width: 600px) {
      .contact-container {
        margin: 30px auto;
      }

      .contact-hero {
        padding: 40px 20px;
      }

      .contact-hero h1 {
        font-size: 1.75rem;
      }

      .card-title {
        font-size: 1.25rem;
      }
    }
  </style>
</head>

<body>
  <div class="contact-container">
    <!-- Hero Section -->
    <div class="contact-hero">
      <h1>Get In Touch</h1>
      <p>Have questions or need assistance? We're here to help! Reach out to our support team and we'll get back to you as soon as possible.</p>
    </div>

    <!-- Contact Grid -->
    <div class="contact-grid">
      <!-- Contact Form -->
      <div class="card">
        <h2 class="card-title">
          <i class="fas fa-paper-plane"></i>
          Send us a Message
        </h2>

        <form action="/contact/submit" method="POST">
          @csrf
          <div class="form-group">
            <label class="form-label">Full Name</label>
            <input type="text" class="form-control" name="name" placeholder="John Doe" required>
          </div>

          <div class="form-group">
            <label class="form-label">Email Address</label>
            <input type="email" class="form-control" name="email" placeholder="you@example.com" required>
          </div>

          <div class="form-group">
            <label class="form-label">Phone Number</label>
            <input type="tel" class="form-control" name="phone" placeholder="+1 (555) 123-4567">
          </div>

          <div class="form-group">
            <label class="form-label">Subject</label>
            <input type="text" class="form-control" name="subject" placeholder="How can we help you?" required>
          </div>

          <div class="form-group">
            <label class="form-label">Message</label>
            <textarea class="form-control" name="message" placeholder="Tell us more about your inquiry..." required></textarea>
          </div>

          <button type="submit" class="btn btn-primary">
            <i class="fas fa-paper-plane"></i>
            Send Message
          </button>
        </form>
      </div>

      <!-- Contact Information -->
      <div class="card">
        <h2 class="card-title">
          <i class="fas fa-address-card"></i>
          Contact Information
        </h2>

        <div class="contact-info-list">
          <div class="contact-info-item">
            <div class="contact-icon">
              <i class="fas fa-map-marker-alt"></i>
            </div>
            <div class="contact-details">
              <h3>Visit Us</h3>
              <p>Patel Coloney<br>Bedibandar Road<br>Jamnagar</p>
            </div>
          </div>

          <div class="contact-info-item">
            <div class="contact-icon">
              <i class="fas fa-phone"></i>
            </div>
            <div class="contact-details">
              <h3>Call Us</h3>
              <p>
                Toll Free: <a href="tel:+18001234567">+1 (800) 123-4567</a><br>
                Local: <a href="tel:+12125551234">8849000260</a>
              </p>
            </div>
          </div>

          <div class="contact-info-item">
            <div class="contact-icon">
              <i class="fas fa-envelope"></i>
            </div>
            <div class="contact-details">
              <h3>Email Us</h3>
              <p>
                Support: <a href="mailto:support@buspass.com">support@buspass.com</a><br>
                Sales: <a href="mailto:sales@buspass.com">meet@buspass.com</a>
              </p>
            </div>
          </div>

          <div class="contact-info-item">
            <div class="contact-icon">
              <i class="fas fa-clock"></i>
            </div>
            <div class="contact-details">
              <h3>Business Hours</h3>
              <p>
                Monday - Friday: 8:00 AM - 8:00 PM<br>
                Saturday: 9:00 AM - 5:00 PM<br>
                Sunday: Closed
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

   

    <!-- FAQ Quick Link -->
    <div class="faq-quick">
      <h2>Need Quick Answers?</h2>
      <p>Check out our comprehensive FAQ section for instant solutions to common questions</p>
      <a href="/help" class="btn btn-outline-white">
        <i class="fas fa-question-circle"></i>
        Visit Help Center
      </a>
    </div>
  </div>
</body>
