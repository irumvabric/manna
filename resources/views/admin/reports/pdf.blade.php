<!DOCTYPE html>
<html>
<head>
    <title>{{ __('messages.reports') }}</title>
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
        <h2>{{ __('messages.reports_exports') }}</h2>
        <p>Generated on {{ now()->format('Y-m-d H:i') }}</p>
    </div>

    <div class="summary">
        <strong>{{ __('messages.total_records') }}:</strong> {{ $totalRecords }} | 
        <strong>{{ __('messages.total_amount') }}:</strong> {{ session('currency_symbol', '$') }}{{ number_format($totalAmount, 2) }}
    </div>

    <table>
        <thead>
            <tr>
                <th>{{ __('messages.donator') }}</th>
                <th>{{ __('messages.email') }}</th>
                <th>{{ __('messages.amount') }}</th>
                <th>{{ __('messages.period') }}</th>
                <th>{{ __('messages.status') }}</th>
                <th>{{ __('messages.date') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($donations as $donation)
            <tr>
                <td>{{ $donation->donator->name ?? __('messages.unknown') }}</td>
                <td>{{ $donation->donator->email ?? '-' }}</td>
                <td>{{ number_format($donation->amount, 2) }} {{ $donation->currency ?? 'USD' }}</td>
                <td>
                    @php
                        $periodMap = [
                            1 => __('messages.monthly'),
                            3 => __('messages.quarterly'),
                            6 => __('messages.semiannually'),
                            12 => __('messages.yearly')
                        ];
                    @endphp
                    {{ $periodMap[$donation->donator->periodicity ?? 1] ?? __('messages.monthly') }}
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
                        {{ __('messages.' . $donation->status) }}
                    </span>
                </td>
                <td>{{ $donation->created_at->format('Y-m-d') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
