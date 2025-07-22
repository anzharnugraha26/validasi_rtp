<?php
$name = $validasi->client . '_result';
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=$name.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>


<table border="1">
    <thead>
        <tr>
           <th>SIM ID</th>
           <th>PARAMETER</th>
           <th>FILE 1</th>
           <th>FILE 2</th>

        </tr>
    </thead>

    <tbody>
        @foreach ($data as $item)
            <tr>
                <td>{{ $item->sim_id }}</td>
                <td>{{ $item->parameter }}</td>
                <td>{{ $item->file1 }}</td>
                <td>{{ $item->file2 }}</td>
            </tr>
        @endforeach
    </tbody>

</table>
