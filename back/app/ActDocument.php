<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ActDocumentApprobation;
use App\Http\Controllers\ActDocumentController;

class ActDocument extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'act_document';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idact_document';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'identificator',
        'subject'
    ];

    /**
     * define el identificador del documento
     *
     * @return boolean
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019
     */
    public function approve()
    {
        $route = ActDocumentApprobation::where('fk_act_document', $this->idact_document)
            ->where('state', 1)
            ->get();

        foreach ($route as $key => $ActDocumentApprobation) {
            if (is_null($ActDocumentApprobation->action)) {
                return false;
            }

            if ($ActDocumentApprobation->action == 0) {
                $reject = true;
            }
        }

        if (!isset($reject)) {
            $total = self::where('identificator', '<>', 0)->count();
            $this->identificator = ++$total;

            if (!$this->save()) {
                throw new Exception("Error al actualizar el radicado", 1);
            }
        }

        ActDocumentController::generatePdf($this);

        return true;
    }

    /**
     * obtiene las instancias de los funcionarios
     * encargados de aprobar el documento
     *
     * @return array
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-11-07
     */
    public function getApprobationUsers()
    {
        return User::join(
            'act_document_approbation',
            'funcionario.idfuncionario',
            '=',
            'act_document_approbation.fk_funcionario'
        )
            ->where('act_document_approbation.fk_act_document', $this->idact_document)
            ->where('act_document_approbation.state', 1)
            ->whereNull('act_document_approbation.action')
            ->get();
    }
}
