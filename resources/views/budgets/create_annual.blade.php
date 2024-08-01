@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tambah Anggaran Tahunan</h1>
        <form action="{{ route('budgets.store_annual') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="year">Tahun</label>
                <input type="number" name="year" class="form-control" value="{{ old('year') }}" required>
                @if ($errors->has('year'))
                    <span class="text-danger">{{ $errors->first('year') }}</span>
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
            <a href="{{ route('budgets.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
        
    </div>
@endsection
