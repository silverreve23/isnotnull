<template>
    <nav v-if="shouldPaginate" class="p-2 pagination is-rounded" role="navigation" aria-label="pagination">
      <a @click="page--" v-show="prevUrl" class="pagination-previous" rel="next">Previous</a>
      <a @click="page++" v-show="nextUrl" class="pagination-next" rel="prev">Next page</a>
    </nav>
</template>
<script>
    export default {
        props: ['dataSet'],
        data(){
            return {
                page: 1,
                prevUrl: false,
                nextUrl: false,
            };
        },
        computed: {
            shouldPaginate(){
                return !!(this.prevUrl || this.nextUrl);
            }
        },
        watch: {
            dataSet(){
                this.page = this.dataSet.current_page;
                this.prevUrl = this.dataSet.prev_page_url;
                this.nextUrl = this.dataSet.next_page_url;
            },
            page(){
                this.broadcast();
            }
        },
        methods: {
            broadcast(){
                this.$emit('changed', this.page);
            }
        }
    }
</script>
