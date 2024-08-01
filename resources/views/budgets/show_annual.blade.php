@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Anggaran Bulanan untuk Tahun {{ $annualBudget->year }}</h1>
        </div>
        <a href="{{ route('budgets.create_monthly', $annualBudget->id) }}" class="btn btn-primary mt-2 mb-3">Tambah Anggaran Bulanan</a>
        <a href="{{ route('budgets.index') }}" class="btn btn-secondary mt-2 mb-3">Kembali</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Kode Rekening</th>
                    <th>Nama Rekening</th>
                    <th>Jumlah Anggaran</th>
                    <th>Total Pengeluaran</th>
                    <th>Sisa Anggaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($annualBudget->monthlyBudgets as $monthlyBudget)
                    @php
                        $totalExpenses = $monthlyBudget->expenses->sum('item_cost');
                        $remainingBudget = $monthlyBudget->amount - $totalExpenses;
                        $statusClass = $totalExpenses > $monthlyBudget->amount ? 'text-danger' : 'text-success';
                    @endphp
                    <tr>
                        <td>{{ $monthlyBudget->account_code }}</td>
                        <td>{{ $monthlyBudget->account_name }}</td>
                        <td>{{ 'Rp ' . number_format($monthlyBudget->amount, 0, ',', '.') }}</td>
                        <td class="{{ $statusClass }}">{{ 'Rp ' . number_format($totalExpenses, 0, ',', '.') }}</td>
                        <td class="{{ $statusClass }}">{{ 'Rp ' . number_format($remainingBudget, 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('expenses.create', $monthlyBudget->id) }}" class="btn btn-secondary">Tambah Pengeluaran</a>
                            <a href="{{ route('budgets.edit_monthly', [$annualBudget->id, $monthlyBudget->id]) }}" class="btn btn-warning">Ubah</a>
                            <form action="{{ route('budgets.destroy_monthly', [$annualBudget->id, $monthlyBudget->id]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Anda yakin ingin menghapus anggaran bulanan ini?');">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nama Item</th>
                                        <th>Biaya Item</th>
                                        <th>Tanggal Item</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($monthlyBudget->expenses as $expense)
                                        <tr>
                                            <td>{{ $expense->item_name }}</td>
                                            <td>{{ 'Rp ' . number_format($expense->item_cost, 0, ',', '.') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($expense->item_date)->format('d M Y') }}</td> <!-- Menampilkan tanggal item -->
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <a href="{{ route('budgets.export', $annualBudget->id) }}" class="btn btn-success">Export to Excel</a>

@endsection
