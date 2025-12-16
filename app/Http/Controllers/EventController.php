<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    /**
     * Affiche la liste de tous les événements.
     */
    public function index()
    {
        // Récupère tous les événements depuis la base de données, triés par date de début croissante
        $events = Event::orderBy('start_time', 'asc')->get();

        // Retourne la vue 'events.index' et lui passe les événements via compact('events')
        return view('events.index', compact('events'));
    }

    /**
     * Affiche le formulaire pour créer un nouvel événement.
     */
    public function create()
    {
        // Retourne simplement la vue du formulaire de création
        return view('events.create');
    }

    /**
     * Enregistre un nouvel événement dans la base de données.
     */
    public function store(Request $request)
    {
        // Validation des données envoyées depuis le formulaire
        $request->validate([
            'title' => 'required|string|max:255',       // Le titre est obligatoire, chaîne de caractères max 255
            'description' => 'nullable|string',         // La description est optionnelle
            'start_time' => 'required|date',            // La date de début est obligatoire et doit être valide
            'end_time' => 'nullable|date|after_or_equal:start_time', // La date de fin est optionnelle et doit être après ou égale à la date de début
        ]);

        // Création du nouvel événement dans la base avec les données validées
        Event::create($request->all());

        // Redirection vers la liste des événements avec un message de succès
        return redirect()->route('events.index')->with('success', 'Événement ajouté !');
    }

    /**
     * Affiche le formulaire pour éditer un événement existant.
     */
    public function edit(Event $event)
    {
        // Passe l'événement à la vue d'édition
        return view('events.edit', compact('event'));
    }

    /**
     * Met à jour un événement existant dans la base.
     */
    public function update(Request $request, Event $event)
    {
        // Validation des données comme pour la création
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'required|date',
            'end_time' => 'nullable|date|after_or_equal:start_time',
        ]);

        // Mise à jour de l'événement avec les nouvelles données
        $event->update($request->all());

        // Redirection vers la liste des événements avec un message de succès
        return redirect()->route('events.index')->with('success', 'Événement mis à jour !');
    }

    /**
     * Supprime un événement de la base de données.
     */
    public function destroy(Event $event)
    {
        // Suppression de l'événement
        $event->delete();

        // Redirection vers la liste avec message de confirmation
        return redirect()->route('events.index')->with('success', 'Événement supprimé !');
    }
}
