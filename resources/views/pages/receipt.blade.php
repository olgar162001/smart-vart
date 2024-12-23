<p style="color:black;">Dear {{$my_receipt->name}},</p>
<p style="color:black;">We have confirmed your payment and sent your receipt: # {{$my_receipt->receipt_no}}</p>

@component('mail::message')
<h1 style="text-align: center;">RECEIPT</h1>   

@component('mail::panel')
Receipt: {{$my_receipt->receipt_no}}<br>
Date: {{$my_receipt->created_at}}

@component('mail::table')

| Package                 | Description                 | Duration                 | Amount Paid                             |
|:------------------------:|:---------------------------:|:------------------------:|:-----------------------------------------:|
| {{$my_receipt->package}}|{{$my_receipt->description}} |{{$my_receipt->duration}} Months |TZS {{number_format($my_receipt->amount_paid)}}|

@endcomponent
    
@component('mail::button', ['url' => "vatapp.test/dashboard", 'color' => "success"])
Go to Dashboard
@endcomponent

Kind Regards,
## SMART VAT App   

@endcomponent

@endcomponent
    

