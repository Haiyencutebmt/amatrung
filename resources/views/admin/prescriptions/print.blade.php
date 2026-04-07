<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>In Đơn Thuốc - {{ $prescription->prescription_code }}</title>
    <style>
        @page {
            size: A4;
            margin: 20mm;
        }
        body {
            font-family: 'Times New Roman', Times, serif;
            color: #000;
            line-height: 1.5;
            margin: 0;
            padding: 0;
            background: #fff;
        }
        .print-container {
            max-width: 800px;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            text-transform: uppercase;
            font-weight: bold;
        }
        .header p {
            margin: 5px 0 0 0;
            font-size: 14px;
        }
        .prescription-title {
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            margin: 20px 0;
            text-transform: uppercase;
        }
        .info-section {
            margin-bottom: 20px;
        }
        .info-row {
            display: flex;
            margin-bottom: 5px;
        }
        .info-label {
            min-width: 150px;
            font-weight: bold;
        }
        .items-title {
            font-weight: bold;
            font-size: 18px;
            margin: 15px 0 10px;
            text-transform: uppercase;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .items-table th, .items-table td {
            border: 1px dotted #666;
            padding: 8px;
            text-align: left;
        }
        .items-table th {
            font-weight: bold;
            text-align: center;
        }
        .items-table .text-center {
            text-align: center;
        }
        .notes-section {
            margin-bottom: 30px;
        }
        .notes-section h4 {
            margin: 0 0 5px 0;
        }
        .footer-signatures {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
        }
        .signature-box {
            text-align: center;
            width: 250px;
        }
        .signature-date {
            font-style: italic;
            margin-bottom: 10px;
        }
        .signature-space {
            height: 100px;
        }
        
        @media print {
            .no-print {
                display: none !important;
            }
        }

        .print-btn-wrapper {
            text-align: center;
            margin: 20px 0;
        }
        .btn-print {
            padding: 10px 20px;
            background: #1a5632;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            font-family: Arial, sans-serif;
        }
    </style>
</head>
<body>
    <div class="no-print print-btn-wrapper">
        <button class="btn-print" onclick="window.print()">🖨 Nhấn vào đây để In Đơn Thuốc</button>
        <p style="color: #666; font-size: 13px; font-family: Arial, sans-serif;">(Hoặc nhấn Ctrl+P)</p>
    </div>

    <div class="print-container">
        <!-- Header -->
        <div class="header">
            <h1>Nhà thuốc Y học cổ truyền AmaTrung</h1>
            <p>Địa chỉ: Số 123 Đường Đông Y, Quận Y Học, TP. Khỏe Mạnh</p>
            <p>Điện thoại: 0123.456.789 - Email: contact@amatrung.com</p>
        </div>

        <!-- Title -->
        <div class="prescription-title">ĐƠN THUỐC ĐÔNG Y</div>

        <!-- Patient Info -->
        <div class="info-section">
            <div class="info-row">
                <div class="info-label">Mã đơn thuốc:</div>
                <div><strong>{{ $prescription->prescription_code }}</strong></div>
            </div>
            <div class="info-row">
                <div class="info-label">Mã hồ sơ bệnh án:</div>
                <div>{{ $prescription->medicalRecord->record_code }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Họ tên bệnh nhân:</div>
                <div style="flex-grow: 1; text-transform: uppercase;"><strong>{{ $prescription->medicalRecord->patient->full_name }}</strong></div>
                <div style="margin-left: 20px;">SĐT: {{ $prescription->medicalRecord->patient->phone }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Chẩn đoán:</div>
                <div>{{ $prescription->medicalRecord->diagnosis ?: 'Không có' }}</div>
            </div>
        </div>

        <!-- Prescription Items -->
        <div class="items-title">Chỉ định các vị thuốc ({{ $prescription->items->count() }} vị)</div>
        <table class="items-table">
            <thead>
                <tr>
                    <th width="10%">STT</th>
                    <th width="40%">Tên Vị Thuốc</th>
                    <th width="20%">Số lượng</th>
                    <th width="30%">Ghi chú / Cách sắc</th>
                </tr>
            </thead>
            <tbody>
                @foreach($prescription->items as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td><strong>{{ $item->herb->name }}</strong></td>
                    <td class="text-center">{{ floatval($item->quantity) }} {{ $item->unit }}</td>
                    <td>{{ $item->instruction ?: '' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Instructions -->
        <div class="notes-section">
            <h4>Hướng dẫn sử dụng chung:</h4>
            <p>{{ $prescription->usage_instruction ?: 'Theo chỉ dẫn của thầy thuốc.' }}</p>
            
            @if($prescription->general_note)
                <h4 style="margin-top: 15px;">Lời dặn:</h4>
                <p>{{ $prescription->general_note }}</p>
            @endif
        </div>

        <!-- Signatures -->
        <div class="footer-signatures">
            <div class="signature-box">
                <div class="signature-date">Người bệnh (hoặc người nhà)</div>
                <div class="signature-space"></div>
                <div>__________________</div>
            </div>
            <div class="signature-box">
                <div class="signature-date">Ngày {{ $prescription->prescribed_date->format('d') }} tháng {{ $prescription->prescribed_date->format('m') }} năm {{ $prescription->prescribed_date->format('Y') }}</div>
                <div><strong>Thầy thuốc kê đơn</strong></div>
                <div class="signature-space"></div>
                <div>__________________</div>
            </div>
        </div>
    </div>
    
    <!-- Auto trigger print dialog on page load -->
    <script>
        window.addEventListener('load', function() {
            setTimeout(function() {
                window.print();
            }, 500);
        });
    </script>
</body>
</html>
