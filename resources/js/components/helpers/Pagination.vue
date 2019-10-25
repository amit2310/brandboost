<template>
    <div style="width:100%;display:block;">
        <div style="width:80%;float:left;">
            <ul class="pagination">
                <li v-if="pagination.current_page > 1" class="page-item">
                    <a class="page-link" href="javascript:void(0)" aria-label="Previous"
                       v-on:click.prevent="changePage(pagination.current_page - 1)">
                        <span aria-hidden="true">Previous</span>
                    </a>
                </li>
                <li v-for="page in pagesNumber" :class="{'active': page == pagination.current_page}" class="page-item">
                    <a class="page-link" href="javascript:void(0)" v-on:click.prevent="changePage(page)">{{ page }}</a>
                </li>
                <li v-if="pagination.current_page < pagination.last_page" class="page-item">
                    <a class="page-link" href="javascript:void(0)" aria-label="Next"
                       v-on:click.prevent="changePage(pagination.current_page + 1)">
                        <span aria-hidden="true">Next</span>
                    </a>
                </li>
            </ul>
        </div>
        <div style="width:20%;float:right;">
            <span style="margin-left:20px;"><strong>Total Record: {{pagination.total}}</strong></span>
            <span><strong>Page {{pagination.current_page}} of {{pagesNumber.length}}</strong></span>
        </div>



            <!--<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false" style="float:right;">
                Per Page
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="javascript:void(0);"><i class="dripicons-user text-muted mr-2"></i> 5 </a>
                <a class="dropdown-item" href="javascript:void(0);"><i class="dripicons-user text-muted mr-2"></i> 10 </a>
                <a class="dropdown-item" href="javascript:void(0);"><i class="dripicons-user text-muted mr-2"></i> 25 </a>
                <a class="dropdown-item" href="javascript:void(0);"><i class="dripicons-user text-muted mr-2"></i> 50 </a>
                <a class="dropdown-item" href="javascript:void(0);"><i class="dripicons-user text-muted mr-2"></i> 100 </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="http://vue.brandboostx.com/admin/login/logout"><i class="dripicons-exit text-muted mr-2"></i> View All </a>
            </div>-->
        </div>

</template>

<script>
    export default {
        name: 'pagination',
        props: {
            pagination: {
                type: Object,
                required: true
            },
            offset: {
                type: Number,
                default: 4
            }
        },
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
