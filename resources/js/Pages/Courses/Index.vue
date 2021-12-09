<template>
    <app-layout>
        <template #header>
            Liste des formations
        </template>

         <div class="container alert alert-success" role="alert" v-if="$page.props.flash.success">
           {{ $page.props.flash.success }}
         </div>
        
        <div class="card mt-5" v-for="course in this.courseList" v-bind:key="course.id">
            <div class="card-header course_display_flex">
                <div class="title">{{ course.title }}</div>
                <div> {{ course.episodes_count }} épisodes</div>
            </div>
        
            <div class="card-body">
                <div class="italic"> Mise en ligne par : {{ course.user.name}}
                    - <span> {{ course.participants }} participant<span v-if="parseInt(course.participants) > 1">s</span></span>
                </div>
                <p class="card-text">{{ cut_string(course.description, 0, 150 )}}</p>
                <div style="display: flex; justify-content:space-between">
                    <a :href="'/course/' + course.id" class="btn btn-primary">Détail</a>

                    <a :href="'/courses/edit/' + course.id" v-if="course.update" class="btn btn-secondary">Modifier la formation</a>
                </div>
               

                <!-- <jet-nav-link :href="route('course')" :active="route().current('course')">
                    Formations
                </jet-nav-link> -->
            </div>
        </div>

    </app-layout>
    
</template>

<script>

import AppLayout from '@/Layouts/AppLayout.vue'

export default {
    components: {
            AppLayout,
            
        },

        data() {
            return {
                courseList: this.courses
            }
        },

        props: ['courses'],

        mounted() {
            console.log(this.courses)
        },

        methods: {
            cut_string(string, offset, length) {
                if (string.length <= length) {
                    return string
                } else {
                    return `${string.substring(offset, length)}...`
                }
            }
        }
}
</script>

