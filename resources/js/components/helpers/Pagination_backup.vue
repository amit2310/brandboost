<template>
    <div class="mt-4" style="width:100%;display:block;" v-if="pagination.total > pagination.per_page">
        <div style="width:80%;float:left;">
            <ul class="pagination">
                <li v-if="pagination.current_page > 1" class="page-item">
                    <a class="page-link" href="javascript:void(0)" aria-label="Previous"
                       @click.prevent="changePage(pagination.current_page - 1)">
                        <span aria-hidden="true">Previous</span>
                    </a>
                </li>
                <li v-for="page in pagesNumber" :class="{'active': page == pagination.current_page}" class="page-item">
                    <a class="page-link" href="javascript:void(0)" @click.prevent="changePage(page)">{{ page }}</a>
                </li>
                <li v-if="pagination.current_page < pagination.last_page" class="page-item">
                    <a class="page-link" href="javascript:void(0)" aria-label="Next"
                       @click.prevent="changePage(pagination.current_page + 1)">
                        <span aria-hidden="true">Next</span>
                    </a>
                </li>
            </ul>
        </div>
        <div style="width:20%;float:right;">
            <span style="margin-left:20px;"><strong>Total Record: {{pagination.total}}</strong></span>
            <span><strong>Page {{pagination.current_page}} of {{pagesNumber.length}}</strong></span>
        </div>

        </div>

</template>

<script>
    export default {
        name: 'pagination',
        props: ['pagination', 'offset'],
        computed: {
            pagesNumber() {
                if (!this.pagination.to) {
                    return [];
                }
                let from = this.pagination.current_page - this.offset;
                if (from < 1) {
                    from = 1;
                }
                let to = from + (this.offset * 2);
                if (to >= this.pagination.last_page) {
                    to = this.pagination.last_page;
                }
                let pagesArray = [];
                for (let page = from; page <= to; page++) {
                    pagesArray.push(page);
                }
                return pagesArray;
            }
        },
        methods: {
            changePage(page) {
                this.pagination.current_page = page;
                this.$emit('paginate', page);
            }
        }
    }
</script>
