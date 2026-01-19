
<head>
  <style>
    :root {
      --primary: #2563eb;
      --primary-dark: #1d4ed8;
      --bg: #f3f6fb;
      --card: #ffffff;
      --border: #e5e9f2;
      --radius: 12px;
      --shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
    }

    body {
      font-family: "Inter", system-ui, sans-serif;
      background: var(--bg);
      margin: 0;
      padding: 0;
    }

    .login-container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .login-box {
      background: var(--card);
      box-shadow: var(--shadow);
      border-radius: var(--radius);
      padding: 40px;
      width: 400px;
      border: 1px solid var(--border);
    }

    .login-box h2 {
      text-align: center;
      color: #0f172a;
      margin-bottom: 10px;
    }

    .login-box p {
      text-align: center;
      color: #64748b;
      margin-bottom: 30px;
      font-size: 0.9rem;
    }

    form .field {
      margin-bottom: 18px;
    }

    label {
      display: block;
      font-weight: 600;
      margin-bottom: 6px;
      color: #334155;
    }

    input {
      width: 100%;
      padding: 10px 12px;
      border-radius: 8px;
      border: 1px solid #d0d7e2;
      font-size: 0.95rem;
      outline: none;
      transition: border 0.2s, box-shadow 0.2s;
    }

    input:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    button {
      width: 100%;
      background: var(--primary);
      color: #fff;
      padding: 12px;
      border-radius: 8px;
      border: none;
      font-weight: 600;
      font-size: 1rem;
      cursor: pointer;
      transition: background 0.2s;
    }

    button:hover {
      background: var(--primary-dark);
    }

    .error {
      color: #ef4444;
      text-align: center;
      font-size: 0.9rem;
      margin-bottom: 10px;
    }

    .small-text {
      text-align: center;
      margin-top: 15px;
      font-size: 0.9rem;
      color: #6b7280;
    }

    .small-text a {
      color: var(--primary);
      text-decoration: none;
      font-weight: 600;
    }

    .small-text a:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>
  <div class="login-container">
    <div class="login-box">
      <h2>Admin Login</h2>
      <p>Access the BusPass admin dashboard</p>

      {{-- Show error messages --}}
      @if(session('error'))
        <div class="error">{{ session('error') }}</div>
      @endif

      <form action="{{ url('/admin/login') }}" method="POST">
        @csrf
        <div class="field">
          <label for="email">Admin Email</label>
          <input type="email" id="email" name="email" placeholder="admin@domain.com" required>
        </div>

        <div class="field">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="Enter password" required>
        </div>

        <button type="submit">Login</button>
      </form>

      <div class="small-text">
        <a href="{{ url('/') }}">Back to Website</a>
      </div>
    </div>
  </div>
</body>
