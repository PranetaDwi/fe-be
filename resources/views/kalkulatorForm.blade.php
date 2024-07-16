@extends('master')

@section('style')
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
        margin: 0;
        padding: 20px;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    .card {
        width: 100%;
        max-width: 600px;
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-body {
        padding: 30px;
    }

    .card-title {
        font-size: 24px;
        font-weight: bold;
        color: #658354;
        margin-bottom: 20px;
    }

    .form-group label {
        font-weight: bold;
        color: #333;
    }

    .form-control {
        border-radius: 5px;
        padding: 10px;
    }

    .btn-primary {
        background-color: #658354;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        font-size: 18px;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #b3cf99;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title text-center mb-4">Kalkulator Komisi</h5>
            <form method="POST" action="{{ route('store-komisi') }}">
                @csrf
                <div class="form-group">
                    <label for="employeeInput">Pilih Employee</label>
                    <select class="form-control @error('employee_id') is-invalid @enderror" id="employeeInput" name="employee_id">
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                        @endforeach
                    </select>
                    @error('employee_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="periodJobInput">Tanggal Job</label>
                    <input type="date" class="form-control @error('period_job') is-invalid @enderror" id="periodJobInput" name="period_job">
                    @error('period_job')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="amount">Nilai Total Job</label>
                    <input type="text" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount">
                    @error('amount')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="grossProfit">Gross Profit</label>
                    <input type="text" class="form-control @error('gross_profit') is-invalid @enderror" id="grossProfit" name="gross_profit">
                    @error('gross_profit')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="nilaiKomisi">Nilai Komisi</label>
                    <input type="text" class="form-control @error('komisi') is-invalid @enderror" id="NilaiKomisi" name="komisi">
                    @error('komisi')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary w-100">Simpan Perhitungan</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function() {
    $('#grossProfit').on('input', function() {
        var grossProfit = $(this).val();
        var komisi = 0.1 * grossProfit;
        $('#NilaiKomisi').val(komisi.toFixed(2));
    });
});
</script>
@endsection
