@extends('layouts.master')

@section('title', 'Terms & Privacy - BusPass')

@section('content')
<style>
body {
    font-family: 'Segoe UI', sans-serif;
    background: #f0f4ff;
}
.container2p {
    max-width: 900px;
    margin: 100px auto;
    padding: 20px;
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
}
h1 {
    text-align: center;
    color: #1e3a8a;
    margin-bottom: 20px;
}
h2 {
    color: #2563eb;
    margin-top: 20px;
}
p {
    line-height: 1.6;
    color: #4b5563;
    margin-bottom: 15px;
}
</style>

<div class="container2p">
    <h1>Terms & Conditions</h1>
    <p>
        By using BusPass, you agree to follow all rules and regulations.
        All bookings are final and non-refundable.
    </p>

    <h2>Privacy Policy</h2>
    <p>
        We respect your privacy. Your personal data is secure with us and
        will never be shared with third parties without your consent.
    </p>
</div>
