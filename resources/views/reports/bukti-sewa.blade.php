<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Bukti Sewa Rental</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            color: #0f172a;
            font-size: 11.5px;
            margin: 0;
            padding: 0;
            background: #f8fafc;
        }

        .page {
            padding: 24px;
        }

        .bukti-sewa-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            overflow: hidden;
        }

        .accent-line {
            height: 5px;
            background: linear-gradient(90deg, #0f172a 0%, #1d4ed8 55%, #60a5fa 100%);
        }

        .topbar {
            padding: 18px 22px 16px;
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
        }

        .topbar-title {
            font-size: 21px;
            font-weight: 700;
            margin: 0;
            color: #0f172a;
        }

        .topbar-subtitle {
            font-size: 11px;
            color: #64748b;
            margin-top: 4px;
        }

        .content {
            padding: 18px 22px 20px;
        }

        .meta {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 14px;
            background: #f9fbff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
        }

        .meta td {
            font-size: 10.5px;
            color: #4b5563;
            padding: 8px 12px;
        }

        .meta .right {
            text-align: right;
        }

        .section-title {
            margin: 10px 0 8px;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #6b7280;
            font-weight: 700;
        }

        .details,
        .summary {
            width: 100%;
            border-collapse: collapse;
        }

        .details th,
        .details td,
        .summary th,
        .summary td {
            border: 1px solid #e5e7eb;
            padding: 9px 11px;
            vertical-align: top;
        }

        .details th,
        .summary th {
            width: 35%;
            background: #f6f8fb;
            color: #374151;
            text-align: left;
            font-weight: 600;
        }

        .details tr:nth-child(even) td {
            background: #fbfdff;
        }

        .summary-wrap {
            margin-top: 16px;
            width: 45%;
            margin-left: auto;
            border: 1px solid #dbe4f0;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: inset 0 1px 0 #ffffff;
        }

        .money {
            text-align: right;
            font-weight: 600;
        }

        .grand-total th,
        .grand-total td {
            background: #eff6ff;
            font-weight: 700;
            color: #111827;
            border-top: 2px solid #60a5fa;
        }

        .footer {
            margin-top: 18px;
            font-size: 10px;
            color: #6b7280;
            text-align: right;
            padding-top: 10px;
            border-top: 1px dashed #d1d5db;
        }
    </style>
</head>
<body>
    <div class="page">
        <div class="bukti-sewa-card">
            <div class="accent-line"></div>
            <div class="topbar">
                <p class="topbar-title">Sistem Rental Kendaraan</p>
                <div class="topbar-subtitle">Bukti sewa transaksi rental kendaraan motor dan mobil</div>
            </div>

            <div class="content">
                <table class="meta">
                    <tr>
                        <td><strong>Bukti Sewa #BS-{{ str_pad((string) $rental->id, 6, '0', STR_PAD_LEFT) }}</strong></td>
                        <td class="right">Tanggal cetak: {{ now()->format('d F Y') }}</td>
                    </tr>
                </table>

                <div class="section-title">Detail Transaksi</div>
                <table class="details">
                    <tr>
                        <th>Customer</th>
                        <td>{{ $rental->customer?->nama }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $rental->customer?->email }}</td>
                    </tr>
                    <tr>
                        <th>Kendaraan</th>
                        <td>{{ $rental->kendaraan?->nama }} ({{ $rental->kendaraan?->tipe }})</td>
                    </tr>
                    <tr>
                        <th>Tanggal Sewa</th>
                        <td>{{ $rental->tgl_sewa?->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Kembali</th>
                        <td>{{ $rental->tgl_kembali?->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>{{ ucfirst($rental->status) }}</td>
                    </tr>
                </table>

                <div class="summary-wrap">
                    <table class="summary">
                        <tr>
                            <th>Subtotal</th>
                            <td class="money">Rp {{ number_format($rental->total, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Denda</th>
                            <td class="money">Rp {{ number_format($rental->denda, 0, ',', '.') }}</td>
                        </tr>
                        <tr class="grand-total">
                            <th>Total Akhir</th>
                            <td class="money">Rp {{ number_format($rental->total + $rental->denda, 0, ',', '.') }}</td>
                        </tr>
                    </table>
                </div>

                <div class="footer">
                    Dokumen ini dibuat otomatis oleh sistem.
                </div>
            </div>
        </div>
    </div>
</body>
</html>