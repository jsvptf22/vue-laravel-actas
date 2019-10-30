<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Http\Controllers\ActDocumentController;
use App\ActDocumentUser;
use App\User;

class DocumentApprobation extends Mailable
{
    use Queueable, SerializesModels;

    public $pdfRoute;
    public $ActDocument;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($ActDocument)
    {
        $this->ActDocument = $ActDocument;
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
        $types = [
            ActDocumentUser::SECRETARY,
            ActDocumentUser::PRESIDENT,
        ];

        $users = User::join(
            'act_document_user',
            'funcionario.idfuncionario',
            '=',
            'act_document_user.user_identification'
        )
            ->where('act_document_user.fk_act_document', $this->ActDocument->idact_document)
            ->whereIn('act_document_user.relation_type', $types)
            ->where('act_document_user.state', 1)
            ->where('act_document_user.external', 0)
            ->get();

        if (!$users) {
            throw new Exception("Se debe definir el secretario y el presidente", 1);
        }

        return $users;
    }
}
