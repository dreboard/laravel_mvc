<?php
/**
 * @class        TicketService
 * @package     App\Services
 * @since       v0.1.0
 * @author      Andre Board <dre.board@gmail.com>
 * @version     v1.0
 * @access      public
 * @see         https://github.com/dreboard
 */
namespace App\Services;

use App\Helpers\DateHelper;
use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketService
{

    /**
     * Process New Ticket
     * @param Request $request
     * @return Ticket
     */
    public function processNewTicket(Request $request)
    {
        $ticket = Ticket::create([
            'title' => request('title'),
            'description' => request('description'),
            'due_date' => DateHelper::formatTicketEndDate(request('due_date')),
            'create_date' => date('Y-m-d h:i:s'),
            'project_id' => request('project_id'),
            'created_by' => Auth::user()->id,
        ]);
        return $ticket->id;
    }
}