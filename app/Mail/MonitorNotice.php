<?php

namespace App\Mail;

use App\Snapshot;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MonitorNotice extends Mailable
{
    use Queueable, SerializesModels;
    protected $snapshot;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Snapshot $snapshot)
    {
        $this->snapshot = $snapshot;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.monitor.notice')->with('snapshot', $this->snapshot);
    }
}
