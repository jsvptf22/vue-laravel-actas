<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title></title>
    <!--<link href="css/app.css" rel="stylesheet">-->
</head>

<body>
    <div class="container">
        <div class="row-fluid mb-5">
            <div class="col-12 text-center p-3">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut maiores libero officiis, maxime ut esse necessitatibus distinctio ad dolorem reprehenderit obcaecati ratione eum commodi! Modi possimus consequuntur aliquid rerum beatae!</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered">
                    <tr>
                        <td>Acta N°</td>
                        <td>{{$ActDocument->identificator}}</td>
                        <td>Tema / Asunto</td>
                        <td colspan="3">{$ActDocument->subject}}</td>
                    </tr>
                    <tr>
                        <td>Fecha</td>
                        <td>{getInitialDate()}</td>
                        <td>Hora Inicio</td>
                        <td>{getInitialTime()}</td>
                        <td>Hora Final</td>
                        <td>{getFinaltime()}</td>
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
                            <span v-for="user of getAssistants()" v-bind:key="user.id">{user.nombre_completo},&nbsp;&nbsp;</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Invitados:
                            <span v-for="user of getInvited()" v-bind:key="user.id">{user.nombre_completo},&nbsp;&nbsp;</span>
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
                        <td>
                            <ul>
                                <li v-for="topic of documentInformation.topicList" v-bind:key="topic.id">{topic.label}</li>
                            </ul>
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
                            <ul>
                                <li v-for="item of documentInformation.topicListDescription" v-bind:key="item.id">
                                    <span>{getTopicLabel(item.topic)}</span>
                                    <br />
                                    <p>{item.description}</p>
                                </li>
                            </ul>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered">
                    <tr>
                        <td class="firm_square">
                            Revisado por:
                            <span v-if="documentInformation.roles.secretary">{documentInformation.roles.secretary.nombre_completo}</span>
                        </td>
                        <td class="firm_square">
                            Aprobado por:
                            <span v-if="documentInformation.roles.president">{documentInformation.roles.president.nombre_completo}</span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row-fluid mt-5">
            <div class="col-12 text-center p-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt eveniet excepturi accusantium corrupti quae, sapiente aperiam quam vitae error quibusdam atque, at, iusto perferendis quas debitis quia voluptas nisi suscipit?</div>
        </div>
    </div>
</body>

</html>