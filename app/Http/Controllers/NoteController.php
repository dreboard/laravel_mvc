<?php

namespace App\Http\Controllers;

use App\Notes;
use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class NoteController extends Controller
{

    public function getAllTicketNotes(int $ticket_id)
    {
        $notes = DB::table('notes')->where('ticket_id', $ticket_id)->orderBy('id', 'desc')->get();
        return response()->json(['notes' => $notes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @todo Fix gate (new-note) for open edit //if(Gate::allows('new-note', $ticket)){
     */
    public function store(Request $request)
    {
        $request->validate([
            'note' => 'required'
        ]);
        try{
            $note = new Notes();
            $ticket = Ticket::find($request->ticket_id);

            if($ticket->open_edit == 1){
                $note->note = $request->note;
                $note->ticket_id = $request->ticket_id;
                $note->note_date = date('Y-m-d H:i:s');
                $note->site_id = $request->site_id ?? 0;
                $note->save();
                $this->allowed = 'Note added';
                return response()->json(['allowed' => $this->allowed, 'note_id' =>$note->id], 200);
            }
            return response()->json(['complete' => 0, 'allowed' => 'Project Not Open For Adding', 'note_id' => 0, 'title' => 'No Title'], 200);

        }catch (\Throwable $e){
            \Log::error($e->getMessage());
            return response()->json(['allowed' => 'Note Not Added']);
        }

    }

    public function deleteTicketNote(Request $request)
    {
        try{
            $note = Notes::find($request->note_id);
            $note->delete();
            $this->allowed = 'Note deleted';
            return response()->json(['allowed' => $this->allowed, 'note_id' =>$note->id], 200);
        }catch (\Throwable $e){
            \Log::error($e->getMessage());
            return response()->json(['allowed' => 'Note Not Deleted']);
        }

    }
}
