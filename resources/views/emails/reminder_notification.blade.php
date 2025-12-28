<x-mail::message>
# {{ $title }}

Dear {{ $donator->name }},

We hope this email finds you well.

This is a gentle reminder regarding your commitment to supporting the **Manna Initiative**. Your contributions play a vital role in providing scholarships and support to our beneficiaries.

Your scheduled donation is coming up. If you've already made your contribution for this period, please disregard this message and thank you for your generosity!

<x-mail::button :url="config('app.url') . '/get-involved'" color="primary">
Support Manna Initiative
</x-mail::button>

Thanks,<br>
**{{ config('app.name') }} Team**
</x-mail::message>
