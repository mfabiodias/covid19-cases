<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
  

        <title>Casos de Covid-19 no Brasil</title>
    </head>

    <body>

        <div class="container mt-5">
            <h1 class="text-center">Total de casos de COVID no Brasil</h1>
            <table id="covid-data" class="table table-striped mt-5">
                <thead>
                  <tr>
                    <th scope="col">Ano</th>
                    <th scope="col">Mês</th>
                    <th scope="col">Casos</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($cases->original as $year => $datas)
                    @foreach ($datas as $data)
                    <tr>
                        <td>{{$year}}</td>
                        <td>{{$data["month"]}}</td>
                        <td>{{number_format($data["total"], 0,",",".")}}</td>
                    </tr>
                    @endforeach
                @endforeach
                </tbody>
            </table>
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#covid-data').DataTable();
        } );
    </script>
</html>
