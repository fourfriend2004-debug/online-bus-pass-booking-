<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Bus Pass Payment</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
body{background:#f8fafc;font-family:Segoe UI}
.payment-section{background:#fff;padding:30px;max-width:700px;margin:auto;border-radius:15px}
.method{border:2px solid #ddd;padding:15px;border-radius:10px;margin-bottom:10px;cursor:pointer}
.method.active{border-color:#2563eb;background:#eef2ff}
.details{display:none;margin-top:15px}
.details.active{display:block}
.details input{width:100%;padding:10px;margin-bottom:10px}
button{background:#2563eb;color:#fff;padding:10px 30px;border:none;border-radius:8px}
</style>
</head>

<body>

<h2 style="text-align:center">💳 Student Bus Pass Payment</h2>

<form id="paymentForm" method="POST" action="/save-payment">
@csrf

<div class="payment-section">

<!-- PAYMENT METHOD -->
<div class="method" onclick="selectMethod('card')">
<input type="radio" name="method" value="card"> Debit / Credit Card
</div>

<div class="method" onclick="selectMethod('upi')">
<input type="radio" name="method" value="upi"> UPI / Google Pay
</div>

<!-- CARD DETAILS -->
<div id="card-details" class="details">
<input name="card_number" id="card-num" placeholder="Card Number">
<input name="card_holder" id="card-name" placeholder="Card Holder Name">
<input name="expiry" id="card-exp" placeholder="MM/YY">
<button type="button" onclick="sendOtp()">Send OTP</button>
</div>

<!-- UPI DETAILS -->
<div id="upi-details" class="details">
<input name="upi_id" id="upi-id" placeholder="example@upi">
<button type="button" onclick="sendOtp()">Send OTP</button>
</div>

<!-- OTP -->
<div id="otp-box" class="details">
<input id="otp-input" placeholder="Enter OTP">
<button type="button" onclick="verifyOtp()">Verify & Pay</button>
</div>

</div>
</form>

<script>
let otp = "";
let selectedMethod = "";

function selectMethod(method){
    selectedMethod = method;
    document.querySelectorAll('.details').forEach(d=>d.style.display='none');
    document.getElementById(method+'-details').style.display='block';
}

function sendOtp(){
    if(!selectedMethod){
        alert("Select payment method first");
        return;
    }
    otp = Math.floor(100000 + Math.random()*900000);
    alert("OTP sent: " + otp);
    document.getElementById('otp-box').style.display='block';
}

function verifyOtp(){
    let entered = document.getElementById('otp-input').value;
    if(entered != otp){
        alert("Invalid OTP");
        return;
    }
    document.getElementById('paymentForm').submit(); // ✅ REAL SUBMIT
}
</script>

</body>
</html>
