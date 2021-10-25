<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['orders', 'user'])->get();

        return view('admin.transaction.index', [
            'title' => "Data Transaction",
            'transactions' => $transactions
        ]);
    }

    public function show(Transaction $transaction)
    {
        if (!auth()->user()->is_admin && auth()->user()->id !== $transaction->user_id) {
            return abort(403);
        }

        $detail = $this->getTransactionDetail($transaction);

        return view('admin.transaction.show', [
            'title' => "Detail Transaction",
            'transaction' => $transaction,
            'detail' => $detail
        ]);
    }

    public function set_reciept(Request $request, Transaction $transaction)
    {
        $validatedData = $request->validate([
            'reciept_number' => 'required'
        ]);

        $validatedData['status'] = 'On Delivery';

        Transaction::where('id', $transaction->id)->update($validatedData);

        return redirect()->route('admin.transaction.show', $transaction)->with("success", "Reciept Number Updated");
    }

    public function notification()
    {
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$serverKey = 'SB-Mid-server-nDv_Z65iSjuX0xw6zXK6MeuD';
        $notif = new \Midtrans\Notification();

        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $order_id = $notif->order_id;
        $fraud = $notif->fraud_status;

        if ($transaction == 'capture') {
            // For credit card transaction, we need to check whether transaction is challenge by FDS or not
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    // TODO set payment status in merchant's database to 'Challenge by FDS'
                    // TODO merchant should decide whether this transaction is authorized or not in MAP
                    Transaction::where('serial_order', $order_id)->update(['status' => 'Challenge by FDS']);
                } else {
                    // TODO set payment status in merchant's database to 'Success'
                    Transaction::where('serial_order', $order_id)->update(['status' => 'Success']);
                }
            }
        } else if ($transaction == 'settlement') {
            // TODO set payment status in merchant's database to 'Settlement'
            Transaction::where('serial_order', $order_id)->update(['status' => 'Settlement']);
        } else if ($transaction == 'pending') {
            // TODO set payment status in merchant's database to 'Pending'
            Transaction::where('serial_order', $order_id)->update(['status' => 'Pending']);
        } else if ($transaction == 'deny') {
            // TODO set payment status in merchant's database to 'Denied'
            Transaction::where('serial_order', $order_id)->update(['status' => 'Denied']);
        } else if ($transaction == 'expire') {
            // TODO set payment status in merchant's database to 'expire'
            Transaction::where('serial_order', $order_id)->update(['status' => 'Expire']);
        } else if ($transaction == 'cancel') {
            // TODO set payment status in merchant's database to 'Denied'
            Transaction::where('serial_order', $order_id)->update(['status' => 'Canceled']);
        }

        // $orderTransaction = Transaction::where('serial_order', $order_id)->first();

        return response()->json(['order_id' => $order_id, 'status' => $transaction]);
    }

    protected function getTransactionDetail($transaction)
    {
        switch ($transaction->status) {
            case 'Challenge by FDS':
                return [
                    'pesan' => 'The order has challenge by FDS, please try to reorder, or call the customer service',
                    'badge' => 'danger',
                    'pdf' => '',
                    'bill' => '',
                ];
                break;
            case 'On Delivery':
                return [
                    'pesan' => 'The order is on delivery to your place',
                    'pdf' => '',
                    'badge' => 'success',
                    'bill' => '',
                ];
                break;
            case 'Success':
                return [
                    'pesan' => 'The order is on proccessing',
                    'pdf' => $transaction->pdf_url,
                    'badge' => 'primary',
                    'bill' => '',
                ];
                break;
            case 'Settlement':
                return [
                    'pesan' => 'The order has been paid for and will be processed soon. We have sent the detail to your email, please check your email',
                    'badge' => 'success',
                    'bill' => '',
                    'pdf' => '',
                ];
                break;
            case 'Pending':
                return [
                    'pesan' => 'The order is waiting to be paid, please pay immediately using the payment method you choose',
                    'pdf' => $transaction->pdf_url,
                    'badge' => 'warning',
                    'bill' => '',
                ];
                break;
            case 'Denied':
                return [
                    'pesan' => 'The order has been denied, please try to reorder',
                    'badge' => 'danger',
                    'pdf' => '',
                    'bill' => '',
                ];
                break;
            case 'Expire':
                return [
                    'pesan' => 'The order has expired because it has passed the payment deadline',
                    'badge' => 'danger',
                    'pdf' => '',
                    'bill' => '',
                ];
                break;
            case 'Canceled':
                return [
                    'pesan' => 'The order has been cancelled',
                    'badge' => 'danger',
                    'pdf' => '',
                    'bill' => '',
                ];
                break;

            default:
                return [
                    'pesan' => 'The order is waiting to be paid, please pay immediately using the payment method you choose',
                    'badge' => 'info',
                    'pdf' => $transaction->pdf_url ?? '',
                    'bill' => '',
                ];
                break;
        }
    }
}
