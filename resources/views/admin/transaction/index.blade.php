@extends('admin.layouts.main')

@section('content')

  <div class="container-fluid p-0">
    <h1 class="display-6 mb-3">{{ $title }}</h1>

    <div class="row">
      <div class="col-12 col-lg-12">

        <div class="row justify-content-between d-print-none">
          <div class="col-md-3">
            <a href="#" onclick="window.print()"
              class="btn btn-success mb-3 d-block"><i
                data-feather="printer"></i>Print</a>
          </div>
        </div>

        @if (session()->has('success'))
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert"
              aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <div class="alert-message">
              {{ session('success') }}
            </div>
          </div>
        @endif


        <div class="card">
          <table class="table">
            <thead>
              <tr>
                <th>Customer
                </th>
                <th class="d-print-none d-none d-xl-table-cell">Total Item</th>
                <th class="d-print-none d-none d-xl-table-cell">Type
                </th>
                <th>Total</th>
                <th>Action
                </th>
              </tr>
            </thead>
            <tbody>
              @forelse ($transactions as $transaction)
                <tr>
                  <td>
                    {{ $transaction->user->firstname }}
                  </td>
                  <td class="d-print-none d-none d-xl-table-cell">
                    {{ $transaction->orders->count() }}
                  </td>
                  <td class="d-print-none d-none d-xl-table-cell">
                    {{ $transaction->payment_type }}</td>
                  <td>
                    Rp {{ number_format($transaction->total, '0', '', '.') }}
                  </td>
                  <td>
                    <a href="{{ route('admin.transaction.show', $transaction) }}"
                      class="btn btn-info btn-sm">Detail</a>
                  </td>
                </tr>
              @empty
                <tr>
                  <td>
                    No Transaction Yet
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

@endsection
