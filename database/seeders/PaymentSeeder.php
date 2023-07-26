<?php

namespace Database\Seeders;

use App\Models\Balance;
use App\Models\Payment;
use App\Models\PaymentLog;
use App\Models\SchoolYear;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $payments = [
            ['student_id' => 1, 'sy_id' =>  SchoolYear::find(1)->id, 'grade_level_id' => 1, 'mop' => 'Cash', 'payment_method' => 'Annual', 'amount' => 14900, 'status' => 1, 'created_at' => now()],
        ];
        foreach ($payments as $payment) {
            Payment::create($payment);
        }
        $balances = [
            ['student_id' => 1, 'amount' => 14900, 'reminder_at' => now()->addYear(1)],
        ];
        foreach ($balances as $balance) {
            Balance::create($balance);
        }
        $data = [
            ['student_id' => 1, 'payment_id' => 1,  'created_by' => 'Dev', 'created_at' => now(), 'updated_by' => 'Dev', 'updated_at' => now()],
        ];
        foreach ($data as $payment) {
            PaymentLog::create($payment);
        }
    }
}
