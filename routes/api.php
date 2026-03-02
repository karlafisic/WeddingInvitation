<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RsvpController;

//Route::get('/rsvps', [RsvpController::class, 'index']);          // svi RSVP-evi
//Route::get('/rsvps/{id}', [RsvpController::class, 'show']);      // jedan RSVP
Route::post('/rsvps', [RsvpController::class, 'store']);         
//Route::put('/rsvps/{id}', [RsvpController::class, 'update']);    // update RSVP
//Route::delete('/rsvps/{id}', [RsvpController::class, 'destroy']); // delete RSVP

