<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use stdClass;
use Dompdf\Dompdf;


class ActDocumentController extends Controller
{
    public function save(Request $request)
    {
        $Response = (object) [
            'success' => 0,
            'message' => '',
            'data' => new stdClass()
        ];

        $data = (object) $request->all();

        if (!empty($data->documentId)) {
            $ActDocument = \App\ActDocument::find($data->documentId);
        } else {
            $ActDocument = new \App\ActDocument();
        }

        $ActDocument->subject = $data->subject;

        if (!$ActDocument->save()) {
            $Response->message = "Error al guardar";
        } else {
            if (empty($data->documentId)) {
                $this->bindManager($request->user(), $ActDocument->idact_document);
            }

            $this->bindAsistants(
                $data->userList,
                $ActDocument->idact_document
            );
            $Response->data->topics = $this->saveTopics(
                $data->topicList,
                $data->topicListDescription,
                $ActDocument->idact_document
            );
            $Response->success = 1;
            $Response->message = "Docuento guardado";
            $Response->data->documentId = $ActDocument->idact_document;
        }

        return json_encode($Response);
    }

    /**
     * asigna el creador del documento
     */
    public function bindManager($user, $documentId)
    {
        $ActDocumentUser = new \App\ActDocumentUser();
        $ActDocumentUser->state = 1;
        $ActDocumentUser->user_identification = $user->ids_user . "-" . 0;
        $ActDocumentUser->relation_type = \App\ActDocumentUser::MANAGER;
        $ActDocumentUser->fk_act_document = $documentId;
        $ActDocumentUser->save();
    }

    /**
     * guarda los asistentes del encuentro
     */
    public function bindAsistants($userList, $documentId)
    {
        \App\ActDocumentUser::where('fk_act_document', $documentId)
            ->where('relation_type', \App\ActDocumentUser::ASISTANTS)
            ->where('state', 1)
            ->update(['state' => 0]);

        foreach ($userList as $user) {
            $ActDocumentUser = \App\ActDocumentUser::where('fk_act_document', $documentId)
                ->where('relation_type', \App\ActDocumentUser::ASISTANTS)
                ->where('user_identification', $user['id'])
                ->first();

            if (!$ActDocumentUser) {
                $ActDocumentUser = new \App\ActDocumentUser();
            }

            $ActDocumentUser->state = 1;
            $ActDocumentUser->user_identification = $user['id'];
            $ActDocumentUser->relation_type = \App\ActDocumentUser::ASISTANTS;
            $ActDocumentUser->fk_act_document = $documentId;
            $ActDocumentUser->save();
        }
    }

    /**
     * guarda los temas del encuentro
     */
    public function saveTopics($topicList, $topicListDescription, $documentId)
    {
        \App\ActDocumentTopic::where('fk_act_document', $documentId)
            ->where('state', 1)
            ->update(['state' => 0]);

        $relations = [];
        foreach ($topicList as $topic) {
            $ActDocumentTopic = \App\ActDocumentTopic::where('idact_document_topic', $topic['id'])
                ->where('fk_act_document', $documentId)
                ->first();

            if (!$ActDocumentTopic) {
                $ActDocumentTopic = new \App\ActDocumentTopic();
            }

            $ActDocumentTopic->state = 1;
            $ActDocumentTopic->name = $topic['label'];
            $ActDocumentTopic->fk_act_document = $documentId;
            $ActDocumentTopic->save();

            $relations[$topic['id']] = $ActDocumentTopic->idact_document_topic;
        }

        foreach ($topicListDescription as $topic) {
            $id = $relations[$topic['topic']];
            $ActDocumentTopic = \App\ActDocumentTopic::find($id);
            $ActDocumentTopic->description = $topic['description'];
            $ActDocumentTopic->save();
        }

        return \App\ActDocumentTopic::where('state', 1)
            ->where('fk_act_document', $documentId)->get();
    }

    public function generatePdf(Request $request)
    {
        $Response = (object) [
            'success' => 0,
            'message' => '',
            'data' => new stdClass()
        ];

        $documentId = $request->input('documentId');
        $Documento = \App\ActDocument::find($documentId);

        $content = <<<HTML
        <html>
            <head>
                <link href="css/app.css" rel="stylesheet">
                <style>
                    /** Define the margins of your page **/
                    @page {
                        margin: 100px 25px;
                    }

                    header {
                        position: fixed;
                        top: -60px;
                        left: 0px;
                        right: 0px;
                        height: 50px;

                        /** Extra personal styles **/
                        background-color: #03a9f4;
                        color: white;
                        text-align: center;
                        line-height: 35px;
                    }

                    footer {
                        position: fixed; 
                        bottom: -60px; 
                        left: 0px; 
                        right: 0px;
                        height: 50px; 

                        /** Extra personal styles **/
                        background-color: #03a9f4;
                        color: white;
                        text-align: center;
                        line-height: 35px;
                    }
                </style>
            </head>
            <body>
                <!-- Define header and footer blocks before your content -->
                <header>
                    encabezado
                </header>

                <footer>
                    Pie de página
                </footer>

                <!-- Wrap the content of your PDF inside a main tag -->
                <main>
                    <div class="container-fluid mx-0 px-0 bg-white">
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-bordered">
                                    <tr>
                                        <td>Acta N°</td>
                                        <td>{$Documento->identification}</td>
                                        <td>Tema / Asunto</td>
                                        <td colspan="3">{$Documento->subject}</td>
                                    </tr>
                                    <tr>
                                        <td>Fecha</td>
                                        <td></td>
                                        <td>Hora Inicio</td>
                                        <td></td>
                                        <td>Hora Final</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Lugar</td>
                                        <td colspan="5"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-bordered">
                                    <tr>
                                        <td class="text-center">Participantes</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Asistentes:
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Invitados:
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-bordered">
                                    <tr>
                                        <td class="text-center">Puntos a Tratar / Orden del día</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-bordered">
                                    <tr>
                                        <td class="text-center">Puntos Tratados / Desarrollo</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-bordered">
                                    <tr>
                                        <td class="text-center">Puntos Tratados / Desarrollo</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-bordered">
                                    <tr>
                                        <td>Elaborado por:</td>
                                        <td>Revisado por:</td>
                                        <td>Aprobado por:</td>
                                    </tr>
                                    <tr>
                                        <td>Cargo:</td>
                                        <td>Cargo:</td>
                                        <td>Cargo:</td>
                                    </tr>
                                    <tr>
                                        <td>Fecha:</td>
                                        <td>Fecha:</td>
                                        <td>Fecha:</td>
                                    </tr>
                                    <tr>
                                        <td>Firma:</td>
                                        <td>Firma:</td>
                                        <td>Firma:</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
            </body>
        </html>     
HTML;

        $dompdf = new Dompdf();
        $dompdf->loadHtml($content);
        $dompdf->render();
        $output = $dompdf->output();

        $directory = "documentos/" . $documentId;
        $fileRoute = "{$directory}/documento.pdf";

        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        $Response->success = file_put_contents($fileRoute, $output);
        $Response->data->route = $fileRoute;

        return json_encode($Response);
    }
}
