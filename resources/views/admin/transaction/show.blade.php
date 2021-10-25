@extends('admin.layouts.main')

@section('content')

<div class="container-fluid p-0">
  <h1 class="display-6 mb-3">{{ $title }}</h1>

  @if (auth()->user()->is_admin)
  <div class="row justify-content-between d-print-none">
    <div class="col-md-6">
      <form action="{{ route('admin.transaction.reciept', $transaction) }}" method="POST">
        @method('PUT')
        @csrf

        <div class="input-group mb-3">
          <input type="text" class="form-control py-2" placeholder="Reciept Number" name="reciept_number"
            value="{{ old('reciept_number', $transaction->reciept_number) }}">
          <button class="btn btn-info" type="submit">
            @if ($transaction->reciept_number)
            Update Reciept Number
            @else
            Set Reciept Number
            @endif
          </button>
        </div>
      </form>
    </div>
  </div>
  @endif

  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <ul class="list-group list-group-flush">
          <li class="d-flex list-group-item py-3 justify-content-between">
            <strong>Serial Order</strong>
            <span>{{ $transaction->serial_order }}</span>
          </li>
          <li class="d-flex list-group-item py-3 justify-content-between">
            <strong>Customer Name</strong>
            <span>{{ $transaction->user->firstname }}
              {{ $transaction->user->lastname }}</span>
          </li>
          <li class="d-flex list-group-item py-3 justify-content-between">
            <strong>Total Item</strong>
            <span>{{ $transaction->orders->count() }}</span>
          </li>
          <li class="d-flex list-group-item py-3 justify-content-between">
            <strong>Total</strong>
            <span>Rp
              {{ number_format($transaction->total, '0', '', '.') }}</span>
          </li>
          <li class="d-flex list-group-item py-3 justify-content-between">
            <strong>Payment Type</strong>
            <span>{{ $transaction->payment_type }}</span>
          </li>
          <li class="d-flex list-group-item py-3 justify-content-between">
            <strong>Payment Code / VA Number</strong>
            <span>{{ $transaction->payment_code }}</span>
          </li>
          <li class="d-flex list-group-item py-3 justify-content-between">
            <strong>Status</strong>
            <p class="m-0"><span class="badge bg-{{ $detail['badge'] }} text-light text-uppercase">
                {{ $transaction->status }}
              </span></p>
          </li>
          @if ($transaction->reciept_number)
          <li class="d-flex list-group-item py-3 justify-content-between">
            <strong>Reciept Number</strong>
            <span>{{ $transaction->reciept_number }}</span>
          </li>
          @endif
        </ul>
      </div>
    </div>

    @if ($detail['pesan'] != '')
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <div class="card-text">
            <p class="h4 mb-2">{{ $detail['pesan'] }}</p>
            @if ($transaction->reciept_number)
            <p class="h4 text-muted mb-2">This is the reciept number</p>
            <p class="h4 text-muted mb-2">{{ $transaction->reciept_number }}</p>
            @endif
            @if ($detail['pdf'] != '')
            <p class="h4 text-muted mb-2">You can get step by step payment here</p>
            <a class="btn btn-primary mb-2" href="{{ $detail['pdf'] }}" target="_blank">Download Instructions</a>
            @endif
            @if ($detail['bill'] != '')
            <p class="h4 text-muted mb-2">atau Anda bisa mendapatkan nota
              bukti pembayaran melalui tombol dibawah</p>
            <a class="btn btn-primary mb-2" href="#">Download Nota</a>
            @endif
          </div>
        </div>
      </div>
      <div class="card">
        <div class="py-3">
          <div class="card-header my-0 py-0">
            <h4>List Item</h4>
          </div>
          <div class="card-body my-0 py-0">
            <ul class="list-group list-group-flush my-0 py-0">
              @foreach ($transaction->orders as $order)
              <li class="d-flex list-group-item justify-content-between py-1">
                <span>{{ $order->product->name }} x {{ $order->quantity }}</span>
                <span>Rp {{ number_format($order->quantity * $order->product->price, '0', '', '.') }}</span>
              </li>
              @endforeach
            </ul>
          </div>
        </div>
        <div class="py-3">
          <div class="card-header my-0 py-0">
            <h4>Delivery</h4>
          </div>
          <div class="card-body my-0 py-0">
            <ul class="list-group list-group-flush my-0 py-0">
              <li class="d-flex list-group-item justify-content-between my-0 py-0">
                <span>{{ $transaction->delivery_service }}</span>
                <span>Rp {{ number_format($transaction->delivery_cost, '0', '', '.') }}</span>
              </li>
            </ul>
          </div>
        </div>
        <div class="py-3">
          <div class="card-header my-0 py-0 d-flex justify-content-between">
            <h4>Total</h4>
            <span class="px-4">Rp {{ number_format($transaction->total, '0', '', '.') }}</span>
          </div>
        </div>
      </div>
    </div>
    @endif
  </div>
</div>

@endsection