<!DOCTYPE html>
<html lang="tr">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"></head>
<body style="font-family: Arial, sans-serif; background: #f4f7fa; margin:0; padding:20px;">
<div style="max-width:580px;margin:0 auto;background:#fff;border-radius:8px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,.1);">
    <div style="background:#dc3545;padding:30px;text-align:center;">
        <h1 style="color:#fff;margin:0;font-size:24px;">❌ Randevunuz İptal Edildi</h1>
    </div>
    <div style="padding:30px;">
        <p>Merhaba <strong>{{ $appointment->user->name }}</strong>,</p>
        <p>Aşağıdaki randevunuz iptal edilmiştir:</p>

        <table style="width:100%;border-collapse:collapse;margin:20px 0;">
            <tr style="background:#f8f9fa;">
                <td style="padding:12px;border:1px solid #dee2e6;font-weight:bold;">Doktor</td>
                <td style="padding:12px;border:1px solid #dee2e6;">{{ $appointment->doctor->name }}</td>
            </tr>
            <tr>
                <td style="padding:12px;border:1px solid #dee2e6;font-weight:bold;">Tarih</td>
                <td style="padding:12px;border:1px solid #dee2e6;">{{ $appointment->timeSlot->slot_date->format('d.m.Y') }}</td>
            </tr>
            <tr style="background:#f8f9fa;">
                <td style="padding:12px;border:1px solid #dee2e6;font-weight:bold;">Saat</td>
                <td style="padding:12px;border:1px solid #dee2e6;">{{ substr($appointment->timeSlot->slot_time, 0, 5) }}</td>
            </tr>
        </table>

        <p style="color:#6c757d;font-size:14px;">Yeni randevu almak için uygulamamızı ziyaret edebilirsiniz.</p>
    </div>
    <div style="background:#f8f9fa;padding:15px;text-align:center;color:#6c757d;font-size:12px;">
        Sağlık Kabini Randevu Sistemi
    </div>
</div>
</body>
</html>
