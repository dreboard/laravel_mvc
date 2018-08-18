<?php

namespace App\Services;


use App\Helpers\DateHelper;
use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class TicketService
 * @package App\Services
 */
class TicketService
{

    /**
     * @param Request $request
     * @return Ticket
     */
    public function processNewTicket(Request $request)
    {
        $ticket = new Ticket();
        $ticket->title = $request->title;
        $ticket->description = $request->description;
        $ticket->due_date = DateHelper::formatTicketEndDate($request->input('due_date'));
        $ticket->create_date = date('Y-m-d h:i:s');
        $ticket->project_id = $request->project_id ?? 0;
        $ticket->created_by = Auth::user()->id;
        $ticket->save();

        return $ticket;
    }
}