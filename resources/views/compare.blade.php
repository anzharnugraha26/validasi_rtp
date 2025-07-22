<!DOCTYPE html>
<html>
<head>
    <title>Compare Excel Files</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5">
    <div class="container">
        <h2>Compare Two Excel Files</h2>
        <form action="{{ route('compare.excel') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label>File Excel 1</label>
                <input type="file" name="file1" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>File Excel 2</label>
                <input type="file" name="file2" class="form-control" required>
            </div>
            <button class="btn btn-primary">Compare</button>
        </form>

        @if(isset($differences))
            <hr>
            <h4>Differences:</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Row</th>
                        <th>Column</th>
                        <th>File 1</th>
                        <th>File 2</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($differences as $diff)
                        <tr>
                            <td>{{ $diff['row'] }}</td>
                            <td>{{ $diff['col'] }}</td>
                            <td>{{ $diff['file1'] }}</td>
                            <td>{{ $diff['file2'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>
