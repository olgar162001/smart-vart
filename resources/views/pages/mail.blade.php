<p style="color:black;">Dear User,</p>
<p style="color:black;">We have prepared the following invoice for you: # {{$my_invoice->invoice_no}}</p>

@component('mail::message')
<h1 style="text-align: center;">INVOICE</h1>   

@component('mail::panel')
Invoice: {{$my_invoice->invoice_no}}<br>
Date: {{$my_invoice->created_at}}

@component('mail::table')

| Package                 | Description                 | Duration                 | Amount to Pay                             |
|:------------------------:|:---------------------------:|:------------------------:|:-----------------------------------------:|
| {{$my_invoice->package}}|{{$my_invoice->description}} |{{$my_invoice->duration}} Months |TZS {{number_format($my_invoice->price)}}/=    |

@endcomponent
    
@component('mail::button', ['url' => "vatapp.test/payment", 'color' => "success"])
View Invoice
@endcomponent

Kind Regards,
## SMART VAT App   

@endcomponent

@endcomponent
    

