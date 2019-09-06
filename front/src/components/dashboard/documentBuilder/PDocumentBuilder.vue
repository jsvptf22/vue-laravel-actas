<template>
  <div>
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
      <div class="col">
        <div class="template p-5">
          <div class="row-fluid mb-5">
            <div class="col-12 text-center p-3">
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut maiores libero officiis, maxime ut esse necessitatibus distinctio ad dolorem reprehenderit obcaecati ratione eum commodi! Modi possimus consequuntur aliquid rerum beatae!</p>
            </div>
          </div>
          <div class="row-fluid">
            <div class="col-12 p-3">
              <div class="row">
                <div class="col-12">id: {{documentInformation.documentId}}</div>
              </div>
              <div class="row py-4" id="userListTemplate" v-if="documentInformation.userList">
                <div class="col-12">
                  <ul>
                    <li
                      v-for="user of documentInformation.userList"
                      v-bind:key="user.id"
                    >{{user.complete_name}}</li>
                  </ul>
                </div>
              </div>
              <div class="row py-4" id="subjectTemplate" v-if="documentInformation.subject">
                <div class="col-12">
                  <span>Asunto :{{ documentInformation.subject }}</span>
                </div>
              </div>
              <div
                class="row py-4"
                id="topicListTempalte"
                v-if="documentInformation.topicList.length"
              >
                <div class="col-12">
                  Listado de temas
                  <ul>
                    <li
                      v-for="topic of documentInformation.topicList"
                      v-bind:key="topic.id"
                    >{{topic.label}}</li>
                  </ul>
                </div>
              </div>

              <div
                class="row py-4"
                id="topicDescriptionTempalte"
                v-if="documentInformation.topicListDescription.length"
              >
                <div class="col-12">
                  Listado de temas
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
                </div>
              </div>
              <!--<textarea class="form-control" rows="10"></textarea>-->
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

const axios = require("axios");

export default {
  name: "PDocumentBuilder",
  methods: {
    saveData() {
      const ENVDATA = process.env;

      axios
        .request({
          url: `${ENVDATA.VUE_APP_MODULE_API_ROUTE}document/save`,
          method: "post",
          responseType: "json",
          data: this.documentInformation,
          headers: {
            Authorization: this.$session.get("token")
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
        documentId: data.documentId,
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
  height: 100%;
}
</style>