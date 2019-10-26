<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use stdClass;
use Dompdf\Dompdf;

use App\Mail\MailtrapExample;
use Illuminate\Support\Facades\Mail;

class ActDocumentController extends Controller
{
    public function save(Request $request)
    {
        $Response = (object) [
            'success' => 0,
            'message' => '',
            'data' => new stdClass()
        ];

        try {
            $data = (object) $request->all();

            if (!empty($data->documentId)) {
                $ActDocument = \App\ActDocument::find($data->documentId);
            } else {
                $ActDocument = new \App\ActDocument();
            }

            $ActDocument->subject = $data->subject;

            if (!$ActDocument->save()) {
                throw new \Exception("Error al guardar", 1);
            }

            $this->bindUsers(
                $request,
                $ActDocument->idact_document,
                $data
            );

            $Response->data->topics = $this->saveTopics(
                $data->topicList,
                $data->topicListDescription,
                $ActDocument->idact_document
            );
            $Response->data->document = [
                'id' => $ActDocument->idact_document,
                'identificator' => $ActDocument->identificator,
                'initialDate' => $ActDocument->created_at->format('Y-m-d H:i:s'),
                'finalDate' => $ActDocument->updated_at->format('Y-m-d H:i:s')
            ];
            $Response->success = 1;
            $Response->message = "Docuento guardado";
        } catch (\Throwable $th) {
            $Response->message = $th->getMessage();
        }

        return json_encode($Response);
    }

    /**
     * vincula los funcionarios al documento
     *
     * @param object $request
     * @param object $documentId
     * @param object $data
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-10-26
     */
    public function bindUsers($request, $documentId, $data)
    {
        //vinculo el creador o responsable
        if (empty($data->documentId)) {
            $this->bindManager($request->user(), $documentId);
        }

        //vinculo los asistentes
        $this->bindAsistants($data->userList, $documentId);

        //vinculo los encargados de aprobar el documento 
        $this->bindRoles($data->roles, $documentId);
    }

    /**
     * asigno el creador o responsable del documento
     *
     * @param object $user
     * @param integer $documentId
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019
     */
    public function bindManager($user, $documentId)
    {
        $ActDocumentUser = new \App\ActDocumentUser();
        $ActDocumentUser->state = 1;
        $ActDocumentUser->user_identification = $user->idfuncionario;
        $ActDocumentUser->relation_type = \App\ActDocumentUser::MANAGER;
        $ActDocumentUser->external = 0;
        $ActDocumentUser->fk_act_document = $documentId;
        $ActDocumentUser->save();
    }

    /**
     * vincula los asistentes
     *
     * @param array $userList
     * @param integer $documentId
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019
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
            $ActDocumentUser->external = $user['externo'];
            $ActDocumentUser->relation_type = \App\ActDocumentUser::ASISTANTS;
            $ActDocumentUser->fk_act_document = $documentId;
            $ActDocumentUser->save();
        }
    }

    /**
     * vincula los encargados de aprobar el documento
     *
     * @param array $roles
     * @param integer $documentId
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019
     */
    public function bindRoles($roles, $documentId)
    {
        \App\ActDocumentUser::where('fk_act_document', $documentId)
            ->where('relation_type', \App\ActDocumentUser::PRESIDENT)
            ->where('state', 1)
            ->update(['state' => 0]);

        if (!empty($roles['president'])) {
            $ActDocumentUser = \App\ActDocumentUser::where('fk_act_document', $documentId)
                ->where('relation_type', \App\ActDocumentUser::PRESIDENT)
                ->where('user_identification', $roles['president']['id'])
                ->first();

            if (!$ActDocumentUser) {
                $ActDocumentUser = new \App\ActDocumentUser();
            }

            $ActDocumentUser->state = 1;
            $ActDocumentUser->user_identification = $roles['president']['id'];
            $ActDocumentUser->external = $roles['president']['externo'];
            $ActDocumentUser->relation_type = \App\ActDocumentUser::PRESIDENT;
            $ActDocumentUser->fk_act_document = $documentId;
            $ActDocumentUser->save();

            unset($ActDocumentUser);
        }

        \App\ActDocumentUser::where('fk_act_document', $documentId)
            ->where('relation_type', \App\ActDocumentUser::SECRETARY)
            ->where('state', 1)
            ->update(['state' => 0]);

        if (!empty($roles['secretary'])) {
            $ActDocumentUser = \App\ActDocumentUser::where('fk_act_document', $documentId)
                ->where('relation_type', \App\ActDocumentUser::SECRETARY)
                ->where('user_identification', $roles['secretary']['id'])
                ->first();

            if (!$ActDocumentUser) {
                $ActDocumentUser = new \App\ActDocumentUser();
            }

            $ActDocumentUser->state = 1;
            $ActDocumentUser->user_identification = $roles['secretary']['id'];
            $ActDocumentUser->external = $roles['secretary']['externo'];
            $ActDocumentUser->relation_type = \App\ActDocumentUser::SECRETARY;
            $ActDocumentUser->fk_act_document = $documentId;
            $ActDocumentUser->save();
        }
    }

    /**
     * guarda los temas del documento
     *
     * @param array $topicList
     * @param array $topicListDescription
     * @param integer $documentId
     * @return array
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019
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
                                        <td>   Es un hecho establecido hace demasiado tiempo que un lector se distraerá con el contenido del texto de un sitio mientras que mira su diseño. El punto de usar Lorem Ipsum es que tiene una distribución más o menos normal de las letras, al contrario de usar textos como por ejemplo "Contenido aquí, contenido aquí". Estos textos hacen parecerlo un español que se puede leer. Muchos paquetes de autoedición y editores de páginas web usan el Lorem Ipsum como su texto por defecto, y al hacer una búsqueda de "Lorem Ipsum" va a dar por resultado muchos sitios web que usan este texto si se encuentran en estado de desarrollo. Muchas versiones han evolucionado a través de los años, algunas veces por accidente, otras veces a propósito (por ejemplo insertándole humor y cosas por el estilo).

                                        </td>
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
                                        <td>
                                        Es un hecho establecido hace demasiado tiempo que un lector se distraerá con el contenido del texto de un sitio mientras que mira su diseño. El punto de usar Lorem Ipsum es que tiene una distribución más o menos normal de las letras, al contrario de usar textos como por ejemplo "Contenido aquí, contenido aquí". Estos textos hacen parecerlo un español que se puede leer. Muchos paquetes de autoedición y editores de páginas web usan el Lorem Ipsum como su texto por defecto, y al hacer una búsqueda de "Lorem Ipsum" va a dar por resultado muchos sitios web que usan este texto si se encuentran en estado de desarrollo. Muchas versiones han evolucionado a través de los años, algunas veces por accidente, otras veces a propósito (por ejemplo insertándole humor y cosas por el estilo).



                                        </td>
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
                                        <td>   Es un hecho establecido hace demasiado tiempo que un lector se distraerá con el contenido del texto de un sitio mientras que mira su diseño. El punto de usar Lorem Ipsum es que tiene una distribución más o menos normal de las letras, al contrario de usar textos como por ejemplo "Contenido aquí, contenido aquí". Estos textos hacen parecerlo un español que se puede leer. Muchos paquetes de autoedición y editores de páginas web usan el Lorem Ipsum como su texto por defecto, y al hacer una búsqueda de "Lorem Ipsum" va a dar por resultado muchos sitios web que usan este texto si se encuentran en estado de desarrollo. Muchas versiones han evolucionado a través de los años, algunas veces por accidente, otras veces a propósito (por ejemplo insertándole humor y cosas por el estilo).

                                        Es un hecho establecido hace demasiado tiempo que un lector se distraerá con el contenido del texto de un sitio mientras que mira su diseño. El punto de usar Lorem Ipsum es que tiene una distribución más o menos normal de las letras, al contrario de usar textos como por ejemplo "Contenido aquí, contenido aquí". Estos textos hacen parecerlo un español que se puede leer. Muchos paquetes de autoedición y editores de páginas web usan el Lorem Ipsum como su texto por defecto, y al hacer una búsqueda de "Lorem Ipsum" va a dar por resultado muchos sitios web que usan este texto si se encuentran en estado de desarrollo. Muchas versiones han evolucionado a través de los años, algunas veces por accidente, otras veces a propósito (por ejemplo insertándole humor y cosas por el estilo).

                                        Es un hecho establecido hace demasiado tiempo que un lector se distraerá con el contenido del texto de un sitio mientras que mira su diseño. El punto de usar Lorem Ipsum es que tiene una distribución más o menos normal de las letras, al contrario de usar textos como por ejemplo "Contenido aquí, contenido aquí". Estos textos hacen parecerlo un español que se puede leer. Muchos paquetes de autoedición y editores de páginas web usan el Lorem Ipsum como su texto por defecto, y al hacer una búsqueda de "Lorem Ipsum" va a dar por resultado muchos sitios web que usan este texto si se encuentran en estado de desarrollo. Muchas versiones han evolucionado a través de los años, algunas veces por accidente, otras veces a propósito (por ejemplo insertándole humor y cosas por el estilo).
                                        </td>
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

    public function sendDocument()
    {
        Mail::to('jhon.valencia@cerok.com')->send(new MailtrapExample());

        return 'A message has been sent to Mailtrap!';
    }
}
