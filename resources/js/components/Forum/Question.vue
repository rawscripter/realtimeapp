<template>
    <v-card>
        <v-card-title primary-title>
            <div>
                <h3 class="headline mb-0">
                    <router-link :to='question.path' style="text-decoration: none;color:#5c5a5a">
                        {{question.title}}
                    </router-link>
                </h3>
                <div class="grey--text">{{question.user}} posted {{question.created_at}}</div>
            </div>
        </v-card-title>
        <v-card-text v-html="body">

        </v-card-text>
    </v-card>
</template>

<script>
    export default {
        name: "Question",
        props: ['question'],
        computed:{
            body(){
                return md.parse(this.question.body)
            }
        }
    }

</script>

<style scoped>

</style>