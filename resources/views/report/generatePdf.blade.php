@extends('layout.sbadmin') 

@section('content')

{{-- 'invoice', 'startDate', 'endDate', 'omset', 'profit' --}}
<button class="btn" id="export" onclick="exportPDF('dataToPdf')">Save</button>
<div id="dataToPdf">
    <div class="form-group row">
        <div class="">
            <h3>Tanggal Awal {{$startDate}}</h3>
            <h3>Tanggal Akhir {{$endDate}}</h3>
            <h3>Omset: Rp. <span>{{number_format($omset)}}</span></h3>
            <h3>Keuntungan: Rp. <span>{{number_format($profit)}}</span></h3>
        </div>
    </div>
    <div class="form-group row">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Nota</th>
                    <th>Nama Penjual</th>
                    <th>Nama Pelanggan</th>
                    <th>Tanggal Pembelian</th>
                    <th>Total</th>
                    <th>Keuntungan</th>
                </tr>
            </thead>
            <tbody>
                @isset($invoice)
                @foreach ($invoice as $i)
                <tr>
                    <td>{{$i['invoice_id']}}</td>
                    <td>{{$i['seller_name']}}</td>
                    <td>{{$i['customer_name']}}</td>
                    <td>{{$i['date']}}</td>
                    <td>Rp. {{number_format($i['total'])}}</td>
                    <td>Rp. {{number_format($i['profit'])}}</td>
                </tr>
                @endforeach
                @endisset
            </tbody>
        </table>
    </div>
</div>

@endsection
@section('script')

<script>
    var specialElementHandlers = {
        // element with id of "bypass" - jQuery style selector
        '.no-export': function (element, renderer) {
            // true = "handled elsewhere, bypass text extraction"
            return true;
        }
    };

    function exportPDF(id) {
        var doc = new jsPDF('p', 'pt', 'a4');
        //A4 - 595x842 pts
        //https://www.gnu.org/software/gv/manual/html_node/Paper-Keywords-and-paper-size-in-points.html


        //Html source 
        var source = document.getElementById(id);
        console.log(source);
        var margins = {
            top: 10,
            bottom: 10,
            left: 10,
            width: 595
        };

        doc.fromHTML(
            source, // HTML string or DOM elem ref.
            margins.left,
            margins.top, {
                'width': margins.width,
                'elementHandlers': specialElementHandlers
        },

        function (dispose) {
            // dispose: object with X, Y of the last line add to the PDF 
            //          this allow the insertion of new lines after html
            doc.save('Test.pdf');
        }, margins);
    }
</script>
@endsection