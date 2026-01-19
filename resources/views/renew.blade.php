@extends('layouts.master')
@section('title', 'Passenger Bus Pass Booking')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --bg-light: #f1f5f9;
            --white: #ffffff;
            --text-dark: #1e293b;
        }

        body {
            background-color: var(--bg-light);
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            color: var(--text-dark);
        }

        /* Hero Section */
        .hero-banner {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            padding: 100px 20px 80px;
            text-align: center;
            color: white;
            clip-path: ellipse(150% 100% at 50% 0%);
        }

        .hero-banner h1 { font-size: 2.5rem; margin-bottom: 10px; }

        /* Stepper Logic */
        .stepper-container {
            max-width: 600px;
            margin: -40px auto 40px;
            display: flex;
            justify-content: space-between;
            position: relative;
            z-index: 10;
        }

        .step-node {
            background: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
            border: 3px solid #e2e8f0;
            transition: 0.3s;
        }

        .step-node.active {
            border-color: var(--primary);
            color: var(--primary);
            transform: scale(1.1);
        }

        /* Form Styling */
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 0 auto 50px;
            margin-top:120px;
        }

        .icard-highlight {
            background: #f8fafc;
            border: 2px dashed #cbd5e1;
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            margin-bottom: 30px;
        }

        .icard-highlight label {
            font-size: 1.1rem;
            color: var(--primary);
            font-weight: 700;
            display: block;
            margin-bottom: 10px;
        }

        .icard-input {
            font-size: 1.5rem !important;
            text-align: center;
            letter-spacing: 2px;
            font-weight: bold;
            max-width: 400px;
            margin: 0 auto;
            border: 2px solid #e2e8f0 !important;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        label { font-weight: 600; margin-bottom: 8px; display: block; font-size: 0.9rem; }

        input, select {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            box-sizing: border-box;
            transition: 0.3s;
        }

        input:focus { border-color: var(--primary); outline: none; box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1); }

        .btn-group { display: flex; gap: 15px; margin-top: 30px; }

        .btn-main {
            padding: 12px 25px;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            font-weight: 600;
            transition: 0.3s;
            flex: 1;
        }

        .btn-primary { background: var(--primary); color: white; }
        .btn-primary:hover { background: var(--primary-hover); transform: translateY(-2px); }

        .btn-back { background: #e2e8f0; color: #475569; }

        .step-content { display: none; animation: fadeIn 0.4s ease; }
        .step-content.active { display: block; }

        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

        @media (max-width: 600px) { .form-grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>

<div class="glass-card">
    <form id="renewalForm" method="POST" action="{{ route('renew.update') }}" enctype="multipart/form-data">
        @csrf

        {{-- STEP 1 --}}
        <div class="step-content active" id="step-1">
            <div class="icard-highlight">
                <label>🪪 ENTER I-CARD NUMBER</label>
                <input type="text" class="icard-input" id="icard_no" name="icard_no" placeholder="IC-2024-XXXX" required>
            </div>
            
            <div class="form-grid">
                <div>
                    <label>Mobile Number</label>
                    <input type="tel" name="mobile" id="mobile" placeholder="10-digit number" readonly>
                </div>
                <div>
                    <label>Email Address</label>
                    <input type="email" name="email" id="email" placeholder="student@example.com" readonly>
                </div>
            </div>
            <div class="btn-group">
                <button type="button" class="btn-main btn-primary next-step" data-next="2" id="verifyBtn">Verify & Continue</button>
            </div>
        </div>

        {{-- STEP 2 --}}
        <div class="step-content" id="step-2">
            <h3 style="margin-top:0">🔄 Renewal Details</h3>
            <div class="form-grid">
                <div>
                    <label>Duration</label>
                    <select name="pass_duration" required>
                        <option value="">Select</option>
                        <option value="Monthly">Monthly</option>
                        <option value="Quarterly">Quarterly</option>
                        <option value="Yearly">Yearly</option>
                    </select>
                </div>
                <div>
                    <label>Academic Year</label>
                    <select name="academic_year" required>
                        <option>2025-2026</option>
                        <option>2026-2027</option>
                    </select>
                </div>
                <div>
                    <label>Upload Bonafide (PDF/JPG)</label>
                    <input type="file" name="bonafide">
                </div>
                <div>
                    <label>Upload Recent Photo</label>
                    <input type="file" name="photo">
                </div>
            </div>
            <div class="btn-group">
                <button type="button" class="btn-main btn-back prev-step" data-prev="1">Back</button>
                <button type="button" class="btn-main btn-primary next-step" data-next="3">Save & Proceed</button>
            </div>
        </div>

        {{-- STEP 3 --}}
        <div class="step-content" id="step-3">
            <h3 style="margin-top:0">💳 Finalize Payment</h3>
            <div class="icard-highlight" style="background: #ecfdf5; border-color: #10b981;">
                <p style="margin:0; font-weight:bold; color: #065f46;">Payable Amount: ₹450.00</p>
            </div>
            
            <label>Select Payment Gateway</label>
            <select name="payment_method" style="margin-bottom: 20px;">
                <option>UPI (PhonePe, GPay, Paytm)</option>
                <option>Debit / Credit Card</option>
                <option>Net Banking</option>
            </select>

            <div style="background: #fff4f4; padding: 15px; border-radius: 10px; color: #991b1b; font-size: 0.85rem;">
                ℹ️ Note: Renewal will be processed within 24 hours after successful payment.
            </div>

            <div class="btn-group">
                <button type="button" class="btn-main btn-back prev-step" data-prev="2">Back</button>
                <button type="submit" class="btn-main btn-primary">Renew Pass Now ✅</button>
            </div>
        </div>
    </form>
</div>

<script>
document.querySelectorAll(".next-step").forEach(btn => {
    btn.addEventListener("click", () => {
        const step = btn.dataset.next;
        changeStep(step);
    });
});

document.querySelectorAll(".prev-step").forEach(btn => {
    btn.addEventListener("click", () => {
        const step = btn.dataset.prev;
        changeStep(step);
    });
});

function changeStep(stepNumber) {
    document.querySelectorAll(".step-content").forEach(s => s.classList.remove("active"));
    document.querySelectorAll(".step-node").forEach(n => n.classList.remove("active"));

    document.getElementById("step-" + stepNumber).classList.add("active");

    for(let i=1; i<=stepNumber; i++){
        document.getElementById("node-" + i).classList.add("active");
    }

    window.scrollTo({ top: 100, behavior: 'smooth' });
}

// -------- AJAX I-CARD FETCH --------
document.getElementById('verifyBtn').addEventListener('click', function(){
    let icard = document.getElementById('icard_no').value.trim();
    if(icard === ''){
        alert('Please enter I-Card number');
        return;
    }

    fetch("{{ route('renew.find') }}", {
        method: 'POST',
        headers:{
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type':'application/json'
        },
        body: JSON.stringify({icard_no: icard})
    })
    .then(res => res.json())
    .then(res => {
        if(!res.status){
            alert(res.message);
            return;
        }

        // Auto-fill data
        document.getElementById('mobile').value = res.data.mobile;
        document.getElementById('email').value = res.data.email;

        // Move to next step
        changeStep(2);
    })
});
</script>

</body>
</html>
@endsection
