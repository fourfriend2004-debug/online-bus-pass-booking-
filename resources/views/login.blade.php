@extends('layouts.master')
@section('title', 'Login - BusPass')

@section('content')
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
    .wrap {
      max-width:1200px;
      margin:80px auto;
      padding: 50px;
      padding-top: 20px;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: calc(100vh - 160px);
    }
    .split {
      display:grid;
      grid-template-columns: 1.05fr 1fr;
      gap: 28px;
      align-items:center;
      width: 100%;
    }
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
      background-image: url('https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?auto=format&fit=crop&w=1200&q=80');
      background-size:cover;
      background-position:center;
      filter:brightness(0.55) saturate(0.95);
      z-index:0;
    }
    .visual .overlay {
      position:absolute; inset:0; background: linear-gradient(90deg, rgba(255,255,255,0.06), rgba(255,255,255,0.02)); z-index:1;
    }
    .visual-content { position:relative; z-index:2; color:#fff; max-width:520px; }
    .visual h1 { font-size:2.1rem; margin-bottom:14px; color:#fff; text-shadow: 0 6px 22px rgba(2,6,23,0.25); line-height:1.05; }
    .visual p { color: rgba(255,255,255,0.92); margin-bottom:22px; font-size:1rem; }
    .benefits { display:flex; flex-direction:column; gap:12px; margin-top:6px }
    .benefit { display:flex; gap:12px; align-items:flex-start; background: rgba(255,255,255,0.06); padding:10px 12px; border-radius:10px; max-width:420px; }
    .benefit i { font-size:18px; color: #a7d2ff; margin-top:4px }
    .benefit strong { color:#fff; display:block }
    .visual .badge { display:inline-block;margin-top:18px;padding:8px 12px;border-radius:999px;background:rgba(255,255,255,0.08); color:#fff;font-weight:700;font-size:0.85rem; }
    .card { background: var(--card); border-radius: var(--radius); box-shadow: var(--shadow-lg); padding: 40px; border: 1px solid var(--glass-border); min-height: 520px; display:flex; flex-direction:column; justify-content:center; }
    .card h2 { margin:0 0 10px 0; font-size:1.8rem; color:#0f172a; }
    .card p.lead { margin:0 0 30px 0; color:var(--muted); font-size:0.95rem; }
    form .row { display:grid; gap:16px }
    .field { position:relative; display:flex; flex-direction:column; }
    .field label { font-size:0.85rem; color:#1e293b; margin-bottom:6px; font-weight:600; }
    .input { display:flex; align-items:center; gap:8px; border-radius:9px; border:1px solid #e6eefc; padding:10px; transition: box-shadow .12s, border-color .12s; background:#fff; }
    .input input { border:0; outline:0; font-size:0.95rem; width:100%; background:transparent; }
    .input .icon { color:var(--primary); width:36px;height:36px;border-radius:8px;display:flex;align-items:center;justify-content:center; background:linear-gradient(180deg,#eef4ff,#fff); font-size:14px; }
    .input:focus-within { border-color:var(--primary); box-shadow: 0 6px 18px rgba(37,99,235,0.06); }
    .forgot-link { text-align:right; margin-top:-8px; margin-bottom:8px; }
    .forgot-link a { color:var(--primary); text-decoration:none; font-size:0.85rem; font-weight:600; }
    .forgot-link a:hover { text-decoration:underline; }
    .btn-submit { margin-top:14px; background:var(--primary); color:#fff; border:0; padding:12px; border-radius:10px; font-weight:700; cursor:pointer; transition: background .18s; display:flex; align-items:center; justify-content:center; gap:10px; font-size:1rem; }
    .btn-submit:hover { background:var(--primary-700) }
    .small-link { text-align:center; margin-top:16px; color:var(--muted); font-size:0.95rem }
    .small-link a { color:var(--primary); text-decoration:none; font-weight:600 }
    .small-link a:hover { text-decoration:underline; }
    @media (max-width: 960px){ .split { grid-template-columns: 1fr; } .visual { min-height:280px; padding:28px 20px; order:2; } .card { min-height:auto; padding:30px 20px; order:1; } .wrap { padding: 18px; margin:40px auto; } }
    @media (max-width:460px){ .visual h1 { font-size:1.5rem } .card h2 { font-size:1.5rem } .card { padding:25px 18px } }
  </style>
</head>

<body>
  <main class="wrap" role="main">
    <div class="split" aria-live="polite">

      <section class="visual" aria-hidden="false">
        <div class="bg-photo"></div>
        <div class="overlay"></div>
        <div class="visual-content">
          <h1>Welcome Back! 👋</h1>
          <p>Login to your BusPass account and continue your seamless commuting experience.</p>
          <div class="benefits">
            <div class="benefit">
              <i class="fa-solid fa-ticket"></i>
              <div><strong>Quick Access</strong><div>View and manage your active passes</div></div>
            </div>
            <div class="benefit">
              <i class="fa-solid fa-clock-rotate-left"></i>
              <div><strong>Booking History</strong><div>Track all your past journeys</div></div>
            </div>
            <div class="benefit">
              <i class="fa-solid fa-bell"></i>
              <div><strong>Real-time Alerts</strong><div>Get notified about your routes</div></div>
            </div>
          </div>
          <div class="badge">Secure · Fast · Reliable</div>
        </div>
      </section>

      <aside class="card">
        <div>
          <h2>Login to BusPass</h2>
          <p class="lead">Enter your credentials to access your account</p>

          <form action="{{ url('/login') }}" method="POST">
            @csrf
            <div class="row">
              <div class="field">
                <label for="email">Email address</label>
                <div class="input">
                  <span class="icon"><i class="fa-solid fa-envelope"></i></span>
                  <input id="email" name="email" type="email" placeholder="you@domain.com" required>
                </div>
              </div>

              <div class="field">
                <label for="password">Password</label>
                <div class="input">
                  <span class="icon"><i class="fa-solid fa-lock"></i></span>
                  <input id="password" name="password" type="password" placeholder="Enter your password" required>
                </div>
              </div>

              <button class="btn-submit" type="submit">
                <span>Login</span> <i class="fa-solid fa-arrow-right"></i>
              </button>

              <div class="small-link">
                Don't have an account? <a href="/reg">Sign up</a>
              </div>
            </div>
          </form>
        </div>
      </aside>
    </div>
  </main>
</body>
@endsection
