<!DOCTYPE html>
<html>

<head>
    <title>Invoice {{ $invoice->invoice_number }}</title>
</head>

<body>
    <h1>Hello, {{ $invoice->createdBy->name }}</h1>
    <p>A new invoice has been {{ $action }} successfully.</p>
    <p><strong>Invoice Number:</strong> {{ $invoice->invoice_number }}</p>
    @if ($changes)
        <h3>Changes:</h3>
        <ul>
            @foreach ($changes as $key => $value)
                <li>{{ $key }}: {{ $value }}</li>
            @endforeach
        </ul>
    @endif
    <p>Thank you!</p>
</body>

</html>
