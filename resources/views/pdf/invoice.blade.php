<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $invoice->invoice_number }} - FutureCloud.id</title>
    <style>
        /* SETUP HALAMAN & FONT */
        @page {
            margin: 0cm;
        }
        body {
            font-family: 'Segoe UI', 'Helvetica Neue', 'Arial', sans-serif;
            font-size: 13px;
            color: #1e293b;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
        }
        
        /* LAYOUT UTAMA */
        .page-container {
            padding: 30px 40px;
            max-width: 210mm;
            margin: 0 auto;
        }
        
        /* UTILITIES */
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .text-bold { font-weight: 600; }
        .text-sm { font-size: 12px; }
        .text-xs { font-size: 10px; }
        .uppercase { text-transform: uppercase; }
        .no-margin { margin: 0; }
        
        /* HEADER DENGAN BRAND BAR */
        .brand-bar {
            height: 6px;
            background: linear-gradient(90deg, #2563EB 0%, #3B82F6 100%);
            margin: -30px -40px 25px -40px;
            box-shadow: 0 2px 4px rgba(37, 99, 235, 0.1);
        }
        
        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f1f5f9;
        }
        
        .logo-section {
            flex: 1;
        }
        
        .logo {
            font-size: 26px;
            font-weight: 700;
            color: #2563EB;
            letter-spacing: -0.5px;
            margin-bottom: 3px;
        }
        
        .tagline {
            font-size: 11px;
            color: #64748b;
            font-weight: 500;
        }
        
        .company-details {
            text-align: right;
            font-size: 10px;
            color: #64748b;
            line-height: 1.6;
        }
        
        .company-details strong {
            color: #1e293b;
            font-size: 11px;
            display: block;
            margin-bottom: 3px;
        }

        /* INVOICE HEADER */
        .invoice-header {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            padding: 20px 25px;
            border-radius: 8px;
            margin-bottom: 25px;
            border: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .invoice-title-section {
            flex: 1;
        }
        
        .invoice-label {
            font-size: 9px;
            font-weight: 700;
            color: #94a3b8;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-bottom: 5px;
        }
        
        .invoice-number {
            font-size: 24px;
            font-weight: 700;
            color: #2563EB;
            letter-spacing: -0.5px;
        }
        
        .invoice-dates {
            text-align: right;
        }
        
        .date-row {
            margin-bottom: 8px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 12px;
        }
        
        .date-label {
            font-size: 9px;
            color: #64748b;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .date-value {
            font-size: 11px;
            color: #1e293b;
            font-weight: 600;
            background: white;
            padding: 4px 10px;
            border-radius: 4px;
            border: 1px solid #e2e8f0;
        }
        
        .date-value.due {
            color: #dc2626;
            background: #fef2f2;
            border-color: #fecaca;
        }

        /* STATUS BADGE */
        .status-badge {
            display: inline-block;
            margin-top: 8px;
        }
        
        .badge {
            padding: 5px 12px;
            border-radius: 12px;
            font-size: 9px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-block;
        }
        .badge-paid { 
            background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
            color: #166534;
            border: 1px solid #86efac;
            box-shadow: 0 1px 2px rgba(22, 101, 52, 0.1);
        }
        .badge-unpaid { 
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            color: #991b1b;
            border: 1px solid #fca5a5;
            box-shadow: 0 1px 2px rgba(153, 27, 27, 0.1);
        }

        /* CLIENT INFO BOX */
        .client-section {
            background: white;
            padding: 18px 20px;
            border-radius: 8px;
            border: 2px solid #e2e8f0;
            margin-bottom: 25px;
        }
        
        .client-label {
            font-size: 9px;
            font-weight: 700;
            color: #94a3b8;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 8px;
            display: block;
        }
        
        .client-name {
            font-size: 15px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 6px;
        }
        
        .client-details {
            font-size: 11px;
            color: #475569;
            line-height: 1.6;
        }

        /* TABLE ITEMS */
        .table-items {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
            border-radius: 6px;
            overflow: hidden;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }
        .table-items thead {
            background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
        }
        .table-items th {
            color: #ffffff;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 10px 15px;
            text-align: left;
        }
        .table-items td {
            padding: 12px 15px;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: top;
            background: white;
        }
        .table-items tbody tr:hover td {
            background: #f8fafc;
        }
        .table-items tbody tr:last-child td {
            border-bottom: 2px solid #e2e8f0;
        }
        .item-name { 
            font-weight: 600;
            color: #1e293b;
            font-size: 13px;
            margin-bottom: 4px;
        }
        .item-desc { 
            font-size: 11px;
            color: #64748b;
            line-height: 1.5;
        }
        .item-cycle {
            font-size: 11px;
            color: #475569;
            background: #f8fafc;
            padding: 3px 10px;
            border-radius: 4px;
            display: inline-block;
            border: 1px solid #e2e8f0;
        }
        .item-price {
            font-weight: 700;
            color: #1e293b;
            font-size: 13px;
        }

        /* TOTALS SECTION */
        .summary-section {
            display: flex;
            gap: 20px;
            margin-top: 20px;
        }
        
        .payment-info {
            flex: 1;
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            padding: 15px 18px;
            border-radius: 8px;
            border: 1px solid #bfdbfe;
        }
        
        .payment-label {
            font-size: 9px;
            font-weight: 700;
            color: #1e40af;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }
        
        .payment-method {
            font-size: 14px;
            color: #2563eb;
            font-weight: 700;
            margin-bottom: 8px;
        }
        
        .payment-note {
            font-size: 10px;
            color: #475569;
            line-height: 1.5;
        }
        
        .totals-box {
            flex: 0 0 320px;
        }
        
        .table-totals {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            overflow: hidden;
        }
        .table-totals td {
            padding: 10px 15px;
            text-align: right;
        }
        .table-totals tr {
            border-bottom: 1px solid #f1f5f9;
        }
        .table-totals .label { 
            color: #64748b;
            font-size: 11px;
            font-weight: 500;
            text-align: left;
        }
        .table-totals .value { 
            color: #1e293b;
            font-weight: 600;
            font-size: 12px;
        }
        
        .grand-total-row {
            background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
        }
        .grand-total-row td {
            padding: 12px 15px;
            font-size: 14px;
            font-weight: 700;
            border: none;
        }
        .grand-total-row .label { 
            color: #dbeafe;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 10px;
        }
        .grand-total-row .value { 
            color: white;
            font-size: 16px;
        }

        /* FOOTER */
        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 2px solid #f1f5f9;
            text-align: center;
            color: #94a3b8;
            font-size: 10px;
        }
        
        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .footer strong {
            color: #475569;
        }
        
        .footer-link {
            color: #2563eb;
            text-decoration: none;
            font-weight: 600;
        }
        
        /* PRINT OPTIMIZATION */
        @media print {
            body { margin: 0; }
            .page-container { padding: 30px; }
            .brand-bar { margin: -30px -30px 20px -30px; }
        }
    </style>
</head>
<body>

    <div class="brand-bar"></div>

    <div class="page-container">

        <!-- HEADER SECTION -->
        <div class="header-section">
            <div class="logo-section">
                <div class="logo">FutureCloud.id</div>
                <div class="tagline">Solusi Digital & Cloud Hosting Terpercaya</div>
            </div>
            <div class="company-details">
                <strong>PT Berkah Teknologi Terdepan</strong>
                Gedung Jaya Lomba 5 unit A.6<br>
                Jl. M H Thamrin No.12, Jakarta Pusat 10340<br>
                <span style="color: #2563eb;">📞</span> (+62) 815-2022-225 | 
                <span style="color: #2563eb;">✉</span> info@futurecloud.id
            </div>
        </div>

        <!-- INVOICE HEADER -->
        <div class="invoice-header">
            <div class="invoice-title-section">
                <div class="invoice-label">Invoice Number</div>
                <div class="invoice-number">#{{ $invoice->invoice_number }}</div>
                <div class="status-badge">
                    @if(in_array(strtolower($invoice->status), ['paid', 'active']))
                        <span class="badge badge-paid">✓ Lunas / Paid</span>
                    @else
                        <span class="badge badge-unpaid">⊘ Belum Dibayar / Unpaid</span>
                    @endif
                </div>
            </div>
            <div class="invoice-dates">
                <div class="date-row">
                    <span class="date-label">Tanggal Terbit</span>
                    <span class="date-value">{{ $invoice->created_at->format('d/m/Y') }}</span>
                </div>
                <div class="date-row">
                    <span class="date-label">Jatuh Tempo</span>
                    <span class="date-value due">{{ $invoice->created_at->addDays(7)->format('d/m/Y') }}</span>
                </div>
            </div>
        </div>

        <!-- CLIENT INFO -->
        <div class="client-section">
            <span class="client-label">Ditagihkan Kepada</span>
            <div class="client-name">{{ $user->name }}</div>
            <div class="client-details">
                {{ $user->address ?? 'Alamat belum dilengkapi' }}<br>
                <span style="color: #2563eb;">✉</span> {{ $user->email }}<br>
                @if($user->phone)
                    <span style="color: #2563eb;">📱</span> {{ $user->phone }}
                @endif
            </div>
        </div>

        <!-- ITEMS TABLE -->
        <table class="table-items">
            <thead>
                <tr>
                    <th width="50%">Deskripsi Layanan</th>
                    <th width="20%">Siklus Billing</th>
                    <th width="30%" class="text-right">Harga (IDR)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoice->items as $item)
                    @php $config = $item->configuration ?? []; @endphp
                    <tr>
                        <td>
                            <div class="item-name">{{ $item->product_name }}</div>
                            <div class="item-desc">
                                Tipe Layanan: <strong>{{ ucfirst($item->type) }}</strong>
                                @if(isset($config['domain_connection'])) 
                                    <br>Domain Terhubung: <strong>{{ $config['domain_connection'] }}</strong>
                                @elseif(isset($config['domain']))
                                    <br>Domain: <strong>{{ $config['domain'] }}</strong>
                                @endif
                            </div>
                        </td>
                        <td>
                            <span class="item-cycle">{{ ucfirst($item->billing_cycle) }}</span>
                        </td>
                        <td class="text-right">
                            <div class="item-price">Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- SUMMARY SECTION -->
        <div class="summary-section">
            <!-- Payment Info -->
            <div class="payment-info">
                <div class="payment-label">Metode Pembayaran</div>
                <div class="payment-method">{{ strtoupper(str_replace('_', ' ', $invoice->payment_method)) }}</div>
                <div class="payment-note">
                    Mohon transfer sesuai dengan nominal yang tertera. Invoice ini diterbitkan secara otomatis oleh sistem FutureCloud.id dan tidak memerlukan tanda tangan.
                </div>
            </div>

            <!-- Totals -->
            <div class="totals-box">
                @php
                    $subtotal = $invoice->items->sum('price');
                    $tax = $subtotal * 0.11; 
                @endphp
                <table class="table-totals">
                    <tr>
                        <td class="label">Subtotal</td>
                        <td class="value">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td class="label">PPN (11%)</td>
                        <td class="value">Rp {{ number_format($tax, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td class="label">Biaya Admin</td>
                        <td class="value">Rp 0</td>
                    </tr>
                    <tr class="grand-total-row">
                        <td class="label">Total Tagihan</td>
                        <td class="value">Rp {{ number_format($invoice->total_amount, 0, ',', '.') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- FOOTER -->
        <div class="footer">
            <div class="footer-content">
                <div>
                    &copy; {{ date('Y') }} <strong>PT Berkah Teknologi Terdepan</strong>. Semua hak dilindungi.
                </div>
                <div>
                    <a href="https://www.futurecloud.id" class="footer-link">www.futurecloud.id</a>
                </div>
            </div>
        </div>

    </div>

</body>
</html>