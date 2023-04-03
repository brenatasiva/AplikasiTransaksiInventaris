@extends('layout.sbadmin') 

@section('content')

<body onload="window.print(); self.close();">
    @foreach ($invoice as $i)
            <div align="center">
		<table width="500" border="0" cellpadding="1" cellspacing="0">
			<tr>
				<th>Toko Maju <br>
					Alamat <br></th>
			</tr>
			<tr align="center"><td><hr></td></tr>
			<tr>
				<td>#{{$i['invoice_id']}}</td>
			</tr>
			<tr><td><hr></td></tr>
		</table>
		<table width="500" border="0" cellpadding="3" cellspacing="0">
            <thead>
                <tr>
                    <td>Item</td>
                    <td>Harga</td>
                    <td>Qty</td>
                    <td>Subtotal</td>
                </tr>
            </thead>
            <tr align="center"><td><hr></td></tr>
            @foreach($invoiceDetails as $iD)
                <tr>
                    <td>{{$iD['item_name']}}</td>
                    <td>{{number_format($iD['price'])}}</td>
                    <td>{{$iD['quantity']}}</td>
                    <td>{{number_format($iD['subtotal'])}}</td>
                </tr>
            @endforeach
            <tr>
				<td colspan="4"><hr></td>
			</tr>
			<tr>
				<td align="right" colspan="3">Total</td>
				<td align="right">Rp. {{number_format($i['total'])}}</td>
			</tr>
			<tr>
				<td align="right" colspan="3">Bayar</td>
				<td align="right">Rp. {{number_format($i['pay'])}}</td>
			</tr>
			<tr>
				<td align="right" colspan="3">Kembali</td>
				<td align="right">Rp. {{number_format($i['pay']-$i['total'])}}</td>
			</tr>
        </table>
		<table width="500" border="0" cellpadding="1" cellspacing="0">
			<tr><td><hr></td></tr>
			<tr>
                <th>Terimkasih, Selamat Belanja Kembali</th>
			</tr>
			<tr>
                <th>===== Layanan Konsumen ====</th>
			</tr>
			<tr>
                <th>SMS/CALL 08123456789 </th>
			</tr>
		</table>
	</div>
    @endforeach
</body>

@endsection