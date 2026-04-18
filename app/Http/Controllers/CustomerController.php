<?php

namespace App\Http\Controllers;

use App\Models\Transaction;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Transaction::query()
            ->selectRaw('customer_name, customer_phone, COUNT(*) as visit_count, MAX(created_at) as last_visit')
            ->groupBy('customer_name', 'customer_phone')
            ->orderByDesc('visit_count')
            ->get()
            ->map(function ($customer) {
                $phone = preg_replace('/\D+/', '', (string) $customer->customer_phone);
                if (str_starts_with($phone, '0')) {
                    $phone = '62' . substr($phone, 1);
                }

                return [
                    'plate_number' => '-',
                    'customer_name' => strtoupper($customer->customer_name),
                    'customer_phone' => $customer->customer_phone,
                    'visit_count' => (int) $customer->visit_count,
                    'wa_link' => $phone ? 'https://wa.me/' . $phone : 'https://wa.me/',
                ];
            });

        return view('customers.index', [
            'customers' => $customers,
        ]);
    }
}
