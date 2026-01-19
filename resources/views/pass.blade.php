<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Bus Pass</title>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<style>
/* 🔒 AAPKA PURE CSS SAME HAI — NO CHANGE */
:root {
  --primary-blue:#0d47a1;
  --light-blue:#e3f2fd;
  --accent-gold:#ffca28;
}
body{font-family:'Segoe UI',Tahoma,sans-serif;background:#f4f7f6;display:flex;flex-direction:column;align-items:center;padding:40px;}
.card{width:3.4in;height:2.1in;border-radius:12px;background:#fff;margin-bottom:30px;overflow:hidden;position:relative;box-shadow:0 10px 25px rgba(0,0,0,0.1);border:1px solid #c0c0c0;}
.card-header{background:var(--primary-blue);height:38px;color:white;display:flex;align-items:center;padding:0 15px;font-size:10px;font-weight:bold;justify-content:space-between;border-bottom:3px solid var(--accent-gold);}
.photo{position:absolute;top:48px;right:15px;width:62px;height:78px;border:1.5px solid var(--primary-blue);}
.photo img{width:100%;height:100%;object-fit:cover;}
.info-container{padding:10px 15px;width:65%;}
.label{font-size:7px;color:#777;text-transform:uppercase;font-weight:bold;}
.value{font-size:9px;font-weight:700;}
.route-box{background:var(--light-blue);padding:3px 6px;border-radius:4px;font-size:8.5px;color:var(--primary-blue);font-weight:bold;}
.back-content{padding:12px 15px;height:calc(100% - 38px);}
.grid-row{display:flex;justify-content:space-between;margin-bottom:6px;}
.qr-code{position:absolute;bottom:12px;right:12px;width:50px;height:50px;}
.btn-download{background:#0d47a1;color:white;border:none;padding:12px 35px;border-radius:50px;font-weight:bold;cursor:pointer;}
</style>
</head>

<body>

<div id="bus-pass">

<!-- ================= FRONT CARD ================= -->
<div class="card">
  <div class="card-header">
    <span>BUS PASS</span>

    <!-- ✅ I-CARD NUMBER TOP -->
    <span style="font-size:9px;background:rgba(255,255,255,.2);padding:2px 6px;border-radius:10px;">
      {{ $data->icard_no }}
    </span>
  </div>

  <div class="photo">
    <img src="{{ asset('uploads/docs/'.$data->photo) }}">
  </div>

  <div class="info-container">
    <div>
      <span class="label">Name</span>
      <span class="value" style="font-size:11px;color:var(--primary-blue);">
        {{ $data->pass_type == 'student' ? $data->student_name : $data->full_name }}
      </span>
    </div>

    <div>
      <span class="label">Institute / Occupation</span>
      <span class="value">
        {{ $data->pass_type == 'student' ? $data->school_name : $data->occupation }}
      </span>
    </div>

    <div>
      <span class="label">Route</span>
      <div class="route-box">
        {{ $data->from_location }} ➜ {{ $data->to_location }}
      </div>
    </div>

    <div style="display:flex;gap:20px;">
      <div>
        <span class="label">Gender</span>
        <span class="value">{{ ucfirst($data->gender) }}</span>
      </div>
      <div>
        <span class="label">Mobile</span>
        <span class="value">{{ $data->mobile }}</span>
      </div>
    </div>
  </div>
</div>

<!-- ================= BACK CARD ================= -->
<div class="card">
  <div class="card-header">
    <span>VALIDITY DETAILS</span>
    <span>{{ ucfirst($data->pass_duration) }}</span>
  </div>

  <div class="back-content">
    <div class="grid-row">
      <div>
        <span class="label">Issue Date</span>
        <span class="value">{{ $data->created_at->format('d M Y') }}</span>
      </div>
      <div style="text-align:right;padding-right:60px;">
        <span class="label">Valid Till</span>
        <span class="value">{{ $data->expiry_date }}</span>
      </div>
    </div>

    <div class="qr-code">
      <img src="https://api.qrserver.com/v1/create-qr-code/?data={{ $data->icard_no }}&size=100x100" width="100%">
    </div>
  </div>
</div>

</div>

<button class="btn-download" onclick="downloadPDF()">Download PDF Pass</button>

<script>
function downloadPDF(){
  html2pdf().from(document.getElementById("bus-pass")).save("{{ $data->icard_no }}.pdf");
}
</script>

</body>
</html>
