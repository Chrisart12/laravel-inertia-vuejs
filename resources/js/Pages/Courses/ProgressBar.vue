<template>
   <div class="progress mt-3">
        <div class="progress-bar bg-success" role="progressbar" :style="`width:${percentage}%`"
        aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">{{ percentage }} %</div>
    </div>
</template>

<script>



export default {

    props: ['watchedEpisodes', 'episodes'],

    data() {
        return {
            watchedEpisodesData: this.watchedEpisodes
        }
    },

    computed: {
        percentage() {
            let filteredEp = this.episodes.filter(courseEp => {
                return this.watchedEpisodesData.find(watchedEp => {
                    return watchedEp.id === courseEp.id
                })
            });

            return Math.round(filteredEp.length * 100 / this.episodes.length)
    
        }
    },

  
    mounted() {
    
        eventBus.on('toggleProgress', data => this.watchedEpisodesData = data);
    }

}
</script>

<style>

</style>