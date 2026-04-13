@if ($errors->any())
    <div style="
        background: #fef2f2;
        border-left: 4px solid #ef4444;
        color: #b91c1c;
        padding: 10px 14px;
        margin-bottom: 16px;
        border-radius: 4px;
        font-size: 14px;
    ">
        <strong>⚠ Data tidak lengkap:</strong>
        <ul style="margin: 6px 0 0 18px; padding: 0;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif