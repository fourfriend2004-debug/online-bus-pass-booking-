@extends('layouts.master')
@section('title', 'applay bus pass')

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>User Profile | Bus Pass System</title>

  <style>
    :root {
      --bg-top: #eaf3ff;
      --bg-bottom: #f9fbff;
      --primary: #2563eb;
      --primary-700: #1d4ed8;
      --muted: #6b7280;
      --glass-border: rgba(37,99,235,0.08);
      --radius: 12px;
      --shadow-lg: 0 10px 30px rgba(18,25,50,0.08);
    }

    body {
      font-family: "Segoe UI", sans-serif;
      background: linear-gradient(180deg, var(--bg-top), var(--bg-bottom));
      margin: 0;
      padding: 0;
      color: #0f172a;
    }

    .container {
      max-width: 900px;
      margin: 80px auto;
      background: var(--card);
      border-radius: var(--radius);
      box-shadow: var(--shadow-lg);
      border: 1px solid var(--glass-border);
      padding: 40px;
    }

    h2 {
      text-align: center;
      color: var(--primary);
      font-size: 1.8rem;
      margin-bottom: 30px;
    }

    form {
      display: grid;
      gap: 20px;
    }

    .photo-upload {
      text-align: center;
      margin-bottom: 20px;
    }

    .photo-preview {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      border: 3px solid var(--primary);
      object-fit: cover;
      margin-bottom: 10px;
    }

    .photo-upload label {
      display: inline-block;
      background: var(--primary);
      color: #fff;
      padding: 8px 14px;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
    }

    input[type="file"] {
      display: none;
    }

    .field {
      display: flex;
      flex-direction: column;
    }

    label {
      font-weight: 600;
      margin-bottom: 6px;
      color: #1e293b;
    }

    input, select, textarea {
      border: 1px solid #dbeafe;
      border-radius: 8px;
      padding: 10px;
      font-size: 15px;
      transition: all 0.3s ease;
      background: #fff;
    }

    input:focus, select:focus, textarea:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(37,99,235,0.08);
      outline: none;
    }

    .two-col {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
    }

    button {
      background: var(--primary);
      color: #fff;
      border: none;
      padding: 12px;
      font-size: 16px;
      border-radius: 10px;
      cursor: pointer;
      transition: 0.3s;
    }

    button:hover {
      background: var(--primary-700);
    }

    @media (max-width: 768px) {
      .two-col { grid-template-columns: 1fr; }
      .container { padding: 20px; margin: 40px 10px; }
    }
  </style>
</head>

<body>
  <div class="container">
    <h2>👤 User Profile Details</h2>

    <form action="{{ url('/profile') }}" method="POST" enctype="multipart/form-data">
  @csrf

  <!-- Photo Upload -->
  <div class="photo-upload">
      <img 
  src="{{ $data && $data->photo ? url('uploads/profile/'.$data->photo) : 'https://via.placeholder.com/120' }}" 
  id="photoPreview" 
  class="photo-preview" 
  alt="Profile Photo"
/>

      <br />
      <label for="photo">Upload Photo</label>
      <input type="file" name="photo" id="photo" accept="image/*" onchange="previewImage(event)" />
  </div>

  <div class="two-col">
    <div class="field">
      <label>Full Name</label>
      <input type="text" name="name" value="{{ $data->name }}" />
    </div>
    <div class="field">
      <label>Email</label>
      <input type="email" name="email" value="{{ $data->email }}" />
    </div>
  </div>

  <div class="two-col">
    <div class="field">
      <label>Phone Number</label>
      <input type="tel" name="phone" value="{{ $data->phone }}" />
    </div>
    <div class="field">
      <label>Date of Birth</label>
      <input type="date" name="dob" value="{{ $data->dob }}" />
    </div>
  </div>

  <div class="two-col">
    <div class="field">
      <label>Gender</label>
      <select name="gender">
        <option>Select gender</option>
        <option value="Male" {{ $data->gender == 'Male' ? 'selected' : '' }}>Male</option>
        <option value="Female" {{ $data->gender == 'Female' ? 'selected' : '' }}>Female</option>
        <option value="Other" {{ $data->gender == 'Other' ? 'selected' : '' }}>Other</option>
      </select>
    </div>

    <div class="field">
      <label>City</label>
      <input type="text" name="city" value="{{ $data->city }}" />
    </div>
  </div>

  <div class="two-col">
    <div class="field">
      <label>Address</label>
      <textarea name="address" rows="2">{{ $data->address }}</textarea>
    </div>
    <div class="field">
      <label>Pincode</label>
      <input type="text" name="pincode" value="{{ $data->pincode }}" />
    </div>
  </div>

  <button type="submit">💾 Save Profile</button>
</form>

  </div>

  <script>
    function previewImage(event) {
      const reader = new FileReader();
      reader.onload = function(){
        document.getElementById('photoPreview').src = reader.result;
      }
      reader.readAsDataURL(event.target.files[0]);
    }
  </script>
</body>
</html>
