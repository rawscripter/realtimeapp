<template>
    <div>
        <h2>Replies From Other users</h2>
        <reply
                v-for="(reply,index) in content"
                :key="reply.id"
                :index="index"
                v-if="content"
                :data="reply">
        </reply>
    </div>
</template>

<script>
    import Reply from "./Reply";

    export default {
        props: ['data'],
        components: {
            Reply
        },
        data() {
            return {
                content: this.data.replies,
                slug: this.data.slug
            }
        },
        created() {
            this.listen();
            this.destroy();
            this.edit();
        },
        methods: {
            listen() {
                EventBus.$on('newReply', (reply) => {
                    this.content.unshift(reply);
                })
                Echo.private('App.User.' + User.id())
                    .notification((notification) => {
                        this.content.unshift(notification.reply);
                    });
            },


            destroy() {
                EventBus.$on('deleteReply', (index) => {
                    axios.delete(`/api/question/${this.slug}/reply/${this.content[index].id}`)
                        .then(res => {
                            this.content.splice(index, 1);
                        })
                        .catch(error => console.log(error.response.data))
                })
            },

            edit() {
                EventBus.$on('editReply', (index) => {
                    // axios.delete(`/api/question/${this.slug}/reply/${this.content[index].id}`)
                    //     .then(res => {
                    //         this.content.splice(index, 1);
                    //     })
                    //     .catch(error => console.log(error.response.data))
                })
            }


        }
    }
</script>

<style scoped>

</style>