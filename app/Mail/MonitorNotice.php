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
    protected $statusText;

    /**
     * Create a new message instance.
     *
     * @param $statusText
     * @param Snapshot $snapshot
     */
    public function __construct($statusText, Snapshot $snapshot)
    {
        $this->statusText = $statusText;
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
        return $this->view('emails.monitor.notice')
            ->subject("{$title}[{$host}]: [$this->statusText]")
            ->with('statusText', $this->statusText)
            ->with('snapshot', $this->snapshot);
    }
}
