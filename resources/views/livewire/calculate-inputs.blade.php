<div class="container my-4 bg-secondary-subtle rounded p-4">
    <h2 class="py-2 text-center">Purchase Details</h2>
    {{ html()->form('POST','/purchase')->open()}}
        {{ html()->div()->class('form-group my-4')->open()}}
            {{ html()->label('Supplier Name')->class('form-label') }}
            {{ html()->text('supplier_name')->class('form-control') }}
        {{ html()->div()->close() }}

        {{ html()->div()->class('form-group my-4')->open()}}
            {{ html()->label('Goods Description')->class('form-label') }}
            {{ html()->textarea('goods')->class('form-control') }}
        {{ html()->div()->close() }}

        {{ html()->div()->class('form-group my-4')->open()}}
            {{ html()->label('URL')->class('form-label') }}
            {{ html()->text('url')->class('form-control') }}
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
            {{ html()->submit('Submit')->class('btn btn-dark bg-gradient form-control') }}
        {{ html()->div()->close() }}


    {{html()->form()->close()}}
</div>
