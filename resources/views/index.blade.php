<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <div class="container">
        <iframe width="600" height="450" src="https://lookerstudio.google.com/embed/reporting/88bffaed-643f-4058-a9d9-4570792e288c/page/p_ej7wsggwhd" frameborder="0" style="border:0" allowfullscreen sandbox="allow-storage-access-by-user-activation allow-scripts allow-same-origin allow-popups allow-popups-to-escape-sandbox"></iframe>
    </div>

    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
        </tr>
        @foreach ($data as $d)
            <tr>
                <td>{{$d->name}}</td>
                <td>{{$d->email}}</td>
            </tr>
        @endforeach
        <tr>

</body>
</html>
