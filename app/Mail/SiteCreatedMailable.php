<?php
/**
 * @class        SiteCreatedMailable
 * @package     App\Mail
 * @since       v0.1.0
 * @author      Andre Board <dre.board@gmail.com>
 * @version     v1.0
 * @access      public
 * @see         https://github.com/dreboard
 */
namespace App\Mail;

use App\Site;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class SiteCreatedMailable extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The cycle instance.
     *
     * @var Site
     */
    public $site;

    /**
     * Create a new message instance.
     *
     * @param Site $site
     */
    public function __construct(Site $site)
    {
        $this->site = $site;
    }

    /**
     * Build the message.
     * {@internal Global from Address already set}}
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.site_create')
            ->with([
                'title' => $this->site->title,
                'url' => $this->site->url,
                'end_date' => $this->site->git_url
            ]);
    }
}
