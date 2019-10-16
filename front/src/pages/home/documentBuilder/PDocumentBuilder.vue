<template>
  <div id="component_container">
    <div class="row">
      <div class="col-auto">
        <div class="row">
          <div class="col-12">
            <div class="btn-group-vertical mr-2" role="group" aria-label="First group">
              <button
                type="button"
                class="btn btn-secondary"
                v-on:click="showModal(1)"
              >Validar asistentes</button>
              <button type="button" class="btn btn-secondary" v-on:click="showModal(2)">Crear asunto</button>
              <button type="button" class="btn btn-secondary" v-on:click="showModal(3)">Crear temas</button>
              <button
                type="button"
                class="btn btn-secondary"
                v-on:click="showModal(4)"
              >Desarrollo de tema</button>
            </div>
          </div>
        </div>
        <div class="row pt-3">
          <div class="col-12">
            <button class="btn btn-primary btn-block" v-on:click="saveData">Guardar datos</button>
          </div>
        </div>
      </div>
      <div class="col" id="template_parent">
        <div class="template p-5">
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
                  <td>{{documentInformation.documentId}}</td>
                  <td>Tema / Asunto</td>
                  <td colspan="3">{{documentInformation.subject}}</td>
                </tr>
                <tr>
                  <td>Fecha</td>
                  <td>{{documentInformation.initialDate}}</td>
                  <td>Hora Inicio</td>
                  <td></td>
                  <td>Hora Final</td>
                  <td>{{documentInformation.finalDate}}</td>
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
                    <span
                      v-for="user of getAssistants()"
                      v-bind:key="user.id"
                    >{{user.nombre_completo}},&nbsp;&nbsp;</span>
                  </td>
                </tr>
                <tr>
                  <td>
                    Invitados:
                    <span
                      v-for="user of getInvited()"
                      v-bind:key="user.id"
                    >{{user.nombre_completo}},&nbsp;&nbsp;</span>
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
                      <li
                        v-for="topic of documentInformation.topicList"
                        v-bind:key="topic.id"
                      >{{topic.label}}</li>
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
                      <li
                        v-for="item of documentInformation.topicListDescription"
                        v-bind:key="item.id"
                      >
                        <span>{{getTopicLabel(item.topic)}}</span>
                        <br />
                        <p>{{item.description}}</p>
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
                  <td class="firm_square">Elaborado por:</td>
                  <td class="firm_square">Revisado por:</td>
                  <td class="firm_square">Aprobado por:</td>
                </tr>
              </table>
            </div>
          </div>
          <div class="row-fluid mt-5">
            <div
              class="col-12 text-center p-3"
            >Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt eveniet excepturi accusantium corrupti quae, sapiente aperiam quam vitae error quibusdam atque, at, iusto perferendis quas debitis quia voluptas nisi suscipit?</div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <b-modal id="componentModal" ref="modal" v-bind:title="documentInformation.modalTitle">
          <template slot="default">
            <router-view></router-view>
          </template>
          <template slot="modal-footer" slot-scope="{ ok }">
            <b-button size="sm" variant="primary" @click="ok()">Ver documento</b-button>
          </template>
        </b-modal>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState } from "vuex";

export default {
  name: "PDocumentBuilder",
  methods: {
    saveData() {
      this.$http
        .request({
          url: `${process.env.VUE_APP_MODULE_API_ROUTE}document/save`,
          method: "post",
          responseType: "json",
          data: this.documentInformation,
          headers: {
            Authorization: this.$session.get("apiToken")
          }
        })
        .then(response => {
          if (response.data.success) {
            this.updateData(response.data.data);
          } else {
            alert("Error al guardar");
          }
        })
        .catch(response => {
          alert(response.message);
        });
    },
    updateData(data) {
      let newData = {
        documentId: data.document.documentId,
        identificator: data.document.identificator,
        initialDate: data.document.initialDate,
        finalDate: data.document.finalDate,
        topicList: [],
        topicListDescription: []
      };

      data.topics.forEach(t => {
        newData.topicList.push({
          id: t.idact_document_topic,
          label: t.name
        });

        if (t.description) {
          newData.topicListDescription.push({
            topic: t.idact_document_topic,
            description: t.description
          });
        }
      });

      this.$store.commit("refreshDocumentInformation", newData);
    },
    showModal(type) {
      switch (type) {
        case 1:
          this.$router.push("/users");
          break;
        case 2:
          this.$router.push("/subject");
          break;
        case 3:
          this.$router.push("/topics");
          break;
        case 4:
          this.$router.push("/topic");
          break;
      }
      this.$bvModal.show("componentModal");
    },
    getTopicLabel(topicId) {
      return this.documentInformation.topicList.find(i => i.id == topicId)
        .label;
    },
    getAssistants() {
      return this.documentInformation.userList.filter(u => u.externo == 0);
    },
    getInvited() {
      return this.documentInformation.userList.filter(u => u.externo == 1);
    }
  },
  computed: mapState(["documentInformation"])
};
</script>

<style>
.template {
  border: 1px solid #cacaca;
  margin-bottom: 8px;
  box-shadow: 2px 2px 8px #c6c6c6;
}

#template_parent {
  height: 100vh;
  overflow-y: auto;
}

.firm_square {
  height: 150px;
}
</style>