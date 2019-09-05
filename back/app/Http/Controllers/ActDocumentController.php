<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActDocumentController extends Controller
{
    public function save(Request $request)
    {
        $Response = (object) [
            'success' => 0,
            'message' => '',
            'data' => null
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
            $Response->success = 1;
            $Response->message = "Docuento guardado";
            $Response->data = $ActDocument->idact_document;
        }

        return json_encode($Response);
    }

    public function bindManager($user, $documentId)
    {
        $ActDocumentUser = new \App\ActDocumentUser();
        $ActDocumentUser->state = 1;
        $ActDocumentUser->user_identification = $user->ids_user . "-" . 0;
        $ActDocumentUser->relation_type = \App\ActDocumentUser::MANAGER;
        $ActDocumentUser->fk_act_document = $documentId;
        $ActDocumentUser->save();
    }

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
}
