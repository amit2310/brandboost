<template>
    <div class="content" id="masterContainer">
        Widget Overview Content goes here.
    </div>
</template>

<script>
    import UserAvatar from '@/components/helpers/UserAvatar';
    import Pagination from '@/components/helpers/Pagination';

    export default {
        title: 'Widgets Overview - Brand Boost',
        components: {UserAvatar, Pagination},
        data() {
            return {

            }
        },
        mounted() {
            //this.loadPaginatedData();

            console.log('Component mounted')
        },
    }
</script>
