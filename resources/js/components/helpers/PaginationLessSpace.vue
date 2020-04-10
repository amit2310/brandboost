<template>
    <!--<div v-if="pagination.total > pagination.per_page">-->
    <div>
        <!--<div v-if="lessSpace" class="sidebar_pagination">-->
        <div class="sidebar_pagination">
            <div class="col-md-4 white_bkg shadow3 left">
                <i class="ri-file-list-2-line float-left dark_200"></i>
                <select v-model="pagination.per_page" v-on:click.prevent="changeItemsPerPage()">
                    <option>5</option>
                    <option>10</option>
                    <option>15</option>
                    <option>20</option>
                    <option>50</option>
                    <option>100</option>
                    <option>All</option>
                </select>
            </div>
            <div class="col-md-8 white_bkg shadow3 right custom_pagination">
                <ul class="page_list float-right">
                    <li v-if="pagination.current_page > 1"><a href="javascript:void(0);" v-on:click.prevent="changePage(pagination.current_page - 1)"><img src="assets/images/arrow-right-s-line.svg"></a></li>
                    <li v-for="(page, key) in pagesNumber" :key="key"><a :class="{'active': page == pagination.current_page}" href="javascript:void(0);" v-on:click.prevent="changePage(page)">{{ page }}</a></li>
                    <li v-if="pagination.current_page < pagination.last_page"><a href="javascript:void(0);" v-on:click.prevent="changePage(pagination.current_page + 1)"><img src="assets/images/arrow-left-s-line.svg"></a></li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'pagination',
        props: ['pagination', 'offset', 'lessSpace'],
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
            },
            changeItemsPerPage(page) {
                this.$emit('paginate_per_page', this.pagination.per_page);
            }
        }
    }
</script>
