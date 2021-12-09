<template>
    <app-layout>
        <template #header>
            {{ course.title}}
        </template>
        
        <div class="card mt-5">
            <div class="card-header course_display_flex">
                <div class="title">{{ this.courseShow.title }}</div>
                
            </div>
            <div class="card-body">
                 <div> {{ this.courseShow.description }}</div>
                 <div> {{ this.courseShow.episodes[this.currentKey].video_url }}</div>
                 <div> {{ this.courseShow.episodes[this.currentKey].description }}</div>
               <iframe width="560" height="315" :src="this.courseShow.episodes[this.currentKey].video_url" 
                title="YouTube video player" frameborder="0" 
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                allowfullscreen>
               </iframe>

                <progress-bar :watched-episodes="watched" :episodes="course.episodes"/>

                <div class="mt-5">
                    <ul v-for="(episode, index) in this.courseShow.episodes" v-bind:key="episode.id">
                        <li class="mt-3" style="display:flex; justify-content:space-between;">
                            <div>
                                Episode n°{{ index + 1 }} - {{ episode.title }}  
                                <button class="btn btn-primary" @click="switchEpisode(index)">
                                    Voir l'épisode
                                </button>
                            </div>

                            <progress-button :episode-id="episode.id" :watched-episodes="watched"/>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </app-layout>
    
</template>

<script>

import AppLayout from '@/Layouts/AppLayout.vue';
import ProgressButton from '@/Pages/Courses/ProgressButton.vue';
import ProgressBar from '@/Pages/Courses/ProgressBar.vue'

export default {
    components: {
            AppLayout,
            ProgressButton,
            ProgressBar 
        },

        props: ['course', 'watched'],

        data() {
            return {
                courseShow: this.course,
                currentKey: 0,
                // percentageWatched: this.episodePercentageWatched(),
            }
        },

        methods: {
            switchEpisode(index) {
                this.currentKey = index;

                window.scrollTo({
                    top: 0,
                    left: 0,
                    behavior: 'smooth'
                })
            },


        },

       
}
</script>

