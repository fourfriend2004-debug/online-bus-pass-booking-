@extends('layouts.master')
@section('title', 'Passenger Bus Pass Booking')

@section('content')
<style>
  body {
    background: #f8fafc;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }
  .hero {
    background: linear-gradient(to right, #16a34a, #15803d);
    color: white;
    padding: 120px 20px 50px;
    text-align: center;
    border-radius: 0 0 25px 25px;
    margin-bottom: 30px;
  }
  .stepper {
    display: flex;
    justify-content: center;
    gap: 40px;
    flex-wrap: wrap;
    margin-bottom: 40px;
  }
  .stepper-item {
    text-align: center;
    cursor: pointer;
  }
  .circle {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    background: #e2e8f0;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #475569;
    margin: auto;
  }
  .active .circle {
    background: #16a34a;
    color: white;
    transform: scale(1.1);
  }
  .step-content { display: none; }
  .step-content.active { display: block; }

  .booking-section {
    background: white;
    border-radius: 16px;
    padding: 25px 30px;
    box-shadow: 0 4px 16px rgba(0,0,0,0.06);
    margin-bottom: 25px;
  }

  .btn-primary { background: #16a34a; border: none; }
  .btn-primary:hover { background: #15803d; }

  .elegant-select {
    border-radius: 10px;
    padding: 10px;
    border: 2px solid #d1d5db;
    font-weight: 500;
  }
</style>

<div class="hero">
  <h1>🧳 Passenger Bus Pass Booking</h1>
  <p>Fill all mandatory details carefully before submitting.</p>
</div>

<!-- STEPPER -->
<div class="stepper">
  <div class="stepper-item active" data-step="1">
    <div class="circle">1</div>
    <p>Personal Info</p>
  </div>
  <div class="stepper-item" data-step="2">
    <div class="circle">2</div>
    <p>Address</p>
  </div>
  <div class="stepper-item" data-step="3">
    <div class="circle">3</div>
    <p>Pass & Uploads</p>
  </div>
</div>

<div class="container">
<form action="{{ route('passengerpass.store') }}" method="POST" enctype="multipart/form-data">
@csrf

<!-- STEP 1 -->
<div class="step-content active" id="step-1">
  <div class="booking-section">
    <h5>🧍 Passenger Information</h5>
    <div class="row">
      <div class="col-md-6 mb-3">
        <label>Full Name*</label>
        <input name="full_name" class="form-control" required>
      </div>
      <div class="col-md-6 mb-3">
        <label>Date of Birth*</label>
        <input type="date" name="passenger_dob" class="form-control" required>
      </div>
      <div class="col-md-6 mb-3">
        <label>Occupation*</label>
        <input name="occupation" class="form-control" required>
      </div>
      <div class="col-md-6 mb-3">
        <label>Mobile*</label>
        <input name="mobile" class="form-control" required>
      </div>
      <div class="col-md-6 mb-3">
        <label>Email*</label>
        <input type="email" name="email" class="form-control" required>
      </div>
    </div>

    <label>Gender*</label><br>
    <input type="radio" name="gender" value="Male" required> Male
    <input type="radio" name="gender" value="Female"> Female
    <input type="radio" name="gender" value="Other"> Other
    <br><br>

    <button class="btn btn-primary next-step" data-next="2">Next →</button>
  </div>
</div>

<!-- STEP 2 -->
<div class="step-content" id="step-2">
  <div class="booking-section">
    <h5>🏠 Address Details</h5>
    <div class="row">
      <div class="col-md-6 mb-3"><label>District*</label><input name="district" class="form-control" required></div>
      <div class="col-md-6 mb-3"><label>Block*</label><input name="block" class="form-control"></div>
      <div class="col-md-6 mb-3"><label>Village*</label><input name="village" class="form-control"></div>
      <div class="col-md-12 mb-3"><label>Full Address*</label><input name="address" class="form-control" required></div>
      <div class="col-md-6 mb-3"><label>Pincode*</label><input name="pincode" class="form-control"></div>
    </div>

    <button class="btn btn-secondary prev-step" data-prev="1">← Back</button>
    <button class="btn btn-primary next-step" data-next="3">Next →</button>
  </div>
</div>

<!-- STEP 3 -->
<div class="step-content" id="step-3">
  <div class="booking-section">
    <h5>🎫 Pass & Uploads</h5>

    <div class="row">
      <div class="col-md-4 mb-3">
        <label>From*</label>
        <select name="from_location" id="from" class="form-control elegant-select" required>
          <option value="">Select</option>
          @foreach($routes as $r)
            <option value="{{ $r->from }}">{{ $r->from }}</option>
          @endforeach
        </select>
      </div>

      <div class="col-md-4 mb-3">
        <label>To*</label>
        <select name="to_location" id="to" class="form-control elegant-select" required>
          <option value="">Select</option>
        </select>
      </div>

      <div class="col-md-4 mb-3">
        <label>Bus Type*</label>
        <select name="bus_type" id="busType" class="form-control elegant-select" required>
          <option value="">Select</option>
          <option value="Local">Local</option>
          <option value="Express">Express</option>
        </select>
      </div>

      <div class="col-md-12 mb-3">
        <label>Auto Price</label>
        <input type="text" id="price" class="form-control" readonly>
      </div>

      <div class="col-md-6 mb-3">
        <label>Pass Duration*</label>
        <select name="pass_duration" class="form-control elegant-select" required>
          <option value="">Select</option>
          <option value="Monthly">Monthly</option>
          <option value="Quarterly">Quarterly</option>
          <option value="Yearly">Yearly</option>
        </select>
      </div>
    </div>

    <h5 class="mt-4">📎 Upload Documents</h5>
    <div class="row">
      <div class="col-md-6 mb-3"><label>Aadhaar*</label><input type="file" name="aadhaar" class="form-control" required></div>
      <div class="col-md-6 mb-3"><label>Photo*</label><input type="file" name="photo" class="form-control" required></div>
      <div class="col-md-6 mb-3"><label>Signature*</label><input type="file" name="signature" class="form-control" required></div>
    </div>

    <button class="btn btn-secondary prev-step" data-prev="2">← Back</button>
    <button type="submit" class="btn btn-success">Submit Application ✅</button>
  </div>
</div>

</form>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {

  /* ===== STEPPER ===== */
  const steps = document.querySelectorAll(".step-content");
  const stepItems = document.querySelectorAll(".stepper-item");

  function showStep(step) {
    steps.forEach(s => s.classList.remove("active"));
    stepItems.forEach(s => s.classList.remove("active"));
    document.getElementById("step-" + step).classList.add("active");
    document.querySelector(`.stepper-item[data-step="${step}"]`).classList.add("active");
  }

  document.querySelectorAll(".next-step").forEach(btn => {
    btn.addEventListener("click", e => {
      e.preventDefault();
      showStep(btn.dataset.next);
    });
  });

  document.querySelectorAll(".prev-step").forEach(btn => {
    btn.addEventListener("click", e => {
      e.preventDefault();
      showStep(btn.dataset.prev);
    });
  });

  /* ===== FROM → TO ===== */
  document.getElementById("from").addEventListener("change", function () {
    fetch("/get-to/" + this.value)
      .then(res => res.json())
      .then(data => {
        let to = document.getElementById("to");
        to.innerHTML = "<option value=''>Select</option>";
        data.forEach(r => {
          to.innerHTML += `<option value="${r.to}">${r.to}</option>`;
        });
      });
  });

  /* ===== AUTO PRICE ===== */
  const from = document.getElementById("from");
  const to = document.getElementById("to");
  const busType = document.getElementById("busType");
  const price = document.getElementById("price");

  function updatePrice() {
    if (!from.value || !to.value || !busType.value) {
      price.value = "";
      return;
    }

    fetch(`/get-price/${from.value}/${to.value}?type=${busType.value}&passenger=1`)
      .then(res => res.json())
      .then(data => {
        price.value = data.price ?? "N/A";
      })
      .catch(() => {
        price.value = "Error";
      });
  }

  to.addEventListener("change", updatePrice);
  busType.addEventListener("change", updatePrice);

});
</script>

@endsection
