@extends('layouts.admin')

@section('title', 'Thống kê & Báo cáo')
@section('page-title', 'Báo cáo Tổng quan')

@section('styles')
<style>
    .report-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 24px;
        margin-bottom: 32px;
    }

    .stat-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.03);
        border: 1px solid #e8e2d8;
        display: flex;
        align-items: center;
        gap: 20px;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    
    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.06);
    }

    .stat-icon {
        width: 64px;
        height: 64px;
        border-radius: 16px;
        background: #f0f7f1;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        flex-shrink: 0;
    }

    .stat-icon.warning { background: #fff8e1; }
    .stat-icon.danger { background: #ffebee; }
    .stat-icon.info { background: #e3f2fd; }

    .stat-info {
        flex: 1;
    }

    .stat-value {
        font-size: 28px;
        font-weight: 700;
        color: #1a5632;
        line-height: 1.2;
        margin-bottom: 4px;
    }

    .stat-value.warning-text { color: #f57f17; }
    .stat-value.danger-text { color: #c62828; }

    .stat-label {
        font-size: 14px;
        color: #5a6b5e;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Simple CSS Chart section */
    .chart-section {
        background: #ffffff;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.03);
        border: 1px solid #e8e2d8;
    }

    .chart-header {
        font-size: 20px;
        font-weight: 700;
        color: #1a5632;
        margin-bottom: 30px;
        padding-bottom: 15px;
        border-bottom: 2px solid #f2ede5;
    }

    .simple-bar-chart {
        display: flex;
        align-items: flex-end;
        justify-content: space-around;
        height: 250px;
        padding-top: 20px;
        gap: 10px;
    }

    .chart-col {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 12%;
        flex: 1;
        max-width: 80px;
    }

    .chart-bar-group {
        display: flex;
        align-items: flex-end;
        gap: 4px;
        height: 200px;
        width: 100%;
        justify-content: center;
        border-bottom: 2px solid #e8e2d8;
        padding-bottom: 10px;
    }

    .bar {
        width: 50%;
        max-width: 30px;
        border-radius: 4px 4px 0 0;
        min-height: 2px;
        transition: height 0.5s ease;
        position: relative;
        cursor: pointer;
    }

    .bar-patients {
        background: linear-gradient(180deg, #2f7d4a 0%, #1a5632 100%);
    }

    .bar-prescriptions {
        background: linear-gradient(180deg, #42a5f5 0%, #1e88e5 100%);
    }

    .bar-value-tooltip {
        position: absolute;
        top: -30px;
        left: 50%;
        transform: translateX(-50%);
        background: #2d3a2e;
        color: white;
        padding: 4px 8px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        opacity: 0;
        visibility: hidden;
        transition: 0.2s;
    }

    .bar:hover .bar-value-tooltip {
        opacity: 1;
        visibility: visible;
        top: -35px;
    }

    .chart-label {
        margin-top: 15px;
        font-size: 13px;
        font-weight: 600;
        color: #5a6b5e;
    }

    .chart-legend {
        display: flex;
        justify-content: center;
        gap: 24px;
        margin-top: 30px;
    }

    .legend-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        font-weight: 500;
        color: #5a6b5e;
    }

    .legend-color {
        width: 16px;
        height: 16px;
        border-radius: 4px;
    }
</style>
@endsection

@section('content')
    <!-- Dashboard Stats Grid -->
    <h3 style="margin-bottom: 20px; color: #1a5632;">1. Dữ liệu phòng khám</h3>
    <div class="report-grid">
        <div class="stat-card">
            <div class="stat-icon">👥</div>
            <div class="stat-info">
                <div class="stat-value">{{ $totalPatients }}</div>
                <div class="stat-label">Bệnh nhân</div>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">📋</div>
            <div class="stat-info">
                <div class="stat-value">{{ $totalMedicalRecords }}</div>
                <div class="stat-label">Hồ sơ bệnh án</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon info">💊</div>
            <div class="stat-info">
                <div class="stat-value">{{ $totalPrescriptions }}</div>
                <div class="stat-label">Đơn thuốc đã cấp</div>
            </div>
        </div>
    </div>

    <h3 style="margin-bottom: 20px; color: #1a5632;">2. Quản lý kho Dược liệu</h3>
    <div class="report-grid">
        <div class="stat-card">
            <div class="stat-icon">🌿</div>
            <div class="stat-info">
                <div class="stat-value">{{ $totalHerbs }}</div>
                <div class="stat-label">Tổng loại dược liệu</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon warning">⚠️</div>
            <div class="stat-info">
                <div class="stat-value warning-text">{{ $lowStockHerbs }}</div>
                <div class="stat-label">Sắp hết hàng</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon danger">🚨</div>
            <div class="stat-info">
                <div class="stat-value danger-text">{{ $outOfStockHerbs }}</div>
                <div class="stat-label">Đã hết hàng</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon warning">⏳</div>
            <div class="stat-info">
                <div class="stat-value warning-text">{{ $expiringHerbs }}</div>
                <div class="stat-label">Sắp hết hạn (<30d)</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon danger">❌</div>
            <div class="stat-info">
                <div class="stat-value danger-text">{{ $expiredHerbs }}</div>
                <div class="stat-label">Đã hết hạn</div>
            </div>
        </div>
    </div>

    <h3 style="margin-bottom: 20px; color: #1a5632;">3. Tương tác cộng đồng</h3>
    <div class="report-grid">
        <div class="stat-card">
            <div class="stat-icon">📝</div>
            <div class="stat-info">
                <div class="stat-value">{{ $totalArticles }}</div>
                <div class="stat-label">Bài viết y khoa</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">💬</div>
            <div class="stat-info">
                <div class="stat-value">{{ $totalComments }}</div>
                <div class="stat-label">Bình luận</div>
            </div>
        </div>
    </div>

    @php
        // Tính toán max value để xác định chiều cao cột (100%)
        $maxPatients = empty($patientStats) ? 0 : max($patientStats);
        $maxPrescriptions = empty($prescriptionStats) ? 0 : max($prescriptionStats);
        $globalMax = max($maxPatients, $maxPrescriptions);
        if ($globalMax == 0) $globalMax = 1; // prevent division by zero
    @endphp

    <div class="chart-section">
        <div class="chart-header">
            Thống kê Tăng trưởng 6 tháng gần nhất
        </div>
        
        <div class="simple-bar-chart">
            @for($i = 5; $i >= 0; $i--)
                @php
                    $pHeight = round(($patientStats[5-$i] / $globalMax) * 100);
                    $prHeight = round(($prescriptionStats[5-$i] / $globalMax) * 100);
                @endphp
                <div class="chart-col">
                    <div class="chart-bar-group">
                        <div class="bar bar-patients" style="height: {{ max($pHeight, 2) }}%;">
                            <span class="bar-value-tooltip">{{ $patientStats[5-$i] }}</span>
                        </div>
                        <div class="bar bar-prescriptions" style="height: {{ max($prHeight, 2) }}%;">
                            <span class="bar-value-tooltip">{{ $prescriptionStats[5-$i] }}</span>
                        </div>
                    </div>
                    <div class="chart-label">{{ reset($months) }}</div>
                    @php array_shift($months); @endphp
                </div>
            @endfor
        </div>

        <div class="chart-legend">
            <div class="legend-item">
                <div class="legend-color bar-patients"></div>
                Bệnh nhân mới
            </div>
            <div class="legend-item">
                <div class="legend-color bar-prescriptions"></div>
                Đơn thuốc đã kê
            </div>
        </div>
    </div>
@endsection
