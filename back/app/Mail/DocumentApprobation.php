<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Http\Controllers\ActDocumentController;
use App\User;

class DocumentApprobation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * almacena el enlace que usuario
     * abrira para aprobar o rechazar
     *
     * @var string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-11-04
     */
    public $viewRoute;

    /**
     * almacena la ruta del pdf
     *
     * @var string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-11-04
     */
    public $pdfRoute;

    /**
     * almacena la instancia del documento
     *
     * @var object
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-11-04
     */
    public $ActDocument;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($ActDocument, $viewRoute)
    {
        $this->ActDocument = $ActDocument;
        $this->viewRoute = $viewRoute;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->to($this->getDestinations())
            ->view('mails.documentApprobation')
            ->attachFromStorageDisk('local', $this->getPdfRoute());
    }

    /**
     * obtiene la ruta del pdf
     * en caso de no estar definida lo genera
     *
     * @return string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-10-28
     */
    public function getPdfRoute()
    {
        if (!$this->pdfRoute) {
            $data = ActDocumentController::generatePdf($this->ActDocument);

            if (!$data->success) {
                throw new \Exception($data->message, 1);
            }

            $this->pdfRoute = $data->data;
        }

        return $this->pdfRoute;
    }

    /**
     * obtiene la instancia de los usuarios
     * vinculados como secretario y presidente
     *
     * @return array
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-10-28
     */
    public function getDestinations()
    {
        $users = User::join(
            'act_document_approbation',
            'funcionario.idfuncionario',
            '=',
            'act_document_approbation.fk_funcionario'
        )
            ->where('act_document_approbation.fk_act_document', $this->ActDocument->idact_document)
            ->where('act_document_approbation.state', 1)
            ->whereNull('act_document_approbation.action')
            ->get();

        if (!$users) {
            throw new Exception("Se debe definir el secretario y el presidente", 1);
        }

        return $users;
    }
}
