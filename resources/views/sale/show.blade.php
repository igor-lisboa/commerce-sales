<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="3;url=<?= route('sale_invoice', [$sale]) ?>">
    <title>Nota Fiscal</title>
</head>

<body>
    @include('sale.invoice')
</body>

</html>