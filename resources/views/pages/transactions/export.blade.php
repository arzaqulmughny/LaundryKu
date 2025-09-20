```blade
<!doctype html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <title>Nota Kasir Laundry</title>
  <style>
    html {
      margin: 0;
      margin-top: 15px;
    }

    /* Container width for 58mm thermal paper */
    .receipt {
      width: 58mm;
      max-width: 58mm;
      min-width: 58mm;
      background: #fff;
      padding: 16px;
      font-family: monospace, monospace;
      font-size: 12px;
      color: #1a202c;
      line-height: 1.2;
      box-sizing: border-box;
      padding: 0;
    }

    /* Tables styling */
    table {
      width: 100%;
      border-collapse: collapse;
      font-size: 9px;
      margin-bottom: 12px;
    }

    /* Header info table */
    .receipt__info-table td {
      padding: 2px 4px;
      vertical-align: top;
    }

    .receipt__info-term {
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.1em;
      width: 40%;
      padding-right: 8px;
      white-space: nowrap;
    }

    .receipt__info-definition {
      width: 60%;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      text-align: right;
    }

    /* Service list table */
    .receipt__service-table th,
    .receipt__service-table td {
      padding: 2px 4px;
      border-bottom: 1px solid #000;
    }

    .receipt__service-table th {
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.1em;
      text-align: left;
    }

    .receipt__service-table th:nth-child(2),
    .receipt__service-table td:nth-child(2) {
      width: 20%;
      text-align: right;
    }

    .receipt__service-table th:nth-child(3),
    .receipt__service-table td:nth-child(3) {
      width: 40%;
      text-align: right;
    }

    /* Summary table */
    .receipt__summary-table td {
      padding: 2px 4px;
      vertical-align: top;
    }

    .receipt__summary-term {
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.1em;
      width: 50%;
      padding-right: 8px;
    }

    .receipt__summary-definition {
      width: 50%;
      text-align: right;
    }

    .receipt__summary-total .receipt__summary-term,
    .receipt__summary-total .receipt__summary-definition {
      font-weight: 700;
      font-size: 12px;
      border-top: 1px solid #000;
      padding-top: 4px;
      margin-top: 4px;
    }

    /* Payment table */
    .receipt__payment-table td {
      padding: 2px 4px;
      vertical-align: top;
    }

    .receipt__payment-term {
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.1em;
      width: 50%;
      padding-right: 8px;
    }

    .receipt__payment-definition {
      width: 50%;
      text-align: right;
    }

    .receipt__header {
      text-align: center;
      margin-bottom: 12px;
      padding-bottom: 8px;
    }

    /* Logo as colored square */
    .receipt__logo {
      margin: 0 auto 8px;
      width: 48px;
      height: 48px;
      background-color: #4f46e5;
      /* Indigo 600 */
      border-radius: 4px;
    }

    .receipt__title {
      font-weight: 700;
      font-size: 14px;
      text-transform: uppercase;
      letter-spacing: 0.1em;
      margin: 0 0 2px 0;
    }

    .receipt__footer {
      text-align: center;
      font-size: 8px;
      color: #000;
      line-height: 1.2;
      margin-top: 8px;
    }

    .receipt__footer p {
      margin: 4px 0;
    }

    .receipt__footer-text--uppercase {
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.1em;
    }

    .receipt__footer-text--italic {
      font-style: italic;
    }

    .receipt__qr-container {
      margin-top: 8px;
      display: flex;
      flex-direction: column;
      align-items: center;
      color: #000;
    }

    .receipt__qr {
      width: 64px;
      height: 64px;
      stroke: currentColor;
      fill: none;
      stroke-width: 2;
      margin-bottom: 4px;
    }

    .receipt__desc {
      font-size: 10px;
      margin: 0;
      padding: 0;
      text-align: center;
    }
  </style>
</head>

<body>
  <article class="receipt" role="document" aria-label="Cashier Receipt Laundry">
    <header class="receipt__header">
      <div class="receipt__logo" aria-label="Store Logo"></div>
      <h1 class="receipt__title">Laundry Bersih</h1>

      <p class="receipt__desc">Jl. Kebersihan No. 10, Jakarta</p>
      <p class="receipt__desc">0812-3456-7890</p>
    </header>

    <section aria-label="Transaction Information">
      <table class="receipt__info-table">
        <tbody>
          <tr>
            <td class="receipt__info-term">No. Nota</td>
            <td class="receipt__info-definition">#{{ $transaction->id }}</td>
          </tr>
          <tr>
            <td class="receipt__info-term">Tanggal</td>
            <td class="receipt__info-definition">{{ $transaction->formatted_date }}</td>
          </tr>
          <tr>
            <td class="receipt__info-term">Kasir</td>
            <td class="receipt__info-definition">{{ $transaction->admin->name }}</td>
          </tr>
          <tr>
            <td class="receipt__info-term">Pelanggan</td>
            <td class="receipt__info-definition">{{ $transaction->customer->name }}</td>
          </tr>
        </tbody>
      </table>
    </section>

    <main aria-label="Laundry Service List" style="margin-top: 25px;">
      <table class="receipt__service-table">
        <thead>
          <tr>
            <th>Layanan</th>
            <th>Qty</th>
            <th>Harga</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($transaction->services as $item)
          <tr>
            <td>{{ $item->service_name }}</td>
            <td style="text-align:right;">{{ $item->quantity }}</td>
            <td style="text-align:right;">Rp {{ number_format($item->service_price, 0, ',', '.') }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </main>

    <section aria-label="Payment Summary">
      <table class="receipt__summary-table">
        <tbody>
          <tr>
            <td class="receipt__summary-term">Diskon</td>
            <td class="receipt__summary-definition">Rp 0</td>
          </tr>

          <tr>
            <td class="receipt__summary-term">Subtotal</td>
            <td class="receipt__summary-definition">Rp {{ number_format($transaction->total ?? 0, 0, ',', '.') }}</td>
          </tr>

          <tr class="receipt__summary-total">
            <td class="receipt__summary-term">Total</td>
            <td class="receipt__summary-definition">Rp {{ number_format($transaction->total ?? 0, 0, ',', '.') }}</td>
          </tr>
        </tbody>
      </table>
    </section>

    <section aria-label="Payment Details">
      <table class="receipt__payment-table">
        <tbody>
          <tr>
            <td class="receipt__payment-term">Status Pembayaran</td>
            <td class="receipt__payment-definition">{{ strtoupper($transaction->payment_status_label) }}</td>
          </tr>
        </tbody>
      </table>
    </section>

    <footer class="receipt__footer">
      <p class="receipt__footer-text--uppercase">Terima Kasih Atas Kepercayaan Anda!</p>
      <p class="receipt__footer-text">Estimasi Pengambilan: {{ $transaction->formatted_due_date }}</p>
    </footer>
  </article>
</body>

</html>