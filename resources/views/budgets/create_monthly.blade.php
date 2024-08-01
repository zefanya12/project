@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tambah Anggaran Bulanan</h1>
        <form action="{{ route('budgets.store_monthly', $annualBudgetId) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="account_code">Kode Rekening</label>
                <input type="text" name="account_code" class="form-control" value="{{ old('account_code') }}" required>
                @if ($errors->has('account_code'))
                    <span class="text-danger">{{ $errors->first('account_code') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="account_name">Nama Rekening</label>
                <input type="text" name="account_name" class="form-control" value="{{ old('account_name') }}" required>
                @if ($errors->has('account_name'))
                    <span class="text-danger">{{ $errors->first('account_name') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="amount">Jumlah</label>
                <input type="text" name="amount" id="amount" class="form-control" value="{{ old('amount') }}" required>
                <input type="hidden" name="amount_hidden" id="amount_hidden" value="{{ old('amount') }}">
                @if ($errors->has('amount'))
                    <span class="text-danger">{{ $errors->first('amount') }}</span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Tambah</button>
            <a href="{{ route('budgets.show_annual', $annualBudgetId) }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
