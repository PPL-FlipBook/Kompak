@extends('layout')

@section('content')
    <div class="container">
        <h1>Beli Buku: {{ $flipbook->title }}</h1>

        <form action="{{ route('purchases.store', $flipbook->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="quantity" class="form-label">Jumlah</label>
                <input type="number" name="quantity" id="quantity" class="form-control" value="1" min="1">
            </div>

            <div class="mb-3">
                <label for="payment_method" class="form-label">Metode Pembayaran</label>
                <select name="payment_method" id="payment_method" class="form-control">
                    <option value="Credit Card">Credit Card</option>
                    <option value="Bank Transfer">Bank Transfer</option>
                    <option value="E-Wallet">E-Wallet</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Beli Sekarang</button>
        </form>
    </div>
@endsection
