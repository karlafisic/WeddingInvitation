<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            max-width: 600px;
            margin: 0 auto;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            color: #42a5f5;
            border-bottom: 3px solid #bbdefb;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }
        .status {
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
        }
        .coming {
            background-color: #e8f5e9;
            color: #2e7d32;
        }
        .not-coming {
            background-color: #ffebee;
            color: #c62828;
        }
        .info-row {
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        .label {
            font-weight: bold;
            color: #666;
        }
        .guests-list {
            background-color: #e3f2fd;
            padding: 15px;
            border-radius: 8px;
            margin-top: 15px;
        }
        .guest-item {
            padding: 8px;
            background: white;
            margin: 5px 0;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>♡ Nova RSVP Potvrda ♡</h1>
        </div>

        <div class="status {{ $rsvp->dolazi ? 'coming' : 'not-coming' }}">
            @if($rsvp->dolazi)
                ✅ DOLAZI NA VJENČANJE
            @else
                ❌ NE MOŽE DOĆI
            @endif
        </div>

        <div class="info-row">
            <span class="label">Ime i prezime:</span>
            {{ $rsvp->ime }} {{ $rsvp->prezime }}
        </div>

        @if($rsvp->dolazi && $rsvp->broj_dodatnih > 0)
            <div class="info-row">
                <span class="label">Broj dodatnih osoba:</span>
                {{ $rsvp->broj_dodatnih }}
            </div>

            @if($rsvp->dodatni_uzvanici && count($rsvp->dodatni_uzvanici) > 0)
                <div class="guests-list">
                    <strong>Dodatni uzvanici:</strong>
                    @foreach($rsvp->dodatni_uzvanici as $index => $guest)
                        <div class="guest-item">
                            {{ $index + 1 }}. {{ $guest['ime'] }} {{ $guest['prezime'] }}
                        </div>
                    @endforeach
                </div>
            @endif
        @endif

        <div style="margin-top: 30px; padding-top: 20px; border-top: 2px solid #bbdefb; text-align: center; color: #999; font-size: 14px;">
            <p>Ova poruka je automatski generirana sa vaše vjenčane stranice.</p>
            <p style="color: #42a5f5; font-style: italic;">S ljubavlju ♡ Darija & Ljubo ♡</p>
        </div>
    </div>
</body>
</html>