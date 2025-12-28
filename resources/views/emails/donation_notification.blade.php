<x-mail::message>
# {{ $type === 'donation' ? 'New Donation Submission' : 'New Contact Inquiry' }}

A new submission has been received from the website.

**Details:**
@if($type === 'donation')
- **Name:** {{ $data['name'] }}
- **Email:** {{ $data['email'] }}
- **Phone:** {{ $data['phone'] ?? 'N/A' }}
- **Amount:** {{ $data['target_amount'] }} {{ $data['currency'] }}
- **Frequency:** {{ $data['periodicity'] }}
@else
- **Email:** {{ $data['email'] }}
- **Message:** 
{{ $data['message'] }}
@endif

<x-mail::button :url="url('/admin/dashboard')" color="primary">
Go to Admin Panel
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
