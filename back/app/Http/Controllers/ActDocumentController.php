<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Mail\DocumentApprobation;
use App\ActDocument;
use App\ActDocumentApprobation;
use App\ActDocumentUser;
use App\User;
use stdClass;

class ActDocumentController extends Controller
{
    /**
     * ejecuta el guardado del documento
     *
     * @param Request $request
     * @return object
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019
     */
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
                $ActDocument = ActDocument::find($data->documentId);
            } else {
                $ActDocument = new ActDocument();
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
        $ActDocumentUser = new ActDocumentUser();
        $ActDocumentUser->state = 1;
        $ActDocumentUser->user_identification = $user->idfuncionario;
        $ActDocumentUser->relation_type = ActDocumentUser::MANAGER;
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
        ActDocumentUser::where('fk_act_document', $documentId)
            ->where('relation_type', ActDocumentUser::ASISTANTS)
            ->where('state', 1)
            ->update(['state' => 0]);

        foreach ($userList as $user) {
            $ActDocumentUser = ActDocumentUser::where('fk_act_document', $documentId)
                ->where('relation_type', ActDocumentUser::ASISTANTS)
                ->where('user_identification', $user['id'])
                ->first();

            if (!$ActDocumentUser) {
                $ActDocumentUser = new ActDocumentUser();
            }

            $ActDocumentUser->state = 1;
            $ActDocumentUser->user_identification = $user['id'];
            $ActDocumentUser->external = $user['externo'];
            $ActDocumentUser->relation_type = ActDocumentUser::ASISTANTS;
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
        ActDocumentUser::where('fk_act_document', $documentId)
            ->where('relation_type', ActDocumentUser::PRESIDENT)
            ->where('state', 1)
            ->update(['state' => 0]);

        if (!empty($roles['president'])) {
            $ActDocumentUser = ActDocumentUser::where('fk_act_document', $documentId)
                ->where('relation_type', ActDocumentUser::PRESIDENT)
                ->where('user_identification', $roles['president']['id'])
                ->first();

            if (!$ActDocumentUser) {
                $ActDocumentUser = new ActDocumentUser();
            }

            $ActDocumentUser->state = 1;
            $ActDocumentUser->user_identification = $roles['president']['id'];
            $ActDocumentUser->external = $roles['president']['externo'];
            $ActDocumentUser->relation_type = ActDocumentUser::PRESIDENT;
            $ActDocumentUser->fk_act_document = $documentId;
            $ActDocumentUser->save();

            unset($ActDocumentUser);
        }

        ActDocumentUser::where('fk_act_document', $documentId)
            ->where('relation_type', ActDocumentUser::SECRETARY)
            ->where('state', 1)
            ->update(['state' => 0]);

        if (!empty($roles['secretary'])) {
            $ActDocumentUser = ActDocumentUser::where('fk_act_document', $documentId)
                ->where('relation_type', ActDocumentUser::SECRETARY)
                ->where('user_identification', $roles['secretary']['id'])
                ->first();

            if (!$ActDocumentUser) {
                $ActDocumentUser = new ActDocumentUser();
            }

            $ActDocumentUser->state = 1;
            $ActDocumentUser->user_identification = $roles['secretary']['id'];
            $ActDocumentUser->external = $roles['secretary']['externo'];
            $ActDocumentUser->relation_type = ActDocumentUser::SECRETARY;
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

    /**
     * genera el pdf del documento
     *
     * @param object $ActDocument
     * @return object
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-10-26
     */
    public static function generatePdf($ActDocument)
    {
        $Response = (object) [
            'success' => 0,
            'message' => '',
            'data' => new stdClass()
        ];

        try {
            $documentId = $ActDocument->idact_document;
            $fileRoute = "documentos/{$documentId}/documento.pdf";
            $pdf = PDF::loadView('documentTemplate', ['ActDocument' => $ActDocument]);
            $content = $pdf->output();

            if (!Storage::disk('local')->put($fileRoute, $content)) {
                throw new \Exception("Error al generar el pdf", 1);
            }

            $Response->success = 1;
            $Response->data = $fileRoute;
        } catch (\Throwable $th) {
            $Response->message = $th->getMessage();
        }

        return $Response;
    }

    /**
     * genera los registros de la ruta de aprobacion
     *
     * @param object $ActDocument
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-11-06
     */
    public function defineApprobationUsers($ActDocument)
    {
        ActDocumentApprobation::where('fk_act_document', $ActDocument->idact_document)
            ->where('state', 1)
            ->update(['state' => 0]);

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
            ->where('act_document_user.fk_act_document', $ActDocument->idact_document)
            ->whereIn('act_document_user.relation_type', $types)
            ->where('act_document_user.state', 1)
            ->where('act_document_user.external', 0)
            ->get();

        foreach ($users as $User) {
            $ActDocumentApprobation = new ActDocumentApprobation();
            $ActDocumentApprobation->fk_funcionario = $User->idfuncionario;
            $ActDocumentApprobation->fk_act_document = $ActDocument->idact_document;
            $ActDocumentApprobation->state = 1;

            if (!$ActDocumentApprobation->save()) {
                throw new \Exception("Error al generar la ruta de aprobacion", 1);
            }
        }
    }

    /**
     * envia el documento en pdf para su aprobacion
     *
     * @param Request $request
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-10-26
     */
    public function sendDocument(Request $request)
    {
        $request->validate([
            'documentId' => 'required|integer'
        ]);

        $Response = (object) [
            'success' => 0,
            'message' => '',
            'data' => new stdClass()
        ];

        try {
            $documentId = $request->input('documentId');
            $route = $request->input('route');

            $ActDocument = ActDocument::find($documentId);
            $this->defineApprobationUsers($ActDocument);

            $DocumentApprobation = new DocumentApprobation(
                $ActDocument,
                $route
            );
            Mail::send($DocumentApprobation);

            $Response->success = 1;
            $Response->message = "Documento enviado por correo";
        } catch (\Throwable $th) {
            $Response->message = $th->getMessage();
        }

        return json_encode($Response);
    }

    public function approve(Request $request)
    {
        $request->validate([
            'user' => 'required|string',
            'password' => 'required|string',
            'documentId' => 'required|integer',
            'approve' => 'required|integer'
        ]);

        $Response = (object) [
            'success' => 0,
            'message' => '',
            'data' => new stdClass()
        ];

        try {
            $user = $request->input('user');
            $password = $request->input('password');
            $documentId = $request->input('documentId');
            $approve = $request->input('approve');

            $Client = new \GuzzleHttp\Client();
            $clientRequest = $Client->request('POST', env('SAIA_APP_FOLDER') . 'funcionario/login.php', [
                'form_params' => [
                    'externalAccess' => 1,
                    'user' => $user,
                    'password' => $password
                ]
            ]);

            $response = json_decode($clientRequest->getBody());

            if (!$response->success) {
                throw new \Exception("Credenciales incorrectas", 1);
            }

            $ActDocument = ActDocument::find($documentId);
        } catch (\Throwable $th) {
            $Response->message = $th->getMessage();
        }

        return json_encode($Response);
    }
}
