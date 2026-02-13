<?php

namespace App\Console\Commands;

use App\Mail\DonationReminder;
use App\Models\Donator;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendDonationReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-donation-reminders';

    protected $description = 'Send donation reminders to donators based on their periodicity commitment';

    /**
     * Execute the console command.
     */
    public function handle()
    {
   $this->info('');
        $today = now();
        $targetDate = $today->copy()->addDays(4); // 5 days before the 5th (if today is 1st, 1+4=5, so it's 4 days before? No, 5 days BEFORE means 5-5=0. Let's use 5th as target.)
        
        // Let's use strictly 5 days before the 5th.
        // If target is 5th, 5 days before is the last day of previous month.
        // If today is the last day of the month, today + 5 days = 5th.
        
        if ($today->copy()->addDays(5)->day !== 5) {
            $this->info('Today is not a reminder day.');
            return;
        }

        $this->info('Processing donation reminders...');

        $month = $today->copy()->addDays(5)->month;

        // 1. Monthly Reminders (Every month)
        $monthlyDonators = \App\Models\Donator::where('periodicity', 1)->get();
        foreach ($monthlyDonators as $donator) {
            $this->info('Sending monthly reminder to ' . $donator->email);
            \Illuminate\Support\Facades\Mail::to($donator->email)->queue(new \App\Mail\DonationReminder($donator, 'Monthly Donation Reminder'));
        }

        // 2. Yearly Reminders (Only if target month is January)
        if ($month == 1) {
            $yearlyDonators = \App\Models\Donator::where('periodicity', 12)->get();
            foreach ($yearlyDonators as $donator) {
                \Illuminate\Support\Facades\Mail::to($donator->email)->queue(new \App\Mail\DonationReminder($donator, 'Yearly Donation Reminder'));
            }
        }

        // 3. Semester Reminders (If target month is January or July)
        if ($month == 1 || $month == 7) {
            $semesterDonators = \App\Models\Donator::where('periodicity', 6)->get();
            foreach ($semesterDonators as $donator) {
                \Illuminate\Support\Facades\Mail::to($donator->email)->queue(new \App\Mail\DonationReminder($donator, 'Semi-Annual Donation Reminder'));
            }
        }

        $this->info('Reminders sent successfully.');
    }
}
