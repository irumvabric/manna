@extends('layouts.admin')

@section('title', 'System Settings')
@section('page-title', 'System Settings')

@section('content')
    <div class="d-flex flex-column gap-4" style="max-width: 800px;">

        <!-- Header Section -->
        <div>
            <h4 class="fw-bold text-dark mb-1">System Settings</h4>
            <p class="text-muted mb-0">Configure system-wide preferences and notifications</p>
        </div>

        @if (session('success'))
            <div class="alert alert-success border-0 shadow-sm d-flex align-items-center gap-2 mb-0" role="alert"
                style="background-color: #d1fae5; color: #047857;">
                <i data-lucide="check-circle" style="width: 18px; height: 18px;"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf
            <div class="d-flex flex-column gap-4">

                <!-- Notification Settings -->
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center gap-2 mb-4">
                            <i data-lucide="bell" style="width: 20px; height: 20px;" class="text-muted"></i>
                            <h6 class="fw-semibold text-dark mb-0">Notification Settings</h6>
                        </div>

                        <div class="d-flex flex-column gap-4">
                            <!-- Email Notifications -->
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="fw-medium text-dark">Email Notifications</div>
                                    <div class="text-muted small">Send email notifications to donators</div>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        name="email_notifications" id="emailNotifications" @checked(old('email_notifications', $settings['email_notifications'] ?? false))
                                        style="width: 40px; height: 20px;">
                                </div>
                            </div>

                            <!-- Late Payment Alerts -->
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="fw-medium text-dark">Late Payment Alerts</div>
                                    <div class="text-muted small">Notify donators about overdue payments</div>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        name="late_payment_alerts" id="latePaymentAlerts" @checked(old('late_payment_alerts', $settings['late_payment_alerts'] ?? false))
                                        style="width: 40px; height: 20px;">
                                </div>
                            </div>

                            <!-- Reminder Days -->
                            <div>
                                <label for="reminderDays" class="form-label fw-medium text-dark">Reminder Days Before Due
                                    Date</label>
                                <input type="number" class="form-control" id="reminderDays" name="reminder_days"
                                    value="{{ old('reminder_days', $settings['reminder_days'] ?? 7) }}">
                                <div class="form-text text-muted">Send reminders this many days before payment is due</div>
                                @error('reminder_days')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Approval Settings -->
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center gap-2 mb-4">
                            <i data-lucide="users" style="width: 20px; height: 20px;" class="text-muted"></i>
                            <h6 class="fw-semibold text-dark mb-0">Approval Settings</h6>
                        </div>

                        <!-- Auto-Approval -->
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="fw-medium text-dark">Auto-Approval</div>
                                <div class="text-muted small">Automatically approve donations without admin review</div>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" name="auto_approval"
                                    id="autoApproval" @checked(old('auto_approval', $settings['auto_approval'] ?? false)) style="width: 40px; height: 20px;">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Admin Settings -->
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center gap-2 mb-4">
                            <i data-lucide="mail" style="width: 20px; height: 20px;" class="text-muted"></i>
                            <h6 class="fw-semibold text-dark mb-0">Admin Settings</h6>
                        </div>

                        <!-- Admin Email -->
                        <div>
                            <label for="adminEmail" class="form-label fw-medium text-dark">Admin Email Address</label>
                            <input type="email" class="form-control" id="adminEmail" name="admin_email"
                                value="{{ old('admin_email', $settings['admin_email'] ?? 'admin@donation.com') }}">
                            <div class="form-text text-muted">Receive system notifications at this email</div>
                            @error('admin_email')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Save Button -->
                <div class="d-flex justify-content-end mt-2">
                    <button type="submit"
                        class="btn btn-primary d-flex align-items-center gap-2 px-4 py-2 shadow-sm fw-medium">
                        <i data-lucide="save" style="width: 18px; height: 18px;"></i>
                        <span>Save Settings</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
