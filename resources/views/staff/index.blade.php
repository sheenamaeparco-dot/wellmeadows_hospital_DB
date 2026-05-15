@extends('layouts.app')

@section('content')

<style>
    .sd-wrap {
        padding: 28px 32px;
        font-family: inherit;
    }

    .sd-hero {
        background: linear-gradient(135deg, #2d6a4f 0%, #1b4332 100%);
        border-radius: 14px;
        padding: 24px 30px;
        margin-bottom: 24px;
        position: relative;
        overflow: hidden;
    }
    .sd-hero::after {
        content: '';
        position: absolute;
        right: -40px; top: -40px;
        width: 200px; height: 200px;
        border-radius: 50%;
        background: rgba(255,255,255,.05);
    }
    .sd-hero h2 {
        font-size: 20px;
        font-weight: 700;
        color: #fff;
        margin-bottom: 4px;
    }
    .sd-hero p {
        font-size: 13px;
        color: rgba(255,255,255,.65);
    }

    .sd-stats {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin-bottom: 24px;
    }

    .sd-stat-card {
        background: #fff;
        border-radius: 12px;
        padding: 20px 22px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border: 1px solid #e5e7eb;
        box-shadow: 0 1px 4px rgba(0,0,0,.05);
        transition: box-shadow .2s, transform .2s;
    }
    .sd-stat-card:hover {
        box-shadow: 0 4px 16px rgba(27,67,50,.12);
        transform: translateY(-2px);
    }
    .sd-stat-label {
        font-size: 11.5px;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: .05em;
        margin-bottom: 6px;
    }
    .sd-stat-val {
        font-size: 32px;
        font-weight: 800;
        color: #111827;
        line-height: 1;
    }
    .sd-stat-icon {
        width: 50px; height: 50px;
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .sd-stat-icon svg { width: 26px; height: 26px; }
    .sd-stat-icon.green  { background: #d1fae5; color: #065f46; }
    .sd-stat-icon.teal   { background: #ccfbf1; color: #0f766e; }
    .sd-stat-icon.sage   { background: #dcfce7; color: #166534; }
    .sd-stat-icon.olive  { background: #ecfdf5; color: #15803d; }

    .sd-bottom {
        display: grid;
        grid-template-columns: 1fr 340px;
        gap: 20px;
    }

    .sd-card {
        background: #fff;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 1px 4px rgba(0,0,0,.04);
        overflow: hidden;
    }
    .sd-card-header {
        padding: 16px 22px;
        font-size: 15px;
        font-weight: 700;
        color: #111827;
        border-bottom: 1px solid #f3f4f6;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .sd-dot {
        width: 8px; height: 8px;
        border-radius: 50%;
        background: #2d6a4f;
        display: inline-block;
    }

    .sd-table {
        width: 100%;
        border-collapse: collapse;
    }
    .sd-table thead th {
        padding: 10px 22px;
        font-size: 10.5px;
        font-weight: 700;
        letter-spacing: .07em;
        text-transform: uppercase;
        color: #9ca3af;
        text-align: left;
        background: #f9fafb;
        border-bottom: 1px solid #f3f4f6;
    }
    .sd-table tbody tr {
        border-bottom: 1px solid #f3f4f6;
        transition: background .12s;
    }
    .sd-table tbody tr:last-child { border-bottom: none; }
    .sd-table tbody tr:hover { background: #f0fdf4; }
    .sd-table tbody td {
        padding: 14px 22px;
        font-size: 13.5px;
        color: #374151;
    }
    .sd-dept { font-weight: 600; color: #111827; }
    .sd-num  { color: #6b7280; }
    .sd-badge {
        display: inline-block;
        padding: 2px 10px;
        border-radius: 99px;
        font-size: 12px;
        font-weight: 600;
        background: #d1fae5;
        color: #065f46;
    }

    .sd-activity { padding: 4px 0; }
    .sd-act-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 13px 20px;
        border-bottom: 1px solid #f3f4f6;
        transition: background .12s;
    }
    .sd-act-item:last-child { border-bottom: none; }
    .sd-act-item:hover { background: #f0fdf4; }
    .sd-act-icon {
        width: 36px; height: 36px;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
        background: #d1fae5;
        color: #065f46;
    }
    .sd-act-icon svg { width: 18px; height: 18px; }
    .sd-act-title {
        font-size: 13px;
        font-weight: 700;
        color: #111827;
    }
    .sd-act-sub {
        font-size: 12px;
        color: #6b7280;
        margin-top: 2px;
    }
    .sd-act-time {
        font-size: 11px;
        color: #9ca3af;
        margin-top: 3px;
    }

    .sd-fade { animation: sdFadeUp .35s ease both; }
    .sd-fade:nth-child(1) { animation-delay: .04s; }
    .sd-fade:nth-child(2) { animation-delay: .08s; }
    .sd-fade:nth-child(3) { animation-delay: .12s; }
    .sd-fade:nth-child(4) { animation-delay: .16s; }
    @keyframes sdFadeUp {
        from { opacity: 0; transform: translateY(10px); }
        to   { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="sd-wrap">

    <div class="sd-hero">
        <h2>Staff &amp; Department Dashboard</h2>
        <p>Overview of staff distribution, department performance, and recent activities</p>
    </div>

    <div class="sd-stats">

        {{-- Total Staff --}}
        <div class="sd-stat-card sd-fade">
            <div>
                <div class="sd-stat-label">Total Staff</div>
                <div class="sd-stat-val">156</div>
            </div>
            <div class="sd-stat-icon green">
                {{-- Users / group icon --}}
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
            </div>
        </div>

        {{-- Doctors --}}
        <div class="sd-stat-card sd-fade">
            <div>
                <div class="sd-stat-label">Doctors</div>
                <div class="sd-stat-val">45</div>
            </div>
            <div class="sd-stat-icon teal">
                {{-- Stethoscope / doctor icon --}}
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4.8 2.3A.3.3 0 1 0 5 2H4a2 2 0 0 0-2 2v5a6 6 0 0 0 6 6 6 6 0 0 0 6-6V4a2 2 0 0 0-2-2h-1a.2.2 0 1 0 .3.3"/>
                    <path d="M8 15v1a6 6 0 0 0 6 6v0a6 6 0 0 0 6-6v-4"/>
                    <circle cx="20" cy="10" r="2"/>
                </svg>
            </div>
        </div>

        {{-- Nurses --}}
        <div class="sd-stat-card sd-fade">
            <div>
                <div class="sd-stat-label">Nurses</div>
                <div class="sd-stat-val">89</div>
            </div>
            <div class="sd-stat-icon sage">
                {{-- Person + cross (nurse) --}}
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="7" r="4"/>
                    <path d="M5.5 21a8.38 8.38 0 0 1 13 0"/>
                    <line x1="12" y1="13" x2="12" y2="17"/>
                    <line x1="10" y1="15" x2="14" y2="15"/>
                </svg>
            </div>
        </div>

        {{-- Admin Staff --}}
        <div class="sd-stat-card sd-fade">
            <div>
                <div class="sd-stat-label">Admin Staff</div>
                <div class="sd-stat-val">22</div>
            </div>
            <div class="sd-stat-icon olive">
                {{-- Clipboard / admin icon --}}
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/>
                    <rect x="8" y="2" width="8" height="4" rx="1" ry="1"/>
                    <line x1="9" y1="12" x2="15" y2="12"/>
                    <line x1="9" y1="16" x2="13" y2="16"/>
                </svg>
            </div>
        </div>

    </div>

    <div class="sd-bottom">

        <div class="sd-card">
            <div class="sd-card-header">
                <span class="sd-dot"></span> Department Overview
            </div>
            <table class="sd-table">
                <thead>
                    <tr>
                        <th>Department</th>
                        <th>Total</th>
                        <th>Doctors</th>
                        <th>Nurses</th>
                        <th>Admin</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="sd-dept">Emergency</td>
                        <td><span class="sd-badge">28</span></td>
                        <td class="sd-num">8</td>
                        <td class="sd-num">18</td>
                        <td class="sd-num">2</td>
                    </tr>
                    <tr>
                        <td class="sd-dept">Cardiology</td>
                        <td><span class="sd-badge">22</span></td>
                        <td class="sd-num">7</td>
                        <td class="sd-num">13</td>
                        <td class="sd-num">2</td>
                    </tr>
                    <tr>
                        <td class="sd-dept">Pediatrics</td>
                        <td><span class="sd-badge">25</span></td>
                        <td class="sd-num">9</td>
                        <td class="sd-num">14</td>
                        <td class="sd-num">2</td>
                    </tr>
                    <tr>
                        <td class="sd-dept">Surgery</td>
                        <td><span class="sd-badge">31</span></td>
                        <td class="sd-num">11</td>
                        <td class="sd-num">17</td>
                        <td class="sd-num">3</td>
                    </tr>
                    <tr>
                        <td class="sd-dept">General Medicine</td>
                        <td><span class="sd-badge">35</span></td>
                        <td class="sd-num">10</td>
                        <td class="sd-num">21</td>
                        <td class="sd-num">4</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="sd-card">
            <div class="sd-card-header">
                <span class="sd-dot"></span> Recent Activity
            </div>
            <div class="sd-activity">

                {{-- New staff registered --}}
                <div class="sd-act-item">
                    <div class="sd-act-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <line x1="19" y1="8" x2="19" y2="14"/>
                            <line x1="16" y1="11" x2="22" y2="11"/>
                        </svg>
                    </div>
                    <div>
                        <div class="sd-act-title">New staff registered</div>
                        <div class="sd-act-sub">Dr. Sarah Johnson &mdash; Doctor</div>
                        <div class="sd-act-time">2 hours ago</div>
                    </div>
                </div>

                {{-- Assignment updated --}}
                <div class="sd-act-item">
                    <div class="sd-act-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="sd-act-title">Assignment updated</div>
                        <div class="sd-act-sub">Nurse Emma Wilson &mdash; Nurse</div>
                        <div class="sd-act-time">3 hours ago</div>
                    </div>
                </div>

                {{-- Schedule modified --}}
                <div class="sd-act-item">
                    <div class="sd-act-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                            <line x1="16" y1="2" x2="16" y2="6"/>
                            <line x1="8" y1="2" x2="8" y2="6"/>
                            <line x1="3" y1="10" x2="21" y2="10"/>
                            <polyline points="9 16 11 18 15 14"/>
                        </svg>
                    </div>
                    <div>
                        <div class="sd-act-title">Schedule modified</div>
                        <div class="sd-act-sub">Dr. Michael Chen &mdash; Doctor</div>
                        <div class="sd-act-time">5 hours ago</div>
                    </div>
                </div>

                {{-- Department transfer --}}
                <div class="sd-act-item">
                    <div class="sd-act-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="17 1 21 5 17 9"/>
                            <path d="M3 11V9a4 4 0 0 1 4-4h14"/>
                            <polyline points="7 23 3 19 7 15"/>
                            <path d="M21 13v2a4 4 0 0 1-4 4H3"/>
                        </svg>
                    </div>
                    <div>
                        <div class="sd-act-title">Department transfer</div>
                        <div class="sd-act-sub">Admin Lisa Brown &mdash; Admin</div>
                        <div class="sd-act-time">1 day ago</div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

@endsection
