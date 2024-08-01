@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Anggaran Tahunan</h1>
        <a href="{{ route('budgets.create_annual') }}" class="btn btn-primary">Tambah Anggaran Tahunan</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Tahun</th>
                    <th>Jumlah</th>
                    <th>Total Anggaran Bulanan</th>
                    <th>Sisa Anggaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($annualBudgets as $annualBudget)
                    @php
                        $totalMonthlyBudgets = $annualBudget->monthlyBudgets->sum('amount');
                        $totalExpenses = $annualBudget->monthlyBudgets->sum(function ($monthlyBudget) {
                            return $monthlyBudget->expenses->sum('item_cost');
                        });
                        $remainingBudget = $annualBudget->amount - $totalExpenses;
                        $statusClass = $remainingBudget < 0 ? 'text-danger' : 'text-success';
                    @endphp
                    <tr>
                        <td>{{ $annualBudget->year }}</td>
                        <td>{{ 'Rp ' . number_format($annualBudget->amount, 0, ',', '.') }}</td>
                        <td>{{ 'Rp ' . number_format($totalMonthlyBudgets, 0, ',', '.') }}</td>
                        <td class="{{ $statusClass }}">{{ 'Rp ' . number_format($remainingBudget, 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('budgets.show_annual', $annualBudget->id) }}" class="btn btn-secondary">Lihat Anggaran Bulanan</a>
                            <a href="{{ route('budgets.edit_annual', $annualBudget->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('budgets.destroy_annual', $annualBudget->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this annual budget?');">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
