<template>
  <div>
      <button class="btn btn-success" @click="toggleProgress()">
          
          {{ isWatched ? 'Vue' : 'Terminé ?'}}
        </button>
  </div>
</template>

<script>


export default {

    props: ['episodeId', 'watchedEpisodes'],

    data() {
        return {
            watchedEp: this.watchedEpisodes,
            isWatched: null
        }
    },

    methods: {
        toggleProgress() {
            axios.post('/toggleProgress', {
                episodeId: this.episodeId
            })
            .then(response => {
                if(response.status === 200) {
                    this.isWatched = !this.isWatched;
                    eventBus.emit('toggleProgress', response.data)
                }
                
            })
            .catch(error => console.log(error));
        },

        isWatchedEpisode() {
            return this.watchedEp.find(episode => episode.id === this.episodeId) ? true : false
            // return this.watchedEp.includes()
        }
    },
    mounted() {
        this.isWatched = this.isWatchedEpisode();
    }
}
</script>

<style>

</style>