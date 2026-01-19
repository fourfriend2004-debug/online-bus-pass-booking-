@extends('layouts.master')
@section('title', 'Help Center - BusPass')

<head>
  <style>
    :root {
      --primary: #2563eb;
      --primary-dark: #1d4ed8;
      --success: #16a34a;
      --warning: #f59e0b;
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

    .help-container {
      max-width: 1200px;
      margin: 60px auto;
      padding: 20px;
    }

    /* Hero Section */
    .help-hero {
      text-align: center;
      padding: 60px 20px;
      margin-bottom: 40px;
    }

    .help-hero h1 {
      font-size: 2.5rem;
      font-weight: 800;
      color: var(--gray-900);
      margin-bottom: 16px;
    }

    .help-hero p {
      font-size: 1.1rem;
      color: var(--gray-600);
      max-width: 600px;
      margin: 0 auto 30px;
    }

    /* Search Box */
    .search-box {
      max-width: 600px;
      margin: 0 auto;
      position: relative;
    }

    .search-box input {
      width: 100%;
      padding: 16px 24px 16px 56px;
      border: 2px solid var(--gray-200);
      border-radius: 50px;
      font-size: 1rem;
      transition: all 0.3s;
      background: #fff;
    }

    .search-box input:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .search-box i {
      position: absolute;
      left: 24px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--gray-600);
      font-size: 1.25rem;
    }

    /* Quick Links Grid */
    .quick-links-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 24px;
      margin-bottom: 50px;
    }

    .quick-link-card {
      background: #fff;
      border-radius: 16px;
      padding: 32px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.06);
      text-align: center;
      transition: all 0.3s;
      cursor: pointer;
      text-decoration: none;
      color: inherit;
      display: block;
    }

    .quick-link-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 12px 24px rgba(0,0,0,0.12);
    }

    .quick-link-icon {
      width: 72px;
      height: 72px;
      margin: 0 auto 20px;
      border-radius: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 32px;
    }

    .quick-link-icon.blue { background: #dbeafe; color: var(--primary); }
    .quick-link-icon.green { background: #dcfce7; color: var(--success); }
    .quick-link-icon.orange { background: #fed7aa; color: var(--warning); }
    .quick-link-icon.purple { background: #f3e8ff; color: #9333ea; }

    .quick-link-card h3 {
      font-size: 1.25rem;
      font-weight: 700;
      color: var(--gray-900);
      margin-bottom: 8px;
    }

    .quick-link-card p {
      color: var(--gray-600);
      font-size: 0.9rem;
      margin: 0;
    }

    /* FAQ Section */
    .faq-section {
      background: #fff;
      border-radius: 16px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
      padding: 40px;
      margin-bottom: 40px;
    }

    .faq-header {
      text-align: center;
      margin-bottom: 40px;
    }

    .faq-header h2 {
      font-size: 2rem;
      font-weight: 800;
      color: var(--gray-900);
      margin-bottom: 12px;
    }

    .faq-header p {
      color: var(--gray-600);
      font-size: 1rem;
    }

    /* Accordion */
    .faq-category {
      margin-bottom: 30px;
    }

    .category-title {
      font-size: 1.5rem;
      font-weight: 700;
      color: var(--gray-900);
      margin-bottom: 20px;
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .category-title i {
      color: var(--primary);
    }

    .faq-item {
      border: 2px solid var(--gray-100);
      border-radius: 12px;
      margin-bottom: 12px;
      overflow: hidden;
      transition: all 0.3s;
    }

    .faq-item:hover {
      border-color: var(--gray-200);
    }

    .faq-question {
      padding: 20px 24px;
      background: #fff;
      cursor: pointer;
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-weight: 600;
      color: var(--gray-900);
      font-size: 1rem;
      transition: all 0.3s;
    }

    .faq-question:hover {
      background: var(--gray-50);
    }

    .faq-question i {
      color: var(--primary);
      transition: transform 0.3s;
    }

    .faq-item.active .faq-question i {
      transform: rotate(180deg);
    }

    .faq-answer {
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.3s ease;
    }

    .faq-item.active .faq-answer {
      max-height: 500px;
    }

    .faq-answer-content {
      padding: 0 24px 20px;
      color: var(--gray-600);
      line-height: 1.6;
    }

    /* Contact CTA */
    .contact-cta {
      background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
      border-radius: 16px;
      padding: 50px 40px;
      text-align: center;
      color: #fff;
    }

    .contact-cta h2 {
      font-size: 1.75rem;
      margin-bottom: 12px;
    }

    .contact-cta p {
      margin-bottom: 24px;
      opacity: 0.95;
      font-size: 1.05rem;
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
      text-decoration: none;
    }

    .btn-white {
      background: #fff;
      color: var(--primary);
    }

    .btn-white:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 16px rgba(255,255,255,0.3);
    }

    /* Responsive */
    @media (max-width: 968px) {
      .quick-links-grid {
        grid-template-columns: repeat(2, 1fr);
      }

      .faq-section {
        padding: 28px 20px;
      }

      .help-hero h1 {
        font-size: 2rem;
      }
    }

    @media (max-width: 600px) {
      .help-container {
        margin: 30px auto;
      }

      .help-hero {
        padding: 40px 20px;
      }

      .help-hero h1 {
        font-size: 1.75rem;
      }

      .quick-links-grid {
        grid-template-columns: 1fr;
      }

      .category-title {
        font-size: 1.25rem;
      }

      .contact-cta {
        padding: 40px 24px;
      }
    }
  </style>
</head>

<body>
  <div class="help-container">
    <!-- Hero Section -->
    <div class="help-hero">
      <h1>How Can We Help You?</h1>
      <p>Search our knowledge base or browse categories below to find answers to your questions</p>
      
      <div class="search-box">
        <i class="fas fa-search"></i>
        <input type="text" placeholder="Search for help articles...">
      </div>
    </div>

    <!-- Quick Links -->
    <div class="quick-links-grid">
      <a href="#booking" class="quick-link-card">
        <div class="quick-link-icon blue">
          <i class="fas fa-ticket-alt"></i>
        </div>
        <h3>Booking Passes</h3>
        <p>Learn how to book and manage your bus passes</p>
      </a>

      <a href="#payment" class="quick-link-card">
        <div class="quick-link-icon green">
          <i class="fas fa-credit-card"></i>
        </div>
        <h3>Payments & Billing</h3>
        <p>Payment methods, invoices, and refunds</p>
      </a>

      <a href="#account" class="quick-link-card">
        <div class="quick-link-icon orange">
          <i class="fas fa-user-circle"></i>
        </div>
        <h3>Account Settings</h3>
        <p>Manage your profile and preferences</p>
      </a>

      <a href="#technical" class="quick-link-card">
        <div class="quick-link-icon purple">
          <i class="fas fa-wrench"></i>
        </div>
        <h3>Technical Support</h3>
        <p>Troubleshooting and technical issues</p>
      </a>
    </div>

    <!-- FAQ Section -->
    <div class="faq-section">
      <div class="faq-header">
        <h2>Frequently Asked Questions</h2>
        <p>Find quick answers to the most common questions</p>
      </div>

      <!-- Booking & Passes -->
      <div class="faq-category" id="booking">
        <h3 class="category-title">
          <i class="fas fa-ticket-alt"></i>
          Booking & Passes
        </h3>

        <div class="faq-item">
          <div class="faq-question" onclick="toggleFaq(this)">
            How do I book a monthly bus pass?
            <i class="fas fa-chevron-down"></i>
          </div>
          <div class="faq-answer">
            <div class="faq-answer-content">
              To book a monthly bus pass, log in to your account, browse available routes, select your preferred pass type, and complete the payment. Your digital pass will be instantly available in your account.
            </div>
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question" onclick="toggleFaq(this)">
            Can I cancel or modify my bus pass?
            <i class="fas fa-chevron-down"></i>
          </div>
          <div class="faq-answer">
            <div class="faq-answer-content">
              Yes, you can cancel or modify your pass up to 24 hours before the start date. Go to "My Passes" in your account, select the pass, and choose the modify or cancel option. Refunds are processed within 5-7 business days.
            </div>
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question" onclick="toggleFaq(this)">
            What happens if I lose my digital pass?
            <i class="fas fa-chevron-down"></i>
          </div>
          <div class="faq-answer">
            <div class="faq-answer-content">
              Don't worry! Your digital pass is securely stored in your account. Simply log in from any device to access it. You can also download it again from the "My Passes" section.
            </div>
          </div>
        </div>
      </div>

      <!-- Payment & Billing -->
      <div class="faq-category" id="payment">
        <h3 class="category-title">
          <i class="fas fa-credit-card"></i>
          Payments & Billing
        </h3>

        <div class="faq-item">
          <div class="faq-question" onclick="toggleFaq(this)">
            What payment methods do you accept?
            <i class="fas fa-chevron-down"></i>
          </div>
          <div class="faq-answer">
            <div class="faq-answer-content">
              We accept all major credit cards (Visa, MasterCard, American Express), debit cards, PayPal, and digital wallets like Apple Pay and Google Pay. All transactions are encrypted and secure.
            </div>
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question" onclick="toggleFaq(this)">
            How do I get a receipt for my purchase?
            <i class="fas fa-chevron-down"></i>
          </div>
          <div class="faq-answer">
            <div class="faq-answer-content">
              After completing your purchase, you'll receive an email receipt automatically. You can also download receipts from your account under "Billing History" at any time.
            </div>
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question" onclick="toggleFaq(this)">
            Are there any discounts available?
            <i class="fas fa-chevron-down"></i>
          </div>
          <div class="faq-answer">
            <div class="faq-answer-content">
              Yes! We offer student discounts (up to 30% off), senior citizen discounts (25% off), and group booking discounts. Check our "Special Offers" page for current promotions.
            </div>
          </div>
        </div>
      </div>

      <!-- Account Settings -->
      <div class="faq-category" id="account">
        <h3 class="category-title">
          <i class="fas fa-user-circle"></i>
          Account Settings
        </h3>

        <div class="faq-item">
          <div class="faq-question" onclick="toggleFaq(this)">
            How do I reset my password?
            <i class="fas fa-chevron-down"></i>
          </div>
          <div class="faq-answer">
            <div class="faq-answer-content">
              Click on "Forgot Password" on the login page, enter your registered email address, and we'll send you a password reset link. Follow the link to create a new password.
            </div>
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question" onclick="toggleFaq(this)">
            Can I change my email address?
            <i class="fas fa-chevron-down"></i>
          </div>
          <div class="faq-answer">
            <div class="faq-answer-content">
              Yes, go to "Profile Settings" in your account, click on "Edit Profile," update your email address, and verify it through the confirmation email we'll send to your new address.
            </div>
          </div>
        </div>
      </div>

      <!-- Technical Support -->
      <div class="faq-category" id="technical">
        <h3 class="category-title">
          <i class="fas fa-wrench"></i>
          Technical Support
        </h3>

        <div class="faq-item">
          <div class="faq-question" onclick="toggleFaq(this)">
            The app is not working properly. What should I do?
            <i class="fas fa-chevron-down"></i>
          </div>
          <div class="faq-answer">
            <div class="faq-answer-content">
              First, try clearing your browser cache or updating the app to the latest version. If the problem persists, contact our technical support team with details about the issue, and we'll assist you promptly.
            </div>
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question" onclick="toggleFaq(this)">
            Can I use BusPass on multiple devices?
            <i class="fas fa-chevron-down"></i>
          </div>
          <div class="faq-answer">
            <div class="faq-answer-content">
              Absolutely! You can access your BusPass account from any device - smartphone, tablet, or computer. Your passes and account information sync automatically across all devices.
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Contact CTA -->
    <div class="contact-cta">
      <h2>Still Need Help?</h2>
      <p>Can't find what you're looking for? Our support team is ready to assist you</p>
      <a href="/contact" class="btn btn-white">
        <i class="fas fa-headset"></i>
        Contact Support
      </a>
    </div>
  </div>

  <!-- 🔍 Live Search Script -->
  <script>
    function toggleFaq(element) {
      const faqItem = element.closest('.faq-item');
      const allItems = document.querySelectorAll('.faq-item');
      
      allItems.forEach(item => {
        if (item !== faqItem) item.classList.remove('active');
      });
      
      faqItem.classList.toggle('active');
    }

    document.addEventListener("DOMContentLoaded", function () {
      const searchInput = document.querySelector(".search-box input");
      const faqCategories = document.querySelectorAll(".faq-category");
      const quickLinks = document.querySelectorAll(".quick-link-card");

      searchInput.addEventListener("input", function () {
        const query = this.value.toLowerCase().trim();
        let anyVisible = false;

        // Filter Quick Links
        quickLinks.forEach(link => {
          const text = link.innerText.toLowerCase();
          const match = text.includes(query);
          link.style.display = match ? "block" : "none";
          if (match) anyVisible = true;
        });

        // Filter FAQs
        faqCategories.forEach(category => {
          const items = category.querySelectorAll(".faq-item");
          let visibleItems = 0;

          items.forEach(item => {
            const question = item.querySelector(".faq-question").innerText.toLowerCase();
            const answer = item.querySelector(".faq-answer-content").innerText.toLowerCase();
            const match = question.includes(query) || answer.includes(query);
            item.style.display = match ? "block" : "none";
            if (match) visibleItems++;
          });

          category.style.display = visibleItems > 0 ? "block" : "none";
        });
      });
    });
  </script>
</body>
