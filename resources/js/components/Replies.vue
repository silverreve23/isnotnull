<template>
    <div class="replies">
        <section class="section">
            <div class="container">
                <new-reply @created="add"></new-reply>
            </div>
        </section>
        <section class="section">
            <div class="container">
                <div class="reply">
                    <div v-for="(reply, index) in items" :key="reply.id">
                        <reply :data="reply" @deleted="remove(index)" @updated="update(index)"></reply>
                    </div>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="container">
                <paginator :dataSet="dataSet" @changed="fetch"></paginator>
            </div>
        </section>
    </div>
</template>

<script>
    import Reply from './Reply.vue';
    import NewReply from './NewReply.vue';
    import Collection from '../mixins/Collection.js';

    export default {
        components: {Reply, NewReply},
        mixins: [Collection],
        data(){
            return {
                dataSet: []
            };
        },
        created(){
            this.fetch();
        },
        computed: {
            endpoint(){
                return location.pathname + '/replies';
            }
        },
        methods: {
            fetch(page){
                return axios.get(this.url(page)).then(this.refresh);
            },
            url(page = 1){
                return this.endpoint + '?page=' + page;
            },
            refresh({data}){
                this.dataSet = data;
                return this.items = data.data;
            },
            update(index){
                window.flash('Your reply has beed updated!');
            },
        }
    }
</script>
