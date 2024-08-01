<table>
    <thead>
        <tr>
            <th>Tahun</th>
            <th>Jumlah Anggaran</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $annualBudget->year }}</td>
            <td>{{ number_format($annualBudget->amount, 0, ',', '.') }}</td>
        </tr>
    </tbody>
</table>

<table>
    <thead>
        <tr>
            <th>Kode Rekening</th>
            <th>Nama Rekening</th>
            <th>Jumlah Anggaran Bulanan</th>
            <th>Total Pengeluaran</th>
            <th>Sisa Anggaran</th>
        </tr>
    </thead>
    <tbody>
        @foreach($monthlyBudgets as $monthlyBudget)
            @php
                $totalExpenses = $monthlyBudget->expenses->sum('item_cost');
                $remainingBudget = $monthlyBudget->amount - $totalExpenses;
            @endphp
            <tr>
                <td>{{ $monthlyBudget->account_code }}</td>
                <td>{{ $monthlyBudget->account_name }}</td>
                <td>{{ number_format($monthlyBudget->amount, 0, ',', '.') }}</td>
                <td>{{ number_format($totalExpenses, 0, ',', '.') }}</td>
                <td>{{ number_format($remainingBudget, 0, ',', '.') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
