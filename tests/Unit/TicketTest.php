<?php

namespace Tests\Unit;

use App\User;
use App\Ticket;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class TicketTest extends TestCase
{

    /**
     * @var string
     */
    private $table = 'tickets';

    private $complete = [10,20,30,40,50];

    private $status = ['working','complete','closed'];

    /**
     * @covers TicketController::save
     *
     * A form post to save a ticket.
     * @internal code 302 (return redirect()->route('ticket_view', ['id' => $ticket_id]);)
     *
     * @return void
     */
    public function testCanPostTicket()
    {
        $this->withoutMiddleware();
        $user = User::find(2);
        $ticket = factory(\App\Ticket::class)->make();
        $response = $this->actingAs($user, 'web')->json('POST', route('ticket_save'),$ticket->toArray());
        $response->assertStatus(302);
    }

    /**
     * Test ticket can be saved in database.
     * @internal code 302 (return redirect()->route('ticket_view', ['id' => $ticket_id]);)
     *
     * @return void
     */
    public function testCanCreateTicket()
    {
        $this->withoutMiddleware();
        $ticket = factory(\App\Ticket::class)->create();
        $this->assertDatabaseHas($this->table, ['id' => $ticket->id]);
    }

    /**
     * @covers TicketController::changeCompleted
     * Test ticket completed update.
     *
     * @return void
     */
    public function testChangeTicketComplete()
    {
        $complete = $this->complete[array_rand($this->complete)];
        $this->withoutMiddleware();
        $user = User::find(2);
        $ticket = factory(\App\Ticket::class)->create();
        $response = $this->actingAs($user, 'web')
            ->json('POST', route('ticket_edit_complete'),[
                'ticket_id' => $ticket->id,
                'completed' => $complete
            ]);
        $this->assertDatabaseHas($this->table, ['id' => $ticket->id, 'completed' => $complete]);
        $response->assertStatus(200);
    }

    /**
     * @covers TicketController::changeStatus
     * Test ticket status update.
     *
     * @return void
     */
    public function testChangeTicketStatus()
    {
        $status = $this->status[array_rand($this->status)];
        $this->withoutMiddleware();
        $user = User::find(2);
        $ticket = factory(\App\Ticket::class)->create();
        $response = $this->actingAs($user, 'web')
            ->json('POST', route('ticket_edit_status'),[
                'ticket_id' => $ticket->id,
                'status' => $status
            ]);
        $this->assertDatabaseHas($this->table, ['id' => $ticket->id, 'status' => $status]);
        $response->assertStatus(200);
    }
}
