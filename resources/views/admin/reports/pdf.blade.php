<!DOCTYPE html>
<html>
<head>
    <title>Donation Report</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .summary {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f3f4f6;
            border: 1px solid #e5e7eb;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f8f9fa;
            font-weight: bold;
        }
        .text-right {
            text-align: right;
        }
        .badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 10px;
            text-transform: uppercase;
        }
        .badge-success { color: green; background-color: #d1fae5; }
        .badge-warning { color: orange; background-color: #fef3c7; }
        .badge-danger { color: red; background-color: #fee2e2; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Donation Report</h2>
        <p>Generated on {{ now()->format('Y-m-d H:i') }}</p>
    </div>

    <div class="summary">
        <strong>Total Records:</strong> {{ $totalRecords }} | 
        <strong>Total Amount:</strong> ${{ number_format($totalAmount, 2) }}
    </div>

    <table>
        <thead>
            <tr>
                <th>Donator</th>
                <th>Email</th>
                <th>Amount</th>
                <th>Period</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($donations as $donation)
            <tr>
                <td>{{ $donation->donator->name ?? 'Unknown' }}</td>
                <td>{{ $donation->donator->email ?? '-' }}</td>
                <td>${{ number_format($donation->amount) }}</td>
                <td>
                    @php
                        $periodMap = [1 => 'Monthly', 3 => 'Quarterly', 6 => 'Semiannually', 12 => 'Yearly'];
                    @endphp
                    {{ $periodMap[$donation->donator->periodicity ?? 1] ?? 'Monthly' }}
                </td>
                <td>
                    @php
                        $badgeClass = match($donation->status) {
                            'approved' => 'badge-success',
                            'pending' => 'badge-warning',
                            'late', 'rejected' => 'badge-danger',
                            default => ''
                        };
                    @endphp
                    <span class="badge {{ $badgeClass }}">
                        {{ ucfirst($donation->status) }}
                    </span>
                </td>
                <td>{{ $donation->created_at->format('Y-m-d') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
