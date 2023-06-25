<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();

        if ($events->isEmpty()) {
            return response()->json(['message' => 'Nenhum evento encontrado'], 404);
        }

        return response()->json($events, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'date' => 'required|date',
            'place' => 'required',
            'value' => 'required|numeric',
        ]);

        $event = new Event;
        $event->name = $request->name;
        $event->description = $request->description;
        $event->date = $request->date;
        $event->place = $request->place;
        $event->value = $request->value;
        $event->save();

        return response()->json($event, 200);
    }

    public function show($id)
    {
        $event = Event::find($id);

        if (!$event) {
            return response()->json(['message' => 'Evento não encontrado'], 404);
        }

        return response()->json($event, 200);
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'date' => 'required|date',
            'place' => 'required',
            'value' => 'required|numeric',
        ]);

        try {
            $event = Event::findOrFail($event->id);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['error' => 'Evento não encontrado.'], 404);
        }

        $event->update([
            'name' => $request->name,
            'description' => $request->description,
            'date' => $request->date,
            'place' => $request->place,
            'value' => $request->value,
        ]);

        return response()->json(['message' => 'Evento atualizado com sucesso.'], 200);
    }

    public function destroy(Event $event)
    {
        try {
            $event = Event::findOrFail($event->id);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['message' => 'Evento não encontrado'], 404);
        }

        $event->delete();

        return response()->json(['message' => 'Evento deletado com sucesso'], 200);
    }
}
