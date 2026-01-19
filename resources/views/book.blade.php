@extends('layouts.master')
@section('title', 'Student Bus Pass Booking')

@section('content')
<style>
  body {
    background: #f8fafc;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }

  .hero {
    background: linear-gradient(to right, #2563eb, #1e40af);
    color: white;
    padding: 150px 20px 50px 20px;
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
    background: #2563eb;
    color: white;
    transform: scale(1.1);
  }

  .step-content { display: none; }
  .step-content.active { display: block; }

  .booking-section {
    background: white;
    border-radius: 16px;
    padding: 25px 30px;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
    margin-bottom: 25px;
  }

  .btn-primary { background-color: #2563eb; border: none; }
  .btn-primary:hover { background-color: #1e40af; }

  .fw-bold { font-weight: 600; }
</style>

<div class="hero">
  <h1>🎓 Student Bus Pass Booking</h1>
  <p>Fill all *mandatory fields carefully before submitting.</p>
</div>

<!-- Stepper -->
<div class="stepper">
  <div class="stepper-item active" data-step="1">
    <div class="circle">1</div>
    <p>Personal Info</p>
  </div>
  <div class="stepper-item" data-step="2">
    <div class="circle">2</div>
    <p>Address & Academic</p>
  </div>
  <div class="stepper-item" data-step="3">
    <div class="circle">3</div>
    <p>Pass, Payment & Uploads</p>
  </div>
</div>

<div class="container">
  <form action="studpass" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- STEP 1 -->
    <div class="step-content active" id="step-1">
      <div class="booking-section">
        <h5>🧍 Basic Student Information</h5>
        <div class="row">
          <div class="col-md-6 mb-3"><label>Student Full Name*</label><input name="student_name" class="form-control" required></div>
          <div class="col-md-6 mb-3"><label>Date of Birth*</label><input name="dob" type="date" class="form-control" required></div>
          <div class="col-md-6 mb-3"><label>Bus I-Card Number</label> <input name="icard_no" class="form-control" value="{{ $generateIcard ?? '' }}" readonly required></div>
          <div class="col-md-6 mb-3"><label>pass type</label> <input name="pass_type" class="form-control" value="student" readonly  required></div>

        </div>

        <label>Gender*</label><br>
        <input type="radio" name="gender" value="Male"> Male
        <input type="radio" name="gender" value="Female"> Female
        <input type="radio" name="gender" value="Other"> Other
        <br><br>

        <label>Is Rural?</label><br>
<input type="radio" name="rural" value="Yes" required> Yes
<input type="radio" name="rural" value="No" required> No
<br><br>

        <button class="btn btn-primary next-step" data-next="2">Next →</button>
      </div>
    </div>

    <!-- STEP 2 -->
    <div class="step-content" id="step-2">
      <div class="booking-section">
        <h5>🏠 Address & Academic Details</h5>
        <div class="row">
          <div class="col-md-6 mb-3"><label>District (Permanent)*</label><input name="district_perm" class="form-control"></div>
          <div class="col-md-6 mb-3"><label>Block (Permanent)*</label><input name="block_perm" class="form-control"></div>
          <div class="col-md-6 mb-3"><label>Cluster (Permanent)*</label><input name="cluster_perm" class="form-control"></div>
          <div class="col-md-6 mb-3"><label>Village (Permanent)</label><input name="village_perm" class="form-control"></div>
          <div class="col-md-12 mb-3"><label>Permanent Address*</label><input name="perm_address" class="form-control"></div>
        </div>

        <!-- Checkbox -->
        <div class="form-check mb-3">
          <input type="checkbox" id="sameAddress" class="form-check-input">
          <label for="sameAddress">Same as Permanent</label>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3"><label>District (Current)*</label><input name="district_curr" class="form-control"></div>
          <div class="col-md-6 mb-3"><label>Block (Current)*</label><input name="block_curr" class="form-control"></div>
          <div class="col-md-6 mb-3"><label>Cluster (Current)*</label><input name="cluster_curr" class="form-control"></div>
          <div class="col-md-6 mb-3"><label>Village (Current)</label><input name="village_curr" class="form-control"></div>
          <div class="col-md-12 mb-3"><label>Current Address*</label><input name="curr_address" class="form-control"></div>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3"><label>Section*</label><input name="section" class="form-control"></div>
          <div class="col-md-6 mb-3"><label>Roll Number*</label><input name="roll_no" class="form-control"></div>
          <div class="col-md-6 mb-3"><label>Class*</label><input name="class" class="form-control"></div>
          <div class="col-md-6 mb-3"><label>Class Group*</label><input name="class_group" class="form-control"></div>
          <div class="col-md-12 mb-3"><label>School/College Name*</label><input name="school_name" class="form-control"></div>
          <div class="col-md-12 mb-3"><label>School/College Address*</label><input name="school_address" class="form-control"></div>
        </div>

        <button class="btn btn-secondary prev-step" data-prev="1">← Back</button>
        <button class="btn btn-primary next-step" data-next="3">Next →</button>
      </div>
    </div>

    <!-- STEP 3 -->
    <!-- STEP 3 -->
<div class="step-content" id="step-3">
  <div class="booking-section">
    <h5>🎫 Pass, Payment & File Uploads</h5>
<div class="col-md-6 mb-3">
  <label>Category*</label>
  <select name="category" class="form-control" required>
    <option value="">-- Select Category --</option>
    <option value="General">General</option>
    <option value="OBC">OBC</option>
    <option value="SEBC">SEBC</option>
    <option value="SC">SC</option>
    <option value="ST">ST</option>
  </select>
</div>

    <div class="row">

      <!-- FROM -->
      <div class="col-md-4 mb-3">
        <label class="fw-bold">From Location*</label>
        <select name="from_location" id="from" class="form-control elegant-select">
          <option value="">Select From</option>
          @foreach($routes as $r)
              <option value="{{ $r->from }}">{{ $r->from }}</option>
          @endforeach
        </select>
      </div>

      <!-- TO -->
      <div class="col-md-4 mb-3">
        <label class="fw-bold">To Location*</label>
        <select name="to_location" id="to" class="form-control elegant-select">
          <option value="">Select To</option>
        </select>
      </div>

      <!-- PASS TYPE -->
      <div class="col-md-4 mb-3">
        <label class="fw-bold">Pass Type*</label>
        <select name="pass_type" id="passType" class="form-control elegant-select">
          <option value="">Select Type</option>
          <option value="Local">Local</option>
          <option value="Express">Express</option>
        </select>
      </div>

      <!-- PRICE -->
      <div class="col-md-12 mb-3">
        <label class="fw-bold">Auto Price</label>
        <input type="text" id="price" class="form-control" readonly>
      </div>
    </div>


<script>
  document.querySelector('input[name="rural"][value="No"]').checked = true;

/* ========== GET TO LOCATIONS ========== */
document.getElementById("from").addEventListener("change", function(){
    let from = this.value;

    fetch("/get-to/" + from)
    .then(res => res.json())
    .then(data => {
        let to = document.getElementById("to");
        to.innerHTML = "<option>Select</option>";
        data.forEach(x => {
            to.innerHTML += `<option value="${x.to}">${x.to}</option>`;
        });
    });
});

/* ========== PRICE FETCH FUNCTION ========== */
function updatePrice() {
    let from = document.getElementById("from").value;
    let toVal = document.getElementById("to").value;
    let passType = document.getElementById("passType").value;

    if (!from || !toVal || !passType) return;

    fetch(`/get-price/${from}/${toVal}?type=${passType}`)
    .then(res => res.json())
    .then(data => {
        document.getElementById("price").value = data.price ?? "N/A";
    });
}

document.getElementById("to").addEventListener("change", updatePrice);
document.getElementById("passType").addEventListener("change", updatePrice);
</script>


    <style>
      .elegant-select {
        border-radius: 10px;
        padding: 10px;
        font-weight: 500;
        border: 2px solid #d1d5db;
        transition: 0.2s;
      }
      .elegant-select:focus {
        border-color: #2563eb;
        box-shadow: 0 0 8px rgba(37, 99, 235, 0.3);
      }
    </style>


    <div class="row mt-4">
      <div class="col-md-6 mb-3">
  <label>Academic Year*</label>
  <select name="academic_year" class="form-control" required>
    <option value="">-- Select Academic Year --</option>
    <option value="2023-2024">2023 - 2024</option>
    <option value="2024-2025">2024 - 2025</option>
    <option value="2025-2026">2025 - 2026</option>
    <option value="2026-2027">2026 - 2027</option>
  </select>
</div>


      <div class="col-md-6 mb-3">
        <label>Pass Duration*</label>
        <select name="pass_duration" class="form-control elegant-select">
          <option value="Monthly">Monthly</option>
          <option value="Quarterly">Quarterly</option>
          <option value="Yearly">Yearly</option>
        </select>
      </div>

      <div class="col-md-6 mb-3"><label>Mobile No*</label><input name="mobile" class="form-control"></div>
      <div class="col-md-6 mb-3"><label>Email*</label><input name="email" type="email" class="form-control"></div>
    </div>

    <label>Payment Method</label><br>
    <input type="radio" name="pay" value="UPI"> UPI
    <input type="radio" name="pay" value="Google Pay"> Google Pay
    <br><br>

    <h5 class="mt-4">📎 Upload Required Documents</h5>
    <div class="row">
      <div class="col-md-6 mb-3"><label>Aadhaar Card*</label><input name="aadhaar" type="file" class="form-control"></div>
      <div class="col-md-6 mb-3"><label>School Bonafide*</label><input name="bonafide" type="file" class="form-control"></div>
      <div class="col-md-6 mb-3"><label>Photo*</label><input name="photo" type="file" class="form-control"></div>
      <div class="col-md-6 mb-3"><label>Signature*</label><input name="signature" type="file" class="form-control"></div>
      <div class="col-md-6 mb-3"><label>Ration Card*</label><input name="ration" type="file" class="form-control"></div>
    </div>

    <p class="text-danger mt-3">
      ⚠️ Note: Once submitted, no changes can be made. Please verify all details before submission.
    </p>

    <button class="btn btn-secondary prev-step" data-prev="2">← Back</button>
    <button type="submit" class="btn btn-success">Submit Application ✅</button>
  </div>
</div>

<!-- Stepper + Same Address JS -->
<script>
  document.addEventListener("DOMContentLoaded", () => {
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

    // ✅ Copy Permanent Address to Current Address
    const sameCheckbox = document.getElementById('sameAddress');

    sameCheckbox.addEventListener('change', () => {
      const isChecked = sameCheckbox.checked;
      const fields = ['district', 'block', 'cluster', 'village', 'address'];

      fields.forEach(field => {
        const perm = document.querySelector(`[name="${field}_perm"]`);
        const curr = document.querySelector(`[name="${field}_curr"]`);
        if (isChecked) {
          curr.value = perm.value;
          curr.setAttribute('readonly', true); // prevent editing
        } else {
          curr.value = '';
          curr.removeAttribute('readonly');
        }
      });
    });

    // ✅ Update automatically if Permanent Address changes
    document.querySelectorAll('[name$="_perm"]').forEach(input => {
      input.addEventListener('input', () => {
        if (sameCheckbox.checked) {
          const fieldName = input.name.replace('_perm', '');
          const currField = document.querySelector(`[name="${fieldName}_curr"]`);
          if (currField) currField.value = input.value;
        }
      });
    });
  });
</script>
