<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\EnvioContratoPresupuesto;
use Illuminate\Support\Facades\Mail; 
 

class EnvioContratoPresupuestoJobs implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $mensaje; 
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($mensaje)
    {
        $this->mensaje=$mensaje;

        
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $envio = new EnvioContratoPresupuesto($this->mensaje);

        Mail::to($this->mensaje['email'])->send($envio);
 
    }
}
