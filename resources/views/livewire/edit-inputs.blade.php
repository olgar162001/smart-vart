<div class="container my-4 bg-secondary-subtle rounded p-4">
    <h2 class="py-2 text-center">Edit Purchase</h2>
    {{ html()->form('PUT','/purchase/'.$purchase->id)->open()}}
        {{ html()->div()->class('form-group my-4')->open()}}
            {{ html()->label('Supplier Name')->class('form-label') }}
            {{ html()->text('supplier_name')->attributes(['class'=>'form-control', 'value' => "$supplierName", 'wire:model'=> 'supplierName']) }}
        {{ html()->div()->close() }}

        {{ html()->div()->class('form-group my-4')->open()}}
            {{ html()->label('Goods Description')->class('form-label') }}
            {{ html()->textarea('goods')->attributes(['class'=>'form-control', 'value'=> "$goods", 'wire:model'=> 'goods',]) }}
        {{ html()->div()->close() }}

        {{ html()->div()->class('form-group my-4')->open()}}
            {{ html()->label('URL')->class('form-label') }}
            {{ html()->text('url')->attributes(['class'=>'form-control', 'value' => "$url", 'wire:model'=> 'url']) }}
        {{ html()->div()->close() }}

        {{ html()->div()->class('form-group my-4')->open()}}
            {{ html()->label('Amount Inclusive')->class('form-label') }}
            {{ html()->number('amount_inclusive')->attributes(['placeholder'=>'TZS', 'value'=>$inclusiveInput, 'wire:model'=> 'inclusiveInput', 'wire:keyup'=>'update', 'class'=>'form-control']) }}
        {{ html()->div()->close() }}

        {{ html()->div()->class('form-group my-4')->open()}}
            {{ html()->label('Amount Exlcusive')->class('form-label') }}
            {{ html()->number('amount_exclusive')->attributes(['placeholder'=>'TZS', 'value'=>$exclusiveInput, 'wire:model'=> 'exclusiveInput', 'class'=>'form-control', 'readonly']) }}
        {{ html()->div()->close() }}

        {{ html()->div()->class('form-group my-4')->open()}}
            {{ html()->label('VAT')->class('form-label') }}
            {{ html()->number('vat')->attributes(['placeholder'=>'TZS', 'value'=>$vatInput, 'wire:model'=> 'vatInput', 'class'=>'form-control', 'readonly']) }}
        {{ html()->div()->close() }}

        {{ html()->div()->class('form-group my-4')->open()}}
            {{ html()->submit('Edit')->class('btn btn-dark form-control') }}
        {{ html()->div()->close() }}


    {{html()->form()->close()}}
</div>

