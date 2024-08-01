@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tambah Pengeluaran untuk {{ $monthlyBudget->account_name }}</h1>
        <form action="{{ route('expenses.store', $monthlyBudget->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="item_name">Nama Item</label>
                <input type="text" name="item_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="item_cost">Biaya Item</label>
                <input type="text" name="item_cost" id="item_cost" class="form-control" required>
                <input type="hidden" name="item_cost_hidden" id="item_cost_hidden">
            </div>
            <div class="form-group">
                <label for="item_date">Tanggal Item</label>
                <input type="date" name="item_date" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Kirim</button>
            <a href="{{ route('budgets.show_annual', $monthlyBudget->annual_budget_id) }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

@endsection
