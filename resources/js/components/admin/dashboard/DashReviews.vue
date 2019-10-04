<template>

    <table class="table display dataTable" id="reviewsTable">
        <thead>
        <tr>
            <th>Review Comment</th>
            <th>Ratings</th>
            <th>Campaign Name</th>
            <th>Created Date</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="review in reviews">
            <td>{{review.review_title}}</td>
            <td>{{review.ratings}}</td>
            <td>{{review.brand_title}}</td>
            <td>{{review.created}}</td>
            <td>{{review.action}}</td>
        </tr>
        </tbody>
    </table>

</template>

<script>
    let tkn = $('meta[name="_token"]').attr('content');

    export default {
        name : 'dashboard-reivews',
        data() {
            return {
                reviews: {}
            }
        },

        mounted() {
            console.log('Component mounted.');
            axios.post('/admin/dashboard/getReviewData', {_token: tkn})
                .then(response => {
                    /*console.log(response);
                    console.log(response.data.iTotalRecords);*/
                    this.reviews = response.data.aaData;
                    var tableId = 'reviewsTable';
                    this.paginate(tableId);

                });
        }
        /*created() {
            axios.post('/admin/dashboard/getReviewData', {_token: tkn})
                .then(response => console.log(response));
        }*/

    }
</script>
