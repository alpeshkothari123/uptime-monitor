<x-mail::message>

# {{ $website->url }} is down!

This is an automated alert to notify you that **{{ $website->url }}** is currently unreachable or returned an error during the last check.

Thanks,

Uptime Monitor
<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
