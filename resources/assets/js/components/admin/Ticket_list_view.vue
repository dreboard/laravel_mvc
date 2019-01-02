<template>
    <div>
        <h3>Tickets</h3>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newTicketForm">
            New Ticket
        </button>
        <table border="0" cellspacing="0" cellpadding="0">
            <thead>
            <tr>
                <th class="text-left">Name</th>
                <th class="text-right">Created</th>
                <th class="text-right">Due</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="ticket in tickets">
                <td class="w-75 text-left">{{ ticket.title }}</td>
                <td class="unit">{{ticket.create_date }}</td>
                <td class="qty">{{ ticket.due_date }}</td>
            </tr>

            </tbody>
            <tfoot>
            <tr>
                <th class="text-left">Info Name</th>
                <th class="text-right">Created</th>
                <th class="text-right">Due</th>
            </tr>
            </tfoot>
        </table>

        <!-- Modal -->


    </div>
    <!-- /.row -->
</template>

<script>

    export default {
        props: ['tickets', 'get_ticket_url'],
        data() {
            return {
                tickets: [],
                tickets_form: {
                    title: '',
                    description: '',
                    create_date: '',
                    due_date: '',
                    git_tag: ''
                },
            }
        },
        methods: {
            getTickets() {
                axios.get(this.project_tickets_url)
                    .then((response)=>{
                        this.tickets = response.data.tickets;
                        console.log(this.tickets);

                    }).catch((error)=>{
                    if (ENVIRONMENT === "local") {
                        console.log(error);
                    }
                });
            },projectUrl(ticket) {
                return route('api.project', {id: ticket.id})
            },

        },
        created(){
            this.getTickets()
        },
        mounted() {
            if (ENVIRONMENT === "local") {
                console.log(this.tickets);
            }
        }
    }
</script>
