@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Anggaran Tahunan Untuk Tahun {{ $annualBudget->year }}</h1>
        <form action="{{ route('budgets.update_annual', $annualBudget->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="year">Tahun</label>
                <input type="number" name="year" class="form-control" value="{{ $annualBudget->year }}" required>
                @if ($errors->has('year'))
                    <span class="text-danger">{{ $errors->first('year') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="amount">Jumlah</label>
                <input type="text" name="amount" id="amount" class="form-control" value="" required>
                <input type="hidden" name="amount_hidden" id="amount_hidden" value="">
                @if ($errors->has('amount'))
                    <span class="text-danger">{{ $errors->first('amount') }}</span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('budgets.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
