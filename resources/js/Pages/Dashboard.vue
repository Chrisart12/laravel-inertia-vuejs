<template>
  <app-layout title="Dashboard">
    <template #header>
      <h2 class="h4 font-weight-bold">
        Dashboard
      </h2>

      
    </template>

    <!-- <welcome /> -->
  </app-layout>

    
  <div class="container card">
    <div class="container alert alert-success" role="alert" v-if="$page.props.flash.success">
      {{ $page.props.flash.success }}
    </div>
      <div class="card-header">
        <h4>Créer des formations</h4>
      </div>
      <div class="card-body">
          <form @submit.prevent="submit">
              <div class="mb-3">
                <label for="title" class="form-label">Titre de la formation</label>
                <input type="text" class="form-control" id="title" v-model="form.title">
                <div class="errors" v-if="$page.props.errors.title">{{ $page.props.errors.title }} </div>
              </div>
              <div class="mb-3">
                <label for="description" class="form-label">Description de la formation</label>
                <textarea class="form-control" id="description" v-model="form.description"></textarea>
                <div class="errors" v-if="$page.props.errors.description">{{ $page.props.errors.description}} </div>
              </div>
              <div class="mb-4">
                  <h2>Episode de la formation</h2>

                    <div v-for="(episode, index) in form.episodes" v-bind:key="index">
                        <div class="mb-4" :class="{separator_line: form.episodes.length > 1  && (form.episodes.length - 1 != index )}">
                            <div class="form-group">  
                                <label :for="'title-'+index" class="form-label">Titre de l'épisode {{ index + 1 }}</label>
                                <input type="text" class="form-control" :id="'title-'+index" v-model="form.episodes[index].title">
                                  <div class="errors" v-if="$page.props.errors['episodes.' + index + '.title']">
                                    {{ $page.props.errors['episodes.' + index + '.title'] }} 
                                  </div>
                            </div>
                            <div class="form-group"> 
                                <label :for="'description-'+index" class="form-label">Description de l'épisode {{ index + 1 }}</label>
                                <input type="text" class="form-control" :id="'description-'+index" v-model="form.episodes[index].description">
                                <div class="errors" v-if="$page.props.errors['episodes.' + index + '.description']">
                                    {{ $page.props.errors['episodes.' + index + '.description'] }} 
                                </div>
                            </div>
                            <div class="form-group">
                                <label :for="'video_url-'+index" class="form-label">Vidéo de l'épisode {{ index + 1 }}</label>
                                <input type="text" class="form-control" :id="'video_url-'+index" v-model="form.episodes[index].video_url">
                                <div class="errors" v-if="$page.props.errors['episodes.' + index + '.video_url']">
                                    {{ $page.props.errors['episodes.' + index + '.video_url'] }} 
                                </div>
                            </div>
                        </div>
                    </div>
              </div>

              <div class="mb-4">
                  <button type="button" class="btn pink_color me-4" v-if="form.episodes.length < 5" @click="add">+</button>
                  <button type="button" class="btn pink_color" v-if="form.episodes.length >= 2" @click="subtract">-</button>
              </div>
              
              <button type="submit" class="btn btn-primary">Créer ma formation</button>
          </form>
      </div>
  </div>
  
</template>

<script>
import { defineComponent } from "vue"
import AppLayout from "@/Layouts/AppLayout.vue"
// import Welcome from "@/Jetstream/Welcome.vue"

export default defineComponent({
  components: {
    AppLayout,

  },

  // props: {
  //   // errors: Object,
  // },

    data() {
      return {
        form: {
          title: null,
          description: null,
          episodes: [
            { title: null, description: null, video_url: null}
          ]
        },
      }
    },
    methods: {
      submit() {
        this.$inertia.post('/courses', this.form)
      },

      add() {
        this.form.episodes.push({ title: null, description: null, video_url: null})
      },

      subtract() {
        this.form.episodes.pop()
      }
    },
});
</script>
