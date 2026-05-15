@extends('layouts.app')

@section('content')
<style>
    .dashboard-container {
        font-family: system-ui, -apple-system, sans-serif;
        padding: 30px;
        max-width: 1200px;
        margin: 0 auto;
    }
    .dashboard-banner {
        background: linear-gradient(135deg, #234e36 0%, #1e422e 100%);
        padding: 24px;
        border-radius: 12px;
        margin-bottom: 28px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }
    .dashboard-banner::after {
        content: '';
        position: absolute;
        right: -40px;
        top: -40px;
        width: 180px;
        height: 180px;
        background: rgba(255, 255, 255, 0.04);
        border-radius: 50%;
        pointer-events: none;
    }
    .dashboard-title {
        font-size: 24px;
        font-weight: 700;
        color: #ffffff;
        margin: 0 0 6px 0;
        letter-spacing: 0.5px;
    }
    .dashboard-subtitle {
        font-size: 13px;
        color: #d1eae1;
        margin: 0;
        opacity: 0.9;
    }
    .metrics-grid {
        display: grid;
        grid-template-columns: repeat(1, minmax(0, 1fr));
        gap: 24px;
        margin-bottom: 32px;
    }
    @media (min-width: 768px) {
        .metrics-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }
    }
    .metric-card {
        background-color: #ffffff;
        padding: 24px;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
        gap: 20px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.03);
    }
    .icon-container {
        width: 56px;
        height: 56px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .bg-occupied { background-color: #e6f4ea; color: #234e36; }
    .bg-available { background-color: #fef7e0; color: #b06000; }
    .bg-waiting { background-color: #fce8e6; color: #c5221f; }
    
    .card-content { display: flex; flex-direction: column; }
    .card-label { font-size: 13px; font-weight: 700; color: #5f6368; margin: 0; text-transform: uppercase; }
    .card-value { font-size: 36px; font-weight: 800; color: #202124; margin: 4px 0; line-height: 1.2;}
    .card-subtext { font-size: 13px; color: #70757a; margin: 0; }

    .table-section-card {
        background-color: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.03);
    }
    .table-header-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    .table-section-title {
        font-size: 18px;
        font-weight: 700;
        color: #1f2937;
        margin: 0;
    }
    .search-filter-box { display: flex; gap: 10px; }
    .search-input {
        padding: 8px 14px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 14px;
        width: 180px;
    }
    .search-input:focus {
        border-color: #234e36;
        outline: none;
    }
    .filter-btn {
        background: #ffffff; border: 1px solid #d1d5db; border-radius: 8px;
        padding: 8px 14px; font-size: 14px; color: #4b5563;
        display: flex; align-items: center; gap: 6px; cursor: pointer;
    }
    .category-tabs {
        display: flex; gap: 16px; margin-bottom: 20px;
        border-bottom: 1px solid #f3f4f6; padding-bottom: 12px;
    }
    .tab-item { font-size: 14px; font-weight: 600; color: #9ca3af; cursor: pointer; padding-bottom: 12px;}
    .tab-item.active {
        color: #234e36; border-bottom: 2px solid #234e36;
        margin-bottom: -13px;
    }
    .responsive-table-wrapper { overflow-x: auto; }
    .custom-data-table { width: 100%; border-collapse: collapse; text-align: left; }
    .custom-data-table th {
        font-size: 13px; font-weight: 600; color: #6b7280; padding: 12px 16px;
        border-bottom: 1px solid #f3f4f6; text-transform: uppercase;
    }
    .custom-data-table td { padding: 16px; border-bottom: 1px solid #f3f4f6; font-size: 14px; color: #1f2937; }
    .patient-name { font-weight: 600; color: #111827; }
    .patient-meta { font-size: 12px; color: #9ca3af; margin-top: 2px; }

    /* Clean two-state status badges styles */
    .status-badge { display: inline-block; padding: 4px 12px; border-radius: 6px; font-size: 12px; font-weight: 600; text-transform: capitalize; }
    .status-occupied { background-color: #eff6ff; color: #1d4ed8; border: 1px solid #dbeafe; }
    .status-available { background-color: #e6f4ea; color: #137333; border: 1px solid #ceead6; }
</style>

<div class="dashboard-container">
    <!-- Header Banner -->
    <div class="dashboard-banner">
        <h2 class="dashboard-title">Ward & Bed Management</h2>
        <p class="dashboard-subtitle">Overview of real-time ward occupancy, available clinic beds, and admission waiting lists.</p>
    </div>

    <!-- Live Aggregates Metrics Card Container Row -->
    <div class="metrics-grid">
        <div class="metric-card">
            <div class="icon-container bg-occupied">
                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 10V19M21 10V19M3 14H21M3 10H21M5 6H9M3 19H21"/>
                </svg>
            </div>
            <div class="card-content">
                <p class="card-label">Occupied beds</p>
                <p class="card-value">{{ $occupiedBeds }}</p>
                <p class="card-subtext">out of {{ $totalBeds }} total beds</p>
            </div>
        </div>

        <div class="metric-card">
            <div class="icon-container bg-available">
                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div class="card-content">
                <p class="card-label">Available beds</p>
                <p class="card-value">{{ $availableBeds }}</p>
                <p class="card-subtext">ready for admission</p>
            </div>
        </div>

        <div class="metric-card">
            <div class="icon-container bg-waiting">
                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div class="card-content">
                <p class="card-label">Waiting list</p>
                <p class="card-value">{{ $waitingList }}</p>
                <p class="card-subtext">patients pending a bed</p>
            </div>
        </div>
    </div>

    <!-- Active Ward Listings Section Card Body -->
    <div class="table-section-card">
        <div class="table-header-row">
            <h3 class="table-section-title">Wards availability</h3>
            <div class="search-filter-box">
                <input type="text" id="tableSearchInput" class="search-input" placeholder="Search here...">
                <button class="filter-btn">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    Filter
                </button>
            </div>
        </div>

        <div class="category-tabs" id="filterTabs">
            <span class="tab-item active" data-ward="all">All ({{ count($activeWards) }})</span>
            <span class="tab-item" data-ward="icu">ICU</span>
            <span class="tab-item" data-ward="general">General</span>
            <span class="tab-item" data-ward="isolation">Isolation</span>
        </div>

        <!-- Data Render Table -->
        <div class="responsive-table-wrapper">
            <table class="custom-data-table">
                <thead>
                    <tr>
                        <th>Bed ID</th>
                        <th>Patient</th>
                        <th>Status</th>
                        <th>Length of Stay</th>
                        <th>Ward</th>
                    </tr>
                </thead>
                <tbody id="tableDataRows">
                    @forelse($activeWards as $row)
                        <tr data-ward-type="{{ strtolower($row->ward ?? '') }}">
                            <td style="font-weight: 600;">{{ $row->bed_id }}</td>
                            <td>
                                @if($row->patient_name)
                                    <div class="patient-name">{{ $row->patient_name }}</div>
                                    <div class="patient-meta">#{{ $row->patient_code ?? '000000' }}</div>
                                @else
                                    <div class="patient-meta" style="font-style: italic;">No patient assigned</div>
                                @endif
                            </td>
                            <td>
                                <!-- Simplified two-state logic assessment marker -->
                                @if(strtolower($row->status ?? '') == 'occupied')
                                    <span class="status-badge status-occupied">Occupied</span>
                                @else
                                    <span class="status-badge status-available">Available</span>
                                @endif
                            </td>
                            <td>{{ $row->length_of_stay ?? '0' }} days</td>
                            <td>{{ $row->ward ?? 'N/A' }}</td>
                        </tr>
                    @empty
                        <tr class="empty-row-placeholder">
                            <td colspan="5" style="text-align: center; padding: 30px; color: #9ca3af;">
                                No real-time ward data records found in the database.
                            </td>
                        </tr>
                    @endforelse
                    
                    <tr id="noResultsRow" style="display: none;">
                        <td colspan="5" style="text-align: center; padding: 30px; color: #9ca3af; font-style: italic;">
                            No matching ward or patient records found.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('tableSearchInput');
    const tableBody = document.getElementById('tableDataRows');
    const rows = tableBody.querySelectorAll('tr:not(#noResultsRow):not(.empty-row-placeholder)');
    const noResultsRow = document.getElementById('noResultsRow');
    const tabs = document.querySelectorAll('#filterTabs .tab-item');

    let currentSearchQuery = '';
    let currentActiveWardFilter = 'all';

    function applyCombinedFilters() {
        let visibleCount = 0;
        rows.forEach(row => {
            const rowText = row.textContent.toLowerCase();
            const rowWardType = row.getAttribute('data-ward-type') || '';
            const matchesSearch = rowText.includes(currentSearchQuery);
            const matchesTab = (currentActiveWardFilter === 'all' || rowWardType === currentActiveWardFilter);

            if (matchesSearch && matchesTab) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });
        noResultsRow.style.display = (visibleCount === 0 && rows.length > 0) ? '' : 'none';
    }

    searchInput.addEventListener('input', function (e) {
        currentSearchQuery = e.target.value.toLowerCase().trim();
        applyCombinedFilters();
    });

    tabs.forEach(tab => {
        tab.addEventListener('click', function () {
            tabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            currentActiveWardFilter = this.getAttribute('data-ward').toLowerCase();
            applyCombinedFilters();
        });
    });
});
</script>
@endsection
