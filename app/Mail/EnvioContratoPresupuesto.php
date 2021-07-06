<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels; 
 //implements ShouldQueue



 use App\Models\Pedido; 
 use App\Models\Servicio;
 use App\Models\Equipo;
 use App\Models\Tubo;  
 use App\Models\Registro;
 use Barryvdh\DomPDF\Facade as PDF;
 use Luecano\NumeroALetras\NumeroALetras;

class EnvioContratoPresupuesto extends Mailable  
{
    use Queueable, SerializesModels;   
    public $mensaje;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mensaje)
    {
        $this->mensaje=$mensaje;

        $pedido=Pedido::find($this->mensaje['id']);  
        $equipoER=Equipo::find($pedido->dispoER); 
        $equipoEA=Equipo::find($pedido->dispoEA); 
        $equipoEY=Equipo::find($pedido->dispoEY); 
        $tuboT1=Tubo::find($pedido->dispoT1); 
        $tuboT415=Tubo::find($pedido->dispoT415); 
        $servicio=Servicio::find($pedido->idServicio); 
        $registro=Registro::where('idPedido','LIKE',$this->mensaje['id'])->first(); 
 
        $formatter = new NumeroALetras();
        $pesos=$formatter->toWords($pedido->garantia);

        $pdf=PDF::loadView('vistaPdfTodo',compact('pedido','equipoER','equipoEA','equipoEY','tuboT1','tuboT415','servicio','registro','pesos'));
        
        $this->pdf=$pdf;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $nombreCliente=$this->mensaje['nombreCliente'];

        
        return $this->view('mails.envioContratoPresupuesto',compact('nombreCliente')) 
        ->to($this->mensaje['email'],$this->mensaje['nombreCliente'])
        ->subject($this->mensaje['asunto']) 
        ->attachData( $this->pdf->output() , 'hhoxigeno.pdf');
       
       
        
    }
} 
