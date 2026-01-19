@extends('layouts.master')

@section('title', 'BusPass Booking')

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bus Pass System</title>
  <style>
    body {
      font-family: "Segoe UI", sans-serif;
      background: linear-gradient(to right, #dbeafe, #fef9c3);
      margin: 0;
      padding: 0;
    }

    .container1 {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 50px 20px;
      gap: 40px;
    }

    h1 {
      color: #1e3a8a;
      text-align: center;
      font-size: 2.5rem;
      margin-bottom: 40px;
      text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
    }

    .cards {
      display: flex;
      flex-wrap: wrap;
      gap: 30px;
      justify-content: center;
    }

    .card {
      background: white;
      width: 250px;
      height: 300px;
      border-radius: 20px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.1);
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      align-items: center;
      cursor: pointer;
      transition: transform 0.3s, box-shadow 0.3s;
      text-align: center;
      padding: 20px;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 35px rgba(0,0,0,0.15);
    }

    .card img {
      width: 120px;
      height: 120px;
      object-fit: cover;
      border-radius: 50%;
      margin-top: 10px;
    }

    .card h2 {
      margin: 10px 0 5px 0;
      font-size: 1.5rem;
      color: #1e3a8a;
    }

    .card p {
      font-size: 1rem;
      color: #475569;
    }

    /* 🔥 Underline Remove 100% */
    a {
      text-decoration: none !important;
      color: inherit !important;
      display: block;
    }

    .cards a {
      text-decoration: none !important;
      color: inherit !important;
    }

    .cards a * {
      text-decoration: none !important;
      color: inherit !important;
    }
  </style>
</head>

<body>
  <div class="container1">
    <h1>🎟️ Select Your Pass</h1>

    <div class="cards">

      <!-- Student Pass Card -->
      <a href="book">
        <div class="card">
          <img src="img/student.jpeg" alt="Student Pass">
          <h2>Student Pass</h2>
          <p>Special rates for students</p>
        </div>
      </a>

      <!-- Passenger Pass Card -->
      <a href="apply">
        <div class="card">
          <img src="img/pasanger.jpeg" alt="Passenger Pass">
          <h2>Passenger Pass</h2>
          <p>Regular passenger pass</p>
        </div>
      </a>

    </div>
  </div>
</body>