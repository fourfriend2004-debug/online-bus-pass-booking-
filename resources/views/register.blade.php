@extends('layouts.master')
@section('title', 'applay bus pass')
<head>
    
  <style>
    :root{
      --bg-top: #eaf3ff;
      --bg-bottom: #f9fbff;
      --primary: #2563eb;
      --primary-700: #1d4ed8;
      --muted: #6b7280;
      --card: #ffffff;
      --glass-border: rgba(37,99,235,0.08);
      --radius: 12px;
      --shadow-lg: 0 10px 30px rgba(18,25,50,0.08);
      --success: #16a34a;
      --danger: #ef4444;
      --warning: #f59e0b;
    }
    *{box-sizing:border-box}
    html,body{height:100%}
    body{
      font-family: "Inter", system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
      margin:0;
      background: linear-gradient(180deg,var(--bg-top),var(--bg-bottom));
      color: #0f172a;
      -webkit-font-smoothing:antialiased;
      -moz-osx-font-smoothing:grayscale;
    }

    /* Header: minimal (logo left, login button right) */
    header {
      display:flex;
      align-items:center;
      justify-content:space-between;
      padding:18px 36px;
      background: transparent;
      position:sticky;
      top:0;
      z-index:30;
    }
    .brand {
      display:flex;
      align-items:center;
      gap:12px;
      text-decoration:none;
      color:var(--primary);
      font-weight:800;
      font-size:1.25rem;
    }
    .brand .mark{
      width:44px;height:44px;border-radius:10px;display:flex;align-items:center;justify-content:center;
      background:linear-gradient(135deg, rgba(37,99,235,0.12), rgba(37,99,235,0.04));
      border:1px solid var(--glass-border);
      color:var(--primary);
      font-size:18px;
    }
    .header-cta {
      display:flex;
      align-items:center;
      gap:10px;
    }
    .btn-login {
      background:transparent;
      border: 1px solid rgba(15,23,42,0.06);
      color:var(--primary);
      padding:10px 14px;
      border-radius:10px;
      cursor:pointer;
      font-weight:600;
    }
    .btn-login:hover{ background: rgba(37,99,235,0.04) }

    /* Page layout */
    .wrap {
      max-width:1200px;
      margin:80px 48px auto;
   
      padding: 50px ;
      padding-top: 20px ;
    }
    .split {
      display:grid;
      grid-template-columns: 1.05fr 1fr;
      gap: 28px;
      align-items:stretch;
      padding-left: 150px;
    }

    /* Left visual panel */
    .visual {
      position:relative;
      border-radius: var(--radius);
      overflow:hidden;
      background: linear-gradient(135deg, rgba(37,99,235,0.06), rgba(37,99,235,0.02));
      box-shadow: var(--shadow-lg);
      display:flex;
      align-items:center;
      padding: 40px;
      min-height:520px;
    }
    .visual .bg-photo {
      position:absolute;
      inset:0;
      background-image: url('img/bus1.jpg');
      background-size:cover;
      background-position:center;
      filter:brightness(0.55) saturate(0.95);
      z-index:0;
    }
    .visual .overlay {
      position:absolute; inset:0; background: linear-gradient(90deg, rgba(255,255,255,0.06), rgba(255,255,255,0.02)); z-index:1;
    }
    .visual-content {
      position:relative; z-index:2; color:#fff; max-width:520px;
    }
    .visual h1 {
      font-size:2.1rem;
      margin-bottom:14px;
      color:#fff;
      text-shadow: 0 6px 22px rgba(2,6,23,0.25);
      line-height:1.05;
    }
    .visual p {
      color: rgba(255,255,255,0.92);
      margin-bottom:22px;
      font-size:1rem;
    }
    .benefits { display:flex; flex-direction:column; gap:12px; margin-top:6px }
    .benefit {
      display:flex; gap:12px; align-items:flex-start;
      background: rgba(255,255,255,0.06);
      padding:10px 12px;
      border-radius:10px;
      max-width:420px;
    }
    .benefit i { font-size:18px; color: #a7d2ff; margin-top:4px }
    .benefit strong { color:#fff; display:block }
    .visual .badge {
      display:inline-block;margin-top:18px;padding:8px 12px;border-radius:999px;
      background:rgba(255,255,255,0.08); color:#fff;font-weight:700;font-size:0.85rem;
    }

    /* Right form panel */
    .card {
      background: var(--card);
      border-radius: var(--radius);
      box-shadow: var(--shadow-lg);
      padding: 28px;
      border: 1px solid var(--glass-border);
      min-height: 520px;
      display:flex;
      flex-direction:column;
      justify-content:center;
    }
    .card h2 {
      margin:0 0 10px 0;
      font-size:1.4rem;
      color:#0f172a;
    }
    .card p.lead {
      margin:0 0 20px 0;
      color:var(--muted);
      font-size:0.95rem;
    }

    /* Social buttons */
    .social {
      display:flex;
      gap:12px;
      margin-bottom:16px;
    }
    .social .btn {
      flex:1;
      display:inline-flex;
      align-items:center;
      justify-content:center;
      gap:10px;
      padding:10px 12px;
      border-radius:10px;
      border:1px solid var(--glass-border);
      cursor:pointer;
      background:#fff;
      font-weight:600;
    }
   
    .divider {
      display:flex;
      align-items:center;
      gap:12px;
      margin:16px 0;
      color:var(--muted);
      font-size:0.9rem;
    }
    .divider::before, .divider::after {
      content:""; flex:1;height:1px;background:#eef2ff;border-radius:2px;
    }

    form .row { display:grid; gap:12px }
    .field {
      position:relative;
      display:flex;
      flex-direction:column;
    }
    .field label {
      font-size:0.85rem;
      color:#1e293b;
      margin-bottom:6px;
      font-weight:600;
    }
    .input {
      display:flex;
      align-items:center;
      gap:8px;
      border-radius:9px;
      border:1px solid #e6eefc;
      padding:10px;
      transition: box-shadow .12s, border-color .12s;
      background:#fff;
    }
    .input input, .input select {
      border:0;
      outline:0;
      font-size:0.95rem;
      width:100%;
      background:transparent;
      appearance:none;
    }
    .input .icon {
      color:var(--primary);
      width:36px;height:36px;border-radius:8px;display:flex;align-items:center;justify-content:center;
      background:linear-gradient(180deg,#eef4ff,#fff);
      font-size:14px;
    }
    .input:focus-within { border-color:var(--primary); box-shadow: 0 6px 18px rgba(37,99,235,0.06); }

    .two-col { display:grid; grid-template-columns:1fr 1fr; gap:12px; }
    .note { font-size:0.85rem; color:var(--muted); margin-top:6px }

    /* Password strength */
    .pw-meter { height:8px; background:#f1f5f9; border-radius:6px; overflow:hidden; margin-top:8px }
    .pw-meter > span { display:block; height:100%; width:0%; transition:width .3s ease, background .3s ease }

    /* Terms & button */
    .terms { display:flex; gap:10px; align-items:center; margin-top:10px }
    .terms input[type="checkbox"] { width:16px; height:16px; accent-color: var(--primary) }
    .btn-submit {
      margin-top:14px;
      background:var(--primary);
      color:#fff;
      border:0;
      padding:12px;
      border-radius:10px;
      font-weight:700;
      cursor:pointer;
      transition: background .18s;
      display:flex;
      align-items:center;
      justify-content:center;
      gap:10px;
    }
    .btn-submit[disabled]{ opacity:0.6; cursor:not-allowed }
    .btn-submit:hover { background:var(--primary-700) }

    .small-link { text-align:center; margin-top:12px; color:var(--muted) }
    .small-link a { color:var(--primary); text-decoration:none; font-weight:600 }

    /* Errors */
    .error { color:var(--danger); font-size:0.85rem; margin-top:6px }

    /* Success toast */
    .toast {
      position:fixed; right:20px; bottom:20px; background:var(--primary);
      color:#fff; padding:14px 18px; border-radius:10px; box-shadow:0 12px 40px rgba(2,6,23,0.18); display:none; z-index:80;
    }

    /* Responsive */
    @media (max-width: 960px){
      .split { grid-template-columns: 1fr; }
      .visual { min-height:280px; padding:28px 20px }
      .card { min-height:auto; padding:20px; margin-top:18px }
      .wrap { padding: 18px }
    }
    @media (max-width:460px){
      header { padding:12px 16px }
      .brand { font-size:1.05rem }
      .visual h1 { font-size:1.5rem }
      .social .btn { font-size:0.9rem; padding:10px }
    }

  </style>
</head>
<body>


  <main class="wrap" role="main">
    <div class="split" aria-live="polite">
      <!-- Visual / Benefits -->
      <section class="visual" aria-hidden="false">
        <div class="bg-photo" aria-hidden="true"></div>
        <div class="overlay" aria-hidden="true"></div>

        <div class="visual-content">
          <h1>Fast. Affordable. Reliable.</h1>
          <p>Get instant digital monthly passes for your commute. Save money, skip queues, and travel with comfort.</p>

          <div class="benefits" aria-hidden="true">
            <div class="benefit">
              <i class="fa-solid fa-clock"></i>
              <div>
                <strong>Unlimited rides</strong>
                <div style="color:rgba(255,255,255,0.9)">Valid for 30 days on selected route</div>
              </div>
            </div>

            <div class="benefit">
              <i class="fa-solid fa-sack-dollar"></i>
              <div>
                <strong>Save with passes</strong>
                <div style="color:rgba(255,255,255,0.9)">Up to 40% off daily tickets</div>
              </div>
            </div>

            <div class="benefit">
              <i class="fa-solid fa-wifi"></i>
              <div>
                <strong>Connected in-ride</strong>
                <div style="color:rgba(255,255,255,0.9)">Wi-Fi and real-time tracking</div>
              </div>
            </div>
          </div>

          <div class="badge">Trusted by commuters · Secure payments</div>
        </div>
      </section>

      <!-- Registration form -->
      <aside class="card" aria-labelledby="registerHeading">
        <div>
          <h2 id="registerHeading">Create your BusPass account</h2>
          <p class="lead">Sign up quickly to start booking monthly passes and enjoy discounted commuting.</p>

          <form action="form" method="POST" id="registerForm" novalidate>
             @csrf
            <div class="row">
              <div class="field">
                <label for="fullname">Full name</label>
                <div class="input">
                  <span class="icon"><i class="fa-solid fa-user"></i></span>
                  <input id="fullname" name="name" type="text" placeholder="Your full name" aria-describedby="fullnameError" required>
                </div>
                <div id="fullnameError" class="error" aria-live="polite" style="display:none"></div>
              </div>

              <div class="field">
                <label for="email">Email address</label>
                <div class="input">
                  <span class="icon"><i class="fa-solid fa-envelope"></i></span>
                  <input id="email" name="email" type="email" placeholder="you@domain.com" aria-describedby="emailError" required>
                </div>
                <div id="emailError" class="error" aria-live="polite" style="display:none"></div>
              </div>

              <!-- <div class="two-col">
                <div class="field">
                  <label for="country">Country</label>
                  <div class="input">
                    <span class="icon"><i class="fa-solid fa-globe"></i></span>
                    <select id="country" name="country" aria-label="Country code">
                      <option value="+1">🇺🇸 +1</option>
                      <option value="+44">🇬🇧 +44</option>
                      <option value="+91" selected>🇮🇳 +91</option>
                      <option value="+61">🇦🇺 +61</option>
                      <option value="+49">🇩🇪 +49</option>
                    </select>
                  </div>
                </div> -->

                <div class="field">
                  <label for="phone">Phone number</label>
                  <div class="input">
                    <span class="icon"><i class="fa-solid fa-phone"></i></span>
                    <input id="phone" name="no" type="tel" placeholder="9876543210" aria-describedby="phoneError" required>
                  </div>
                  <div id="phoneError" class="error" aria-live="polite" style="display:none"></div>
                </div>
              </div>

              <div class="field">
                <label for="password">Password</label>
                <div class="input" style="align-items:center;">
                  <span class="icon"><i class="fa-solid fa-lock"></i></span>
                  <input id="password" name="pass" type="password" placeholder="Create a strong password" aria-describedby="pwError" required>
                  <button type="button" id="togglePw" title="Show password" style="border:0;background:transparent;color:var(--muted);font-size:14px;cursor:pointer;"> <i class="fa-regular fa-eye"></i></button>
                </div>
                <div class="pw-meter" aria-hidden="true"><span id="pwBar"></span></div>
                <div id="pwHint" class="note">Use at least 8 characters, including letters & numbers.</div>
                <div id="pwError" class="error" aria-live="polite" style="display:none"></div>
              </div>

              <!-- <div class="field">
                <label for="confirm">Confirm password</label>
                <div class="input">
                  <span class="icon"><i class="fa-solid fa-lock"></i></span>
                  <input id="confirm" name="confirm" type="password" placeholder="Re-enter password" aria-describedby="confirmError" required>
                </div>
                <div id="confirmError" class="error" aria-live="polite" style="display:none"></div>
              </div>

              <div class="terms">
                <input id="agree" type="checkbox" />
                <label for="agree" style="font-size:0.95rem;color:var(--muted)">I agree to the <a href="#" style="color:var(--primary);text-decoration:none;font-weight:700">Terms & Conditions</a></label>
              </div> -->

              <button class="btn-submit" id="submitBtn" type="submit" >
                <span id="btnText">Create account</span>
                <span id="btnSpinner" style="display:none"><i class="fa-solid fa-circle-notch fa-spin"></i></span>
              </button>

              <div class="small-link">
                Already have an account? <a href="login" id="goToLogin">Login</a>
              </div>
            </div>
          </form>
        </div>
      </aside>
    </div>
  </main>


</body>