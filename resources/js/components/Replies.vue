<template>
    <div class="reply">
        <div v-for="(reply, index) in items">
            <reply :data="reply" @deleted="remove(index)" @updated="update(index)"></reply>
        </div>
    </div>
</template>

<script>
    import Reply from './Reply.vue';

    export default {
        props: ['data'],
        components: {Reply},
        data(){
            return {
                items: this.data,
            };
        },
        methods: {
            remove(index){
                this.items.splice(index, 1);
                window.flash('Your reply has beed deleted!');
            },
            remove(index){
                window.flash('Your reply has beed updated!');
            }
        }
    }
</script>
