@extends('layouts.admin')

@section('title', 'Thống kê & Báo cáo')
@section('page-title', 'Báo cáo Tổng quan')

@section('styles')
    <style>
        .section-title {
            font-size: 20px;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .report-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 28px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: var(--bg-card);
            border-radius: var(--radius);
            padding: 28px;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 24px;
            transition: var(--transition);
        }

        .stat-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary);
        }

        .stat-icon {
            width: 68px;
            height: 68px;
            border-radius: 18px;
            background: var(--primary-soft);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            flex-shrink: 0;
            box-shadow: 0 4px 10px rgba(37, 99, 235, 0.08);
            color: var(--primary);
        }

        .stat-icon.warning {
            background: #fff7ed;
            color: #f97316;
        }

        .stat-icon.danger {
            background: #fef2f2;
            color: #dc2626;
        }

        .stat-icon.info {
            background: var(--accent-soft);
            color: var(--accent);
        }

        .stat-info {
            flex: 1;
        }

        .stat-value {
            font-size: 32px;
            font-weight: 800;
            color: var(--text-main);
            line-height: 1.1;
            margin-bottom: 4px;
        }

        .stat-value.warning-text {
            color: #ea580c;
        }

        .stat-value.danger-text {
            color: #dc2626;
        }

        .stat-label {
            font-size: 13px;
            color: var(--text-muted);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Simple CSS Chart section */
        .chart-section {
            background: var(--bg-card);
            border-radius: var(--radius-lg);
            padding: 40px;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border);
            margin-bottom: 40px;
        }

        .chart-header {
            font-size: 24px;
            font-weight: 800;
            color: var(--text-main);
            margin-bottom: 40px;
            display: flex;
            align-items: center;
            gap: 12px;
            letter-spacing: -0.5px;
        }

        .simple-bar-chart {
            display: flex;
            align-items: flex-end;
            justify-content: space-around;
            height: 300px;
            padding-top: 40px;
            gap: 15px;
            border-bottom: 2px solid var(--border);
        }

        .chart-col {
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;
            max-width: 100px;
        }

        .chart-bar-group {
            display: flex;
            align-items: flex-end;
            gap: 6px;
            height: 240px;
            width: 100%;
            justify-content: center;
            padding-bottom: 0;
        }

        .bar {
            width: 35%;
            min-width: 16px;
            border-radius: 8px 8px 0 0;
            min-height: 4px;
            transition: all 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
            position: relative;
            cursor: pointer;
        }

        .bar-patients {
            background: linear-gradient(180deg, var(--primary) 0%, var(--primary-hover) 100%);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
        }

        .bar-prescriptions {
            background: linear-gradient(180deg, var(--accent) 0%, var(--accent-hover) 100%);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
        }

        .bar-value-tooltip {
            position: absolute;
            top: -36px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--text-main);
            color: white;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 800;
            opacity: 0;
            visibility: hidden;
            transition: var(--transition);
            white-space: nowrap;
            z-index: 10;
            box-shadow: var(--shadow-md);
        }

        .bar:hover {
            filter: brightness(1.1);
            transform: scaleX(1.1);
        }

        .bar:hover .bar-value-tooltip {
            opacity: 1;
            visibility: visible;
            top: -42px;
        }

        .chart-label {
            margin-top: 20px;
            font-size: 14px;
            font-weight: 700;
            color: var(--text-muted);
        }

        .chart-legend {
            display: flex;
            justify-content: center;
            gap: 32px;
            margin-top: 40px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 15px;
            font-weight: 700;
            color: var(--text-main);
        }

        .legend-color {
            width: 20px;
            height: 20px;
            border-radius: 6px;
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
                <div class="stat-label">Sắp hết hạn (<30d)< /div>
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
            if ($globalMax == 0)
                $globalMax = 1; // prevent division by zero
        @endphp

        <div class="chart-section">
            <div class="chart-header">
                Thống kê Tăng trưởng 6 tháng gần nhất
            </div>

            <div class="simple-bar-chart">
                @for($i = 5; $i >= 0; $i--)
                    @php
                        $pHeight = round(($patientStats[5 - $i] / $globalMax) * 100);
                        $prHeight = round(($prescriptionStats[5 - $i] / $globalMax) * 100);
                    @endphp
                    <div class="chart-col">
                        <div class="chart-bar-group">
                            <div class="bar bar-patients" style="height: {{ max($pHeight, 2) }}%;">
                                <span class="bar-value-tooltip">{{ $patientStats[5 - $i] }}</span>
                            </div>
                            <div class="bar bar-prescriptions" style="height: {{ max($prHeight, 2) }}%;">
                                <span class="bar-value-tooltip">{{ $prescriptionStats[5 - $i] }}</span>
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