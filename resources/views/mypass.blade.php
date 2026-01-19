@extends('layouts.master')
@section('title', 'My Bus Passes')

@section('content')

<style>
    .dashboard-bg {
        background: #f0f4f8;
        min-height: 100vh;
        padding: 80px 20px;
        font-family: 'Inter', 'Segoe UI', sans-serif;
    }

    .pass-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 25px;
        max-width: 1200px;
        margin: 0 auto;
    }

    /* Base Card Style */
    .pass-card {
        background: #ffffff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 1px solid #e2e8f0;
        display: flex;
        flex-direction: column;
    }

    .pass-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 35px rgba(30, 64, 175, 0.1);
    }

    /* Header Variations */
    .card-header {
        padding: 20px;
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .header-student { background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%); }
    .header-passenger { background: linear-gradient(135deg, #334155 0%, #64748b 100%); }

    .pass-badge {
        font-size: 10px;
        font-weight: 800;
        padding: 5px 12px;
        border-radius: 50px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-approved { background: #dcfce7; color: #166534; }
    .status-pending { background: #fef3c7; color: #92400e; }

    /* Body Styling */
    .card-body {
        padding: 25px;
        flex-grow: 1;
    }

    .user-profile {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
    }

    .avatar-circle {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background: #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: #1e40af;
        border: 2px solid #e2e8f0;
    }

    .route-visual {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 15px;
        margin: 15px 0;
        position: relative;
    }

    .route-dot {
        height: 8px;
        width: 8px;
        background: #1e40af;
        border-radius: 50%;
        display: inline-block;
    }

    .route-line {
        flex-grow: 1;
        height: 2px;
        background: #cbd5e1;
        margin: 0 10px;
        border-top: 2px dashed #cbd5e1;
    }

    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin-top: 15px;
    }

    .info-label {
        font-size: 11px;
        color: #64748b;
        text-transform: uppercase;
        font-weight: 600;
    }

    .info-value {
        font-size: 13px;
        color: #1e293b;
        font-weight: 700;
    }

    /* Footer Buttons */
    .card-footer {
        padding: 20px;
        background: #fdfdfd;
        border-top: 1px solid #f1f5f9;
    }

    .btn-main {
        display: block;
        width: 100%;
        text-align: center;
        padding: 12px;
        border-radius: 10px;
        font-weight: 700;
        text-decoration: none;
        transition: 0.3s;
    }

    .btn-approved { background: #1e40af; color: white; box-shadow: 0 4px 12px rgba(30, 64, 175, 0.2); }
    .btn-approved:hover { background: #1e3a8a; transform: translateY(-2px); }
    
    .btn-waiting { background: #f1f5f9; color: #94a3b8; border: 1px solid #e2e8f0; cursor: not-allowed; }

    .empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 60px;
        background: white;
        border-radius: 20px;
        border: 2px dashed #cbd5e1;
    }
</style>

<div class="dashboard-bg">
    <header style="text-align:center; margin-bottom:50px;">
        <h1 style="color:#1e3a8a; font-size: 32px; font-weight: 800;">My Digital Passes</h1>
        <p style="color:#64748b;">View and manage your active transit permissions</p>
    </header>

    <div class="pass-grid">
        @forelse($passes as $pass)
            <div class="pass-card">
                <div class="card-header {{ $pass->pass_type == 'student' ? 'header-student' : 'header-passenger' }}">
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <span style="font-size: 18px;">{{ $pass->pass_type == 'student' ? '🎓' : '👤' }}</span>
                        <span style="font-weight: 800; text-transform: uppercase; font-size: 13px;">
                            {{ $pass->pass_type }} Pass
                        </span>
                    </div>
                    <span class="pass-badge {{ $pass->status == 'approved' ? 'status-approved' : 'status-pending' }}">
                        {{ $pass->status == 'approved' ? 'Active' : 'Pending' }}
                    </span>
                </div>

                <div class="card-body">
                    <div class="user-profile">
                        <div class="avatar-circle">
                            {{ substr(session('username'), 0, 1) }}
                        </div>
                        <div>
                            <div class="info-label">Pass Holder</div>
                            <div class="info-value" style="font-size: 16px;">{{ session('username') }}</div>
                        </div>
                    </div>

                    <div class="route-visual">
                        <div style="display: flex; align-items: center; justify-content: space-between;">
                            <span class="info-value">{{ strtoupper($pass->from_location) }}</span>
                            <div class="route-line"></div>
                            <span class="info-value">{{ strtoupper($pass->to_location) }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-top: 5px;">
                            <span class="info-label">Origin</span>
                            <span class="info-label">Destination</span>
                        </div>
                    </div>

                    <div class="info-grid">
                        <div>
                            <div class="info-label">Pass Number</div>
                            <div class="info-value">#BP-{{ str_pad($pass->id, 4, '0', STR_PAD_LEFT) }}</div>
                        </div>
                        <div>
                            <div class="info-label">Valid Until</div>
                            <div class="info-value">{{ $pass->status == 'approved' ? $pass->created_at->addMonths(6)->format('d M Y') : 'TBD' }}</div>
                        </div>
                        @if($pass->pass_type == 'student')
                        <div>
                            <div class="info-label">Category</div>
                            <div class="info-value">{{ strtoupper($pass->category ?? 'OBC') }}</div>
                        </div>
                        <div>
                            <div class="info-label">Roll No</div>
                            <div class="info-value">{{ strtoupper($pass->roll_no ?? 'N/A') }}</div>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="card-footer">
                    @if($pass->status == 'approved')
                        <a href="{{ route('pass.show', $pass->id) }}" class="btn-main btn-approved">
                            View Digital Pass
                        </a>
                    @else
                        <a href="javascript:void(0)" class="btn-main btn-waiting">
                            Verification in Progress
                        </a>
                    @endif
                </div>
            </div>
        @empty
            <div class="empty-state">
                <div style="font-size: 50px; margin-bottom: 15px;">🎫</div>
                <h3 style="color: #1e293b; font-weight: 800;">No Passes Found</h3>
                <p style="color: #64748b; margin-bottom: 25px;">You haven't applied for any bus passes yet.</p>
                <a href="{{ route('apply.pass') }}" style="color: #1e40af; font-weight: 800; text-decoration: none; border: 2px solid #1e40af; padding: 10px 25px; border-radius: 50px;">
                    Apply for New Pass
                </a>
            </div>
        @endforelse
    </div>
</div>

@endsection