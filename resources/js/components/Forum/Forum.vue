<template>
    <v-container fluid grid-list-md>
        <v-layout row warp>
            <v-flex xs8>
                <question
                        v-for="question in questions"
                        :key="question.id"
                        :question="question"
                >

                </question>
            </v-flex>
            <v-flex xs4>
                sidebar
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    import Question from './Question'

    export default {
        name: "Forum",
        components: {
            Question,
        },
        data() {
            return {
                questions: {}
            }
        },
        created() {
            axios.get('api/question')
                .then(res => this.questions = res.data.data)
                .catch(error => console.log(error.response.data))
        }
    }
</script>

<style scoped>

</style>