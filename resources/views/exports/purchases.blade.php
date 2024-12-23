<table>
    <thead>
        <tr>
            <th><strong>{{'s/n'}}</strong></th>
            <th><strong>{{'Supplier Name'}}</strong></th>
            <th><strong>{{'Goods Description'}}</strong></th>
            <th><strong>{{'URL'}}</strong></th>
            <th><strong>{{'Amount Inclusive'}}</strong></th>
            <th><strong>{{'Amount Exclusive'}}</strong></th>
            <th><strong>{{'VAT'}}</strong></th>
            <th><strong>{{'Date'}}</strong></th>
        </tr>
    </thead>

    <tbody>
            @foreach($purchases as $i => $purchase)
                <tr>
                    <td>{{$i + 1}}</td>
                    <td>{{$purchase->supplier_name}}</td>
                    <td>{{$purchase->goods_description}}</td>
                    <td>{{$purchase->url}}</td>
                    <td>{{number_format($purchase->amount_inclusive, 2)}}</td>
                    <td>{{number_format($purchase->amount_exclusive,2)}}</td>
                    <td>{{number_format($purchase->vat,2)}}</td>
                    <td>{{$purchase->created_at}}</td>
                </tr>
            @endforeach
        
    </tbody>

    <tfoot>
        <tr>
            <td></td>
            <th><strong>TOTAL PURCHASES</strong></th>
            <td></td>
            <td></td>
            <th><strong>{{number_format($purchases->sum('amount_inclusive'),2)}}</strong></th>
            <th><strong>{{number_format($purchases->sum('amount_exclusive'),2)}}</strong></th>
            <th><strong>{{number_format($purchases->sum('vat'),2)}}</strong></th>
            <td></td>
        </tr>
    </tfoot>
</table>

<table>
    <tbody>
        <tr></tr>
        <tr></tr>
        <tr></tr>
    </tbody>

    <tfoot>
        <tr>
            <td></td>
            <th><strong>TOTAL SALES</strong></th>
            <td></td>
            <td></td>
            <th><strong>{{number_format($sales->sum('total_inclusive_sales'),2)}}</strong></th>
            <th><strong>{{number_format($sales->sum('total_exclusive_sales'),2)}}</strong></th>
            <th><strong>{{number_format($sales->sum('total_sales_vat'),2)}}</strong></th>
            <td></td>
        </tr>
    </tfoot>
</table>

<table>
    <tbody>
        <tr></tr>
        <tr></tr>
        <tr></tr>
    </tbody>

    <tfoot>
        <tr>
            <td></td>
            <th><strong>VAT DIFFERENCE</strong></th>
            <td></td>
            <th><strong>{{number_format((($sales->sum('total_sales_vat')) - ($purchases->sum('vat'))),2)}}</strong></th>
            <td></td>
        </tr>

        <tr>
            <td></td>
            <td><strong>REMARKS</strong></td>
            <td></td>
            @if (($sales->sum('total_sales_vat')) > ($purchases->sum('vat')))
                <td><strong>Pay</strong></td> 
            @else
                <td><strong>Refund</strong></td>
            @endif
        </tr>
    </tfoot>
</table>

