<div class="container my-4 bg-secondary-subtle rounded p-4">
    <h2 class="py-2 text-center">Sales Details</h2>
    {{ html()->form('POST','/sales')->open()}}

        {{ html()->div()->class('form-group my-4')->open()}}
            {{ html()->label('Total Inclusive Sales')->class('form-label') }}
            {{ html()->number('total_inclusive_sales')->attributes(['placeholder'=>'TZS', 'value'=>$totalInclusive, 'wire:model'=> 'totalInclusive', 'wire:keyup'=>'update', 'class'=>'form-control']) }}
        {{ html()->div()->close() }}

        {{ html()->div()->class('form-group my-4')->open()}}
            {{ html()->label('Total Exlcusive Sales')->class('form-label') }}
            {{ html()->number('total_exclusive_sales')->attributes(['placeholder'=>'TZS', 'value'=>$totalExclusive, 'wire:model'=> 'totalExclusive', 'class'=>'form-control', 'readonly']) }}
        {{ html()->div()->close() }}

        {{ html()->div()->class('form-group my-4')->open()}}
            {{ html()->label('Total Sales VAT')->class('form-label') }}
            {{ html()->number('total_sales_vat')->attributes(['placeholder'=>'TZS', 'value'=>$totalVat,  'wire:model'=> 'totalVat', 'class'=>'form-control', 'readonly']) }}
        {{ html()->div()->close() }}

        {{ html()->div()->class('form-group my-4')->open()}}
            {{ html()->label('Month')->class('form-label') }}

            {{ html()->select('Month')->attributes(['name'=>'Month', 'class'=>'form-select'])->open() }}  
                {{html()->option('January')->value('January')}}  
                {{html()->option('February')->value('February')}}  
                {{html()->option('March')->value('March')}}  
                {{html()->option('April')->value('April')}}  
                {{html()->option('May')->value('May')}}  
                {{html()->option('June')->value('June')}}  
                {{html()->option('July')->value('July')}}  
                {{html()->option('August')->value('August')}}  
                {{html()->option('September')->value('September')}}  
                {{html()->option('October')->value('October')}}
                {{html()->option('November')->value('November')}}  
                {{html()->option('December')->value('December')}}      
            {{html()->select()->close()}}

        {{ html()->div()->close() }}

        {{ html()->div()->class('form-group my-4')->open()}}
            {{ html()->submit('Submit')->class('btn btn-dark bg-gradient form-control') }}
        {{ html()->div()->close() }}


    {{html()->form()->close()}}
</div>
