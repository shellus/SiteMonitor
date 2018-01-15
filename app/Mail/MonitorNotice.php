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
     * @param $statusText
     * @param Snapshot $snapshot
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
        $host = parse_url($this->snapshot->monitor->request_url, PHP_URL_HOST);

        $title = $this->snapshot->monitor->title;
        $statusText = $this->snapshot->status_text;
        $statusMessage = $this->snapshot->status_message;
        return $this->view('emails.monitor.notice')
            ->subject("{$title}[{$host}]: [$statusText] {$statusMessage}")
            ->with('snapshot', $this->snapshot);
    }
}
