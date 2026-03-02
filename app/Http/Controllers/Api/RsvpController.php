<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use App\Models\Rsvp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\RsvpMail;

class RsvpController extends Controller
{
    public function index()
    {
        return Rsvp::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'ime' => 'required|string',
            'prezime' => 'required|string',
            'dolazi' => 'required|boolean',
            'broj_dodatnih' => 'nullable|integer|min:0',
            'dodatni_uzvanici' => 'nullable|array',
            'dodatni_uzvanici.*.ime' => 'required|string',
            'dodatni_uzvanici.*.prezime' => 'required|string',
        ]);

        try {
            $rsvp = Rsvp::create($data);
            Mail::to('karla.fisic@gmail.com')
                ->cc('darija.fisic@gmail.com')  
                ->send(new RsvpMail($rsvp));

            return response()->json([
                'message' => 'Hvala na odgovoru!',
                'success' => true
            ]);

        } catch (\Exception $e) {
            \Log::error('RSVP Email Error: ' . $e->getMessage());
            
            return response()->json([
                'message' => 'Potvrda je spremljena!',
                'success' => true,
                'warning' => 'Email obavijest možda nije poslana.'
            ]);
        }
    }

    public function show(string $id)
    {
        return Rsvp::findOrFail($id);
    }

    public function update(Request $request, string $id)
    {
        $rsvp = Rsvp::findOrFail($id);

        $data = $request->validate([
            'ime' => 'sometimes|string',
            'prezime' => 'sometimes|string',
            'dolazi' => 'sometimes|boolean',
            'broj_dodatnih' => 'nullable|integer|min:0',
            'dodatni_uzvanici' => 'nullable|array',
            'dodatni_uzvanici.*.ime' => 'required|string',
            'dodatni_uzvanici.*.prezime' => 'required|string',
        ]);

        $rsvp->update($data);

        return response()->json(['message' => 'RSVP je ažuriran ✅']);
    }

    public function destroy(string $id)
    {
        $rsvp = Rsvp::findOrFail($id);
        $rsvp->delete();

        return response()->json(['message' => 'RSVP je obrisan.']);
    }
}