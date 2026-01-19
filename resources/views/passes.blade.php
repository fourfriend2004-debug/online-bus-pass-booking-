@extends('layouts.master')
@section('title', 'Pass Details')
@section('content')
<div class="container" style="padding:20px;">
    <h2>Pass Details (ID: {{ $pass->id }})</h2>

    <table class="table table-bordered">
        <tr><th>Type</th><td>{{ $pass->pass_type }}</td></tr>
        <tr><th>Student Name</th><td>{{ $pass->student_name ?? $pass->full_name }}</td></tr>
        <tr><th>DOB</th><td>{{ $pass->dob ?? $pass->passenger_dob }}</td></tr>
        <tr><th>Gender</th><td>{{ $pass->gender ?? '-' }}</td></tr>
        <tr><th>Mobile</th><td>{{ $pass->mobile }}</td></tr>
        <tr><th>Email</th><td>{{ $pass->email }}</td></tr>
        <tr><th>From → To</th><td>{{ $pass->from_location }} → {{ $pass->to_location }}</td></tr>
        <tr><th>Bus Type</th><td>{{ $pass->bus_type }}</td></tr>
        <tr><th>Price</th><td>{{ $pass->price }}</td></tr>
        <tr><th>Payment Method</th><td>{{ $pass->payment_method }}</td></tr>
        <tr><th>Documents</th>
            <td>
                @if($pass->aadhaar)<a href="{{ asset('uploads/'.$pass->aadhaar) }}" target="_blank">Aadhaar</a>@endif |
                @if($pass->bonafide)<a href="{{ asset('uploads/'.$pass->bonafide) }}" target="_blank">Bonafide</a>@endif |
                @if($pass->photo)<a href="{{ asset('uploads/'.$pass->photo) }}" target="_blank">Photo</a>@endif |
                @if($pass->signature)<a href="{{ asset('uploads/'.$pass->signature) }}" target="_blank">Signature</a>@endif |
                @if($pass->ration)<a href="{{ asset('uploads/'.$pass->ration) }}" target="_blank">Ration</a>@endif
            </td>
        </tr>
        <tr>
            <th>Status</th>
            <td>
                @if($pass->status != 'approved')
                <a href="{{ route('admin.pass.approve', $pass->id) }}" class="btn btn-success btn-sm">Approve</a>
                @endif
                @if($pass->status != 'rejected')
                <a href="{{ route('admin.pass.reject', $pass->id) }}" class="btn btn-danger btn-sm">Reject</a>
                @endif
            </td>
        </tr>
    </table>
</div>
@endsection
